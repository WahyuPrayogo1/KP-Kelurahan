@extends('backend.master')

@section('content')
<style>
    .card-body a:hover {
    transform: scale(1.05); /* Membesarkan elemen sedikit */
    transition: transform 0.3s ease-in-out; /* Durasi animasi */
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan */
}

.card-body a {
    display: block; /* Pastikan elemen link mengisi area di dalam card */
    padding: 8px;
}

</style>
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
                                            <span class="avatar bg-primary-lt">{{ strtoupper(substr($item->nama, 0, 2)) }}</span>
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
@endsection
