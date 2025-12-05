<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;

class CheckoutController extends Controller
{
    /**
     * Checkout page: builds the cart payload for the view
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 1) Legacy: selected checkout items from session
        if (session('checkout_items')) {
            $cart = session('checkout_items'); // associative array
            return view('pages.checkout', compact('cart'));
        }

        // 2) Legacy: direct checkout (single product) from session
        $data = session('checkout.direct');
        if ($data) {
            $product = Product::find($data['product_id']);
            if (!$product) {
                return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan.');
            }

            $quantity = (int) $data['quantity'];
            $maxStock = $product->stock ?? $product->remaining_stock ?? null;
            if ($maxStock !== null) {
                $quantity = min($quantity, max(0, $maxStock));
            }

            return view('pages.checkout', [
                'product'  => $product,
                'quantity' => $quantity,
                'total'    => ($product->price ?? 0) * $quantity,
            ]);
        }

        // 3) Default: pull items from database cart
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $items = $cart->items()->with('product')->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada produk untuk checkout.');
        }

        // Build array compatible with legacy checkout view
        $cartArray = [];
        foreach ($items as $item) {
            if (!$item->product) continue;
            $cartArray[$item->product_id] = [
                'product_id' => $item->product_id,
                'name'       => $item->product->name,
                'price'      => $item->product->price,
                'quantity'   => $item->quantity,
                'image'      => $item->product->image ?? null,
            ];
        }

        return view('pages.checkout', ['cart' => $cartArray]);
    }

    /**
     * Direct checkout entry-point: stores product+qty to session then redirects to checkout
     */
    public function direct(Request $request, $id)
    {
        $product  = Product::findOrFail($id);
        $quantity = (int) $request->input('quantity', 1);

        $maxStock = $product->stock ?? $product->remaining_stock ?? null;
        if ($maxStock !== null && $maxStock < 1) {
            return back()->with('error', 'Stok produk habis.');
        }
        if ($maxStock !== null) {
            $quantity = min($quantity, $maxStock);
        }

        session()->put('checkout.direct', [
            'product_id' => $product->id,
            'quantity'   => $quantity,
        ]);

        return redirect()->route('checkout');
    }

    /**
     * Process: validates minimal fields, stores address_id, redirects to chosen payment page
     */
    public function process(Request $request)
    {
        $request->validate([
            'address_id'     => 'required',
            'payment_method' => 'required|in:bank,cod,ewallet',
        ]);

        // Keep address_id in session for finalize step
        session(['checkout.address_id' => $request->address_id]);

        // If no legacy selected items cached, ensure items are present by caching now from cart/direct
        if (!session('checkout_items')) {
            $items = $this->buildCheckoutItemsFromSources(Auth::user());
            if (empty($items)) {
                return redirect()->route('cart.index')->with('error', 'Tidak ada produk untuk checkout.');
            }
            session(['checkout_items' => $items]);
        }

        // Redirect to specific payment page
        $method = $request->input('payment_method');
        return redirect()->route('checkout.' . $method);
    }

    /**
     * Finalize: actually creates order + order items, updates stock, clears cart/session
     */
    public function finalize(Request $request)
    {
        $user       = Auth::user();
        $addressId  = session('checkout.address_id');
        $method     = $request->input('payment_method'); // hidden input from payment page
        $items      = session('checkout_items') ?? [];

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        if (empty($items)) {
            // Fallback: rebuild items if session expired
            $items = $this->buildCheckoutItemsFromSources($user);
            if (empty($items)) {
                return redirect()->route('cart.index')->with('error', 'Tidak ada produk untuk checkout.');
            }
        }
        if (!$addressId) {
            return redirect()->route('checkout')->with('error', 'Alamat belum dipilih.');
        }
        if (!in_array($method, ['bank', 'cod', 'ewallet'], true)) {
            return redirect()->route('checkout')->with('error', 'Metode pembayaran tidak valid.');
        }

        DB::beginTransaction();
        try {
            // Compute totals
            $subtotal = 0;
            foreach ($items as $it) {
                $qty    = (int) ($it['quantity'] ?? 1);
                $price  = (float) ($it['price'] ?? 0);
                $subtotal += $price * $qty;
            }
            $shippingCost = 10000;
            $total        = $subtotal + $shippingCost;

            // Create order
            $order = Order::create([
                'user_id'         => $user->id,
                'total'           => $total,
                'payment_method'  => $method,
                'status'          => $method === 'cod' ? 'pending' : 'paid',
                'shipping_status' => 'pending',
                'address_id'      => $addressId,
            ]);

            // Create order items + decrement stock
            foreach ($items as $it) {
                $qty   = (int) ($it['quantity'] ?? 1);
                $price = (float) ($it['price'] ?? 0);
                $pid   = $it['product_id'];

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $pid,
                    'name'       => $it['name'] ?? '',
                    'price'      => $price,
                    'quantity'   => $qty,
                ]);

                $prod = Product::find($pid);
                if ($prod) {
                    if (isset($prod->stock)) {
                        $prod->stock = max(0, (int)$prod->stock - $qty);
                    } elseif (isset($prod->remaining_stock)) {
                        $prod->remaining_stock = max(0, (int)$prod->remaining_stock - $qty);
                    }
                    $prod->save();
                }
            }

            // Clear sessions and cart items (keep cart row)
            session()->forget('checkout.direct');
            session()->forget('checkout_items');
            session()->forget('checkout.address_id');

            $userCart = Cart::firstOrCreate(['user_id' => $user->id]);
            $userCart->items()->delete();

            DB::commit();

            return redirect()->route('orders')->with('success', 'Pesanan berhasil dibuat.');


        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat membuat pesanan.');
        }
    }

    /**
     * Selected checkout: caches selected cart items to session then redirects to checkout
     */
    public function checkoutSelected(Request $request)
    {
        $selectedIds = $request->input('selected', []);
        $user        = Auth::user();

        if (empty($selectedIds)) {
            return back()->with('error', 'Pilih minimal satu produk untuk checkout.');
        }

        $cart  = Cart::firstOrCreate(['user_id' => $user->id]);
        $items = $cart->items()->with('product')->get();

        $selectedItems = [];
        foreach ($items as $item) {
            if (in_array($item->product_id, $selectedIds) && $item->product) {
                $selectedItems[$item->product_id] = [
                    'product_id' => $item->product_id,
                    'name'       => $item->product->name,
                    'price'      => $item->product->price,
                    'quantity'   => $item->quantity,
                    'image'      => $item->product->image ?? null,
                ];
            }
        }

        if (empty($selectedItems)) {
            return back()->with('error', 'Produk yang dipilih tidak ditemukan.');
        }

        session(['checkout_items' => $selectedItems]);

        return redirect()->route('checkout');
    }

    // =======================
    // Payment pages
    // =======================

    public function bankTransfer()
    {
        // Page shows bank instructions and confirms the order
        return view('pages.payments.bank');
    }

    public function cod()
    {
        // Page informs COD flow and confirms the order
        return view('pages.payments.cod');
    }

    public function eWallet()
    {
        // Page shows QRIS/ewallet info and confirms the order
        return view('pages.payments.ewallet');
    }

    // =======================
    // Helpers
    // =======================

    /**
     * Build checkout items array from (session selected | session direct | DB cart)
     */
    private function buildCheckoutItemsFromSources($user): array
    {
        // 1) Selected items in session
        if (session('checkout_items')) {
            return session('checkout_items');
        }

        // 2) Direct checkout session
        if (session('checkout.direct')) {
            $data    = session('checkout.direct');
            $product = Product::find($data['product_id']);
            if (!$product) {
                return [];
            }

            $qty      = (int) $data['quantity'];
            $maxStock = $product->stock ?? $product->remaining_stock ?? null;
            if ($maxStock !== null && $qty > $maxStock) {
                $qty = max(0, (int)$maxStock);
            }

            return [
                $product->id => [
                    'product_id' => $product->id,
                    'name'       => $product->name,
                    'price'      => $product->price,
                    'quantity'   => max(1, $qty),
                    'image'      => $product->image ?? null,
                ],
            ];
        }

        // 3) Fallback: cart items from DB
        $cart  = Cart::firstOrCreate(['user_id' => $user->id]);
        $items = $cart->items()->with('product')->get();

        if ($items->isEmpty()) {
            return [];
        }

        $payload = [];
        foreach ($items as $item) {
            if (!$item->product) continue;
            $payload[$item->product_id] = [
                'product_id' => $item->product_id,
                'name'       => $item->product->name,
                'price'      => $item->product->price,
                'quantity'   => $item->quantity,
                'image'      => $item->product->image ?? null,
            ];
        }

        return $payload;
    }
}
