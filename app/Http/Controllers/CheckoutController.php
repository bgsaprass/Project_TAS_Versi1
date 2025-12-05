<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;


class CheckoutController extends Controller
{
    public function index()
    {
       $user = Auth::user();

if (! $user) {
    return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
}


        // 1) Jika ada selected checkout di session (opsional, dari UI lama)
        if (session('checkout_items')) {
            $cart = session('checkout_items'); // array dari session (legacy)
            return view('pages.checkout', compact('cart'));
        }

        // 2) Jika ada direct checkout di session (opsional)
        $data = session('checkout.direct');
        if ($data) {
            $product = Product::find($data['product_id']);
            if (!$product) {
                return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan.');
            }

            $quantity = min($data['quantity'], $product->stock ?? $data['quantity']);
            return view('pages.checkout', [
                'product' => $product,
                'quantity' => $quantity,
                'total' => ($product->price ?? 0) * $quantity,
            ]);
        }

        // 3) Default: ambil dari database cart
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $items = $cart->items()->with('product')->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada produk untuk checkout.');
        }

        // Bentuk struktur yang kompatibel dengan view lama (array asosiatif)
        $cartArray = [];
        foreach ($items as $item) {
            if (!$item->product) continue;
            $cartArray[$item->product_id] = [
                'product_id' => $item->product_id,
                'name' => $item->product->name,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'image' => $item->product->image ?? null,
            ];
        }

        return view('pages.checkout', ['cart' => $cartArray]);
    }

    public function direct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = (int) $request->input('quantity', 1);

        // Validasi terhadap stok (gunakan kolom yang ada di Products)
        $maxStock = $product->stock ?? $product->remaining_stock ?? null;
        if ($maxStock !== null && $maxStock < 1) {
            return back()->with('error', 'Stok produk habis.');
        }
        if ($maxStock !== null) {
            $quantity = min($quantity, $maxStock);
        }

        // Simpan ke session untuk flow direct checkout (dipakai di index)
        session()->put('checkout.direct', [
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        return redirect()->route('checkout');
    }

    public function process(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'postcode' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'payment_method' => 'required',
        ]);

        $user = Auth::user();

        // Tentukan sumber item: 1) selected session, 2) direct session, 3) database cart
        $items = session('checkout_items');

        if (!$items && session('checkout.direct')) {
            $data = session('checkout.direct');
            $product = Product::find($data['product_id']);

            if (!$product) {
                return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan.');
            }

            $qty = (int) $data['quantity'];
            // Validasi stok
            $maxStock = $product->stock ?? $product->remaining_stock ?? null;
            if ($maxStock !== null && $qty > $maxStock) {
                return back()->with('error', 'Stok tidak mencukupi.');
            }

            // Bentuk struktur item kompatibel dengan proses lama
            $items = [
                $product->id => [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $qty,
                ]
            ];
        }

        if (!$items) {
            // Ambil dari database cart
            $cart = Cart::firstOrCreate(['user_id' => $user->id]);
            $dbItems = $cart->items()->with('product')->get();

            if ($dbItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Tidak ada produk untuk checkout.');
            }

            $items = [];
            foreach ($dbItems as $item) {
                if (!$item->product) continue;
                $items[$item->product_id] = [
                    'product_id' => $item->product_id,
                    'name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ];
            }
        }

        DB::beginTransaction();
        try {
            // Hitung subtotal dari items
            $subtotal = 0;
            foreach ($items as $id => $it) {
                $qty = (int) ($it['quantity'] ?? 1);
                $price = (float) ($it['price'] ?? 0);
                $subtotal += $price * $qty;
            }

            $shippingCost = 10000; // ongkir flat (sesuaikan kebutuhan)
            $total = $subtotal + $shippingCost;

            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'status' => $request->payment_method === 'cod' ? 'pending' : 'paid',
                'shipping_status' => 'pending',
                'address_id' => $request->address_id ?? null,
            ]);

            // Simpan item pesanan dan kurangi stok
            foreach ($items as $id => $it) {
                $qty = (int) ($it['quantity'] ?? 1);
                $price = (float) ($it['price'] ?? 0);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $it['product_id'] ?? $id,
                    'name' => $it['name'] ?? '',
                    'price' => $price,
                    'quantity' => $qty,
                ]);

                // Kurangi stok pada kolom yang valid
                $prod = Product::find($it['product_id'] ?? $id);
                if ($prod) {
                    if (isset($prod->stock)) {
                        $prod->stock = max(0, $prod->stock - $qty);
                    } elseif (isset($prod->remaining_stock)) {
                        $prod->remaining_stock = max(0, $prod->remaining_stock - $qty);
                    }
                    $prod->save();
                }
            }

            // Bersihkan keranjang: hapus item di DB, bersihkan session terkait checkout
            session()->forget('checkout.direct');
            session()->forget('checkout_items');
            session()->forget('cart'); // legacy, aman untuk dibersihkan

            $userCart = Cart::firstOrCreate(['user_id' => $user->id]);
            $userCart->items()->delete(); // kosongkan item, JANGAN hapus baris cart-nya

            DB::commit();
            return redirect()->route('orders')->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat membuat pesanan.');
        }
    }

    public function checkoutSelected(Request $request)
    {
        // Flow lama: memilih sebagian item dari session cart (opsional)
        $selectedIds = $request->input('selected', []);
        $cart = session('cart', []);
        $selectedItems = [];

        foreach ($selectedIds as $id) {
            if (isset($cart[$id])) {
                $selectedItems[$id] = $cart[$id];
            }
        }

        if (empty($selectedItems)) {
            return back()->with('error', 'Pilih minimal satu produk untuk checkout.');
        }

        session(['checkout_items' => $selectedItems]);

        return redirect()->route('checkout');
    }
}
