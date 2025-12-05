<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan semua pesanan (admin)
     */
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Update status pengiriman pesanan
     */
    public function updateShipping(Request $request, Order $order)
    {
        $request->validate([
            'shipping_status' => 'required|in:pending,processing,shipped,delivered',
        ]);

        $order->update(['shipping_status' => $request->shipping_status]);

        return back()->with('success', 'Status pengiriman diperbarui.');
    }

    /**
     * Detail pesanan (admin)
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }
}
