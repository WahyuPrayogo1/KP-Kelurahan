@extends('layouts.app')
@section('content')

    <!-- Hero Section -->
    <div class="container-fluid hero-section">
        <div class="row g-0 w-100">
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="hero-text">
                    <h1 class="fw-bold">SALAMIN KE BANG JAY!</h1>
                    <p class="mt-4 mb-5">Selamat datang di SALAMIN KE BANG JAY!
                        Website layanan administrasi Kelurahan Subangjaya yang bisa diakses secara Online</p>
                    <div class="d-flex gap-2">
                        <a href="{{ route('login') }}" class="btn btn-custom w-100">Login</a>
                        <a href="{{route('persyaratan')}}" class="btn btn-outline-custom w-100">Lihat Layanan</a>
                    </div>

                </div>
            </div>
            <div class="col-md-6 hero-image"></div>
        </div>
    </div>

    <!-- Section Baru -->
    <div class="container mt-5 mb-md-5 mb-0 pt-2" id="layanan" style="scroll-margin-top: 100px;">
        <div class="row g-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <div class="text-center text-md-start">
                    <h2 class="text-uppercase m-0"
                        style="color: #6F3A68; font-weight:700; letter-spacing: 3px; font-size: 30px">
                        Layanan Umum
                    </h2>
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

            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-4">
                    <a href="{{ route('surat_keterangan_usahas.create') }}" style="text-decoration: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-store fa-2x me-3" style="color: #FF7043;"></i>
                            <h5 class="mb-0 layanan-text">Surat Keterangan Usaha</h5>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                    <a href="{{ route('beda-data-kependudukan.create') }}" style="text-decoration: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-id-card fa-2x me-3" style="color: #50E3C2;"></i>
                            <h5 class="mb-0 layanan-text">Surat Beda Data Kependudukan</h5>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                    <a href="{{ route('surat_keterangan_tidak_mampu.create') }}" style="text-decoration: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-injured fa-2x me-3" style="color: #e4556d;"></i>
                            <h5 class="mb-0 layanan-text">Surat Keterangan Tidak Mampu</h5>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                    <a href="{{ route('surat_keterangan_miskin.create') }}" style="text-decoration: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-money-bill-wave fa-2x me-3" style="color: #6F3A68;"></i>
                            <h5 class="mb-0 layanan-text">Surat Keterangan Miskin</h5>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                    <a href="{{ route('keterangan_akta_nikah.create') }}" style="text-decoration: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-ring fa-2x me-3" style="color: #D0021B;"></i>
                            <h5 class="mb-0 layanan-text">Surat Keterangan Akta Nikah</h5>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                    <a href="{{ route('surat-bekerja-luar-negeri.create') }}" style="text-decoration: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-briefcase fa-2x me-3" style="color: #50E3C2;"></i>
                            <h5 class="mb-0 layanan-text">Surat Keterangan Bekerja di Luar Negeri</h5>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                    <a href="{{ route('surat_keterangan_kematian.create') }}" style="text-decoration: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-medical fa-2x me-3" style="color: #e4556d;"></i>
                            <h5 class="mb-0 layanan-text">Surat Keterangan Kematian</h5>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                    <a href="{{ route('surat_pengantar_ijin_keramaian.create') }}" style="text-decoration: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-bullhorn fa-2x me-3" style="color: #6F3A68;"></i>
                            <h5 class="mb-0 layanan-text">Surat Pengantar Ijin Keramaian</h5>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                    <a href="{{ route('surat-pindah-perusahaan.create') }}" style="text-decoration: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-building fa-2x me-3" style="color: #BD10E0;"></i>
                            <h5 class="mb-0 layanan-text">Surat Pindah Domisili Perusahaan</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    </div>
<div class="container p-3 mt-5 mt-md-5 mb-0">
    <section class="artikel-slider px-0 py-3 py-md-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
            <div class="text-center text-md-start w-100" style="max-width: 720px;">
                <h2 class="text-uppercase m-0"
                    style="color: #6F3A68; font-weight:700; letter-spacing: 3px; font-size: 30px">
                    Artikel dan Berita Terbaru
                </h2>
                <p class="text-muted small mb-3 mt-2">
                    Baca & Temukan Berita Terbaru Tentang Kelurahan Subangjaya Sukabumi
                </p>
            </div>

            @if($artikels->isNotEmpty())
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
            @endif
        </div>

        <div class="position-relative">
            @if($artikels->isEmpty())
                <div class="alert alert-info text-center py-4">
                    <i class="bi bi-info-circle-fill me-2"></i> Tidak ada artikel tersedia saat ini
                </div>
            @else
                <!-- Slider main container -->
                <div class="swiper artikelSwiper">
                    <!-- Slide Item -->
                    <div class="swiper-wrapper">
                        @foreach ($artikels as $artikel)
                            <div class="swiper-slide">
                                <div class="card shadow-sm rounded-2 overflow-hidden h-100">
                                    <img src="{{ asset('storage/' . $artikel->gambar) }}" class="card-img-top" alt="..." height="200px">

                                    <div class="card-body">
                                        <h5 class="card-title"
                                            style="font-size: 15px; line-height: 24px; color:#000000; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $artikel->judul }}
                                        </h5>
                                        <p class="card-text"
                                            style="font-size: 14px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; padding-top:5px">
                                            {!! Str::limit(strip_tags($artikel->isi), 120) !!}
                                        </p>
                                        <a href="{{ route('berita.detail', $artikel->id) }}" class="text-decoration-none fw-semibold text-purple"
                                            style="margin-top: 10px; font-size: 15px">Baca Selengkapnya →</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
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
                        Tim Kami
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
                        <!-- Lurah -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/lurah.jpg') }}" class="card-img-top" alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Jumyati, S.E</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">NIP.19720412 201001 1 001</p>
                                    <p class="small text-muted">Lurah Subangjaya</p>
                                </div>
                            </div>
                        </div>

                        <!-- Sekretaris -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/Default.png') }}" class="card-img-top" alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Muldan Kamiswara, S.IP</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">NIP.19740328 200901 1 002</p>
                                    <p class="small text-muted">Sekretaris</p>
                                </div>
                            </div>
                        </div>

                        <!-- Bendahara -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/Default.png') }}" class="card-img-top" alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Watnaria Dian Utami, AM, Kep SH</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">NIP.19880103 201101 2 002</p>
                                    <p class="small text-muted">Bendahara</p>
                                </div>
                            </div>
                        </div>

                        <!-- Pelaksana Bendahara -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/Default.png') }}" class="card-img-top" alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Dewi Kurniawati</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">NUP.20180301P851</p>
                                    <p class="small text-muted">Pelaksana</p>
                                </div>
                            </div>
                        </div>

                        <!-- Kasi Trantibum -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/Default.png') }}" class="card-img-top" alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Asep Badrudin, S.IP</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">NIP.19680314 199403 1 004</p>
                                    <p class="small text-muted">Kasi Trantibum</p>
                                </div>
                            </div>
                        </div>

                        <!-- Pelaksana Trantibum -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/Default.png') }}" class="card-img-top" alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Fajar Herdiana Putra</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">NUP.20141001L848</p>
                                    <p class="small text-muted">Pelaksana</p>
                                </div>
                            </div>
                        </div>

                        <!-- MOSAM -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/Default.png') }}" class="card-img-top" alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Herman Lesmana</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">NUP.20170201L849</p>
                                    <p class="small text-muted">MOSAM</p>
                                </div>
                            </div>
                        </div>

                        <!-- Kasi PPM -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/Default.png') }}" class="card-img-top" alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Levi Hendrayani, S.P</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">NIP.19761216 200901 2 002</p>
                                    <p class="small text-muted">Kasi PPM</p>
                                </div>
                            </div>
                        </div>

                        <!-- Pelaksana PPM -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/Default.png') }}" class="card-img-top" alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Kamilah Shalihah Saepullah, S.H</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">NUP.20130101P1308</p>
                                    <p class="small text-muted">Pelaksana</p>
                                </div>
                            </div>
                        </div>

                        <!-- Kasi Kesos -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/Default.png') }}" class="card-img-top" alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Hesti Trestawati, S.E</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">NIP.19781026 200801 2 010</p>
                                    <p class="small text-muted">Kasi Kesos</p>
                                </div>
                            </div>
                        </div>

                        <!-- Pelaksana Kesos -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/Default.png') }}" class="card-img-top" alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Akhmad Hidayat</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">NUP.20220601L1256</p>
                                    <p class="small text-muted">Pelaksana</p>
                                </div>
                            </div>
                        </div>

                        <!-- Operator -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/Default.png') }}" class="card-img-top" alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Fikri Maulana Malik</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;"></p>
                                    <p class="small text-muted">Operator</p>
                                </div>
                            </div>
                        </div>

                        <!-- Babinkamtibmas -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/Default.png') }}" class="card-img-top" alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Bripka Hadi Ismanto</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">NRP</p>
                                    <p class="small text-muted">Babinkamtibmas</p>
                                </div>
                            </div>
                        </div>

                        <!-- Babinsa -->
                        <div class="swiper-slide">
                            <div class="card shadow-sm rounded-2 overflow-hidden h-100 text-center">
                                <img src="{{ asset('images/Default.png') }}" class="card-img-top" alt="Foto Anggota Tim">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size: 16px;">Serka Nasution</h5>
                                    <p class="card-text text-muted" style="font-size: 14px;">NRP</p>
                                    <p class="small text-muted">Babinsa</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tambah slide lainnya sesuai kebutuhan -->
                    </div>
                </div>
            </div>
        </section>
    </div>

<div class="container p-0 p-md-1 mt-0 mb-md-3 mb-0">
    <div class="row d-flex align-items-stretch">
        <!-- Kolom Pertama: Syarat dan Kelengkapan -->
        <div class="col-md-6 mb-4">
            <div class="content-box h-100 p-4 p-md-5 m-3 rounded-5 d-flex flex-column"
                style="background-color: #6F3A68;">
                <h2 class="text-center mb-3" style="font-size: 24px; color: #ffffff;">Pengumuman</h2>
                <ul class="layanan-text-syarat text-white">
                    <li>Lampiran : Keputusan Walikota Sukabumi</li>
                    <li>Nomor : 12 Tahun 2013</li>
                    <li>Tentang : Jenis dan Persyaratan Serta Bentuk Surat Keterangan pada Kelurahan di Lingkungan
                        Pemerintah Kota Sukabumi</li>
                </ul>
                <br><br><h5 class="text-center mb-3 text-white">Jam Operasional Kelurahan</h5>
                <ul class="text-white small text-center list-unstyled">
                    <li>Senin – Kamis: 07.30 – 15.00 WIB</li>
                    <li>Jumat: 07.30 – 13.00 WIB</li>
                    <li>Istirahat: 12.00 – 13.00 WIB</li>
                </ul>
                    <br><br><p class="text-white text-center small">
                        Informasi penting dan pengumuman terbaru akan ditampilkan di sini.<br>
                        Silakan kunjungi kembali secara berkala.
                    </p>
            </div>
        </div>

        <!-- Kolom Kedua: Form Saran -->
        <div class="col-md-6 mb-4">
            <div class="content-box h-100 p-4 p-md-5 m-3 rounded-5" style="background-color: #F3E5F5;">
                <h2 class="text-center mb-3" style="font-size: 24px; color: #6F3A68;">Saran dan Masukan</h2>
                <p class="text-center mb-4" style="color: #4F4F4F; font-size: 13px">
                    Berikan saran dan masukan Anda untuk kemajuan Kelurahan Subangjaya.
                </p>

                <form id="saranForm" action="{{ route('saran.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label" style="color: #4F4F4F; font-weight: 500; font-size: 14px">
                            Nama Lengkap
                        </label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                               name="nama" id="nama" value="{{ old('nama') }}">
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label" style="color: #4F4F4F; font-weight: 500;font-size: 14px">
                            Email
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" id="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pesan" class="form-label" style="color: #4F4F4F; font-weight: 500;font-size: 14px">
                            Saran dan Masukan
                        </label>
                        <textarea class="form-control @error('pesan') is-invalid @enderror" id="pesan"
                                  name="pesan" rows="4">{{ old('pesan') }}</textarea>
                        @error('pesan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="g-recaptcha mb-3" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn"
                                style="background-color: #6F3A68; color: white; padding: 10px 15px;">
                            Kirim Saran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Terima kasih!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000 // menampilkan SweetAlert selama 3 detik
            });
        </script>
    @endif

    <script>
        document.getElementById('saranForm').addEventListener('submit', function(e) {
            // Periksa apakah reCAPTCHA sudah terisi
            if (grecaptcha.getResponse() == "") {
                e.preventDefault(); // Hentikan pengiriman form

                // Tampilkan SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Harap centang reCAPTCHA untuk melanjutkan.',
                });
            }
        });
    </script>

@endsection


