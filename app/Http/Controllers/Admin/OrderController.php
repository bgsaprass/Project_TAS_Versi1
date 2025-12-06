<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
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
     * Menampilkan detail pesanan (admin)
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update status pengiriman pesanan
     */
    public function updateShipping(Request $request, Order $order)
    {
        $request->validate([
            'shipping_status' => 'required|in:pending,processing,shipped,delivered',
        ]);

        // Jika status sama dengan sebelumnya
        if ($order->shipping_status === $request->shipping_status) {
            return back()->with('error', 'Status pengiriman sudah sama, tidak ada perubahan.');
        }

        // Jika status berbeda → update
        $order->update(['shipping_status' => $request->shipping_status]);

        return back()->with('success', 'Status pengiriman telah diperbarui.');
    }

    public function userOrders(User $user)
    {
        $orders = Order::where('user_id', $user->id)
            ->with(['items.product'])
            ->latest()
            ->get();

        return view('admin.orders.user-orders', compact('user', 'orders'));
    }
}
