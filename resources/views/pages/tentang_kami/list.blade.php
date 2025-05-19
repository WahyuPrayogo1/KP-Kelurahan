@extends('layouts.app')

@section('content')
    <div class="container py-5 mb-5">
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4" >
        <ol class="breadcrumb" style="font-size: 14px">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}" class="text-decoration-none text-muted">Beranda</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Tentang Kami
            </li>
        </ol>
    </nav>

    <!-- Tentang Kami -->
    <section class="tentang-kami">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold text-uppercase" style="color: #6F3A68; letter-spacing: 2px;">Tentang Kami</h2>
                <p class="text-muted mt-3" style="font-size: 15px; line-height: 1.8; text-align: justify;">
                    Kelurahan Subangjaya merupakan salah satu kelurahan yang terletak di Kecamatan Cikole, Kota Sukabumi, Jawa Barat.
                    Kelurahan ini memiliki luas wilayah sekitar 2.201.200 m² dan terdiri dari 14 RW dan 76 RT.
                    Wilayah ini memiliki karakteristik masyarakat yang majemuk, dengan kegiatan ekonomi didominasi oleh sektor perdagangan, jasa, dan pertanian.
                </p>
            </div>
        </div>

        <!-- Jumlah Penduduk & Chart -->
        <div class="row mb-4 justify-content-center">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between px-3 py-3 shadow-sm rounded gap-4 w-100" style="max-width: 800px;">
                
                <!-- Kiri: Jumlah Penduduk -->
                <div class="text-center text-md-start flex-grow-1">
                    <h5 class="fw-semibold mb-2">Jumlah Penduduk Tahun Ini:</h5>
                    <p class="mb-0" style="font-size: 21px; font-weight: 300;">
                        {{ number_format($latest->laki_laki + $latest->perempuan) }} Jiwa
                    </p>
                </div>

                <!-- Kanan: Chart dan Ikon -->
                <div class="d-flex flex-column flex-sm-row align-items-center gap-4">
                    
                    <!-- Donut Chart -->
                    <div style="width: 200px; height: 200px; min-width: 200px;">
                        <canvas id="pendudukChart" width="200" height="200"></canvas>
                    </div>

                    <!-- Ikon Laki & Perempuan -->
                    <div class="d-flex flex-column gap-3 text-center text-sm-start">
                        <!-- Laki-laki -->
                        <div class="d-flex align-items-center gap-2" style="color: #FF7043;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#FF7043" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3z"/>
                                <path fill-rule="evenodd" d="M8 8a3 3 0 100-6 3 3 0 000 6z"/>
                            </svg>
                            <div>
                                <div style="font-weight: bold; font-size: 16px;">
                                    {{ round(($latest->laki_laki / ($latest->laki_laki + $latest->perempuan)) * 100, 1) }}%
                                </div>
                                <div style="font-size: 13px;">{{ number_format($latest->laki_laki) }} Laki-laki</div>
                            </div>
                        </div>

                        <!-- Perempuan -->
                        <div class="d-flex align-items-center gap-2" style="color: #6F3A68;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#6F3A68" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3z"/>
                                <path fill-rule="evenodd" d="M8 8a3 3 0 100-6 3 3 0 000 6z"/>
                            </svg>
                            <div>
                                <div style="font-weight: bold; font-size: 16px;">
                                    {{ round(($latest->perempuan / ($latest->laki_laki + $latest->perempuan)) * 100, 1) }}%
                                </div>
                                <div style="font-size: 13px;">{{ number_format($latest->perempuan) }} Perempuan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mata Pencaharian -->
        <div class="row mb-5 text-center px-3" style="padding-top: 50px;">
            <div class="col-12 text-center px-3">
                <h5 class="fw-semibold mb-3">Mata Pencaharian Menurut Sektor</h5>
                <canvas id="sektorPekerjaanChart" style="max-width: 75%; height: 500px; max-height: 600px; margin: 0 auto;"></canvas>
            </div>
        </div>

        <!-- Struktur Organisasi -->
        <div class="row mb-5 justify-content-center px-3">
            <div class="col-12 text-center mb-3">
                <h5 class="fw-semibold">Struktur Organisasi Aparatur Pemerintahan</h5>
            </div>
            <div class="col-12 col-md-8 text-center">
                <img src="{{ asset('images/Struktur-Subangjaya.png') }}" alt="Struktur Organisasi" class="img-fluid shadow-sm rounded" style="max-height: 450px; object-fit: contain;">
            </div>
        </div>

        <!-- Google Maps -->
        <div class="row mb-4 bg-white rounded shadow-sm">
            <div class="col-12 col-md-6 p-3 p-md-4 order-2 order-md-1">
                <h5 class="fw-bold">Batas Wilayah:</h5>

                <div class="row mb-2 text-muted" style="font-size: 15px; line-height: 1.8;">
                    <div class="col-6">
                        <strong>Utara:</strong><br>
                        Berbatasan dengan Desa Sukajaya.
                    </div>
                    <div class="col-6">
                        <strong>Timur:</strong><br>
                        Berbatasan dengan Kelurahan Cibeureum Hilir dan Desa Sukaraja.
                    </div>
                </div>

                <div class="row mb-2 text-muted" style="font-size: 15px; line-height: 1.8;">
                    <div class="col-6">
                        <strong>Selatan:</strong><br>
                        Berbatasan dengan Kelurahan Nanggeleng.
                    </div>
                    <div class="col-6">
                        <strong>Barat:</strong><br>
                        Berbatasan dengan Kelurahan Cisarua.
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between text-muted" style="font-size: 15px;">
                    <strong>Luas Wilayah:</strong>
                    <span>2.201.200 m²</span>
                </div>
                <div class="d-flex justify-content-between text-muted" style="font-size: 15px;">
                    <strong>Jumlah RW/RT:</strong>
                    <span>14 RW / 76 RT</span>
                </div>
                <div class="d-flex justify-content-between text-muted" style="font-size: 15px;">
                    <strong>Kode Pos:</strong>
                    <span>43116</span>
                </div>
            </div>

            <div class="col-12 col-md-6 p-3 p-md-4 order-1 order-md-2">
                <iframe
                    src="https://maps.google.com/maps?q=kelurahan%20subangjaya&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    width="100%" height="100%" style="min-height:300px; border:0; border-radius: 12px;" frameborder="0"
                    allowfullscreen="" aria-hidden="false" tabindex="0"
                ></iframe>
            </div>
        </div>

    </section>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pendudukChart').getContext('2d');
    const pendudukChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [{{ $latest->laki_laki }}, {{ $latest->perempuan }}],
                backgroundColor: ['#FF7043', '#6F3A68'],
                borderWidth: 0,
                cutout: '70%',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.parsed;
                            return label + ': ' + value.toLocaleString() + ' orang';
                        }
                    }
                }
            }
        }
    });

    // Chart sektor Pekerjaan
    const sektorData = @json($sektorPekerjaan);

    // Ambil label sektor dan job titles
    const sektorLabels = Object.keys(sektorData);

    // Dapatkan semua jenis pekerjaan unik di seluruh sektor (untuk legend & dataset)
    const jobTypesSet = new Set();
    sektorLabels.forEach(sektor => {
        Object.keys(sektorData[sektor]).forEach(job => jobTypesSet.add(job));
    });
    const jobTypes = Array.from(jobTypesSet);

    // Palet warna tema halaman (ungu & oranye)
    const themeColors = [
        '#6F3A68', // ungu utama
        '#FF7043', // oranye utama
        '#9C5B87', // ungu muda
        '#FF9C6E', // oranye muda
        '#D1A3C6', // ungu pastel
        '#FFB88C', // oranye pastel
        '#A05195', // ungu tua
        '#FF6F3A'  // oranye cerah
    ];

    // Buat dataset sesuai jobTypes dan sektor dengan warna tema
    const datasets = jobTypes.map((job, i) => {
        return {
            label: job,
            data: sektorLabels.map(sektor => sektorData[sektor][job] || 0),
            backgroundColor: themeColors[i % themeColors.length]
        };
    });

    const ctx2 = document.getElementById('sektorPekerjaanChart').getContext('2d');
    const sektorPekerjaanChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: sektorLabels,
            datasets: datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    stacked: true,
                    title: {
                        display: true,
                        text: 'Sektor'
                    }
                },
                y: {
                    stacked: true,
                    title: {
                        display: true,
                        text: 'Jumlah Orang'
                    },
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 20,
                        padding: 10
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.parsed.y.toLocaleString() + ' orang';
                        }
                    }
                }
            }
        }
    });
</script>

<style>
    #pendudukChart, #sektorPekerjaanChart {
        width: 100% !important;
        height: 100% !important;
    }

    @media (max-width: 575.98px) {
        .tentang-kami h2 {
            font-size: 22px;
        }
        .tentang-kami p {
            font-size: 14px !important;
        }
        .d-flex.flex-column.flex-md-row {
            flex-direction: column !important;
            align-items: center !important;
        }
        .d-flex.flex-column.flex-sm-row > div {
            justify-content: center !important;
            text-align: center !important;
        }
        .d-flex.flex-column.flex-sm-row {
            flex-direction: column !important;
            gap: 12px !important;
        }
        .text-center.text-md-start {
            text-align: center !important;
        }
        iframe {
            min-height: 250px !important;
        }
    }
</style>

@endsection
