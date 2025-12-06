<!doctype html>
<html lang="en">

<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-141734189-6"></script>
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
</head>
@include('assets.head-dashboard')

<body class="bg-gray-50">
@include('assets.nav-das')

    <div class="flex overflow-hidden bg-white pt-16">

        @include("assets.aside-das")

        <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>


        <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
            <main>

                <div
                    class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
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
                                            <svg class="w-6 h-6 text-gray-400" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                                            <svg class="w-6 h-6 text-gray-400" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-gray-400 ml-1 md:ml-2 text-sm font-medium"
                                                aria-current="page">Products</span>
                                        </div>
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">All products</h1>
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
                                <button type="button" data-modal-toggle="add-product-modal"
                                    class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2 text-center sm:ml-auto">
                                    <svg class="-ml-1 mr-2 h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Add product
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="mb-4 text-green-700 bg-green-100 border border-green-300 rounded-lg px-4 py-3">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- Table start --}}
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">
                                <a href="?sort_by=name&order={{ $order === 'asc' ? 'desc' : 'asc' }}">Name</a>
                            </th>
                            <th class="px-6 py-3">
                                <a
                                    href="?sort_by=category_id&order={{ $order === 'asc' ? 'desc' : 'asc' }}">Category</a>
                            </th>
                            <th class="px-6 py-3">
                                <a href="?sort_by=brand&order={{ $order === 'asc' ? 'desc' : 'asc' }}">Brand</a>
                            </th>
                            <th class="px-6 py-3">
                                <a href="?sort_by=price&order={{ $order === 'asc' ? 'desc' : 'asc' }}">Price</a>
                            </th>
                            <th class="px-6 py-3">
                                <a href="?sort_by=stock&order={{ $order === 'asc' ? 'desc' : 'asc' }}">Stock</a>
                            </th>
                            <th class="px-6 py-3">Image</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">{{ $product->name }}</td>
                                <td class="px-6 py-4">{{ optional($product->category)->name ?? $product->category ?? 'Tanpa Kategori' }}</td>
                                <td class="px-6 py-4">{{ $product->brand ?? '-' }}</td>
                                <td class="px-6 py-4">Rp{{ number_format($product->price) }}</td>
                                <td class="px-6 py-4">
                                    @if ($product->remaining_stock == 0)
                                        <span class="text-red-600 font-semibold">Habis</span>
                                    @else
                                        {{ $product->remaining_stock }} / {{ $product->stock }}
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($product->image && file_exists(public_path('img/' . $product->image)))
                                        <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->name }}"
                                            style="width:56px; height:56px; object-fit:cover; border-radius:6px; border:1px solid #e5e7eb;">
                                    @else
                                        <span class="text-gray-400 italic">No image</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <button type="button"
                                        class="text-cyan-600 hover:underline flex items-center gap-1"
                                        data-modal-toggle="edit-product-modal-{{ $product->id }}">
                                        ✏️ Edit
                                    </button>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            data-modal-toggle="delete-product-modal-{{ $product->id }}">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center">Belum ada produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>

                {{-- Table End --}}
                <div
                    class="bg-white sticky sm:flex items-center w-full sm:justify-between bottom-0 right-0 border-t border-gray-200 p-4">
                    <div class="flex items-center mb-4 sm:mb-0">
                        @if ($products->onFirstPage())
                            <span class="text-gray-400 cursor-not-allowed p-1 rounded inline-flex justify-center">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}"
                                class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        @endif

                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}"
                                class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center mr-2">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        @else
                            <span class="text-gray-400 cursor-not-allowed p-1 rounded inline-flex justify-center mr-2">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        @endif

                        <span class="text-sm font-normal text-gray-500 ml-2">
                            Showing <span class="text-gray-900 font-semibold">{{ $products->firstItem() }}</span>
                            to
                            <span class="text-gray-900 font-semibold">{{ $products->lastItem() }}</span> of
                            <span class="text-gray-900 font-semibold">{{ $products->total() }}</span>
                        </span>
                    </div>

                    <div class="flex items-center space-x-3">
                        @if ($products->onFirstPage())
                            <span
                                class="flex-1 text-white bg-gray-300 cursor-not-allowed font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center">
                                <svg class="-ml-1 mr-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Previous
                            </span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}"
                                class="flex-1 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center">
                                <svg class="-ml-1 mr-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Previous
                            </a>
                        @endif

                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}"
                                class="flex-1 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center">
                                Next
                                <svg class="-mr-1 ml-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        @else
                            <span
                                class="flex-1 text-white bg-gray-300 cursor-not-allowed font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center">
                                Next
                                <svg class="-mr-1 ml-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Add Product Modal -->
                <div class="hidden overflow-x-hidden overflow-y-auto fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full"
                    id="add-product-modal">
                    <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="bg-white rounded-lg shadow relative">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-5 border-b rounded-t">
                                <h3 class="text-xl font-semibold">
                                    Add product
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                    data-modal-toggle="add-product-modal">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6">
                                <form action="{{ route('admin.products.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="name"
                                                class="text-sm font-medium text-gray-900 block mb-2">Product
                                                Name</label>
                                            <input type="text" name="name" id="name"
                                                class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5 text-sm text-gray-900 focus:ring-cyan-600 focus:border-cyan-600"
                                                placeholder="Apple iMac 27”" required>
                                        </div>

                                        <div class="col-span-6 sm:col-span-6">
                                            <label
                                                class="text-sm font-medium text-gray-900 block mb-2">Category</label>
                                            <select name="category_id" id="category_id" required
                                                class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5 text-sm text-gray-900 focus:ring-cyan-600 focus:border-cyan-600">
                                                <option value="">-- Select category --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>


                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="brand"
                                                class="text-sm font-medium text-gray-900 block mb-2">Brand</label>
                                            <input type="text" name="brand" id="brand"
                                                class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5 text-sm text-gray-900 focus:ring-cyan-600 focus:border-cyan-600"
                                                placeholder="Apple">
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="price"
                                                class="text-sm font-medium text-gray-900 block mb-2">Price</label>
                                            <input type="number" name="price" id="price"
                                                class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5 text-sm text-gray-900 focus:ring-cyan-600 focus:border-cyan-600"
                                                placeholder="2300" required>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="stock"
                                                class="text-sm font-medium text-gray-900 block mb-2">Initial
                                                Stock</label>
                                            <input type="number" name="stock" id="stock"
                                                class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5 text-sm text-gray-900 focus:ring-cyan-600 focus:border-cyan-600"
                                                placeholder="100" required>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="image"
                                                class="text-sm font-medium text-gray-900 block mb-2">Product
                                                Image</label>
                                            <input type="file" name="image" id="image" accept="image/*"
                                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none"
                                                required>
                                        </div>

                                        <div class="col-span-full">
                                            <label for="description"
                                                class="text-sm font-medium text-gray-900 block mb-2">Product
                                                Details</label>
                                            <textarea name="description" id="description" rows="6"
                                                class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-4 text-sm text-gray-900 focus:ring-cyan-600 focus:border-cyan-600"
                                                placeholder="e.g. Intel Core i7, 512GB SSD, 16GB RAM" required></textarea>
                                        </div>
                                    </div>

                                    <div class="pt-6 border-t border-gray-200 rounded-b">
                                        <button type="submit"
                                            class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            Add Product
                                        </button>
                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>

                @foreach ($products as $product)
                    <!-- Edit Product Modal -->

                    <div class="hidden overflow-x-hidden overflow-y-auto fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full"
                        id="edit-product-modal-{{ $product->id }}">
                        <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
                            <!-- Modal content -->
                            <div class="bg-white rounded-lg shadow relative">
                                <!-- Modal header -->
                                <div class="flex items-start justify-between p-5 border-b rounded-t">
                                    <h3 class="text-xl font-semibold">Edit product</h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                        data-modal-toggle="edit-product-modal-{{ $product->id }}">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Modal body -->
                                <div class="p-6 space-y-6">
                                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="name"
                                                    class="text-sm font-medium text-gray-900 block mb-2">Product
                                                    Name</label>
                                                <input type="text" name="name" id="name"
                                                    value="{{ $product->name }}"
                                                    class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5 text-sm text-gray-900 focus:ring-cyan-600 focus:border-cyan-600"
                                                    required>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="category_id"
                                                    class="text-sm font-medium text-gray-900 block mb-2">Category</label>
                                                <select name="category_id" id="category_id" required
                                                    class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5 text-sm text-gray-900 focus:ring-cyan-600 focus:border-cyan-600">
                                                    <option value="">-- Select category --</option>
                                                    @foreach ($categories as $cat)
                                                        <option value="{{ $cat->id }}"
                                                            {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                                            {{ $cat->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="brand"
                                                    class="text-sm font-medium text-gray-900 block mb-2">Brand</label>
                                                <input type="text" name="brand" id="brand"
                                                    value="{{ $product->brand }}"
                                                    class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5 text-sm text-gray-900 focus:ring-cyan-600 focus:border-cyan-600">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="price"
                                                    class="text-sm font-medium text-gray-900 block mb-2">Price</label>
                                                <input type="number" name="price" id="price"
                                                    value="{{ $product->price }}"
                                                    class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5 text-sm text-gray-900 focus:ring-cyan-600 focus:border-cyan-600"
                                                    required>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="stock"
                                                    class="text-sm font-medium text-gray-900 block mb-2">Initial
                                                    Stock</label>
                                                <input type="number" name="stock" id="stock"
                                                    value="{{ $product->stock }}"
                                                    class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5 text-sm text-gray-900 focus:ring-cyan-600 focus:border-cyan-600"
                                                    required>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label class="text-sm font-medium text-gray-900 block mb-2">Current
                                                    Image</label>
                                                @if ($product->image && file_exists(public_path('img/' . $product->image)))
                                                    <div
                                                        class="w-20 h-20 overflow-hidden rounded border border-gray-300 shadow-sm">
                                                        <img src="{{ asset('img/' . $product->image) }}"
                                                            alt="{{ $product->name }}"
                                                            class="w-full h-full object-cover">
                                                    </div>
                                                @else
                                                    <span class="text-gray-400 italic">No image</span>
                                                @endif
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="image"
                                                    class="text-sm font-medium text-gray-900 block mb-2">Upload New
                                                    Image</label>
                                                <input type="file" name="image" id="image" accept="image/*"
                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none">
                                            </div>

                                            <div class="col-span-full">
                                                <label for="description"
                                                    class="text-sm font-medium text-gray-900 block mb-2">Product
                                                    Details</label>
                                                <textarea name="description" id="description" rows="6"
                                                    class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-4 text-sm text-gray-900 focus:ring-cyan-600 focus:border-cyan-600"
                                                    required>{{ $product->description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="pt-6 border-t border-gray-200 rounded-b">
                                            <button type="submit"
                                                class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                Save all
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Product Modal -->
                    <div class="hidden fixed top-4 left-0 right-0 z-50 justify-center items-center h-modal sm:h-full"
                        id="delete-product-modal-{{ $product->id }}">
                        <div class="relative w-full max-w-md px-4 h-full md:h-auto">
                            <div class="bg-white rounded-lg shadow">
                                <div class="flex justify-end p-2">
                                    <button type="button"
                                        class="text-gray-400 hover:bg-gray-200 rounded-lg text-sm p-1.5"
                                        data-modal-toggle="delete-product-modal-{{ $product->id }}">
                                        ✖
                                    </button>
                                </div>
                                <div class="p-6 pt-0 text-center">
                                    <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">
                                        Are you sure you want to delete <strong>{{ $product->name }}</strong>?
                                    </h3>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                                            Yes, I'm sure
                                        </button>
                                    </form>
                                    <button type="button"
                                        class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 border border-gray-200 font-medium rounded-lg text-base px-3 py-2.5 text-center"
                                        data-modal-toggle="delete-product-modal-{{ $product->id }}">
                                        No, cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach




            </main>

        </div>

    </div>



    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://themewagon.github.io/windster/app.bundle.js"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
</body>

</html>
