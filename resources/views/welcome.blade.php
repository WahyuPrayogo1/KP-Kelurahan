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

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


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
                    <li class="nav-item"><a class="nav-link" href="#">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Persyaratan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Artikel</a></li>
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
    <div class="container mt-5 mb-md-5 mb-0 pt-2">
        <div class="row g-4">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <div class="text-center text-md-start">
                    <h2 class="fw-bold-custom1 m-0">Layanan Umum</h2>
                    <p class="text-muted small mt-2 mb-0">
                        Jelajahi berbagai layanan umum yang tersedia di Kelurahan Subangjaya.
                    </p>
                </div>

                <div class="input-group search-box mx-auto mx-md-0" style="max-width: 250px;">
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
                <a style="text-decoration: none" href="{{ route('surat-keterangan-pindah.create') }}">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/letter (1).png') }}" alt="Gambar 1" class="me-3"
                            width="60">
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


    <div class="container p-0 p-md-1 mt-0 mb-md-3 mb-0 ">
        <div class="row d-flex align-items-stretch">
            <!-- Kolom Pertama -->
            <div class="col-md-6 mb-4">
                <div class="content-box h-100 p-4 p-md-5 m-3 rounded-5 d-flex flex-column"
                    style="background-color: #f3e5f5;">
                    <h2 class="fw-bold-custom text-center lh-base pt-4">Syarat dan Kelengkapan <br> Layanan</h2>
                    <ul class="layanan-text-syarat">
                        <li>Lampiran : Keputusan Walikota Sukabumi</li>
                        <li>Nomor : 12 Tahun 2013</li>
                        <li>Tentang : Jenis dan Persyaratan Serta Bentuk Surat Keterangan pada Kelurahan di Lingkungan
                            Pemerintah Kota Sukabumi</li>
                    </ul>

                    <!-- Tombol di bawah -->
                    <div class="text-center mt-auto">
                        <a href="#" class="btn btn-custom w-50 w-md-100">Lihat Detail</a>
                    </div>
                </div>

            </div>

            <!-- Kolom Kedua -->
            <div class="col-md-6 mb-4">
                <div class="content-box h-100 p-4 p-md-5 m-3 rounded-5 text-white" style="background-color: #6F3A68;">
                    <h2 class="fw-bold-custom text-center lh-base pt-4">Peraturan Perundang- <br> undangan</h2>
                    <p class="text-center layanan-peraturan">
                        KODEX TECHNOLOGY (PVT) LTD is a team of experienced mobile and web applications and website
                        builders measuring dozens of completed projects. We build and develop mobile applications for
                        several top platforms, including Android & IOS.
                    </p>
                </div>
            </div>
        </div>

    </div>
    <div class="container p-3 mt-5 mt-md-5 mb-0">
        <section class="artikel-slider px-0 py-3 py-md-4">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <div class="text-center text-md-start w-100" style="max-width: 720px;">
                    <h2 class="text-uppercase m-0"
                        style="color: #6F3A68; font-weight:700; letter-spacing: 3px; font-size: 30px">
                        Artikel dan Berita Terbaru
                    </h2>
                    <p class="text-muted small mb-3 mt-2">
                        Baca & Temukan Berita Terbaru Tentang Kelurahan Subangjaya Sukabumi
                    </p>
                </div>

                <div class="d-flex align-items-center gap-2 justify-content-center w-100 justify-content-md-end">

                    <!-- Button Prev -->
                    <button
                        class="btn btn-outline-secondary border-0 rounded-circle swiper-button-prev-custom d-flex justify-content-center align-items-center"
                        style="width: 40px; height: 40px;">
                        <i class="bi bi-arrow-left"></i>
                    </button>
                    <!-- Button Next -->
                    <button
                        class="btn bg-purple text-white border-0 rounded-circle swiper-button-next-custom d-flex justify-content-center align-items-center"
                        style="width: 40px; height: 40px;">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>


            <div class="position-relative">
                <!-- Slider main container -->
                <div class="swiper artikelSwiper">
                    <div class="swiper-wrapper">
                        <!-- Slide Item -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100">
                                <img src="{{ asset('images/image-desa.png') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"
                                        style="font-size: 15px; line-height: 24px; color:#000000; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                        Kelurahan Subangjaya Dampingi Dinsos Kota Sukabumi Kucurkan Bantuan Sembako</h5>
                                    <p class="card-text"
                                        style="font-size: 14px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; padding-top:5px">
                                        <strong>CIKOLE</strong> — Pemerintah Kelurahan Subangjaya, Kecamatan Cikole
                                        mendampingi Dinas Sosial <a href="#">Kota Sukabumi</a> ..
                                    </p>
                                    <a href="#" class="text-decoration-none fw-semibold text-purple"
                                        style="margin-top: 10px; font-size: 15px">Baca Selengkapnya →</a>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100">
                                <img src="{{ asset('images/image-desa.png') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"
                                        style="font-size: 15px; line-height: 24px; color:#000000; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                        Kelurahan Subangjaya Dampingi Dinsos Kota Sukabumi Kucurkan Bantuan Sembako</h5>
                                    <p class="card-text"
                                        style="font-size: 14px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; padding-top:5px">
                                        <strong>CIKOLE</strong> — Pemerintah Kelurahan Subangjaya, Kecamatan Cikole
                                        mendampingi Dinas Sosial <a href="#">Kota Sukabumi</a> ..
                                    </p>
                                    <a href="#" class="text-decoration-none fw-semibold text-purple"
                                        style="margin-top: 10px; font-size: 15px">Baca Selengkapnya →</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100">
                                <img src="{{ asset('images/image-desa.png') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"
                                        style="font-size: 15px; line-height: 24px; color:#000000; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                        Kelurahan Subangjaya Dampingi Dinsos Kota Sukabumi Kucurkan Bantuan Sembako</h5>
                                    <p class="card-text"
                                        style="font-size: 14px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; padding-top:5px">
                                        <strong>CIKOLE</strong> — Pemerintah Kelurahan Subangjaya, Kecamatan Cikole
                                        mendampingi Dinas Sosial <a href="#">Kota Sukabumi</a> ..
                                    </p>
                                    <a href="#" class="text-decoration-none fw-semibold text-purple"
                                        style="margin-top: 10px; font-size: 15px">Baca Selengkapnya →</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100">
                                <img src="{{ asset('images/image-desa.png') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"
                                        style="font-size: 15px; line-height: 24px; color:#000000; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                        Kelurahan Subangjaya Dampingi Dinsos Kota Sukabumi Kucurkan Bantuan Sembako</h5>
                                    <p class="card-text"
                                        style="font-size: 14px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; padding-top:5px">
                                        <strong>CIKOLE</strong> — Pemerintah Kelurahan Subangjaya, Kecamatan Cikole
                                        mendampingi Dinas Sosial <a href="#">Kota Sukabumi</a> ..
                                    </p>
                                    <a href="#" class="text-decoration-none fw-semibold text-purple"
                                        style="margin-top: 10px; font-size: 15px">Baca Selengkapnya →</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100">
                                <img src="{{ asset('images/image-desa.png') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"
                                        style="font-size: 15px; line-height: 24px; color:#000000; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                        Kelurahan Subangjaya Dampingi Dinsos Kota Sukabumi Kucurkan Bantuan Sembako</h5>
                                    <p class="card-text"
                                        style="font-size: 14px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; padding-top:5px">
                                        <strong>CIKOLE</strong> — Pemerintah Kelurahan Subangjaya, Kecamatan Cikole
                                        mendampingi Dinas Sosial <a href="#">Kota Sukabumi</a> ..
                                    </p>
                                    <a href="#" class="text-decoration-none fw-semibold text-purple"
                                        style="margin-top: 10px; font-size: 15px">Baca Selengkapnya →</a>
                                </div>
                            </div>
                        </div>
                        <!-- Tambah slide lainnya sesuai data -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="container p-3 mt-2  mb-5">
        <section class="team-slider px-0 py-3 py-md-4">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <div class="text-center text-md-start w-100" style="max-width: 720px;">
                    <h2 class="text-uppercase m-0"
                        style="color: #6F3A68; font-weight:700; letter-spacing: 3px; font-size: 30px">
                        Team Kami
                    </h2>
                    <p class="text-muted small mb-3 mt-2">
                        Kenali anggota tim profesional kami yang siap melayani Anda
                    </p>
                </div>
                <div class="d-flex align-items-center gap-2 justify-content-center w-100 justify-content-md-end">

                    <button
                        class="btn btn-outline-secondary border-0 rounded-circle swiper-button-prev-team d-flex justify-content-center align-items-center"
                        style="width: 40px; height: 40px;">
                        <i class="bi bi-arrow-left"></i>
                    </button>
                    <button
                        class="btn bg-purple text-white border-0 rounded-circle swiper-button-next-team d-flex justify-content-center align-items-center"
                        style="width: 40px; height: 40px;">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>

            <div class="position-relative">
                <div class="swiper teamSwiper">
                    <div class="swiper-wrapper">
                        <!-- Anggota Tim 1 -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/image-desa.png') }}" class="card-img-top"
                                    alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Nama Anggota</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">Jabatan / Role</p>
                                    <p class="small text-muted">Deskripsi singkat tentang anggota tim ini.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Anggota Tim 2 -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/image-desa.png') }}" class="card-img-top"
                                    alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Nama Anggota</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">Jabatan / Role</p>
                                    <p class="small text-muted">Deskripsi singkat tentang anggota tim ini.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Anggota Tim 2 -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/image-desa.png') }}" class="card-img-top"
                                    alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Nama Anggota</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">Jabatan / Role</p>
                                    <p class="small text-muted">Deskripsi singkat tentang anggota tim ini.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/image-desa.png') }}" class="card-img-top"
                                    alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Nama Anggota</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">Jabatan / Role</p>
                                    <p class="small text-muted">Deskripsi singkat tentang anggota tim ini.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/image-desa.png') }}" class="card-img-top"
                                    alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Nama Anggota</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">Jabatan / Role</p>
                                    <p class="small text-muted">Deskripsi singkat tentang anggota tim ini.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/image-desa.png') }}" class="card-img-top"
                                    alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Nama Anggota</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">Jabatan / Role</p>
                                    <p class="small text-muted">Deskripsi singkat tentang anggota tim ini.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tambah slide lainnya sesuai kebutuhan -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="container mt-4 mb-5" style="background-color: #F3E5F5; padding: 40px; border-radius: 8px;">
        <h2 class="text-center mb-3" style="font-size: 24px; color: #6F3A68;">Saran dan Masukan</h2>
        <p class="text-center mb-4" style="color: #4F4F4F; font-size: 13px">Berikan saran dan masukan Anda untuk
            kemajuan Kelurahan Subangjaya.</p>
        <form action="#" method="POST" style="max-width: 600px; margin: 0 auto;">
            <div class="mb-3">
                <label for="nama" class="form-label"
                    style="color: #4F4F4F; font-weight: 500; font-size: 14px">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" placeholder=""
                    style="border-radius: 8px; padding: 10px;">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"
                    style="color: #4F4F4F; font-weight: 500;font-size: 14px">Email</label>
                <input type="email" class="form-control" id="email" placeholder=""
                    style="border-radius: 8px; padding: 10px;">
            </div>
            <div class="mb-3">
                <label for="saran" class="form-label"
                    style="color: #4F4F4F; font-weight: 500;font-size: 14px">Saran dan Masukan</label>
                <textarea class="form-control" id="saran" rows="4" placeholder=""
                    style="border-radius: 8px; padding: 10px;"></textarea>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn"
                    style="background-color: #6F3A68; color: white; border-radius: 8px; padding: 10px 20px;">Kirim
                    Saran</button>
            </div>
        </form>
    </div>


    <!-- Footer -->
    <footer class="bg-light mt-5">
        <div class="container ">
          <div class="row pt-3">
            <!-- Kolom 1: Logo -->
            <div class="col-md-3">
              <img src="path_to_logo.png" alt="Logo" class="img-fluid mb-3" style="max-height: 60px;">
              <p class="text-muted" style="color: #4F4F4F; font-size: 14px">Kami menyediakan layanan berkualitas dengan komitmen tinggi untuk kepuasan pelanggan.</p>
            </div>

            <!-- Kolom 2: Jadwal Pelayanan -->
            <div class="col-md-3">
              <h5 class="mb-3" style="font-weight: 600; font-size: 18px">Jadwal Pelayanan</h5>
              <ul class="list-unstyled text-muted" style="color: #4F4F4F; font-size: 14px">
                <li>Senin s.d Jum’at : pukul 07.30 - 15.00</li>
                <li>Jum’at : pukul 07.30 - 13.00</li>
              </ul>
            </div>

            <!-- Kolom 3: Alamat -->
            <div class="col-md-3">
              <h5 class="mb-3" style="font-weight: 600; font-size: 18px">Alamat</h5>
              <p class="text-muted" style="color: #4F4F4F; font-size: 14px">Jawa Barat
                Kecamatan Cikole,
                Kelurahan Subang Jaya,
                Sukabumi
                </p>
            </div>

            <!-- Kolom 4: Kontak -->
            <div class="col-md-3">
              <h5 class="mb-3" style="font-weight: 600; font-size: 18px">Kontak</h5>
              <ul class="list-unstyled text-muted" style="color: #4F4F4F; font-size: 14px">
                <li>Email: <a href="mailto:info@example.com">kelurahan@gmail.com</a></li>
                <li>Telepon: +62 123 456 789</li>
                <li>WhatsApp: +62 987 654 321</li>
              </ul>
            </div>
          </div>

          <!-- Copyright -->
          <div class="row">
            <div class="col-12 text-center mt-5 pt-4 pb-1 mb-0">
              <p class="text-muted" style="color: #4F4F4F; font-size: 14px">&copy; 2025 Nama Perusahaan. Semua Hak Dilindungi.</p>
            </div>
          </div>
        </div>
      </footer>



    <script>
        const swiper = new Swiper('.artikelSwiper', {
            slidesPerView: 1.2,
            spaceBetween: 16,
            breakpoints: {
                768: {
                    slidesPerView: 2.5,
                },
                992: {
                    slidesPerView: 3.5,
                },
                1200: {
                    slidesPerView: 4.2,
                },
            },
            navigation: {
                nextEl: '.swiper-button-next-custom',
                prevEl: '.swiper-button-prev-custom',
            },
        });
    </script>

    <script>
        const swiperTeam = new Swiper('.teamSwiper', {
            slidesPerView: 1.2,
            spaceBetween: 16,
            breakpoints: {
                768: {
                    slidesPerView: 2.5,
                },
                992: {
                    slidesPerView: 3.5,
                },
                1200: {
                    slidesPerView: 4.2,
                },
            },
            navigation: {
                nextEl: '.swiper-button-next-team',
                prevEl: '.swiper-button-prev-team',
            },
        });
    </script>





    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
