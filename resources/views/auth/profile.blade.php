<!doctype html>
<html lang="en">
@include('assets.head')

<body>
    {{-- Navbar Start --}}
    @include('assets.header')
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
                            <p class="text-muted">📞 {{ Auth::user()->phone }}</p>
                        @endif
                    </div>

                    <hr>

                    <div class="mb-4">
                        <h6 class="info-label">Pesanan Terakhir</h6>
                        <p class="text-muted">Belum ada pesanan atau data belum tersedia.</p>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('orders') }}" class="btn btn-outline-success">
                            <i class="fa fa-box me-2"></i> Lihat Pesanan Saya
                        </a>

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

</body>

</html>
