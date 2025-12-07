<!doctype html>
<html lang="id">

@include('assets.head')

<body>
    {{-- Navbar Start --}}
    @include('assets.header')
    {{-- Navbar End --}}

    {{-- Orders Section --}}
    <div class="container">
        <h2>Detail Pesanan #{{ $order->id }}</h2>
        <p>Tanggal: {{ $order->created_at->format('d M Y H:i') }}</p>
        <p>Metode Pembayaran: {{ ucfirst($order->payment_method) }}</p>
        <p>Status Pembayaran: {{ ucfirst($order->status) }}</p>
        <p>Status Pengiriman: {{ ucfirst($order->shipping_status) }}</p>
        <p>Total: Rp{{ number_format($order->total, 0, ',', '.') }}</p>

        <h4>Item Pesanan:</h4>
        <ul>
            @foreach ($order->items as $item)
                <li>{{ $item->name }} x {{ $item->quantity }} (Rp{{ number_format($item->price, 0, ',', '.') }})</li>
            @endforeach
        </ul>
    </div>
    <!-- Footer Start -->
    @include('assets.footer')
    <!-- Footer End -->
    <!-- Copyright Start -->
    @include('assets.copyright')
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    @include('assets.libraries')
</body>

</html>
