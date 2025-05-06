@extends('backend.master')

@section('content')
    <style>
        .card-body a:hover {
            transform: scale(1.05);
            /* Membesarkan elemen sedikit */
            transition: transform 0.3s ease-in-out;
            /* Durasi animasi */
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            /* Menambahkan bayangan */
        }

        .card-body a {
            display: block;
            /* Pastikan elemen link mengisi area di dalam card */
            padding: 8px;
        }
    </style>

    <style>
        .searchable-card {
            transition: all 0.3s ease;
        }

        .card-link-pop:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Animasi untuk kartu yang muncul */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .searchable-card:not(.d-none) {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>



    @role('Admin')
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Dashboard
                        </div>
                        <h2 class="page-title">
                            Kelurahan Subang Jaya
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xl mt-5">
            <div class="row row-deck row-cards">
                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Proses</div>
                            </div>
                            <!-- Ganti angka '2' dengan data dinamis dari controller -->
                            <div class="h1 mb-3">{{ $prosesCount }}</div>
                            <small>Total</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Selesai</div>
                            </div>
                            <!-- Ganti angka '10' dengan data dinamis dari controller -->
                            <div class="h1 mb-3">{{ $selesaiCount }}</div>
                            <small>Total</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Ditolak</div>
                            </div>
                            <!-- Ganti angka '10' dengan data dinamis dari controller -->
                            <div class="h1 mb-3">{{ $ditolakCount }}</div>
                            <small>Total</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <!-- Proses -->
                <div class="col-md-6">
                    <h1>Proses</h1>
                    <div class="card" style="height: 28rem">
                        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                            @forelse($prosesItems as $item)
                                <div class="py-2 border-bottom">
                                    <a href="{{ url($item->model_type . '/' . $item->id . '/edit') }}"
                                        class="text-decoration-none text-dark">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="avatar bg-primary-lt">{{ strtoupper(substr($item->nama, 0, 2)) }}</span>
                                            </div>
                                            <div class="col">
                                                <h1 class="mb-0 fs-3 fw-bold text-body">
                                                    @if ($item->model_type == 'keterangan_domisili')
                                                        Surat Keterangan Pindah Domisili
                                                    @elseif($item->model_type == 'keterangan_usaha')
                                                        Surat Keterangan Usaha
                                                    @endif
                                                </h1>

                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <div class="text-secondary small">
                                                            Status: {{ ucfirst($item->status) }}
                                                        </div>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="text-muted small">
                                                            Dibuat pada: {{ $item->created_at->format('d M Y') }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div class="text-center text-muted py-3">
                                    Tidak ada data Proses.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Selesai -->
                <div class="col-md-6">
                    <h1>Selesai</h1>
                    <div class="card" style="height: 28rem">
                        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                            @forelse($selesaiItems as $item)
                                <div class="py-2 border-bottom">
                                    <a href="{{ url($item->model_type . '/' . $item->id . '/edit') }}"
                                        class="text-decoration-none text-dark">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="avatar bg-success-lt">{{ strtoupper(substr($item->nama, 0, 2)) }}</span>
                                            </div>
                                            <div class="col">
                                                <h1 class="mb-0 fs-3 fw-bold text-body">
                                                    @if ($item->model_type == 'keterangan_domisili')
                                                        Surat Keterangan Pindah Domisili
                                                    @elseif($item->model_type == 'keterangan_usaha')
                                                        Surat Keterangan Usaha
                                                    @endif
                                                </h1>

                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <div class="text-secondary small">
                                                            Status: {{ ucfirst($item->status) }}
                                                        </div>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="text-muted small">
                                                            Dibuat pada: {{ $item->created_at->format('d M Y') }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div class="text-center text-muted py-3">
                                    Tidak ada data Selesai.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>




            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Jumlah Penduduk</h3>
                            <div id="chart-mentions" class="chart-lg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    @endrole

    @role('User')
        <div class="container-xl mt-5">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

            <div class="page-header d-print-none">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-title">Buat Surat</div>
                        <h2 class="page-pretitle">
                            Silahkan Pilih Jenis Surat Yang Ingin Anda Buat
                        </h2>
                        <input type="text" id="searchInput" class="form-control"
                            placeholder="Cari jenis surat (contoh: usaha, domisili, nikah)..." aria-label="Search in website">
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-3" id="cardsContainer">
                <!-- Card 1 -->
                <div class="col-md-6 col-lg-4 searchable-card" data-search="surat keterangan pindah domisili pindah alamat">
                    <div class="card card-link-pop shadow-sm h-100">
                        <div class="card-header card-header-light">
                            <h5 class="card-title mb-0">Surat Keterangan Pindah Domisili</h5>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between pt-0">
                            <p class="card-text text-muted">
                                Digunakan untuk mengurus kepindahan warga dari satu alamat ke alamat lainnya secara resmi.
                            </p>
                            <div class="text-end">
                                <a href="{{ route('keterangan_domisili.create') }}" class="btn btn-outline-primary btn-sm">
                                    Buat Surat <i class="bi bi-arrow-right-circle-fill ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6 col-lg-4 searchable-card" data-search="surat keterangan usaha bisnis dagang">
                    <div class="card card-link-pop shadow-sm h-100">
                        <div class="card-header card-header-light">
                            <h5 class="card-title mb-0">Surat Keterangan Usaha</h5>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between pt-0">
                            <p class="card-text text-muted">
                                Dibutuhkan sebagai bukti legalitas usaha yang dimiliki oleh warga di wilayah setempat.
                            </p>
                            <div class="text-end">
                                <a href="{{ route('keterangan_usaha.create') }}" class="btn btn-outline-primary btn-sm">
                                    Buat Surat <i class="bi bi-arrow-right-circle-fill ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-6 col-lg-4 searchable-card" data-search="surat keterangan akta nikah pernikahan">
                    <div class="card card-link-pop shadow-sm h-100">
                        <div class="card-header card-header-light">
                            <h5 class="card-title mb-0">Surat Keterangan Akta Nikah</h5>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between pt-0">
                            <p class="card-text text-muted">
                                Surat pendukung yang digunakan untuk proses pembuatan atau pelaporan akta pernikahan.
                            </p>
                            <div class="text-end">
                                <a href="{{ route('keterangan_akta_nikah.create') }}" class="btn btn-outline-primary btn-sm">
                                    Buat Surat <i class="bi bi-arrow-right-circle-fill ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-md-6 col-lg-4 searchable-card" data-search="surat pengantar keterangan ijin keramaian acara">
                    <div class="card card-link-pop shadow-sm h-100">
                        <div class="card-header card-header-light">
                            <h5 class="card-title mb-0">Surat Pengantar Keterangan Ijin Keramaian</h5>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between pt-0">
                            <p class="card-text text-muted">
                                Surat pengantar resmi dari kelurahan sebagai syarat pengajuan izin kegiatan keramaian di
                                lingkungan masyarakat.
                            </p>
                            <div class="text-end">
                                <a href="{{ route('surat_pengantar_ijin_keramaian.create') }}"
                                    class="btn btn-outline-primary btn-sm">
                                    Buat Surat <i class="bi bi-arrow-right-circle-fill ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Template untuk hasil tidak ditemukan -->
            <div id="noResultsTemplate" class="d-none">
                <div class="col-12 text-center py-5">
                    <div class="empty">
                        <div class="empty-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search-off"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 5l14 14"></path>
                                <path d="M9.5 9.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0"></path>
                                <path d="M19.5 15.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0"></path>
                                <path d="M11 15c1.998 0 3.74 -.8 5 -2a8.99 8.99 0 0 0 2.362 -5.633"></path>
                            </svg>
                        </div>
                        <p class="empty-title">Tidak ditemukan hasil pencarian</p>
                        <p class="empty-subtitle text-muted">Coba dengan kata kunci lain</p>
                    </div>
                </div>
            </div>
        </div>





    @endrole
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const cardsContainer = document.getElementById('cardsContainer');
        const cards = Array.from(document.querySelectorAll('.searchable-card'));
        const noResultsTemplate = document.getElementById('noResultsTemplate');

        // Fungsi untuk menampilkan/menyembunyikan kartu berdasarkan pencarian
        function filterCards(searchTerm) {
            searchTerm = searchTerm.toLowerCase().trim();
            let hasMatches = false;

            // Sembunyikan semua kartu terlebih dahulu
            cards.forEach(card => {
                card.classList.add('d-none');
            });

            // Jika pencarian kosong, tampilkan semua kartu
            if (searchTerm === '') {
                cards.forEach(card => {
                    card.classList.remove('d-none');
                });
                return;
            }

            // Cari kartu yang sesuai
            cards.forEach(card => {
                const searchData = card.getAttribute('data-search').toLowerCase();
                const cardTitle = card.querySelector('.card-title').textContent.toLowerCase();
                const cardText = card.querySelector('.card-text').textContent.toLowerCase();

                if (searchData.includes(searchTerm) ||
                    cardTitle.includes(searchTerm) ||
                    cardText.includes(searchTerm)) {
                    card.classList.remove('d-none');
                    hasMatches = true;
                }
            });

            // Tampilkan pesan jika tidak ada hasil
            const existingNoResults = document.getElementById('noResultsDisplay');
            if (!hasMatches) {
                if (!existingNoResults) {
                    const noResultsClone = noResultsTemplate.cloneNode(true);
                    noResultsClone.id = 'noResultsDisplay';
                    noResultsClone.classList.remove('d-none');
                    cardsContainer.appendChild(noResultsClone);
                }
            } else if (existingNoResults) {
                existingNoResults.remove();
            }
        }

        // Fungsi debounce untuk optimasi performa
        function debounce(func, timeout = 300) {
            let timer;
            return function(...args) {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, timeout);
            };
        }

        // Event listener dengan debounce
        searchInput.addEventListener('input', debounce(function() {
            filterCards(this.value);
        }));

        // Fokus ke input search saat halaman dimuat
        searchInput.focus();
    });
</script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const cardsContainer = document.getElementById('cardsContainer');
            const cards = Array.from(document.querySelectorAll('.searchable-card'));
            const noResultsTemplate = document.getElementById('noResultsTemplate');

            // Fungsi untuk menampilkan/menyembunyikan kartu berdasarkan pencarian
            function filterCards(searchTerm) {
                searchTerm = searchTerm.toLowerCase().trim();
                let hasMatches = false;

                // Sembunyikan semua kartu terlebih dahulu
                cards.forEach(card => {
                    card.classList.add('d-none');
                });

                // Jika pencarian kosong, tampilkan semua kartu
                if (searchTerm === '') {
                    cards.forEach(card => {
                        card.classList.remove('d-none');
                    });
                    return;
                }

                // Cari kartu yang sesuai
                cards.forEach(card => {
                    const searchData = card.getAttribute('data-search').toLowerCase();
                    const cardTitle = card.querySelector('.card-title').textContent.toLowerCase();
                    const cardText = card.querySelector('.card-text').textContent.toLowerCase();

                    if (searchData.includes(searchTerm) ||
                        cardTitle.includes(searchTerm) ||
                        cardText.includes(searchTerm)) {
                        card.classList.remove('d-none');
                        hasMatches = true;
                    }
                });

                // Tampilkan pesan jika tidak ada hasil
                const existingNoResults = document.getElementById('noResultsDisplay');
                if (!hasMatches) {
                    if (!existingNoResults) {
                        const noResultsClone = noResultsTemplate.cloneNode(true);
                        noResultsClone.id = 'noResultsDisplay';
                        noResultsClone.classList.remove('d-none');
                        cardsContainer.appendChild(noResultsClone);
                    }
                } else if (existingNoResults) {
                    existingNoResults.remove();
                }
            }

            // Fungsi debounce untuk optimasi performa
            function debounce(func, timeout = 300) {
                let timer;
                return function(...args) {
                    clearTimeout(timer);
                    timer = setTimeout(() => {
                        func.apply(this, args);
                    }, timeout);
                };
            }

            // Event listener dengan debounce
            searchInput.addEventListener('input', debounce(function() {
                filterCards(this.value);
            }));

            // Fokus ke input search saat halaman dimuat
            searchInput.focus();
        });
    </script>






@endsection
