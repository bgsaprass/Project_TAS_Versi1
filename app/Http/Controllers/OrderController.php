<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)
            ->with(['items.product'])
            ->latest()
            ->get();

        return view('pages.orders', compact('orders'));
    }

   
    public function show($id)
    {
        $user = Auth::user();

        $order = Order::where('user_id', $user->id)
            ->with(['items.product'])
            ->findOrFail($id);

        return view('pages.order-detail', compact('order'));
    }
}
