@extends('backend.master')

@php
use Carbon\Carbon;
@endphp

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-file-pdf me-2"></i>Form Cetak Surat Keterangan Status Perkawinan</h4>
        </div>
        <div class="card-body">

            {{-- Tampilkan error global --}}
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

            <form action="{{ route('keterangan_akta_nikah.generate-pdf', $surat->id) }}" method="POST" novalidate>
                @csrf

                <!-- Form Input Nomor dan Tanggal Surat -->
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
                            value="{{ old('tanggal_surat', $surat->tanggal_surat ?? date('Y-m-d')) }}" required>
                        @error('tanggal_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Preview Surat -->
                <div class="border p-4 mb-4">
                    <!-- Kop Surat -->
                    <div class="text-center mb-4">
                        <h4 class="fw-bold" style="font-family: 'Times New Roman', serif;">
                            SURAT KETERANGAN STATUS PERKAWINAN
                        </h4>
                        <p class="mb-0">
                            Nomor : 
                            <span class="fw-bold">
                                {{ old('nomor_surat', $surat->nomor_surat ?? 'PD.PU.08.02.02/____/VII/6/KEL.SBJ/' . date('Y')) }}
                            </span>
                        </p>
                        <p class="mb-0">
                            Tanggal : 
                            <span class="fw-bold">
                                {{ old('tanggal_surat', isset($surat->tanggal_surat) ? Carbon::parse($surat->tanggal_surat)->format('d-m-Y') : date('d-m-Y')) }}
                            </span>
                        </p>
                    </div>

                    <hr class="my-3">

                    <!-- Data Pemohon -->
                    <div class="mb-3">
                        <p class="mb-2">Lurah Subangjaya Kecamatan Cikole Kota Sukabumi, dengan ini menerangkan bahwa :</p>
                        <table class="table table-sm table-borderless">
                            <tr><td width="30%">Nama</td><td width="5px">:</td><td>{{ $surat->nama }}</td></tr>
                            <tr><td>NIK</td><td>:</td><td>{{ $surat->nik }}</td></tr>
                            <tr><td>Tempat Lahir</td><td>:</td><td>{{ $surat->tempat_lahir }}</td></tr>
                            <tr><td>Tanggal Lahir</td><td>:</td><td>{{ Carbon::parse($surat->tanggal_lahir)->format('d-m-Y') }}</td></tr>
                            <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $surat->jenis_kelamin }}</td></tr>
                            <tr><td>Agama</td><td>:</td><td>{{ $surat->agama }}</td></tr>
                            <tr><td>Status Perkawinan</td><td>:</td><td>{{ $surat->status_perkawinan }}</td></tr>
                            <tr><td>Pekerjaan</td><td>:</td><td>{{ $surat->pekerjaan }}</td></tr>
                            <tr><td>Kewarganegaraan</td><td>:</td><td>{{ $surat->kewarganegaraan }}</td></tr>
                            <tr><td>Alamat</td><td>:</td><td>{{ $surat->alamat_lengkap }}</td></tr>
                        </table>
                    </div>

                    <!-- Keterangan Surat Pengantar -->
                    <div class="mb-3">
                        <table class="table table-sm table-borderless">
                            <tr><td width="30%">Nomor KK</td><td width="5px">:</td><td>{{ $surat->no_kk }}</td></tr>
                            <tr><td>Nomor KTP</td><td>:</td><td>{{ $surat->nik }}</td></tr>
                            <tr><td>Keterangan Status</td><td>:</td><td>{{ $surat->status_perkawinan }}</td></tr>
                            <tr>
                                <td>Nomor Surat Pengantar RT/RW</td>
                                <td>:</td>
                                <td>{{ old('nomor_surat_pengantar', $surat->nomor_surat_pengantar ?? '  /   /2025') }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Surat Pengantar RT/RW</td>
                                <td>:</td>
                                <td>
                                    {{ old('tanggal_surat_pengantar', isset($surat->tanggal_surat_pengantar) ? Carbon::parse($surat->tanggal_surat_pengantar)->format('d-m-Y') : '-') }}
                                </td>
                            </tr>
                        </table>
                    </div>

                    <p class="mb-3">Surat keterangan ini dipergunakan untuk : <strong>Melengkapi persyaratan administrasi.</strong></p>
                </div>

                <!-- Input Nomor Surat Pengantar RT/RW dan Tanggal Surat Pengantar RT/RW -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label for="nomor_surat_pengantar" class="form-label fw-bold">Nomor Surat Pengantar RT/RW</label>
                        <input type="text" name="nomor_surat_pengantar" id="nomor_surat_pengantar"
                            class="form-control form-control-sm @error('nomor_surat_pengantar') is-invalid @enderror"
                            value="{{ old('nomor_surat_pengantar', $surat->nomor_surat_pengantar ?? ' /   /2025') }}" required>
                        @error('nomor_surat_pengantar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_surat_pengantar" class="form-label fw-bold">Tanggal Surat Pengantar RT/RW</label>
                        <input type="date" name="tanggal_surat_pengantar" id="tanggal_surat_pengantar"
                            class="form-control form-control-sm @error('tanggal_surat_pengantar') is-invalid @enderror"
                            value="{{ old('tanggal_surat_pengantar', $surat->tanggal_surat_pengantar ?? '') }}" required>
                        @error('tanggal_surat_pengantar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-file-pdf me-2"></i> Generate PDF
                    </button>
                    <a href="{{ route('keterangan_akta_nikah.index') }}" class="btn btn-secondary px-4">
                        <i class="fas fa-times me-2"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
