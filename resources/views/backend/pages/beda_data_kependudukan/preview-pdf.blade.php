@extends('backend.master')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-file-pdf me-2"></i>Form Cetak Surat Keterangan Beda Data Kependudukan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('beda-data-kependudukan.generate-pdf', $surat->id) }}" method="POST" target="_blank">
                @csrf

                <!-- Input Data Surat -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control form-control-sm"
                            value="PD.PU.08.03 /-/VII/6/KEL.SBJ/{{ date('Y') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Surat</label>
                        <input type="date" name="tanggal_surat" class="form-control form-control-sm"
                            value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <!-- Input Nomor dan Tanggal Pengantar RT/RW -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nomor Pengantar RT/RW</label>
                        <input type="text" name="nomor_pengantar" class="form-control form-control-sm" 
                            value="{{ old('nomor_pengantar', '-/-/' . date('Y')) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Surat Pengantar RT/RW</label>
                        <input type="date" name="tanggal_pengantar" class="form-control form-control-sm" 
                            value="{{ old('tanggal_pengantar', date('Y-m-d')) }}" required>
                    </div>
                </div>

                <!-- Preview Surat -->
                <div class="border p-4 mb-4" style="font-family: 'Times New Roman', serif; font-size: 10pt;">
                    <div class="text-center fw-bold mb-2" style="text-decoration: underline; font-size: 11pt;">
                        SURAT KETERANGAN BEDA DATA KEPENDUDUKAN
                        <br> NOMOR : {{ old('nomor_surat', 'PD.PU.08.03 / …… /VII/6/KEL.SBJ/'.date('Y')) }}
                    </div>

                    <p class="mb-2" style="text-align: justify;">Lurah Subangjaya Kecamatan Cikole Kota Sukabumi, dengan ini menerangkan bahwa :</p>

                    <table class="table table-sm table-borderless" style="font-size: 10pt;">
                        <tr><td width="35%">Nama</td><td>: {{ $surat->nama_lengkap }}</td></tr>
                        <tr><td>No. NIK / KTP</td><td>: {{ $surat->nik }}</td></tr>
                        <tr><td>Tempat, Tanggal Lahir</td><td>: {{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->translatedFormat('d F Y') }}</td></tr>
                        <tr><td>Jenis Kelamin</td><td>: {{ $surat->jenis_kelamin }}</td></tr>
                        <tr><td>Kewarganegaraan</td><td>: {{ $surat->kewarganegaraan }}</td></tr>
                        <tr><td>Agama</td><td>: {{ $surat->agama }}</td></tr>
                        <tr><td>Pekerjaan</td><td>: {{ $surat->pekerjaan }}</td></tr>
                        <tr><td>Status Perkawinan</td><td>: {{ $surat->status_perkawinan }}</td></tr>
                        <tr>
                        <td>Alamat</td>
                            <td>: {{ $surat->alamat }} RT.{{ $surat->rt }}/RW.{{ $surat->rw }} <br>Kel. Subangjaya Kec. Cikole Kota Sukabumi, 43116</td>
                        </tr>

                    </table>

                    <p class="mb-2" style="text-align: justify;">Adalah benar Warga RT.{{ $surat->rt }}/RW.{{ $surat->rw }} Kelurahan Subangjaya Kec. Cikole Kota Sukabumi.</p>

                    <p class="mb-2" style="text-align: justify;">
                        Diterangkan lebih lanjut berdasarkan Surat Pengantar dari Ketua RT/RW setempat Nomor :
                        <strong>{{ old('nomor_pengantar', $surat->nomor_pengantar ?? '-') }}</strong>,
                        Tanggal <strong>{{ \Carbon\Carbon::parse(old('tanggal_pengantar', $surat->tanggal_pengantar ?? date('Y-m-d')))->translatedFormat('d F Y') }}</strong>
                        dan pernyataan yang bersangkutan di atas Materai tanggal
                        {{ \Carbon\Carbon::parse(old('tanggal_surat', $surat->tanggal_surat ?? date('Y-m-d')))->translatedFormat('d F Y') }}

                        @php
                        $lokasiPilihan = $surat->lokasi_perbedaan_nama;
                        $opsiResmi = ['Akte Kelahiran', 'Ijazah', 'Sertifikat Tanah', 'Akte Nikah', 'Akte Cerai', 'KTP', 'KK'];
                    @endphp

                        bahwa data kependudukan yang tersebut di atas dengan data kependudukan yang tercantum dalam pernyataan di atas Materai 
                        <strong> @if(in_array($lokasiPilihan, $opsiResmi))
                            {!! implode(' / ', array_map(function($item) use ($lokasiPilihan) {
                                return $item === $lokasiPilihan ? $item : "<s>$item</s>";
                            }, $opsiResmi)) !!}
                        @else
                            {!! implode(' / ', array_map(fn($item) => "<s>$item</s>", $opsiResmi)) !!} / {{ $lokasiPilihan }}
                        @endif </strong>
                        yang bersangkutan adalah orang yang sama.
                    </p>

                    <p class="mb-2" style="text-align: justify;">
                        Surat keterangan ini dipergunakan untuk : <u>melengkapi persyaratan Administrasi</u>.
                    </p>

                    <p class="mb-4" style="text-align: justify;">
                        Demikian Surat Keterangan ini dibuat untuk dipergunakan sebagaimana mestinya dan berlaku sampai dengan tanggal {{ \Carbon\Carbon::parse($surat->masa_berlaku)->translatedFormat('d F Y') }}.
                    </p>

                    <div class="text-end mt-4" style="width: 100%;">
                        <p class="mb-0">Dikeluarkan di&nbsp;&nbsp;: Sukabumi</p>
                        <p class="mb-0">Pada Tanggal&nbsp;&nbsp;&nbsp;: {{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}</p>
                        <p class="fw-bold mt-3">a.n. LURAH SUBANGJAYA</p>
                    </div>
                </div>

                <!-- Tombol Cetak -->
                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-file-pdf me-1"></i> Cetak PDF
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
