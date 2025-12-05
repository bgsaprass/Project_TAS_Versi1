<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    private function filterProducts(Request $request)
    {
        $products = Product::with('category'); // tambahkan eager loading

        if ($request->filled('category') && Category::find($request->category)) {
            $products->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $products->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->sort === 'price_asc') {
            $products->orderBy('price', 'asc');
        } elseif ($request->sort === 'price_desc') {
            $products->orderBy('price', 'desc');
        }

        return $products->get();
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
}
