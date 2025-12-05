<!doctype html>
<html lang="en">

@include('assets.head')

<body>
    {{-- Navbar Start --}}
    @include('assets.header')
    {{-- Navbar End --}}

    {{-- Orders Section --}}
    <div class="container">
        <h2>Pesanan Saya</h2>
        @forelse($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Pesanan #{{ $order->id }}</h5>
                    <p>Tanggal: {{ $order->created_at->format('d M Y H:i') }}</p>
                    <p>Total: Rp{{ number_format($order->total, 0, ',', '.') }}</p>
                    <p>Status: {{ ucfirst($order->status) }} | Pengiriman: {{ ucfirst($order->shipping_status) }}</p>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">Detail</a>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada pesanan.</p>
        @endforelse
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

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#6f42c1',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
</body>

</html>
