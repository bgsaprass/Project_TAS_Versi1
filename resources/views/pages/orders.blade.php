<!doctype html>
<html lang="en">

@include('assets.head')

<body>
    {{-- Navbar Start --}}
    @include('assets.header')
    {{-- Navbar End --}}

    {{-- Orders Section --}}
    <main class="container">
        <div class="orders-card">
            <h2 class="mb-4 text-center">Pesanan Saya</h2>
            @php
                $orders = auth()->user()->orders()->with('items')->orderBy('created_at', 'desc')->get();
            @endphp

            @if($orders->isEmpty())
                <p class="text-center">Belum ada pesanan.</p>
            @else
                <div class="list-group">
                    @foreach($orders as $order)
                        <div class="list-group-item mb-3">
                            <h5>Order #{{ $order->id }} - Rp{{ number_format($order->total) }}</h5>
                            <p>Status: <strong>{{ $order->status }}</strong> | Pengiriman: <strong>{{ $order->shipping_status }}</strong></p>
                            <ul>
                                @foreach($order->items as $item)
                                    <li>{{ $item->name }} x {{ $item->quantity }} - Rp{{ number_format($item->price) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>
</body>

</html>
