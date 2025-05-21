@extends('backend.master')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-file-pdf me-2"></i>Form Cetak Surat Izin Keramaian</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('surat.generate-pdf', $surat->id) }}" method="POST" target="_blank">
                @csrf

                <!-- Form Input -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control form-control-sm"
                               value="300/    /02.1006/{{ date('Y') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Surat</label>
                        <input type="date" name="tanggal_surat" class="form-control form-control-sm"
                               value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <!-- Preview Surat -->
                <div class="border p-4 mb-4">
                    <!-- Kop Surat -->
                    <div class="text-center mb-4">
                        <h4 class="fw-bold" style="font-family: 'Times New Roman', serif;">SURAT PENGANTAR KETERANGAN IJIN KERAMAIAN</h4>
                        <p class="mb-0">Nomor : <span class="fw-bold">{{ "300/    /02.1006/".date('Y') }}</span></p>
                    </div>

                    <hr class="my-3">

                    <!-- Data Pemohon -->
                    <div class="mb-3">
                        <p class="mb-2">Yang bertanda tangan di bawah ini menerangkan bahwa :</p>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="30%">Nama Organisasi</td>
                                <td width="5px">:</td>
                                <td>{{ $surat->nama_organisasi }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $surat->alamat_organisasi }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Data Acara -->
                    <div class="mb-3">
                        <p class="mb-2">Akan menyelenggarakan kegiatan :</p>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="30%">Nama Kegiatan</td>
                                <td width="5px">:</td>
                                <td>{{ $surat->mengadakan_keramain }}</td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>:</td>
                                <td>{{ $surat->waktu }}</td>
                            </tr>
                            <tr>
                                <td>Tempat</td>
                                <td>:</td>
                                <td>{{ $surat->tempat }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Form Persetujuan Kapolsek -->
                    <div class="mt-4 p-3 border rounded">
                        <h5 class="text-center fw-bold mb-3">PERTIMBANGAN KAPOLSEK CIKOLE</h5>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Nomor</label>
                                <input type="text" name="kapolsek_nomor" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Tanggal</label>
                                <input type="date" name="kapolsek_tanggal" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Status</label>
                                <select name="kapolsek_status" class="form-select form-select-sm" required>
                                    <option value="Dapat diizinkan">Dapat diizinkan</option>
                                    <option value="Tidak diizinkan">Tidak diizinkan</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label small fw-bold">Dengan catatan</label>
                            <textarea name="kapolsek_catatan" class="form-control form-control-sm" rows="3"
                                    placeholder="Masukkan catatan (pisahkan dengan enter)&#10;Contoh:&#10;1. Wajib melapor ke Polsek sebelum acara&#10;2. Dilarang menggunakan sound system setelah pukul 22.00&#10;3. Harus menyediakan petugas keamanan"></textarea>
                        </div>
                    </div>

                    <!-- Form Tanda Tangan -->
                    <div class="mt-4 p-3 border rounded">
                        <h5 class="text-center fw-bold mb-3">DATA TANDA TANGAN</h5>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">NIP Lurah</label>
                                <input type="text" name="lurah_nip" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">NIP Camat</label>
                                <input type="text" name="camat_nip" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">NRP Danramil</label>
                                <input type="text" name="danramil_nrp" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="submit" class="btn btn-primary btn px-4">
                        <i class="fas fa-file-pdf me-2"></i> Generate PDF
                    </button>
                    <a href="{{ route('surat_pengantar_ijin_keramaian.index') }}" class="btn btn-secondary btn px-4">
                        <i class="fas fa-times me-2"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
