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
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h2 class="mb-4">Keranjang Belanja</h2>

            @if (session('cart') && count(session('cart')) > 0)
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Tabel Produk --}}
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Pilih</th>
                                <th>Produk</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (session('cart') as $id => $item)
                                @php $itemTotal = $item['price'] * $item['quantity']; @endphp
                                <tr>
                                    <td class="align-middle">
                                        <input type="checkbox" class="product-check" data-id="{{ $id }}"
                                            data-price="{{ $itemTotal }}">
                                    </td>
                                    <td>
                                        <img src="{{ asset('img/' . $item['image']) }}" class="img-fluid rounded-circle"
                                            style="width: 80px; height: 80px;" alt="{{ $item['name'] }}">
                                    </td>
                                    <td class="align-middle">{{ $item['name'] }}</td>
                                    <td class="align-middle">Rp{{ number_format($item['price']) }}</td>
                                    <td class="align-middle">
                                        <form action="{{ route('cart.update', $id) }}" method="POST"
                                            class="d-flex w-100" style="gap: 5px;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" name="action" value="decrease"
                                                class="btn btn-sm btn-minus rounded-circle bg-light border flex-shrink-0">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <input type="number" name="quantity"
                                                class="form-control form-control-sm text-center border"
                                                value="{{ $item['quantity'] }}" min="1" max="999">
                                            <button type="submit" name="action" value="increase"
                                                class="btn btn-sm btn-plus rounded-circle bg-light border flex-shrink-0">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="align-middle">Rp{{ number_format($itemTotal) }}</td>
                                    <td class="align-middle">
                                        <form action="{{ route('cart.remove', $id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm rounded-circle bg-light border"
                                                onclick="return confirm('Hapus item ini?');">
                                                <i class="fa fa-times text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Form Checkout Produk Terpilih --}}
                <form action="{{ route('checkout.selected') }}" method="POST" id="checkoutForm">
                    @csrf
                    <div id="selectedInputs"></div>

                    {{-- Ringkasan Belanja --}}
                    <div class="row g-4 justify-content-end mt-5">
                        <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                            <div class="bg-light rounded">
                                <div class="p-4">
                                    <h4 class="mb-4">Ringkasan Belanja</h4>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal</span>
                                        <span id="subtotalDisplay">Rp0</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Ongkir</span>
                                        <span>Rp10.000</span>
                                    </div>
                                    <div class="border-top border-bottom py-3 d-flex justify-content-between fw-bold">
                                        <span>Total</span>
                                        <span id="totalDisplay">Rp10.000</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 mt-3 text-uppercase">
                                        Checkout Produk Terpilih
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <div class="text-center py-5">
                    <p class="text-muted">Keranjang kamu masih kosong.</p>
                    <a href="{{ route('shop') }}" class="btn btn-outline-primary">Belanja Sekarang</a>
                </div>
            @endif
        </div>
    </div>
    <!-- Cart Page End -->





    <!-- Script untuk Update Ringkasan Belanja -->
    <script>
        const checkboxes = document.querySelectorAll('.product-check');
        const subtotalDisplay = document.getElementById('subtotalDisplay');
        const totalDisplay = document.getElementById('totalDisplay');
        const selectedInputs = document.getElementById('selectedInputs');

        checkboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                updateSummary();
                updateFormInputs();
            });
        });

        function updateSummary() {
            let subtotal = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    subtotal += parseInt(cb.dataset.price);
                }
            });
            subtotalDisplay.textContent = 'Rp' + subtotal.toLocaleString();
            totalDisplay.textContent = 'Rp' + (subtotal + 10000).toLocaleString();
        }

        function updateFormInputs() {
            selectedInputs.innerHTML = '';
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'selected[]';
                    input.value = cb.dataset.id;
                    selectedInputs.appendChild(input);
                }
            });
        }
    </script>

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
