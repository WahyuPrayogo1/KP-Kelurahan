@extends('backend.master')

@php
use Carbon\Carbon;
@endphp

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fas fa-file-pdf me-2"></i>Form Cetak Surat Keterangan Kematian
            </h4>
        </div>
        <div class="card-body">

            {{-- Menampilkan error validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('surat_keterangan_kematian.generate-pdf', $surat->id) }}" method="POST" novalidate>
                @csrf

                {{-- Nomor & Tanggal Surat --}}
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nomor Surat</label>
                        <input type="text" name="nomor_surat"
                               class="form-control form-control-sm @error('nomor_surat') is-invalid @enderror"
                               value="{{ old('nomor_surat', $surat->nomor_surat ?? 'PD.PU.08.02.02/____/VII/6/KEL.SBJ/' . date('Y')) }}"
                               required>
                        @error('nomor_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Surat</label>
                        <input type="date" name="tanggal_surat"
                               class="form-control form-control-sm @error('tanggal_surat') is-invalid @enderror"
                               value="{{ old('tanggal_surat', $surat->tanggal_surat ?? date('Y-m-d')) }}"
                               required>
                        @error('tanggal_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Preview Surat --}}
                <div class="border p-4 mb-4">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold" style="font-family: 'Times New Roman', serif;">SURAT KETERANGAN KEMATIAN</h4>
                        <p class="mb-0">
                            Nomor: 
                            <span class="fw-bold">
                                {{ old('nomor_surat', $surat->nomor_surat ?? 'PD.PU.08.02.02/____/VII/6/KEL.SBJ/' . date('Y')) }}
                            </span>
                        </p>
                        <p class="mb-0">
                            Tanggal: 
                            <span class="fw-bold">
                                {{ old('tanggal_surat', isset($surat->tanggal_surat) ? Carbon::parse($surat->tanggal_surat)->format('d-m-Y') : date('d-m-Y')) }}
                            </span>
                        </p>
                    </div>

                    <hr class="my-3">

                    <p class="mb-2">Lurah Subangjaya Kecamatan Cikole Kota Sukabumi, dengan ini menerangkan bahwa :</p>
                    <table class="table table-sm table-borderless">
                        <tr><td width="30%">Nama</td><td>:</td><td>{{ $surat->nama }}</td></tr>
                        <tr><td>Tempat Tgl Lahir</td><td>:</td><td>{{ $surat->tempat_lahir }}, {{ Carbon::parse($surat->tanggal_lahir)->format('d-m-Y') }}</td></tr>
                        <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $surat->jenis_kelamin }}</td></tr>
                        <tr><td>Agama</td><td>:</td><td>{{ $surat->agama }}</td></tr>
                        <tr><td>Kewarganegaraan</td><td>:</td><td>{{ $surat->kewarganegaraan }}</td></tr>
                        <tr><td>Alamat</td><td>:</td><td>{{ $surat->alamat_lengkap }}</td></tr>
                    </table>

                    <p class="mb-2">
                        Diterangkan lebih lanjut berdasarkan surat pengantar laporan kematian dari Ketua RT {{ $surat->rt ?? '...' }} RW {{ $surat->rw ?? '...' }},
                        Nomor: {{ old('nomor_surat_pengantar', $surat->nomor_surat_pengantar ?? '../.../.../2025') }},
                        bahwa nama tersebut di atas benar telah <strong>meninggal dunia</strong> pada:
                    </p>

                    <table class="table table-sm table-borderless">
                        <tr><td width="30%">Hari</td><td>:</td><td>{{ $surat->hari_meninggal }}</td></tr>
                        <tr><td>Tanggal</td><td>:</td><td>{{ Carbon::parse($surat->tanggal_meninggal)->format('d-m-Y') }}</td></tr>
                        <tr><td>Alamat</td><td>:</td><td>{{ $surat->alamat_lengkap }}</td></tr>
                        <tr><td>Penyebab</td><td>:</td><td>{{ $surat->penyebab_kematian }}</td></tr>
                        <tr><td>Dimakamkan di</td><td>:</td><td>{{ $surat->dimakamkan_di }}</td></tr>
                    </table>

                    <p class="mb-2">Surat keterangan ini dipergunakan untuk: <strong>Melengkapi pembuatan persyaratan administrasi.</strong></p>
                    <p>Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
                </div>

                {{-- Input Tambahan --}}
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">RT</label>
                        <input type="text" name="rt" 
                               class="form-control form-control-sm @error('rt') is-invalid @enderror" 
                               value="{{ old('rt', $surat->rt ?? '') }}" required>
                        @error('rt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">RW</label>
                        <input type="text" name="rw" 
                               class="form-control form-control-sm @error('rw') is-invalid @enderror" 
                               value="{{ old('rw', $surat->rw ?? '') }}" required>
                        @error('rw')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Hari Meninggal</label>
                        <input type="text" name="hari_meninggal" 
                               class="form-control form-control-sm @error('hari_meninggal') is-invalid @enderror" 
                               value="{{ old('hari_meninggal', $surat->hari_meninggal ?? '') }}" required>
                        @error('hari_meninggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Dimakamkan di</label>
                        <input type="text" name="dimakamkan_di" 
                               class="form-control form-control-sm @error('dimakamkan_di') is-invalid @enderror" 
                               value="{{ old('dimakamkan_di', $surat->dimakamkan_di ?? '') }}" required>
                        @error('dimakamkan_di')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nomor Surat Pengantar RT/RW</label>
                        <input type="text" name="nomor_surat_pengantar" 
                               class="form-control form-control-sm @error('nomor_surat_pengantar') is-invalid @enderror" 
                               value="{{ old('nomor_surat_pengantar', $surat->nomor_surat_pengantar ?? ' /   /2025') }}" required>
                        @error('nomor_surat_pengantar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-file-pdf me-2"></i> Generate PDF
                    </button>
                    <a href="{{ route('surat_keterangan_kematian.index') }}" class="btn btn-secondary px-4">
                        <i class="fas fa-times me-2"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
