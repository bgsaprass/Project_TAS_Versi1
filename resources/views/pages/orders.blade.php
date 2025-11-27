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

            {{-- Tambahkan loop data pesanan di sini jika pakai database --}}
        </div>
    </main>
</body>

</html>
