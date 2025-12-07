<!doctype html>
<html lang="id">
@include('assets.head')

<body>
    {{-- Navbar Start --}}
    <div class="container-fluid fixed-top">
        <div
            class="container topbar {{ Auth::check() && Auth::user()->role === 'admin' ? 'bg-dark' : 'bg-primary' }} d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i><a href="#"
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
                        <a href="{{ route('shop') }}" class="nav-item nav-link">Detail Produk</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Kontak</a>
                    </div>
                    <div class="d-flex m-3 me-0">
                        <button
                            class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                            data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="fas fa-search text-primary"></i>
                        </button>

                            @guest
                            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Masuk</a>
                            <a href="{{ route('register') }}" class="btn btn-primary">Buat Akun</a>
                        @else
                            @if (Auth::user()->role === 'admin')
                            @else
                                <a href="{{ route('cart.index') }}" class="position-relative me-4 my-auto">
                                    <i class="fa fa-shopping-bag fa-2x"></i>
                                    @php
                                        $cartCount =
                                            Auth::check() && Auth::user()->cart
                                                ? Auth::user()->cart->items()->count()
                                                : 0;
                                    @endphp
                                    <span
                                        class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                        style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                                        {{ $cartCount }}
                                    </span>
                                </a>
                            @endif

                            <div class="dropdown">
                                <a class="btn btn-light dropdown-toggle ms-2" href="#" role="button" id="userMenu"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                                    <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="dropdown-item" type="submit">Keluar</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endguest
                    </div>
                </div>
            </nav>
        </div>
    </div>
    {{-- Navbar End --}}

    {{-- Profile Section --}}
    <main class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="profile-card p-4 shadow rounded bg-white">
                    <h2 class="mb-4 text-center">Profil Akun</h2>

                    <div class="text-center mb-4">
                        <i class="fa fa-user-circle fa-4x text-success mb-3"></i>
                        <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                        @if (Auth::user()->phone)
                            <p class="text-muted">{{ Auth::user()->phone }}</p>
                        @endif
                    </div>

                    <hr>

                    <div class="mb-4">
                        <h6 class="info-label">Pesanan Terakhir</h6>
                        <p class="text-muted">Belum ada pesanan atau data belum tersedia.</p>
                    </div>

                    <div class="d-grid gap-2">
                        @if (Auth::user()->role === 'admin')
                            {{-- Tombol khusus admin --}}
                            <a href="{{ route('admin.index') }}" class="btn btn-outline-dark">
                                <i class="fa fa-chart-line me-2"></i> Lihat Statistik Penjualan
                            </a>
                        @else
                            {{-- Tombol untuk user biasa --}}
                            <a href="{{ route('orders') }}" class="btn btn-outline-success">
                                <i class="fa fa-box me-2"></i> Lihat Pesanan Saya
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-green">
                                <i class="fa fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>
@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan',
        text: '{{ session('error') }}',
        confirmButtonColor: '#d33'
    });
</script>
@endif

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6'
    });
</script>
@endif

</body>

</html>
