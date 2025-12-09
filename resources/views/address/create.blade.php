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
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
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
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item"><a href="#">Halaman</a></li>
            <li class="breadcrumb-item active text-white">Keranjang</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-8">
        <h3 class="text-center mb-4">Tambah Alamat Baru</h3>

        <form action="{{ route('address.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
            @csrf

            <div class="mb-3">
                <label for="recipient_name" class="form-label">Nama Penerima</label>
                <input type="text" name="recipient_name" id="recipient_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Nomor HP</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat Lengkap</label>
                <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="city" class="form-label">Kabupaten / Kota</label>
                    <input type="text" name="city" id="city" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="postcode" class="form-label">Kode Pos</label>
                    <input type="text" name="postcode" id="postcode" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Negara</label>
                <input type="text" name="country" id="country" class="form-control" value="Indonesia" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Simpan Alamat</button>
                <a href="{{ route('checkout') }}" class="btn btn-outline-secondary">← Kembali ke Checkout</a>
            </div>
        </form>
    </div>
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
