<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
    <div class="container py-5">
        <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
            <div class="row g-4">
                <div class="col-lg-3">
                    <a href="#">
                        <h1 class="text-primary mb-0">CepatBeli</h1>
                        <p class="text-secondary mb-0">Produk Segar dan Menyehatkan</p>
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative mx-auto">
                            <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="email"
                                placeholder="Email Anda">
                            <button type="submit"
                                class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white"
                                style="top: 0; right: 0;">Berlangganan Sekarang</button>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="d-flex justify-content-end pt-3">
                        <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Kenapa Orang Menyukai Kami!</h4>
                    <p class="mb-4">Pelanggan menyukai kami karena kami berkomitmen menghadirkan produk segar dan menyehatkan yang langsung dari sumbernya, menjadikan gaya hidup sehat Anda lebih mudah dan terpercaya setiap hari.</p>
                    <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Baca Lebih Banyak</a>
                </div>
            </div>
                <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Info Toko</h4>
                    <a class="btn-link" href="">Tentang Kami</a>
                    <a class="btn-link" href="">Kontak Kami</a>
                    <a class="btn-link" href="">Peraturan Pengembalian</a>
                    <a class="btn-link" href="">Bantuan</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Akun</h4>
                    <a href="{{ route("profile")}}" class="btn-link" >Akun Saya</a>
                    <a class="btn-link" href="">Keranjang Belanja</a>
                    <a class="btn-link" href="">Riwayat Pembelian</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Kontak</h4>
                    <p>Alamat: 1 Diponegoro, Salatiga</p>
                    <p>Email: CepatBeli@gmail.com</p>
                    <p>Telepon: +0123 4567 8910</p>
                    <p>Pembayaran Yang Diterima</p>
                    <img src="img/payment.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
</div>


@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
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
