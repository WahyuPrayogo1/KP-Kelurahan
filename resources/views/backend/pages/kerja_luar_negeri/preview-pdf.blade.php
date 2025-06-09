@extends('backend.master')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-file-pdf me-2"></i>Form Cetak Surat Keterangan Bekerja di Luar Negeri</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('surat-bekerja-luar-negeri.generate-pdf', $surat->id) }}" method="POST" target="_blank">

                @csrf

                <!-- Nomor & Tanggal Surat -->
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
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nomor Surat Pengantar RT/RW</label>
                        <input type="text" name="nomor_pengantar_rt_rw" class="form-control form-control-sm" value="  /   /2025" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Surat Pengantar RT/RW</label>
                        <input type="date" name="tanggal_pengantar_rt_rw" class="form-control form-control-sm" value="{{ old('tanggal_pengantar_rt_rw') }}" required>
                    </div>
                </div>

                <!-- Tambahan Field RT, RW, Nomor dan Tanggal Surat Pengantar -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">RT</label>
                        <input type="text" name="rt" class="form-control form-control-sm" value="{{ old('rt') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">RW</label>
                        <input type="text" name="rw" class="form-control form-control-sm" value="{{ old('rw') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Berlaku Sampai Tanggal</label>
                        <input type="date" name="berlaku_sampai" class="form-control form-control-sm" value="{{ old('berlaku_sampai') }}" required>
                    </div>
                </div>

                <!-- Preview Surat -->
                <div class="border p-4 mb-4" style="font-family: 'Times New Roman', serif;">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold text-uppercase">
                            SURAT KETERANGAN BEKERJA DI LUAR NEGERI
                        </h4>
                        <p><small>Nomor: <strong>{{ old('nomor_surat') ?? '300/    /02.1006/'.date('Y') }}</strong></small></p>
                    </div>

                    <p><strong>Lurah Subangjaya Kecamatan Cikole Kota Sukabumi</strong> menerangkan bahwa:</p>

                    <!-- Data Pemohon -->
                    <table class="table table-sm table-borderless mb-4">
                        <tr><td width="30%">Nama</td><td width="5px">:</td><td>{{ $surat->nama_pemohon }}</td></tr>
                        <tr><td>No. NIK/KTP</td><td>:</td><td>{{ $surat->nik_pemohon }}</td></tr>
                        <tr><td>Tempat, Tanggal Lahir</td><td>:</td><td>{{ $surat->tempat_lahir_pemohon }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir_pemohon)->translatedFormat('d F Y') }}</td></tr>
                        <tr><td>Pekerjaan</td><td>:</td><td>{{ $surat->pekerjaan_pemohon }}</td></tr>
                        <tr><td>Status Perkawinan</td><td>:</td><td>{{ ucfirst($surat->status_perkawinan_pemohon) }}</td></tr>
                        <tr><td>Agama</td><td>:</td><td>{{ $surat->agama_pemohon }}</td></tr>
                        <tr><td>Alamat</td><td>:</td><td>{{ $surat->alamat_pemohon }}<br>
                            Kel. Subangjaya Kec. Cikole Kota Sukabumi 43116</td></tr>
                    </table>

                    <p>Menyatakan dengan sesungguhnya dan berani diangkat sumpah bahwa <strong>{{ $surat->hubungan_dengan_pekerja }}</strong> saya:</p>

                    <!-- Data Pekerja -->
                    <table class="table table-sm table-borderless mb-4">
                        <tr><td width="30%">Nama</td><td width="5px">:</td><td>{{ $surat->nama_pekerja }}</td></tr>
                        <tr><td>NIK</td><td>:</td><td>{{ $surat->nik_pekerja }}</td></tr>
                        <tr><td>Tempat, Tanggal Lahir</td><td>:</td><td>{{ $surat->tempat_lahir_pekerja }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir_pekerja)->translatedFormat('d F Y') }}</td></tr>
                        <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $surat->jenis_kelamin_pekerja == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                        <tr><td>Kewarganegaraan</td><td>:</td><td>{{ $surat->kewarganegaraan_pekerja }}</td></tr>
                        <tr><td>Agama</td><td>:</td><td>{{ $surat->agama_pekerja }}</td></tr>
                        <tr><td>Alamat</td><td>:</td><td>{{ $surat->alamat_pekerja }}</td></tr>
                    </table>

                    <p>Diterangkan lebih lanjut bahwa berdasarkan surat pengantar RT. <strong>{{ old('rt') }}</strong> RW. <strong>{{ old('rw') }}</strong> nomor: <strong>{{ old('nomor_pengantar_rt_rw') }}</strong> dan pernyataan yang bersangkutan di atas materai tanggal <strong>{{ \Carbon\Carbon::parse(old('tanggal_surat', date('Y-m-d')))->translatedFormat('d F Y') }}</strong>
                     serta sampai dengan dibuatkannya surat keterangan ini bahwa pada saat ini <strong>{{ $surat->hubungan_dengan_pekerja }}</strong> saya sedang bekerja di <strong>{{ $surat->negara_tujuan}}</strong>.</p>

                    <p>Surat keterangan ini dipergunakan untuk: <strong>Melengkapi persyaratan Administrasi.</strong></p>

                    <p>Demikian surat keterangan ini dibuat agar yang berkepentingan maklum dan untuk dipergunakan sebagaimana mestinya dan berlaku sampai dengan tanggal <strong>{{ old('berlaku_sampai') ? \Carbon\Carbon::parse(old('berlaku_sampai'))->translatedFormat('d F Y') : '' }}</strong>.</p>
                </div>

                <!-- Tombol Aksi -->
                <div class="text-center">
                    <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-file-pdf me-2"></i> Generate PDF
                    </button>
                    <a href="{{ route('/dashboard') }}" class="btn btn-secondary ms-2"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
