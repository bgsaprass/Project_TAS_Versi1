<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    // Tampilkan isi keranjang (database-based)
    public function index()
    {
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $items = $cart->items()->with('product')->get();

        $subtotal = $items->sum(fn($item) => $item->product->price * $item->quantity);

        return view('pages.cart', compact('items', 'subtotal'));
    }

    // Tambah produk ke keranjang (database-based)
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if (!isset($product->stock) || $product->stock < 1) {
            return back()->with('error', 'Stok produk habis.');
        }

        $quantity = (int)$request->input('quantity', 1);
        $quantity = min($quantity, $product->stock);

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $item = $cart->items()->firstOrNew(['product_id' => $productId]);
        $item->quantity = $item->exists ? $item->quantity + $quantity : $quantity;
        $item->save();

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    // Update jumlah produk (database-based)
    public function update(Request $request, $productId)
    {
        $cart = Auth::user()->cart;
        $item = $cart->items()->where('product_id', $productId)->first();

        if (!$item) {
            return back()->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $product = Product::findOrFail($productId);
        $action = $request->input('action');
        $newQuantity = (int)$request->input('quantity', $item->quantity);

        if ($action === 'increase') {
            if ($product->stock > $item->quantity) {
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

    // Hapus produk dari keranjang (database-based)
    public function remove($productId)
    {
        $cart = Auth::user()->cart;
        $item = $cart->items()->where('product_id', $productId)->first();

        if ($item) {
            $item->delete();
        }

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
