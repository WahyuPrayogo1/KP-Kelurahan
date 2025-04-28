<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SALAMIN KE BANG JAYI</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #ffffff;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #ffffff;
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 10px 20px;
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
        .hero-text p{
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

        .btn-custom{
            padding: 8px;
            background-color: #6F3A68;
            color: white;
        }

        .btn-custom:hover{
            padding: 8px;
            background-color: #6F3A68;
            color: white;
        }

        .btn-outline-custom{
            padding: 8px;
            background-color: #ffffff;
            color: #6F3A68;
            border-color: #6F3A68;
        }

        .btn-outline-custom:hover{
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
                height: 300px; /* Atur tinggi lebih kecil di mobile */
                width: 100%;
            }

            .hero-text {
                text-align: center;
                padding: 20px;
            }
        }


        /* Section 2 */
        .layanan-text{
            font-weight: 400;
            font-size: 14px;
            color: #969696;
            line-height: 1.6;
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
    </style>
</head>
<body>
    <!-- Sticky Header -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/images.png') }}" alt="Logo" width="40">
            </a>

            <!-- Navbar untuk Desktop -->
            <div class="d-none d-lg-flex ms-3">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Persyaratan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Artikel</a></li>
                </ul>
            </div>

<!-- Button di kanan -->
<div class="ms-auto d-none d-lg-flex">
    @if(Auth::check())  <!-- Memeriksa apakah pengguna sudah login -->
        <a href="{{ route('/dashboard') }}" class="btn btn-custom me-2">DASHBOARD</a>
    @else
        <a href="{{ route('register') }}" class="btn btn-custom me-2">DAFTAR</a>
        <a href="{{ route('login') }}" class="btn btn-outline-custom">MASUK</a>
    @endif
</div>


            <!-- Toggle Button (Mobile) -->
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
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
                <li class="nav-item"><a class="nav-link" href="#">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Persyaratan</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Artikel</a></li>
            </ul>
            <hr>
            <a href="{{ route('register') }}" class="btn btn-custom w-100 mb-2">DAFTAR</a>
            <a href="{{ route('login') }}" class="btn btn-outline-custom w-100">MASUK</a>
        </div>
    </div>


   <!-- Hero Section -->
   <div class="container-fluid hero-section">
    <div class="row g-0 w-100">
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="hero-text">
                <h1 class="fw-bold">SALAMIN KE BANG JAYI</h1>
                <p class="mt-4 mb-5">Selamat datang di SALAMIN KE BANG JAY!
                    Website layanan administrasi Kelurahan Subangjaya yang bisa diakses secara Online</p>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-custom w-100">Login</a>
                        <a href="#" class="btn btn-outline-custom w-100">Lihat Layanan</a>
                    </div>

            </div>
        </div>
        <div class="col-md-6 hero-image"></div>
    </div>
    </div>

    <!-- Section Baru -->
        <!-- Section Baru -->
        <div class="container mt-5 mb-5 ">
            <div class="row g-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">Layanan Umum</h2>
                    <div class="input-group search-box" style="max-width: 250px;">
                        <input type="text" class="form-control" placeholder="Cari layanan...">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/letter (1).png') }}" alt="Gambar 1" class="me-3" width="60">
                        <h5 class="mb-0 layanan-text">Surat Pengantar Keterangan ijin keramaian</h5>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/letter (1).png') }}" alt="Gambar 1" class="me-3" width="60">
                        <h5 class="mb-0 layanan-text">Surat Pengantar Keterangan catatan Kepolisian</h5>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/letter (1).png') }}" alt="Gambar 1" class="me-3" width="60">
                        <h5 class="mb-0 layanan-text">Surat Keterangan tidak mampu Miskin</h5>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/letter (1).png') }}" alt="Gambar 1" class="me-3" width="60">
                        <h5 class="mb-0 layanan-text">Surat Keterangan Penyelenggaraan Jaminan Pemeliharaan</h5>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                        <a style="text-decoration: none" href="{{route('surat-keterangan-pindah.create')}}">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/letter (1).png') }}" alt="Gambar 1" class="me-3" width="60">
                            <h5 class="mb-0 layanan-text">Surat Keterangan Domisili</h5>
                        </div>
                    </a>
                    </div>
                <div class="col-md-3 mb-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/letter (1).png') }}" alt="Gambar 1" class="me-3" width="60">
                        <h5 class="mb-0 layanan-text"> Surat Keterangan pindah Domisili Perusahaan/yayasan</h5>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/letter (1).png') }}" alt="Gambar 1" class="me-3" width="60">
                        <h5 class="mb-0 layanan-text">Surat Keterangan Kepemilikan Tanah</h5>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/letter (1).png') }}" alt="Gambar 1" class="me-3" width="60">
                        <h5 class="mb-0 layanan-text">Surat Keterangan Tanah tidak sengketa</h5>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/letter (1).png') }}" alt="Gambar 1" class="me-3" width="60">
                        <h5 class="mb-0 layanan-text">Surat Pengantar Keterangan ijin keramaian</h5>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/letter (1).png') }}" alt="Gambar 1" class="me-3" width="60">
                        <h5 class="mb-0 layanan-text">Surat Keterangan Beda Data Kependudukan</h5>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/letter (1).png') }}" alt="Gambar 1" class="me-3" width="60">
                        <h5 class="mb-0 layanan-text">Surat Keterangan Status Perkawinan</h5>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/letter (1).png') }}" alt="Gambar 1" class="me-3" width="60">
                        <h5 class="mb-0 layanan-text">Surat Keterangan Laporan Kehilangan</h5>
                    </div>
                </div>
            </div>
        </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
