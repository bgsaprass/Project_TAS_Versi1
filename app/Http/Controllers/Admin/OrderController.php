<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateShipping(Request $request, Order $order)
    {
        $request->validate([
            'shipping_status' => 'required|string',
        ]);

        $order->shipping_status = $request->shipping_status;
        $order->save();

        return redirect()->back()->with('success', 'Status pengiriman berhasil diperbarui.');
    }
}
