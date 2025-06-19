@extends('backend.master')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-file-pdf me-2"></i>Form Cetak Surat Keterangan Tidak Mampu</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('sktm.generate-pdf', $surat->id) }}" method="POST" target="_blank">
                @csrf

                <!-- Form Input -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control form-control-sm"
                             required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Surat</label>
                        <input type="date" name="tanggal_surat" class="form-control form-control-sm"
                               value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <!-- Additional Fields -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nomor Surat Pengantar RT/RW</label>
                        <input type="text" name="nomor_surat_pengantar" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Surat Pengantar</label>
                        <input type="date" name="tanggal_surat_pengantar" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Pernyataan Materai</label>
                        <input type="date" name="tanggal_materai" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Penghasilan Per Bulan (Rp)</label>
                        <input type="number" name="penghasilan_perbulan" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Digunakan Untuk</label>
                        <input type="text" name="digunakan_untuk" class="form-control form-control-sm" placeholder="Contoh: keperluan pengajuan beasiswa" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Nama Lurah</label>
                        <input type="text" name="nama_lurah" class="form-control form-control-sm" required>
                    </div>
                </div>

                <!-- Preview Surat -->
                <div class="border p-4 mb-4">
                    <!-- Kop Surat -->
                    <div class="text-center mb-4">
                        <h4 class="fw-bold" style="font-family: 'Times New Roman', serif;">SURAT KETERANGAN TIDAK MAMPU</h4>
                        <p class="mb-0">Nomor : <span class="fw-bold">{{ "300/    /02.1006/".date('Y') }}</span></p>
                    </div>

                    <hr class="my-3">

                    <!-- Data Pemohon -->
                    <div class="mb-3">
                        <p class="mb-2">Yang bertanda tangan di bawah ini menerangkan bahwa :</p>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="30%">Nama</td>
                                <td width="5px">:</td>
                                <td>{{ $surat->nama }}</td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td>{{ $surat->nik }}</td>
                            </tr>
                            <tr>
                                <td>Tempat/Tgl Lahir</td>
                                <td>:</td>
                                <td>{{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $surat->alamat }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-3">
                        <p style="text-align: justify;">Adalah benar-benar warga yang berdomisili di wilayah Kelurahan Subangjaya dan termasuk keluarga kurang mampu/tidak mampu.</p>
                    </div>

                    <!-- Form Tanda Tangan -->
                    <div class="mt-4 p-3 border rounded">
                        <h5 class="text-center fw-bold mb-3">DATA TANDA TANGAN</h5>

                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label small fw-bold">NIP Lurah</label>
                                <input type="text" name="lurah_nip" class="form-control form-control-sm" required>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="submit" class="btn btn-primary btn px-4">
                        <i class="fas fa-file-pdf me-2"></i> Generate PDF
                    </button>
                    <a href="{{ route('surat_keterangan_tidak_mampu.index') }}" class="btn btn-secondary btn px-4">
                        <i class="fas fa-times me-2"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
