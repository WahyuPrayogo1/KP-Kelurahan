@extends('layouts.app')
@section('content')

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
                <a style="text-decoration: none" href="#">
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

        <form id="saranForm" action="{{ route('saran.store') }}" method="POST" style="max-width: 600px; margin: 0 auto;">

            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label" style="color: #4F4F4F; font-weight: 500; font-size: 14px">Nama Lengkap</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama') }}">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label" style="color: #4F4F4F; font-weight: 500;font-size: 14px">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="pesan" class="form-label" style="color: #4F4F4F; font-weight: 500;font-size: 14px">Saran dan Masukan</label>
                <textarea class="form-control @error('pesan') is-invalid @enderror" id="pesan" name="pesan" rows="4">{{ old('pesan') }}</textarea>
                @error('pesan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>


            <div class="d-flex justify-content-end">
                <button type="submit" class="btn"
                    style="background-color: #6F3A68; color: white; border-radius: 8px; padding: 10px 20px;">Kirim
                    Saran</button>
            </div>
        </form>
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


