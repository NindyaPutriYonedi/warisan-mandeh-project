<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warisan Mandeh</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --orange-main: #E2680B;
        }

        .text-orange {
            color: var(--orange-main) !important;
        }

        .btn-orange {
            background: var(--orange-main) !important;
            color: white !important;
        }

        .btn-orange:hover {
            background: #E2680B !important;
        }

        .btn-orange-outline {
            border: 2px solid var(--orange-main);
            color: var(--orange-main);
        }

        .btn-orange-outline:hover {
            background: var(--orange-main);
            color: white;
        }

        .nav-link:hover {
            color: var(--orange-main) !important;
        }
    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">


<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand fw-bold text-orange d-flex align-items-center gap-2"
   href="{{ route('home') }}">
    <img src="{{ asset('storage/logo-wm.jpeg') }}"
         alt="Warisan Mandeh"
         style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
    <span>Warisan Mandeh</span>
</a>


        <ul class="navbar-nav ms-auto align-items-center">

            <!-- HOME -->
            <li class="nav-item">
                <a class="nav-link fw-semibold" href="{{ route('home') }}">Home</a>
            </li>

            <!-- MENU -->
            <li class="nav-item">
                <a class="nav-link fw-semibold" href="{{ route('product.index') }}">Menu</a>
            </li>

            <!-- TENTANG -->
            <li class="nav-item">
                <a class="nav-link fw-semibold" href="{{ route('about') }}">Tentang</a>
            </li>

            <!-- CART ICON -->
            <li class="nav-item me-2">
                <a href="{{ route('cart.index') }}" class="btn btn-orange-outline px-3">
                    <i class="bi bi-cart"></i>
                </a>
            </li>

            <!-- LOGIN ADMIN -->
            {{-- <li class="nav-item">
                <a href="{{ route('admin.login') }}" class="btn btn-orange fw-semibold px-4">
                    Login
                </a>
            </li> --}}

        </ul>
    </div>
</nav>

<!-- YIELD -->
<main class="container flex-grow-1">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row gy-4">

            {{-- BRAND --}}
            <div class="col-md-4">
                <h5 class="footer-title">Warisan Mandeh</h5>
                <p class="footer-desc">
                    Cemilan rumahan khas Padang dengan raso nan asli.
                    Diracik dari resep turun-temurun,
                    elok dinikmati basamo keluarga.
                </p>
            </div>

            {{-- MENU --}}
            <div class="col-md-4">
                <h6 class="footer-title">Menu</h6>
                <a href="{{ route('home') }}" class="footer-link">Home</a>
                <a href="{{ route('product.index') }}" class="footer-link">Menu</a>
                <a href="{{ route('about') }}" class="footer-link">Tentang Kami</a>
            </div>

            {{-- CONTACT --}}
            <div class="col-md-4">
                <h6 class="footer-title">Hubungi Kami</h6>
                <p class="footer-desc mb-2">
                    Perum Cahaya Mandani<br>
                    Lubuk Minturun, Kota Padang
                </p>

                <div class="footer-social mt-3">
                    <a href="https://wa.me/6289529639475" target="_blank">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                    <a href="https://instagram.com/warisan_mandeh" target="_blank">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="https://www.facebook.com/warisan.mandeh" target="_blank">
                        <i class="bi bi-facebook"></i>
                    </a>
                </div>
            </div>

        </div>

        {{-- <div class="footer-bottom text-center">
            © {{ date('Y') }} Warisan Mandeh — UMKM Oleh-Oleh Minang
        </div> --}}
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
