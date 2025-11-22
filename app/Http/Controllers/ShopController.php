<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
   public function show($id)
{
    $product = Product::findOrFail($id);
    return view('pages.shop_detail', compact('product'));
}
}
