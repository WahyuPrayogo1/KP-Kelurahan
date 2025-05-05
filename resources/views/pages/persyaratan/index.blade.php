@extends('layouts.app')

@section('content')
<div class="container py-5 mb-5">
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="mb-4" >
    <ol class="breadcrumb" style="font-size: 14px">
        <li class="breadcrumb-item">
            <a href="{{ url('/') }}" class="text-decoration-none text-muted">Home</a>
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
                2. Surat Keterangan Status Perkawinan
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
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
                2. Surat Keterangan Status Perkawinan
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
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
                2. Surat Keterangan Status Perkawinan
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
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
                2. Surat Keterangan Status Perkawinan
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
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
                2. Surat Keterangan Status Perkawinan
            </h5>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <ul class="list-unstyled text-muted small" style="line-height: 2">
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy KTP</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Fotocopy Kartu Keluarga</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pernyataan Nikah</li>
                <li><i class="bi bi-check-circle" style="color: #6F3A68;"></i> Surat Pengantar RT/RW setempat</li>
            </ul>
        </div>
    </div>
</div>
@endsection
