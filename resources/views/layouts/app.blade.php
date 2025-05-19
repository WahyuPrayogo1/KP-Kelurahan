<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SALAMIN KE BANG JAY!</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        body {
            background-color: #ffffff;
            font-family: 'Poppins', sans-serif;
        }



        .nav-link {
            color: #6F3A68 !important;
            font-size: 14px;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #d6b5d3 !important;
        }

        .hero-section {
            display: flex;
            align-items: center;
            height: 100vh;
            background-color: #f3e5f5
        }

        .hero-text {
            max-width: 500px;
        }

        .hero-text p {
            font-size: 16px;
            color: #5C5C5C;
            line-height: 1.9;
            font-weight: 400;
        }

        .hero-image {
            background: url('{{ asset('images/image-desa.png') }}') no-repeat center center;
            background-size: cover;
            height: 100vh;
        }

        .btn-custom {
            padding: 8px;
            background-color: #6F3A68;
            color: white;
        }

        .btn-custom:hover {
            padding: 8px;
            background-color: #6F3A68;
            color: white;
        }

        .btn-outline-custom {
            padding: 8px;
            background-color: #ffffff;
            color: #6F3A68;
            border-color: #6F3A68;
        }

        .btn-outline-custom:hover {
            padding: 8px;
            background-color: #ffffff;
            color: #6F3A68;
            border-color: #6F3A68;
        }

        @media (max-width: 768px) {
            .hero-section {
                flex-direction: column;
                height: auto;
            }

            .hero-image {
                height: 300px;
                /* Atur tinggi lebih kecil di mobile */
                width: 100%;
            }

            .hero-text {
                text-align: center;
                padding: 20px;
            }
        }


        /* Section 2 */
        .layanan-text {
            font-weight: 400;
            font-size: 14px;
            color: #969696;
            line-height: 1.6;
        }

        .layanan-text-syarat {
            font-weight: 400;
            font-size: 14px;
            color: #545454;
            line-height: 2;
            list-style: none;
            text-align: center;
            padding-left: 0;
            padding-top: 20px;
        }

        .layanan-peraturan {
            font-weight: 400;
            font-size: 16px;
            color: #ffffff;
            line-height: 2;
            list-style: none;
            text-align: center;
            padding-left: 0;
            padding-top: 20px;
        }




        /* Search */
        .search-box .form-control {
            border: 2px solid #6F3A68;
            background-color: #ffffff;
            color: #6F3A68;
        }

        .search-box .form-control::placeholder {
            color: #6F3A68
        }

        .search-box .input-group-text {
            background-color: #ffffff;
            border: 2px solid #6F3A68;
            color: #6F3A68;
        }

        .search-box .form-control:focus {
            border-color: #5A2F59;
            box-shadow: 0 0 5px rgba(111, 58, 104, 0.5);
        }

        .fw-bold-custom {
            font-weight: 600;
            font-size: 25px;
        }

        .fw-bold-custom1 {
            font-weight: 600;
            font-size: 32px;
        }

        .text-purple {
            color: #6F3A68 !important;
        }

        .bg-purple {
            background-color: #6F3A68 !important;
        }
    </style>

    <style>
        .form-control:focus {
            border-color: #F3E5F5;
            box-shadow: 0 0 5px rgba(111, 58, 104, 0.5);
        }
    </style>

    <!-- Add custom CSS for mobile responsiveness -->
    <style>
        @media (max-width: 768px) {
            .container {
                padding: 40px;
                /* Padding smaller on mobile */
            }
        }
    </style>



</head>

<body>
    <!-- Sticky Header -->
    <nav class="navbar navbar-expand-lg bg-white shadow sticky-top py-2 px-3">
        <div class="container p-0">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/images.png') }}" alt="Logo" width="40">
            </a>

            <!-- Navbar untuk Desktop -->
            <div class="d-none d-lg-flex ms-3">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{route('tentangKami.list')}}">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('persyaratan')}}">Persyaratan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('berita.list')}}">Artikel</a></li>
                </ul>
            </div>

            <!-- Button di kanan -->
            <div class="ms-auto d-none d-lg-flex">
                @if (Auth::check())
                    <!-- Memeriksa apakah pengguna sudah login -->
                    <a href="{{ route('/dashboard') }}" class="btn btn-custom me-2">DASHBOARD</a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-custom me-2">DAFTAR</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-custom">MASUK</a>
                @endif
            </div>


            <!-- Toggle Button (Mobile) -->
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobileMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Offcanvas Sidebar untuk Mobile -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{route('tentangKami.list')}}">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('persyaratan')}}">Persyaratan</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('berita.list')}}">Artikel</a></li>
            </ul>
            <hr>
            <a href="{{ route('register') }}" class="btn btn-custom w-100 mb-2">DAFTAR</a>
            <a href="{{ route('login') }}" class="btn btn-outline-custom w-100">MASUK</a>
        </div>
    </div>

    @yield('content')


    <!-- Footer -->
    <footer class="bg-light mt-5" style="font-size: 14px; color: #4F4F4F;">
        <div class="container">
            <div class="row pt-4 pb-2 gy-4">
                <!-- Kolom 1: Logo + Alamat -->
                <div class="col-md-4">
                    <div class="d-flex align-items-start">
                        <img src="images/logo.png" alt="Logo" class="img-fluid me-3" style="max-height: 75px;">
                        <div>
                            <p class="mb-1">Kecamatan Cikole, Kelurahan Subangjaya,</p>
                            <p class="mb-1">Sukabumi, Jawa Barat, Indonesia.</p>
                            <p class="mb-0">43116</p>
                        </div>
                    </div>
                </div>

                <!-- Kolom 2: Kontak -->
                <div class="col-md-4">
                    <h5 class="mb-3" style="font-weight: 600; font-size: 18px;">Kontak</h5>
                    <ul class="list-unstyled">
                        <li>Email: <a href="mailto:kelurahansubangjaya@gmail.com" class="text-decoration-none text-dark">kelurahansubangjaya@gmail.com</a></li>
                        <li>Telepon: +62 811-2201-102</li>
                        <li>WhatsApp: +62 811-2201-102</li>
                    </ul>
                </div>

                <!-- Kolom 3: Jelajahi -->
                <div class="col-md-4">
                    <h5 class="mb-3" style="font-weight: 600; font-size: 18px;">Jelajahi</h5>
                    <ul class="list-unstyled">
                        <li><a href="https://sukabumikota.go.id" class="text-decoration-underline text-dark">Website Kota Sukabumi</a></li>
                        <li><a href="https://cekdptonline.kpu.go.id" class="text-decoration-underline text-dark">DPT Online</a></li>
                    </ul>
                </div>
            </div>

            <hr class="my-4">

            <!-- Copyright -->
            <div class="text-center pb-2">
                <p class="mb-0">&copy; 2025 Kelurahan Subangjaya. Semua Hak Dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

