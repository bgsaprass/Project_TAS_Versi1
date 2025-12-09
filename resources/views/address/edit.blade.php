<!DOCTYPE html>
<html lang="en">
@include('assets.head')

<body>
    @include('assets.header')

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Edit Alamat</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Akun</a></li>
            <li class="breadcrumb-item active text-white">Edit Alamat</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-8">
            <h3 class="text-center mb-4">Edit Alamat</h3>

            <form action="{{ route('address.update', $address->id) }}" method="POST" class="bg-light p-4 rounded shadow-sm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="recipient_name" class="form-label">Nama Penerima</label>
                    <input type="text" name="recipient_name" id="recipient_name"
                           class="form-control" value="{{ old('recipient_name', $address->recipient_name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor HP</label>
                    <input type="text" name="phone" id="phone"
                           class="form-control" value="{{ old('phone', $address->phone) }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Alamat Lengkap</label>
                    <textarea name="address" id="address" class="form-control" rows="3" required>{{ old('address', $address->address) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="city" class="form-label">Kabupaten / Kota</label>
                        <input type="text" name="city" id="city"
                               class="form-control" value="{{ old('city', $address->city) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="postcode" class="form-label">Kode Pos</label>
                        <input type="text" name="postcode" id="postcode"
                               class="form-control" value="{{ old('postcode', $address->postcode) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Negara</label>
                    <input type="text" name="country" id="country"
                           class="form-control" value="{{ old('country', $address->country ?? 'Indonesia') }}" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Update Alamat</button>
                    <a href="{{ route('profile') }}" class="btn btn-outline-secondary">← Kembali ke Profil</a>
                </div>
            </form>
        </div>
    </div>

    @include('assets.footer')
    @include('assets.copyright')
    @include('assets.libraries')
</body>
</html>
