@extends('backend.master')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h1 class="page-title">Surat Saya</h1>
                <div class="text-muted mt-1">Daftar surat yang Anda ajukan</div>
            </div>
            @if($suratSaya->count() > 0)
            <div class="col-auto ms-auto">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <span class="badge bg-green text-green-fg">
                            Total Surat: {{ $suratSaya->count() }}
                        </span>
                    </span>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        @if($suratSaya->count() > 0)
        <div class="row row-cards">
            @foreach ($suratSaya as $surat)
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                @if ($surat instanceof App\Models\SuratKeteranganPindahDomisili)
                                <span class="avatar avatar-md bg-blue-lt">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-community" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8" />
                                        <path d="M13 7l0 .01" />
                                        <path d="M17 7l0 .01" />
                                        <path d="M17 11l0 .01" />
                                        <path d="M17 15l0 .01" />
                                    </svg>
                                </span>
                                @elseif ($surat instanceof App\Models\SuratKeteranganAktaNikah)
                                <span class="avatar avatar-md bg-pink-lt">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                    </svg>
                                </span>
                                @elseif ($surat instanceof App\Models\SuratPengantarIjinKeramaian)
                                <span class="avatar avatar-md bg-warning-lt">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users-group"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                    </svg>
                                </span>
                                @elseif ($surat instanceof App\Models\SuratKeteranganUsaha)
                                <span class="avatar avatar-md bg-green-lt">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-businessplan" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M16 6m-5 0a5 3 0 1 0 10 0a5 3 0 1 0 -10 0" />
                                        <path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                        <path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                        <path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                        <path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                        <path d="M5 15v1m0 -8v1" />
                                    </svg>
                                </span>
                                @elseif ($surat instanceof App\Models\SuratPernyataanTanahTidakSengketa)
                                <span class="avatar avatar-md bg-green-lt">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-businessplan" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M16 6m-5 0a5 3 0 1 0 10 0a5 3 0 1 0 -10 0" />
                                        <path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                        <path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                        <path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                        <path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                        <path d="M5 15v1m0 -8v1" />
                                    </svg>
                                </span>
                                 @elseif ($surat instanceof App\Models\SuratPindahDomisiliPerusahaan)
                                <span class="avatar avatar-md bg-green-lt">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-businessplan" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M16 6m-5 0a5 3 0 1 0 10 0a5 3 0 1 0 -10 0" />
                                        <path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                        <path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                        <path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                        <path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                        <path d="M5 15v1m0 -8v1" />
                                    </svg>
                                </span>
                                @endif
                            </div>
                            <div>
                                <h3 class="card-title mb-1">
                                    @if ($surat instanceof App\Models\SuratKeteranganPindahDomisili)
                                        Surat Pindah Domisili
                                    @elseif ($surat instanceof App\Models\SuratKeteranganAktaNikah)
                                        Surat Akta Nikah
                                    @elseif ($surat instanceof App\Models\SuratPengantarIjinKeramaian)
                                        Surat Ijin Keramain
                                    @elseif ($surat instanceof App\Models\SuratPindahDomisiliPerusahaan)
                                        Surat Pindah Domisili Perusahaan
                                    @elseif ($surat instanceof App\Models\SuratKeteranganUsaha)
                                        Surat Keterangan Usaha
                                    @elseif ($surat instanceof App\Models\SuratPernyataanTanahTidakSengketa)
                                        Surat Keterangan Kepemilikan Tanah Tidak Sengketa
                                    @endif


                                </h3>
                                <div class="text-muted">
                                    {{ $surat->created_at->format('d M Y H:i') }}
                                </div>
                            </div>
                        </div>

                        @if($surat->status == 'ditolak' && $surat->catatan)
    <div class="alert alert-danger mt-3 p-2">
        <div class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                <path d="M12 8v4"></path>
                <path d="M12 16h.01"></path>
            </svg>
            <div class="ms-2">
                <h4 class="alert-title">Alasan Penolakan</h4>
                <div class="text-muted">{{ $surat->catatan }}</div>
            </div>
        </div>
    </div>
@elseif($surat->status == 'selesai')
    <div class="alert alert-success mt-3 p-2">
        <div class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                <path d="M9 12l2 2l4 -4"></path>
            </svg>
            <div class="ms-2">
                <h4 class="alert-title">Surat Telah Selesai</h4>
                <div class="text-muted">
                        Surat Anda telah selesai diproses dan dapat diambil.
                </div>
            </div>
        </div>
    </div>
@elseif($surat->status == 'proses')
    <div class="alert alert-warning mt-3 p-2">
        <div class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                <path d="M12 7v5l3 3"></path>
            </svg>
            <div class="ms-2">
                <h4 class="alert-title">Sedang Diproses</h4>
                <div class="text-muted">
                    Permohonan Anda sedang diverifikasi. Mohon tunggu                </div>
            </div>
        </div>
    </div>
@endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty">
            <div class="empty-img">
                <img src="{{ asset('static/illustrations/undraw_quitting_time_dm8t.svg') }}" height="128" alt="">
            </div>
            <p class="empty-title">Belum ada surat yang diajukan</p>
            <p class="empty-subtitle text-muted">
                Anda belum mengajukan surat apapun. Klik tombol dibawah untuk mengajukan surat baru.
            </p>
            <div class="empty-action">
                <a href="#" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 5l0 14"></path>
                        <path d="M5 12l14 0"></path>
                    </svg>
                    Ajukan Surat Baru
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
