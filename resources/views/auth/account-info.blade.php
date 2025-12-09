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
                    <a href="#" class="text-white"><small class="text-white ms-2">Penjualan &
                            Pengembalian</small></a>
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
                <div class="p-4 shadow rounded bg-white">
                    <h2 class="mb-4 text-center">Informasi Akun</h2>

                    <div class="mb-3">
                        <h5>Nama</h5>
                        <form method="POST" action="{{ route('profile.updateName') }}" class="d-flex gap-2">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}"
                                required>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </form>
                    </div>

                    <div class="mb-3">
                        <h5>Email</h5>
                        <p>{{ Auth::user()->email }}</p>
                    </div>

                    @if (Auth::user()->phone)
                        <div class="mb-3">
                            <h5>Nomor HP</h5>
                            <p>{{ Auth::user()->phone }}</p>
                        </div>
                    @endif

                    <hr>


                    <a href="{{ route('password.change') }}" class="btn btn-outline-warning mb-3">
                        <i class="fa fa-key me-2"></i> Ubah Sandi
                    </a>


                    <h5 class="mt-4">Alamat Tersimpan</h5>

                    @if (Auth::user()->addresses->count())
                        @foreach (Auth::user()->addresses as $address)
                            <div class="mb-3 p-3 border rounded">
                                <p class="mb-1 text-muted">
                                    <strong>{{ $address->recipient_name }}</strong><br>
                                    {{ $address->address }}, {{ $address->city }} {{ $address->postcode }}<br>
                                    {{ $address->country }} | {{ $address->phone }}
                                </p>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('address.edit', $address->id) }}"
                                        class="btn btn-sm btn-outline-secondary">
                                        <i class="fa fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('address.destroy', $address->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus alamat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fa fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">Belum ada alamat tersimpan.</p>
                    @endif

                    
                    <a href="{{ route('address.create') }}" class="btn btn-outline-primary mt-2">
                        <i class="fa fa-plus me-2"></i> Tambah Alamat
                    </a>

                    <a href="{{ route('profile') }}" class="btn btn-outline-secondary mt-3">
                        <i class="fa fa-arrow-left me-2"></i> Kembali ke Profil
                    </a>
                </div>
            </div>
        </div>
    </main>

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    @if (session('success'))
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
