@extends('layouts.app')

@section('content')
<div class="container py-5 mb-5">
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="mb-4" >
    <ol class="breadcrumb" style="font-size: 14px">
        <li class="breadcrumb-item">
            <a href="{{ url('/') }}" class="text-decoration-none text-muted">Beranda</a>
        </li>
        <li class="breadcrumb-item ">
            <a href="{{ route('persyaratan') }}" class="text-decoration-none text-muted">Persyaratan</a>
        </li>
    </ol>
</nav>

<div class="text-start mb-5">
    {{-- Judul Halaman --}}
    <h1 class="mb-4" style="color: #6F3A68; font-weight:700; letter-spacing: 2px; font-size: 32px;">
        Persyaratan Pembuatan Surat Keterangan
    </h1>

    {{-- Deskripsi Persyaratan --}}
    <p class="text-muted mb-4" style="font-size: 15px; line-height: 1.8;">
        Data permohonan surat keterangan akan diproses setelah pemohon datang membawa seluruh syarat dan kelengkapan ke Kelurahan Subangjaya Sukabumi.
        Syarat dan kelengkapan yang harus dibawa adalah sebagai berikut:
    </p>
</div>


    <div class="row mt-5 pt-5">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                1. Surat Keterangan beda data Kependudukan
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pernyataan Beda Data Kependudukan</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>

    <div class="row mt-3">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                2. Surat Keterangan Status Perkawinan
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2;">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pernyataan Nikah</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>

    <div class="row mt-3">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                3. Surat Pengantar Keterangan Ijin Keramaian
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP Tetangga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i>  Surat Pernyataan tidak keberatan dari tetangga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>

    <div class="row mt-3">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                4. Surat Keterangan Usaha
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pernyataan tidak keberatan dari tetangga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>

    <div class="row mt-3">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                5. Surat Keterangan Pindah Domisili Perusahaan/Yayasan
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pernyataan pindah domisili perusahaan/yayasan</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Akte notaris peralihan</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>

    <div class="row mt-3">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                6. Surat Keterangan Kepemilikan Tanah
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat pernyataan tanah tidak sengketa</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy SPPT</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy AJB/ Sertifikat</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>

    <div class="row mt-3">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                7. Surat Keterangan Kepemilikan Tanah tidak Sengketa
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat pernyataan tanah tidak sengketa</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy SPPT</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy AJB/ Sertifikat</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>

    <div class="row mt-3">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                8. Surat Keterangan Ahli Waris
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP (semua ahli waris)</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga (semua ahli waris)</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat kuasa ahli waris</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Akta kematian</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>
    
    <div class="row mt-3">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                9. Surat Keterangan Domisili
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat pernyataan domisili</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>

    <div class="row mt-3">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                10. Surat Keterangan Domisili Calon Jemaah Haji
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat pernyataan domisili</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Pas Photo 3x4 = 2 lembar</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Materai 10.000 = 1 Lembar</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>

    <div class="row mt-3">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                11. Surat Keterangan pindah Domisili
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat pernyataan pindah domisili</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>

    <div class="row mt-3">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                12. Surat Keterangan Jalan
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat pernyataan melakukan perjalanan</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>

    <div class="row mt-3">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                13. Surat Keterangan untuk Nikah
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Akte Lahir</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Ijazah</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat persetujuan mempelai</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat persetujuan untuk nikah</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat pengantar NA dari pihak laki-laki yang sudah direkomendasikan KUA kec. Masing-masing</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>

    <div class="row mt-3">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                14. Surat Keterangan tentang Orang Tua
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Akte Lahir</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy buku nikah orang tua</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat pernyataan Ahli waris</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>

    <div class="row mt-3">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                15. Surat Keterangan Kematian
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy buku nikah</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar keterangan Kematian dari RT/RW setempat</li>
            </ul>
        </div>
    </div>

    <div class="row mt-3">
        {{-- Kolom Kiri --}}
        <div class="col-md-6 mb-3">
            <h5 class="mb-3" style="font-size: 16px; color: #000000; font-weight: 500;">
                16. Surat Keterangan Bekerja di Luar Negeri
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pernyataan bekerja di luar negeri dari suami/istri bersangkutan</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>
</div>
@endsection
