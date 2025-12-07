<!doctype html>
<html lang="en">

<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-141734189-6"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-141734189-6');
    </script>
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-THQTXJ7');
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
@include('assets.head-dashboard')

<body class="bg-gray-50">
    @include('assets.nav-das')
    <div class="flex overflow-hidden bg-white pt-16">
        <!-- Sidebar backdrop -->
        @include('assets.aside-das')
        <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>
        <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
            <main>
                <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
                    <div class="mb-1 w-full">
                        <div class="mb-4">
                            <nav class="flex mb-5" aria-label="Breadcrumb">
                                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                                    <li class="inline-flex items-center">
                                        <a href="#"
                                            class="text-gray-700 hover:text-gray-900 inline-flex items-center">
                                            <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                                </path>
                                            </svg>
                                            Home
                                        </a>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <a href="#"
                                                class="text-gray-700 hover:text-gray-900 ml-1 md:ml-2 text-sm font-medium">E-commerce</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-gray-400 ml-1 md:ml-2 text-sm font-medium"
                                                aria-current="page">Pengguna</span>
                                        </div>
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Semua Pengguna</h1>
                        </div>
                        <div class="block sm:flex items-center md:divide-x md:divide-gray-100">
                            <form class="sm:pr-3 mb-4 sm:mb-0" action="#" method="GET">
                                <label for="products-search" class="sr-only">Search</label>
                                <div class="mt-1 relative sm:w-64 xl:w-96">
                                    <input type="text" name="email" id="products-search"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                        placeholder="Search for products">
                                </div>
                            </form>
                            <div class="flex items-center sm:justify-end w-full">
                                <div class="hidden md:flex pl-2 space-x-1">
                                    <a href="#"
                                        class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="#"
                                        class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="#"
                                        class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="#"
                                        class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Akun Start-->
                <div class="p-6">
                    {{-- Breadcrumb --}}
                    <nav class="text-sm text-gray-500 mb-4">
                        <ol class="list-reset flex">
                            <li><a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a></li>
                            <li><span class="mx-2">›</span></li>
                            <li><a href="{{ route('admin.orders.index') }}"
                                    class="text-blue-600 hover:underline">Pesanan</a></li>
                            <li><span class="mx-2">›</span></li>
                            <li class="text-gray-700">Detail</li>
                        </ol>
                    </nav>

                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Detail Pesanan #{{ $order->id }}</h2>

                    <div class="bg-white shadow rounded-lg p-6 mb-6">
                        <p><strong>User:</strong> {{ $order->user->name }}</p>
                        <p><strong>Total:</strong> Rp{{ number_format($order->total, 0, ',', '.') }}</p>
                        <p><strong>Status Pembayaran:</strong>
                            <span
                                class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                {{ $order->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        <p><strong>Status Pengiriman:</strong>
                            <span
                                class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                @switch($order->shipping_status)
                    @case('pending') bg-red-100 text-red-700 @break
                    @case('processing') bg-yellow-100 text-yellow-700 @break
                    @case('shipped') bg-blue-100 text-blue-700 @break
                    @case('delivered') bg-green-100 text-green-700 @break
                    @default bg-gray-100 text-gray-700
                @endswitch">
                                {{ ucfirst($order->shipping_status) }}
                            </span>
                        </p>
                    </div>

                    <div class="bg-white shadow rounded-lg p-6 mb-6">
                        <h4 class="text-lg font-semibold mb-3">Item Pesanan:</h4>
                        <ul class="list-disc list-inside text-sm text-gray-700">
                            @foreach ($order->items as $item)
                                <li>{{ $item->name }} x {{ $item->quantity }}
                                    (Rp{{ number_format($item->price, 0, ',', '.') }})
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="bg-white shadow rounded-lg p-6">
                        <form action="{{ route('admin.orders.updateShipping', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div style="margin-bottom: 1rem;">
                                <label for="shipping_status"
                                    style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #374151;">
                                    Update Status Pengiriman:
                                </label>
                                <select name="shipping_status" id="shipping_status"
                                    style="display: block; width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; background-color: white; font-size: 0.875rem; color: #374151;">
                                    <option value="pending"
                                        {{ $order->shipping_status == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="processing"
                                        {{ $order->shipping_status == 'processing' ? 'selected' : '' }}>
                                        Processing
                                    </option>
                                    <option value="shipped"
                                        {{ $order->shipping_status == 'shipped' ? 'selected' : '' }}>
                                        Shipped
                                    </option>
                                    <option value="delivered"
                                        {{ $order->shipping_status == 'delivered' ? 'selected' : '' }}>
                                        Delivered
                                    </option>
                                </select>
                            </div>
                            <button type="submit"
                                style="display: inline-flex; align-items: center; padding: 0.625rem 1rem; background-color: #10b981; border: 1px solid transparent; border-radius: 0.375rem; font-weight: 600; font-size: 0.75rem; color: white; text-transform: uppercase; letter-spacing: 0.05em; transition: all 0.2s; cursor: pointer; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);"
                                onmouseover="this.style.backgroundColor='#059669'; this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)'"
                                onmouseout="this.style.backgroundColor='#10b981'; this.style.boxShadow='0 1px 2px 0 rgba(0, 0, 0, 0.05)'">
                                <i class="fa-solid fa-check" style="margin-right: 0.5rem;"></i> Update Status
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Table Akun Finish-->
            </main>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#6f42c1',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Coba Lagi'
            });
        </script>
    @endif

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://themewagon.github.io/windster/app.bundle.js"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
</body>

</html>
