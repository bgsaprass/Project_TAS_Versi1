<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'created_at');
        $order = $request->get('order', 'desc');

        $products = Product::with('category')->orderBy($sortBy, $order)->paginate(10);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'sortBy', 'order', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string|max:100',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
            'stock' => 'required|integer|min:0',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img'), $imageName);

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'brand' => $request->brand,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageName,
            'stock' => $request->stock,
            'remaining_stock' => $request->stock,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string|max:100',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'stock' => 'required|integer|min:0',
        ]);

        // Ganti gambar jika ada
        if ($request->hasFile('image')) {
            $oldImage = public_path('img/' . $product->image);
            if ($product->image && file_exists($oldImage)) {
                unlink($oldImage);
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $product->image = $imageName;
        }

        // Hitung selisih stok
        $selisih = $request->stock - $product->stock;
        $product->remaining_stock = max(0, $product->remaining_stock + $selisih);

        // Update data
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'brand' => $request->brand,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'remaining_stock' => $product->remaining_stock,
            'image' => $product->image,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $imagePath = public_path('img/' . $product->image);
        if ($product->image && file_exists($imagePath)) {
            unlink($imagePath);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
