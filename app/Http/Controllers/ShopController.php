<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    private function filterProducts(Request $request)
    {
        $products = Product::with('category'); // eager loading kategori

        // Filter kategori
        if ($request->filled('category') && Category::find($request->category)) {
            $products->where('category_id', $request->category);
        }

        // Filter pencarian
        if ($request->filled('search')) {
            $products->where('name', 'like', '%' . $request->search . '%');
        }

        // Sortir produk
        switch ($request->sort) {
            case 'popular':
                $products->orderBy('views', 'desc'); // atau jumlah order
                break;
            case 'best':
                $products->orderBy('rating', 'desc'); // rating tertinggi
                break;
            case 'price_asc':
                $products->orderBy('price', 'asc'); // harga termurah
                break;
            case 'price_desc':
                $products->orderBy('price', 'desc'); // harga termahal
                break;
            case 'newest':
                $products->orderBy('created_at', 'desc'); // produk terbaru
                break;
        }

        return $products->paginate(12); // gunakan paginate agar lebih rapi
    }

    public function index(Request $request)
    {
        $categories = Category::withCount('products')->get();
        $products = $this->filterProducts($request);

        return view('pages.shop', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $request->category,
            'sort' => $request->sort,
            'search' => $request->search
        ]);
    }

    public function welcome(Request $request)
    {
        $categories = Category::withCount('products')->get();
        $products = $this->filterProducts($request);

        return view('shop.welcome', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $request->category,
            'sort' => $request->sort,
            'search' => $request->search
        ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.product_detail', compact('product'));
    }

    public function detail($id)
    {
        return $this->show($id);
    }
    public function searchAjax(Request $request)
    {
        $products = Product::with('category')
            ->where('name', 'like', '%' . $request->search . '%')
            ->limit(10)
            ->get(['id', 'name', 'description', 'price', 'image', 'category_id'])
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'image' => $product->image,
                    'category_name' => optional($product->category)->name,
                ];
            });

        return response()->json($products);
    }
}
