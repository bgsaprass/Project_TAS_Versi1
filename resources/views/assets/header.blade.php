{{-- SPINNER --}}
{{-- <div id="spinner"
    class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div> --}}

{{-- NAVBAR --}}
<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                        class="text-white">1 Diponegoro, Salatiga</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                        class="text-white">CepatBeli@gmail.com</a></small>
            </div>
            <div class="top-link pe-2">
                <a href="#" class="text-white"><small class="text-white mx-2">Kebijakan Privasi</small>/</a>
                <a href="#" class="text-white"><small class="text-white mx-2">Syarat Penggunaan</small>/</a>
                <a href="#" class="text-white"><small class="text-white ms-2">Penjualan & Pengembalian</small></a>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ route('welcome') }}" class="navbar-brand">
                <h1 class="text-primary display-6">CepatBeli</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('welcome') }}" class="nav-item nav-link active">Beranda</a>
                    <a href="{{ route('shop') }}" class="nav-item nav-link">Belanja</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Halaman</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="{{ route('cart.index') }}" class="dropdown-item">Keranjang</a>
                            <a href="{{ route('checkout') }}" class="dropdown-item">Pembayaran</a>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="nav-item nav-link">Kontak</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                        data-bs-toggle="modal" data-bs-target="#searchModal"><i
                            class="fas fa-search text-primary"></i></button>
                    <a href="{{ route('cart.index') }}" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        @php
                            $cartCount = Auth::check() && Auth::user()->cart ? Auth::user()->cart->items()->count() : 0;
                        @endphp
                        <span
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                            {{ $cartCount }}
                        </span>
                    </a>


                    <a href="{{ route('profile') }}" class="my-auto">
                        <i class="fas fa-user fa-2x"></i>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>
