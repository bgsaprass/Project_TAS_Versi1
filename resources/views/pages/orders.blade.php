<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheets -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        rel="stylesheet">

    <!-- Local CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #f6fdf4;
            font-family: 'Segoe UI', sans-serif;
        }

        main {
            padding-top: 140px;
        }

        .orders-card {
            max-width: 800px;
            margin: auto;
            margin-bottom: 60px;
            padding: 30px;
            border: 1px solid #cdeac0;
            border-radius: 12px;
            background-color: #fff;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
        }

        .orders-card h2 {
            color: #7fc242;
            font-weight: 600;
        }

        .order-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .order-status {
            font-size: 0.9rem;
            font-weight: 500;
            color: #6bb03a;
        }
    </style>
</head>

<body>
    {{-- Navbar Start --}}
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i><a href="#"
                            class="text-white">123 Street, New York</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                            class="text-white">Email@Example.com</a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="{{ route('welcome') }}" class="navbar-brand">
                    <h1 class="text-primary display-6">Fruitables</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="{{ route('welcome') }}" class="nav-item nav-link active">Home</a>
                        <a href="shop.html" class="nav-item nav-link">Shop</a>
                        <a href="shop-detail.html" class="nav-item nav-link">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            {{-- Uncomment jika route sudah tersedia
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="{{ route('cart') }}" class="dropdown-item">Cart</a>
                                <a href="{{ route('checkout') }}" class="dropdown-item">Checkout</a>
                                <a href="{{ route('testimonial') }}" class="dropdown-item">Testimonial</a>
                                <a href="{{ route('404') }}" class="dropdown-item">404 Page</a>
                            </div>
                            --}}
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="d-flex m-3 me-0">
                        <button
                            class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                            data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="fas fa-search text-primary"></i>
                        </button>
                        <a href="{{ route('cart') }}" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span
                                class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                        </a>
                        <a href="{{ route('profile') }}" class="my-auto">
                            <i class="fas fa-user fa-2x"></i>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    {{-- Navbar End --}}

    {{-- Orders Section --}}
    <main class="container">
        <div class="orders-card">
            <h2 class="mb-4 text-center">Pesanan Saya</h2>

            {{-- Dummy Order 1 --}}
            <div class="order-item">
                <div class="d-flex justify-content-between">
                    <div>
                        <strong>#ORD-00123</strong><br>
                        <span class="text-muted">22 November 2025</span>
                    </div>
                    <div class="text-end">
                        <span class="order-status">Sedang dikemas</span><br>
                        <a href="#" class="btn btn-sm btn-outline-success mt-2">Lihat Detail</a>
                    </div>
                </div>
            </div>

            {{-- Dummy Order 2 --}}
            <div class="order-item">
                <div class="d-flex justify-content-between">
                    <div>
                        <strong>#ORD-00122</strong><br>
                        <span class="text-muted">20 November 2025</span>
                    </div>
                    <div class="text-end">
                        <span class="order-status text-secondary">Selesai</span><br>
                        <a href="#" class="btn btn-sm btn-outline-secondary mt-2">Lihat Detail</a>
                    </div>
                </div>
            </div>

            {{-- Tambahkan loop data pesanan di sini jika pakai database --}}
        </div>
    </main>
</body>

</html>
