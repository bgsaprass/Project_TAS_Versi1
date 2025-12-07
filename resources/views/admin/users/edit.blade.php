<!doctype html>
<html lang="en">

@include('assets.head-dashboard')

<body class="bg-gray-50">
    @include('assets.nav-das')
    <div class="flex overflow-hidden bg-white pt-16">
        @include('assets.aside-das')
        <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
            <main>
                <div class="p-6">
                    <nav class="text-sm text-gray-500 mb-4">
                        <ol class="list-reset flex">
                            <li><a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a></li>
                            <li><span class="mx-2">›</span></li>
                            <li><a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline">Pengguna</a></li>
                            <li><span class="mx-2">›</span></li>
                            <li class="text-gray-700">Edit Pengguna</li>
                        </ol>
                    </nav>

                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Pengguna {{ $user->id }}</h2>

                    <div class="bg-white shadow rounded-lg p-6 mb-6">
                        @if ($errors->any())
                            <div class="mb-4 text-sm text-red-600">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Role</label>
                                <input type="text" name="role" value="{{ old('role', $user->role) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Password (kosongkan jika tidak diubah)</label>
                                <input type="password" name="password" autocomplete="new-password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" autocomplete="new-password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div class="flex items-center space-x-2">
                                <button type="submit" class="px-4 py-2 bg-cyan-600 text-white rounded">Simpan</button>
                                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://themewagon.github.io/windster/app.bundle.js"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
</body>

</html>
