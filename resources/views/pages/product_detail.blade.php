<!DOCTYPE html>
<html lang="id">
@include('assets.head')

<body>
    @include('assets.header')

    <!-- Page Header -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Detail Produk</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop') }}">Belanja</a></li>
            <li class="breadcrumb-item active text-white">{{ $product->name }}</li>
        </ol>
    </div>

    <!-- Product Detail -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <img src="{{ asset('img/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3">{{ $product->name }}</h4>
                            <p><strong>Kategori:</strong> {{ optional($product->category)->name ?? 'Tanpa Kategori' }}</p>
                            <h5 class="fw-bold mb-3">Rp{{ number_format($product->price) }}</h5>
                            <div class="d-flex mb-4">
                                @for ($i = 0; $i < 4; $i++)
                                    <i class="fa fa-star text-secondary"></i>
                                @endfor
                                <i class="fa fa-star"></i>
                            </div>
                            <p class="mb-4">{{ $product->description }}</p>

                            <!-- Quantity Control -->
                            <div class="input-group quantity mb-4" style="width: 120px;">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="number"
                                       id="quantity"
                                       name="quantity"
                                       class="form-control form-control-sm text-center border-0"
                                       value="1"
                                       min="1"
                                       max="{{ $product->stock }}">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <a href="{{ route('cart.add', ['id' => $product->id]) }}"
                               onclick="event.preventDefault(); submitCart();"
                               class="btn border border-secondary rounded-pill px-4 py-2 mb-2 text-primary">
                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Tambahkan ke Troli
                            </a>

                            <a href="{{ route('checkout.direct', ['id' => $product->id]) }}"
                               onclick="event.preventDefault(); submitBuy();"
                               class="btn border border-primary rounded-pill px-4 py-2 mb-2 text-primary">
                                <i class="fa fa-credit-card me-2 text-primary"></i> Beli Sekarang
                            </a>

                            <!-- Hidden Forms -->
                            <form id="cartForm" method="POST" action="{{ route('cart.add', ['id' => $product->id]) }}">
                                @csrf
                                <input type="hidden" name="quantity" id="cartQuantity">
                            </form>

                            <form id="buyForm" method="POST" action="{{ route('checkout.direct', ['id' => $product->id]) }}">
                                @csrf
                                <input type="hidden" name="quantity" id="buyQuantity">
                            </form>
                        </div>

                        <!-- Tabs -->
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description">Deskripsi</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews">Ulasan</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane fade show active" id="description">
                                    <p>{{ $product->description }}</p>
                                    <div class="row g-4 mt-4">
                                        <div class="col-6">
                                            <div class="bg-light text-center py-2 rounded">Berat: 1 kg</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center py-2 rounded">Kualitas: Organik</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="reviews">
                                    <p class="text-muted">Belum ada ulasan.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Comment Form -->
                        <form action="#">
                            <h4 class="mb-5 fw-bold">Tinggalkan Komentar</h4>
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <input type="text" class="form-control border-bottom" placeholder="Nama Anda *">
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" class="form-control border-bottom" placeholder="Email Anda *">
                                </div>
                                <div class="col-lg-12">
                                    <textarea class="form-control border-bottom my-4" rows="6" placeholder="Ulasan Anda *"></textarea>
                                </div>
                                <div class="col-lg-12 d-flex justify-content-between py-3 mb-5">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 me-3">Silakan beri rating:</p>
                                        <div class="d-flex align-items-center">
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="fa fa-star text-muted"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <a href="#" class="btn border border-secondary text-primary rounded-pill px-4 py-3">Kirim Komentar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 col-xl-3">
                    @include('assets.sidebar')
                </div>
            </div>
        </div>
    </div>

    <!-- Quantity Script -->
    <script>
        const quantityInput = document.getElementById('quantity');
        const maxStock = parseInt(quantityInput.max);

        document.querySelector('.btn-plus').addEventListener('click', () => {
            let val = parseInt(quantityInput.value);
            if (val < maxStock) quantityInput.value = val + 1;
        });

        document.querySelector('.btn-minus').addEventListener('click', () => {
            let val = parseInt(quantityInput.value);
            if (val > 1) quantityInput.value = val - 1;
        });

        function submitCart() {
            document.getElementById('cartQuantity').value = quantityInput.value;
            document.getElementById('cartForm').submit();
        }

        function submitBuy() {
            document.getElementById('buyQuantity').value = quantityInput.value;
            document.getElementById('buyForm').submit();
        }
    </script>

    @include('assets.footer')
</body>
</html>
