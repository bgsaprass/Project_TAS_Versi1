<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{

    public function index()
    {
        // Buat cart jika belum ada untuk user login
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        // Ambil semua item beserta produk
        $items = $cart->items()->with('product')->get();

        // Hitung subtotal
        $subtotal = $items->map(fn($item) => $item->product->price * $item->quantity)->sum();

        return view('pages.cart', compact('items', 'subtotal'));
    }


    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

       
        if ($product->stock < 1) {
            return back()->with('error', 'Stok produk habis.');
        }

        $quantity = min((int)$request->input('quantity', 1), $product->stock);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);


        $item = $cart->items()->firstOrNew(['product_id' => $productId]);
        $item->quantity = $item->exists
            ? min($item->quantity + $quantity, $product->stock)
            : $quantity;
        $item->save();

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }


    public function update(Request $request, $productId)
    {
        $cart = Auth::user()->cart;
        $item = $cart?->items()->where('product_id', $productId)->first();

        if (!$item) {
            return back()->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $product = Product::findOrFail($productId);
        $action = $request->input('action');
        $newQuantity = (int)$request->input('quantity', $item->quantity);

        if ($action === 'increase') {
            if ($item->quantity < $product->stock) {
                $item->quantity++;
            } else {
                return back()->with('error', 'Stok tidak mencukupi.');
            }
        } elseif ($action === 'decrease') {
            if ($item->quantity > 1) {
                $item->quantity--;
            } else {
                return back()->with('error', 'Jumlah minimal 1 produk.');
            }
        } else {
            if ($newQuantity < 1) {
                return back()->with('error', 'Jumlah minimal 1 produk.');
            }
            if ($newQuantity > $product->stock) {
                return back()->with('error', 'Stok tidak mencukupi. Maksimal: ' . $product->stock);
            }
            $item->quantity = $newQuantity;
        }

        $item->save();
        return back()->with('success', 'Keranjang diperbarui.');
    }


    public function remove($productId)
    {
        $cart = Auth::user()->cart;
        $item = $cart?->items()->where('product_id', $productId)->first();

        if ($item) {
            $item->delete();
        }

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $selectedIds = $request->input('selected_items', []);

        if (empty($selectedIds)) {
            return redirect()->route('cart.index')->with('error', 'Pilih minimal satu produk untuk checkout.');
        }

        $cart = Auth::user()->cart;
        $items = $cart->items()->whereIn('product_id', $selectedIds)->with('product')->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Item yang dipilih tidak ditemukan.');
        }

        $subtotal = $items->map(fn($item) => $item->product->price * $item->quantity)->sum();
        $ongkir = 10000;
        $total = $subtotal + $ongkir;


        return view('pages.checkout', compact('items', 'subtotal', 'ongkir', 'total'));
    }
}
