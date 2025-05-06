@extends('backend.master')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-title">Surat Saya</div>
                <h2 class="page-pretitle pb-2">Daftar Surat Yang Anda Ajukan</h2>
            </div>
        </div>
    </div>
</div>

<div class="container-xl mt-5">
    <div class="row row-cards">
        @foreach ($suratSaya as $surat)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    @if ($surat instanceof App\Models\surat_keterangan_pindah_domisili)
                        Surat Keterangan Pindah Domisili
                    @elseif ($surat instanceof App\Models\surat_keterangan_akta_nikah)
                        Surat Keterangan Akta Nikah
                    @elseif ($surat instanceof App\Models\surat_keterangan_usaha)
                        Surat Keterangan Usaha
                    @else
                        Surat Tidak Dikenal
                    @endif
                </h5>
                <p class="card-text">
                    <strong>Status:</strong> {{ $surat->status }}<br>
                    <strong>Tanggal Pengajuan:</strong> {{ $surat->created_at->format('d M Y') }}
                </p>
                <a href="#" class="btn btn-primary">Lihat Detail</a>
            </div>
        </div>
    @endforeach

    </div>
</div>
@endsection
