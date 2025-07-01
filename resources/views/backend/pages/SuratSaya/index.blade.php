@extends('backend.master')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">Surat Saya</h1>
                    <div class="text-muted mt-1">Daftar surat yang Anda ajukan</div>
                </div>
                @if ($suratSaya->count() > 0)
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
            @if ($suratSaya->count() > 0)
                <div class="row row-cards">
                    @foreach ($suratSaya as $surat)
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            @if ($surat instanceof App\Models\SuratKeteranganPindahDomisili)
                                                <span class="avatar avatar-md bg-blue-lt">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-building-community"
                                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8" />
                                                        <path d="M13 7l0 .01" />
                                                        <path d="M17 7l0 .01" />
                                                        <path d="M17 11l0 .01" />
                                                        <path d="M17 15l0 .01" />
                                                    </svg>
                                                </span>
                                            @elseif ($surat instanceof App\Models\SuratKeteranganAktaNikah)
                                                <span class="avatar avatar-md bg-pink-lt">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-heart" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                                    </svg>
                                                </span>
                                            @elseif ($surat instanceof App\Models\SuratKeteranganBedaDataKependudukan)
                                                <span class="avatar avatar-md bg-pink-lt">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-heart" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                                    </svg>
                                                </span>
                                            @elseif ($surat instanceof App\Models\SuratPengantarIjinKeramaian)
                                                <span class="avatar avatar-md bg-warning-lt">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                                        <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                                        <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                                                    </svg>
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                                    </svg>
                                                </span>
                                            @elseif ($surat instanceof App\Models\SuratKeteranganUsaha)
                                                <span class="avatar avatar-md bg-green-lt">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-businessplan" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
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
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-businessplan" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M16 6m-5 0a5 3 0 1 0 10 0a5 3 0 1 0 -10 0" />
                                                        <path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                                        <path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                                        <path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                                        <path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                                        <path d="M5 15v1m0 -8v1" />
                                                    </svg>
                                                </span>
                                            @elseif ($surat instanceof App\Models\SuratKeteranganBekerjaLuarNegeri)
                                                <span
                                                    class="avatar avatar-md d-flex align-items-center justify-content-center"
                                                    style="background-color: #f5f5f5;">
                                                    <i class="fas fa-briefcase fa-2x" style="color: #50E3C2;"></i>
                                                </span>
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M16 6m-5 0a5 3 0 1 0 10 0a5 3 0 1 0 -10 0" />
                                                <path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                                <path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                                <path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                                <path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                                <path d="M5 15v1m0 -8v1" />
                                                </svg>
                                                </span>
                                            @elseif ($surat instanceof App\Models\SuratKeteranganMiskin)
                                                <span
                                                    class="avatar avatar-md d-flex align-items-center justify-content-center"
                                                    style="background-color: #f5f5f5;">
                                                    <i class="fas fa-briefcase fa-2x" style="color: #50E3C2;"></i>
                                                </span>
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M16 6m-5 0a5 3 0 1 0 10 0a5 3 0 1 0 -10 0" />
                                                <path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                                <path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                                <path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                                <path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                                <path d="M5 15v1m0 -8v1" />
                                                </svg>
                                                </span>
                                                 @elseif ($surat instanceof App\Models\SuratKeteranganTidakMampu)
                                                <span
                                                    class="avatar avatar-md d-flex align-items-center justify-content-center"
                                                    style="background-color: #f5f5f5;">
                                                    <i class="fas fa-briefcase fa-2x" style="color: #50E3C2;"></i>
                                                </span>
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M16 6m-5 0a5 3 0 1 0 10 0a5 3 0 1 0 -10 0" />
                                                <path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                                <path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                                <path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                                <path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                                <path d="M5 15v1m0 -8v1" />
                                                </svg>
                                                </span>
                                            @elseif ($surat instanceof App\Models\SuratKeteranganKematian)
                                                <span
                                                    class="avatar avatar-md bg-green-lt d-flex justify-content-center align-items-center">
                                                    <i class="fas fa-file-medical fa-2x" style="color: #e4556d;"></i>
                                                </span>
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
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
                                                @elseif ($surat instanceof App\Models\SuratKeteranganMiskin)
                                                    Surat Miskin
                                                @elseif ($surat instanceof App\Models\SuratKeteranganTidakMampu)
                                                    Surat Tidak Mampu
                                                @elseif ($surat instanceof App\Models\SuratPengantarIjinKeramaian)
                                                    Surat Ijin Keramain
                                                @elseif ($surat instanceof App\Models\SuratPindahDomisiliPerusahaan)
                                                    Surat Pindah Domisili Perusahaan
                                                @elseif ($surat instanceof App\Models\SuratKeteranganUsaha)
                                                    Surat Keterangan Usaha
                                                @elseif ($surat instanceof App\Models\SuratKeteranganBedaDataKependudukan)
                                                    Surat Keterangan Beda Data Kependudukan
                                                @elseif ($surat instanceof App\Models\SuratKeteranganAktaNikah)
                                                    Surat Keterangan Status Perkawinan
                                                @elseif ($surat instanceof App\Models\SuratKeteranganBekerjaLuarNegeri)
                                                    Surat Keterangan Bekerja Luar Negeri
                                                @elseif ($surat instanceof App\Models\SuratKeteranganKematian)
                                                    Surat Keterangan Kematian
                                                @endif
                                            </h3>
                                            <div class="text-muted">
                                                {{ $surat->created_at->format('d M Y H:i') }}
                                            </div>
                                        </div>
                                    </div>

                                    @if ($surat->status == 'ditolak' && $surat->catatan)
                                        <div class="alert alert-danger mt-3 p-2">
                                            <div class="d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-alert-circle" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
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
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-circle-check" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
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
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-clock" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                    <path d="M12 7v5l3 3"></path>
                                                </svg>
                                                <div class="ms-2">
                                                    <h4 class="alert-title">Sedang Diproses</h4>
                                                    <div class="text-muted">
                                                        Permohonan Anda sedang diverifikasi. Mohon tunggu </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="mt-3 d-flex justify-content-end">
                                        <div class="btn-group">
                                            <!-- Button Lihat/Detail -->
                                            @if ($surat->type == 'pindah_domisili')
                                                <a href="{{ route('keterangan_domisili.show', $surat->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-eye" width="16"
                                                        height="16" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                    Lihat
                                                </a>
                                            @elseif($surat->type == 'akta_nikah')
                                                <a href="{{ route('keterangan_akta_nikah.show', $surat->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-eye" width="16"
                                                        height="16" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                    Lihat
                                                </a>
                                            @elseif($surat->type == 'ijin_keramain')
                                                <a href="{{ route('surat_pengantar_ijin_keramaian.show', $surat->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-eye" width="16"
                                                        height="16" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                    Lihat
                                                </a>
                                            @elseif($surat->type == 'usaha')
                                                <a href="{{ route('surat_keterangan_usahas.show', $surat->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-eye" width="16"
                                                        height="16" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                    Lihat
                                                </a>
                                            @elseif($surat->type == 'perusahaan')
                                                <a href="{{ route('surat-pindah-perusahaan.show', $surat->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-eye" width="16"
                                                        height="16" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                    Lihat
                                                </a>
                                            @elseif($surat->type == 'beda_penduduk')
                                                <a href="{{ route('beda-data-kependudukan.show', $surat->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-eye" width="16"
                                                        height="16" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                    Lihat
                                                </a>
                                            @elseif($surat->type == 'keterangan_kematian')
                                                <a href="{{ route('surat_keterangan_kematian.show', $surat->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-eye" width="16"
                                                        height="16" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                    Lihat
                                                </a>
                                            @elseif($surat->type == 'miskin')
                                                <a href="{{ route('surat_keterangan_miskin.show', $surat->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-eye" width="16"
                                                        height="16" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                    Lihat
                                                </a>
                                                @elseif($surat->type == 'tidak_mampu')
                                                <a href="{{ route('surat_keterangan_tidak_mampu.show', $surat->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-eye" width="16"
                                                        height="16" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                    Lihat
                                                </a>
                                            @elseif($surat->type == 'bekerja_luar_negeri')
                                                <a href="{{ route('surat-bekerja-luar-negeri.show', $surat->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-eye" width="16"
                                                        height="16" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                    Lihat
                                                </a>
                                            @endif

                                            <!-- Button Edit - Only show when status is 'ditolak' -->
                                            @if ($surat->status == 'ditolak')
                                                @if ($surat->type == 'pindah_domisili')
                                                    <a href="{{ route('keterangan_domisili.edit', $surat->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-edit" width="16"
                                                            height="16" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                            </path>
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                            </path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                @elseif($surat->type == 'akta_nikah')
                                                    <a href="{{ route('keterangan_akta_nikah.edit', $surat->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-edit" width="16"
                                                            height="16" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                            </path>
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                            </path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                @elseif($surat->type == 'ijin_keramain')
                                                    <a href="{{ route('surat_pengantar_ijin_keramaian.edit', $surat->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-edit" width="16"
                                                            height="16" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                            </path>
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                            </path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                @elseif($surat->type == 'usaha')
                                                    <a href="{{ route('surat_keterangan_usahas.edit', $surat->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-edit" width="16"
                                                            height="16" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                            </path>
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                            </path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                @elseif($surat->type == 'perusahaan')
                                                    <a href="{{ route('surat-pindah-perusahaan.edit', $surat->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-edit" width="16"
                                                            height="16" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                            </path>
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                            </path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                @elseif($surat->type == 'beda_penduduk')
                                                    <a href="{{ route('beda-data-kependudukan.edit', $surat->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-edit" width="16"
                                                            height="16" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                            </path>
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                            </path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                @elseif($surat->type == 'keterangan_kematian')
                                                    <a href="{{ route('surat_keterangan_kematian.edit', $surat->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-edit" width="16"
                                                            height="16" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                            </path>
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                            </path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                @elseif($surat->type == 'miskin')
                                                    <a href="{{ route('surat_keterangan_miskin.edit', $surat->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-edit" width="16"
                                                            height="16" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                            </path>
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                            </path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    @elseif($surat->type == 'tidak_mampu')
                                                    <a href="{{ route('surat_keterangan_tidak_mampu.edit', $surat->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-edit" width="16"
                                                            height="16" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                            </path>
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                            </path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                @elseif($surat->type == 'bekerja_luar_negeri')
                                                    <a href="{{ route('surat-bekerja-luar-negeri.edit', $surat->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-edit" width="16"
                                                            height="16" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                            </path>
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                            </path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                @endif
                                            @endif

                                            <!-- Button Hapus - Only show when status is NOT 'selesai' -->
                                            @if ($surat->status != 'selesai')
                                                @if ($surat->type == 'pindah_domisili')
                                                    <form action="{{ route('keterangan_domisili.destroy', $surat->id) }}"
                                                        method="POST" class="d-inline">
                                                @elseif($surat->type == 'akta_nikah')
                                                    <form
                                                        action="{{ route('keterangan_akta_nikah.destroy', $surat->id) }}"
                                                        method="POST" class="d-inline">
                                                @elseif($surat->type == 'ijin_keramain')
                                                    <form
                                                        action="{{ route('surat_pengantar_ijin_keramaian.destroy', $surat->id) }}"
                                                        method="POST" class="d-inline">
                                                @elseif($surat->type == 'usaha')
                                                    <form
                                                        action="{{ route('surat_keterangan_usahas.destroy', $surat->id) }}"
                                                        method="POST" class="d-inline">
                                                @elseif($surat->type == 'perusahaan')
                                                    <form
                                                        action="{{ route('surat-pindah-perusahaan.destroy', $surat->id) }}"
                                                        method="POST" class="d-inline">
                                                @elseif($surat->type == 'beda_penduduk')
                                                    <form
                                                        action="{{ route('beda-data-kependudukan.destroy', $surat->id) }}"
                                                        method="POST" class="d-inline">
                                                @elseif($surat->type == 'keterangan_kematian')
                                                    <form
                                                        action="{{ route('surat_keterangan_kematian.destroy', $surat->id) }}"
                                                        method="POST" class="d-inline">
                                                @elseif($surat->type == 'miskin')
                                                    <form
                                                        action="{{ route('surat_keterangan_miskin.destroy', $surat->id) }}"
                                                        method="POST" class="d-inline">
                                                @elseif($surat->type == 'tidak_mampu')
                                                    <form
                                                        action="{{ route('surat_keterangan_tidak_mampu.destroy', $surat->id) }}"
                                                        method="POST" class="d-inline">
                                                @elseif($surat->type == 'bekerja_luar_negeri')
                                                    <form
                                                        action="{{ route('surat-bekerja-luar-negeri.destroy', $surat->id) }}"
                                                        method="POST" class="d-inline">
                                                @endif
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-trash" width="16"
                                                        height="16" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M4 7l16 0"></path>
                                                        <path d="M10 11l0 6"></path>
                                                        <path d="M14 11l0 6"></path>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    </svg>
                                                    Hapus
                                                </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty">
                    <div class="empty-img">
                        <img src="{{ asset('static/illustrations/undraw_quitting_time_dm8t.svg') }}" height="128"
                            alt="">
                    </div>
                    <p class="empty-title">Belum ada surat yang diajukan</p>
                    <p class="empty-subtitle text-muted">
                        Anda belum mengajukan surat apapun. Klik tombol dibawah untuk mengajukan surat baru.
                    </p>
                    <div class="empty-action">
                        <a href="#" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
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
