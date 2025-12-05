<!DOCTYPE html>
<html lang="en">
@include('assets.head')

<body>

    <!-- Navbar start -->
    @include('assets.header')
    <!-- Navbar End -->

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
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>

            <form method="POST" action="{{ route('checkout.process') }}">
                @csrf
                <div class="row g-5">
                    {{-- Pilih Alamat --}}
                    <label for="address_id">Pilih Alamat:</label>
                    <select name="address_id" id="address_id" class="form-select" required>
                        @foreach (auth()->user()->addresses as $address)
                            <option value="{{ $address->id }}">
                                {{ $address->recipient_name }} - {{ $address->address }}, {{ $address->city }}
                            </option>
                        @endforeach
                    </select>
                    <a href="{{ route('address.create') }}" class="btn btn-sm btn-outline-primary mt-2">+ Tambah Alamat
                        Baru</a>

                    {{-- Ringkasan Order --}}
                    <div class="col-md-12 col-lg-6 col-xl-5 mt-4">
                        <div class="table-responsive mb-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $subtotal = 0; @endphp

                                    {{-- Jika checkout dari keranjang --}}
                                    @if (isset($cart) && !empty($cart))
                                        @foreach ($cart as $id => $item)
                                            @php
                                                $qty = $item['quantity'] ?? 1;
                                                $price = $item['price'] ?? 0;
                                                $name = $item['name'] ?? '';
                                                $image = $item['image'] ?? null;
                                                $total = $price * $qty;
                                                $subtotal += $total;
                                            @endphp
                                            <tr>
                                                <td>
                                                    @if ($image)
                                                        <img src="{{ asset('img/' . $image) }}"
                                                            class="img-fluid rounded-circle"
                                                            style="width: 80px; height: 80px;">
                                                    @endif
                                                </td>
                                                <td>{{ $name }}</td>
                                                <td>Rp{{ number_format($price) }}</td>
                                                <td>{{ $qty }}</td>
                                                <td>Rp{{ number_format($total) }}</td>
                                            </tr>
                                        @endforeach

                                        {{-- Jika direct checkout --}}
                                    @elseif(isset($product))
                                        @php
                                            $qty = $quantity ?? 1;
                                            $price = $product->price ?? 0;
                                            $name = $product->name ?? '';
                                            $image = $product->image ?? null;
                                            $total = $price * $qty;
                                            $subtotal += $total;
                                        @endphp
                                        <tr>
                                            <td>
                                                @if ($image)
                                                    <img src="{{ asset('img/' . $image) }}"
                                                        class="img-fluid rounded-circle"
                                                        style="width: 80px; height: 80px;">
                                                @endif
                                            </td>
                                            <td>{{ $name }}</td>
                                            <td>Rp{{ number_format($price) }}</td>
                                            <td>{{ $qty }}</td>
                                            <td>Rp{{ number_format($total) }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Tidak ada item untuk
                                                checkout.</td>
                                        </tr>
                                    @endif

                                    {{-- Ringkasan --}}
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Subtotal</td>
                                        <td>Rp{{ number_format($subtotal) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Ongkir</td>
                                        <td>Rp10.000</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold text-uppercase">Total</td>
                                        <td>Rp{{ number_format($subtotal + 10000) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Metode Pembayaran --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Metode Pembayaran</label>
                            <div class="form-check">
                                <input type="radio" name="payment_method" value="bank" class="form-check-input"
                                    required>
                                <label class="form-check-label">Transfer Bank</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="payment_method" value="cod" class="form-check-input">
                                <label class="form-check-label">Bayar di Tempat (COD)</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="payment_method" value="ewallet" class="form-check-input">
                                <label class="form-check-label">E-Wallet</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 text-uppercase">Place Order</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <!-- Script Dinamis untuk Ringkasan & Input -->
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
