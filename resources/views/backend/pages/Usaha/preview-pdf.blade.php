@extends('backend.master')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-file-pdf me-2"></i>Form Cetak Surat Keterangan Usaha</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('suratUsaha.generate-pdf', $surat->id) }}" method="POST" target="_blank">
                @csrf

                <!-- Form Input -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control form-control-sm"
                            value="PP.01/07.04.44/ &nbsp;&nbsp;&nbsp; /IV/KEL.SBJ/{{ date('Y') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Surat</label>
                        <input type="date" name="tanggal_surat" class="form-control form-control-sm"
                               value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <!-- Preview Surat -->
                <div class="border p-4 mb-4" style="font-family: 'Times New Roman', serif;">
                    <!-- Kop Surat -->
                    <div class="text-center mb-4">
                        <h4 class="fw-bold" style="text-decoration: underline; text-transform: uppercase;">SURAT KETERANGAN USAHA</h4>
                        <p class="mb-0">Nomor : <span class="fw-bold">{{ "PP.01/07.04.44/ &nbsp;&nbsp;&nbsp; /IV/KEL.SBJ/".date('Y') }}</span></p>
                    </div>

                    <p style="text-indent: 40px; text-align: justify;">
                        Lurah Subangjaya Kecamatan Cikole Kota Sukabumi, dengan ini menerangkan bahwa:
                    </p>

                    <!-- Data Pemohon -->
                    <table style="margin-left: 40px; margin-bottom: 15px;">
                        <tr>
                            <td width="40%">Nama</td>
                            <td width="5px">:</td>
                            <td>{{ $surat->nama }}</td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td>{{ $surat->nik }}</td>
                        </tr>
                        <tr>
                            <td>Tempat, Tgl Lahir</td>
                            <td>:</td>
                            <td>
                                {{ $surat->alamat_lengkap }}
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{ $surat->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td>Kewarganegaraan</td>
                            <td>:</td>
                            <td>{{ $surat->kewarganegaraan }}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td>{{ $surat->agama }}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td>{{ $surat->pekerjaan }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $surat->alamat_lengkap }}</td>
                        </tr>
                        <tr>
                            <td>Status Perkawinan</td>
                            <td>:</td>
                            <td>{{ $surat->status_perkawinan }}</td>
                        </tr>
                    </table>

                    <p style="text-indent: 40px; text-align: justify;">
                        Diterangkan lebih lanjut berdasarkan Surat Pengantar dari Ketua RT/RW setempat Nomor:
                        <input type="text" name="nomor_pengantar" class="form-control form-control-sm d-inline" style="width: 100px;" required>
                        /<input type="text" name="nomor_pengantar2" class="form-control form-control-sm d-inline" style="width: 100px;" required>
                        /{{ date('Y') }} dan pernyataan yang bersangkutan di atas materai pada tanggal
                        <input type="date" name="tanggal_pernyataan" class="form-control form-control-sm d-inline" style="width: 150px;" required>,
                        serta sampai dengan diterbitkannya Surat Keterangan ini adalah <strong>"Benar"</strong> mempunyai usaha sebagaimana tersebut di bawah ini:
                    </p>

                    <!-- Data Usaha -->
                    <table style="margin-left: 40px; margin-bottom: 15px;">
                        <tr>
                            <td width="40%">Nama Usaha</td>
                            <td width="5px">:</td>
                            <td>{{ $surat->nama_usaha }}</td>
                        </tr>
                        <tr>
                            <td>Bidang Jenis Usaha</td>
                            <td>:</td>
                            <td>{{ $surat->jenis_usaha }}</td>
                        </tr>
                        <tr>
                            <td>Alamat Usaha</td>
                            <td>:</td>
                            <td>{{ $surat->alamat_usaha }}</td>
                        </tr>
                        <tr>
                            <td>Status Bangunan</td>
                            <td>:</td>
                            <td>{{ $surat->status_bangunan }}</td>
                        </tr>
                        <tr>
                            <td>No. SPPT</td>
                            <td>:</td>
                            <td>
                                {{ $surat->no_sppt}}
                            </td>
                        </tr>
                        <tr>
                            <td>Akta Pendirian Usaha</td>
                            <td>:</td>
                            <td>{{ $surat->akta_pendirian_usaha ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Karyawan/Anggota</td>
                            <td>:</td>
                            <td>{{ $surat->jumlah_karyawan }}</td>
                        </tr>
                        <tr>
                            <td>Penanggung Jawab/Pimpinan Usaha</td>
                            <td>:</td>
                            <td>{{ $surat->pimpinan_usaha }}</td>
                        </tr>
                    </table>

                    <p style="text-indent: 40px; text-align: justify;">
                        Surat Keterangan Usaha ini dibuat untuk keperluan
                        <input type="text" name="keperluan" class="form-control form-control-sm d-inline" style="width: 250px;" value="Melengkapi Persyaratan Administrasi" required>
                        dan berlaku sampai dengan 1 (satu) bulan setelah dibukanya SKU ini.
                    </p>

                    <p style="text-indent: 40px; text-align: justify;">
                        Demikian Surat Keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.
                    </p>

                    <!-- Tanda Tangan -->
                    <div style="margin-top: 50px; text-align: right;">
                        <div style="display: inline-block; text-align: center;">
                            <p>Ditetapkan di : Sukabumi<br>
                            Pada Tanggal : <input type="date" name="tanggal_dikeluarkan" class="form-control form-control-sm d-inline" style="width: 150px;" required></p>
                            <p style="text-decoration: underline; font-weight: bold;">a.n. LURAH SUBANGJAYA</p>
                            <input type="text" name="nama_ttd" class="form-control form-control-sm" style="width: 200px; margin: 20px auto 0;" placeholder="Nama Penandatangan" required>
                            <input type="text" name="nip_ttd" class="form-control form-control-sm" style="width: 200px; margin-top: 5px;" placeholder="NIP Penandatangan" value="19601010 198803 1 001">
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="submit" class="btn btn-primary btn px-4">
                        <i class="fas fa-file-pdf me-2"></i> Generate PDF
                    </button>
                    <a href="{{ route('surat_keterangan_usahas.index') }}" class="btn btn-secondary btn px-4">
                        <i class="fas fa-times me-2"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
