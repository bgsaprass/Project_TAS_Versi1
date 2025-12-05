@extends('layouts.admin')

@section('content')
    <div class="p-4">
        <h1 class="text-xl font-semibold mb-4">Orders</h1>

        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Order #</th>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Total</th>
                    <th class="px-6 py-3">Payment</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Shipping Status</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4">#{{ $order->id }}</td>
                        <td class="px-6 py-4">{{ $order->user->name ?? 'User' }}</td>
                        <td class="px-6 py-4">Rp{{ number_format($order->total) }}</td>
                        <td class="px-6 py-4">{{ $order->payment_method }}</td>
                        <td class="px-6 py-4">{{ $order->status }}</td>
                        <td class="px-6 py-4">{{ $order->shipping_status }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.orders.updateShipping', $order->id) }}" method="POST">
                                @csrf
                                <select name="shipping_status" class="form-select">
                                    <option value="pending" {{ $order->shipping_status == 'pending' ? 'selected' : '' }}>pending</option>
                                    <option value="processing" {{ $order->shipping_status == 'processing' ? 'selected' : '' }}>processing</option>
                                    <option value="shipped" {{ $order->shipping_status == 'shipped' ? 'selected' : '' }}>shipped</option>
                                    <option value="delivered" {{ $order->shipping_status == 'delivered' ? 'selected' : '' }}>delivered</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary mt-2">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $orders->links() }}</div>
    </div>
@endsection
