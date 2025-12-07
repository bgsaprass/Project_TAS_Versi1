<!DOCTYPE html>
<html lang="en">
@include('assets.head')

<body>

    @include('assets.header')


    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cari berdasarkan kata kunci</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="kata kunci"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Keranjang</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="#">Halaman</a></li>
            <li class="breadcrumb-item active text-white">Keranjang</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <<div class="container">
        <h2>Checkout - E-Wallet</h2>
        <p>Silakan lakukan pembayaran melalui QRIS / OVO / GoPay / Dana.</p>

        <form action="{{ route('checkout.finalize') }}" method="POST">
            @csrf
            <input type="hidden" name="payment_method" value="ewallet">
            <button type="submit" class="btn btn-success">Konfirmasi Pesanan</button>
        </form>
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
