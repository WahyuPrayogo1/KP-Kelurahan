<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 11pt;
            line-height: 1.3;
            margin: 0;
            padding: 0;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 5mm;
        }

        .header h3 {
            font-size: 12pt;
            text-decoration: underline;
            margin: 2mm 0;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 0.5mm 0;
            vertical-align: top;
        }

        .content-block {
            margin-bottom: 3mm;
            padding-left: 50px;
            padding-right: 50px;
        }

        .indent-justify {
            text-indent: 10mm;
            text-align: justify;
            margin: 3mm 50px 6mm 50px;
        }

        .signature-container {
            display: flex;
        }

        .signature-column {
            width: 40%;
            float: right;
            box-sizing: border-box;
            text-align: right;
        }

        .signature-box {
            margin-bottom: 5mm;
            text-align: start;
        }

        .signature-line {
            border-top: 0.5pt solid #000;
            width: 65mm;
            margin: 25mm auto 1mm;
        }

        .line-through {
            text-decoration: line-through;
            color: #000;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div style="text-align: center;">
        <table width="100%">
            <tr>
                <td width="100" align="center">
                    <img src="{{ public_path('images/logo.png') }}" width="80">
                </td>
                <td align="center">
                    <div style="font-size: 14pt; font-weight: bold;">PEMERINTAH KOTA SUKABUMI</div>
                    <div style="font-size: 13pt;">KECAMATAN CIKOLE</div>
                    <div style="font-size: 16pt; font-weight: bold;">KELURAHAN SUBANGJAYA</div>
                    <div style="font-size: 11pt;">
                        Jl. Subangjaya No. 41 Telp. (0266) 235 755 Kota Sukabumi
                    </div>
                </td>
            </tr>
        </table>
        <div style="height: 3px; background-color: black; margin: 4px 0;"></div>
        <div style="height: 1px; background-color: black; margin-top: 0;"></div>
    </div>

    <!-- Judul Surat -->
    <div class="header">
        <h3 style="margin-bottom: 0;">SURAT KETERANGAN BEKERJA DI LUAR NEGERI</h3>
        <p style="margin-top: 0;">Nomor Surat: {{ $nomor_surat }}</p>
    </div>

    <!-- Isi Surat -->
    <p class="indent-justify">
        Lurah Subangjaya Kecamatan Cikole Kota Sukabumi dengan ini menerangkan bahwa:
    </p>

    <div class="content-block">
        <table>
            <tr><td width="30%">Nama</td><td width="5%">:</td><td>{{ $surat->nama_pemohon }}</td></tr>
            <tr><td>NIK</td><td>:</td><td>{{ $surat->nik_pemohon }}</td></tr>
            <tr><td>Tempat, Tanggal Lahir</td><td>:</td><td>{{ $surat->tempat_lahir_pemohon }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir_pemohon)->translatedFormat('d F Y') }}</td></tr>
            <tr><td>Pekerjaan</td><td>:</td><td>{{ $surat->pekerjaan_pemohon }}</td></tr>
            <tr><td>Status Perkawinan</td><td>:</td><td>{{ ucfirst($surat->status_perkawinan_pemohon) }}</td></tr>
            <tr><td>Agama</td><td>:</td><td>{{ $surat->agama_pemohon }}</td></tr>
            <tr><td>Alamat</td><td>:</td><td>{{ $surat->alamat_pemohon }}<br>Kelurahan Subangjaya, Kecamatan Cikole, Kota Sukabumi, 43116.</td></tr>
        </table>
    </div>

    @php
    $hubunganEnums = ['orang tua', 'suami', 'istri', 'anak', 'saudara'];
    $userChoice = $surat->hubungan_dengan_pekerja;
    @endphp

    <p class="indent-justify">
        Menyatakan dengan sesungguhnya dan berani diangkat sumpah bahwa
        @foreach ($hubunganEnums as $index => $hubungan)
            @php
                $isSelected = ($hubungan === $userChoice);
                $displayText = ucwords($hubungan);
            @endphp
            <span class="{{ $isSelected ? '' : 'line-through' }}">{{ $displayText }}</span>
            @if ($index !== count($hubunganEnums) - 1)
                <span> / </span>
            @endif
        @endforeach
        saya:
    </p>

    <div class="content-block">
        <table>
            <tr><td width="30%">Nama</td><td width="5%">:</td><td>{{ $surat->nama_pekerja }}</td></tr>
            <tr><td>NIK</td><td>:</td><td>{{ $surat->nik_pekerja }}</td></tr>
            <tr><td>Tempat, Tanggal Lahir</td><td>:</td><td>{{ $surat->tempat_lahir_pekerja }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir_pekerja)->translatedFormat('d F Y') }}</td></tr>
            <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $surat->jenis_kelamin_pekerja == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
            <tr><td>Kewarganegaraan</td><td>:</td><td>{{ $surat->kewarganegaraan_pekerja }}</td></tr>
            <tr><td>Agama</td><td>:</td><td>{{ $surat->agama_pekerja }}</td></tr>
            <tr><td>Alamat</td><td>:</td><td>{{ $surat->alamat_pekerja }}</td></tr>
        </table>
    </div>

    <p class="indent-justify">
        Diterangkan lebih lanjut bahwa berdasarkan surat pengantar RT.{{ $rt }}/RW.{{ $rw }} nomor: {{ $nomor_pengantar_rt_rw }} dan Pernyataan yang bersangkutan di atas materai tanggal {{ \Carbon\Carbon::parse($tanggal_pengantar_rt_rw)->translatedFormat('d F Y') }}, serta sampai dengan dibuatkannya Surat keterangan ini bahwa pada saat ini {{ $surat->hubungan_dengan_pekerja }} saya sedang bekerja di {{ $surat->negara_tujuan }}.
    </p>

    <p class="indent-justify" style="margin-bottom: 1mm;">
        Surat keterangan ini dipergunakan untuk: <u>melengkapi persyaratan administrasi</u>.
    </p>

    <p class="indent-justify" style="margin-bottom: 1mm;">
        Demikian Surat Keterangan ini dibuat agar yang berkepentingan maklum dan untuk dipergunakan sebagaimana mestinya dan berlaku sampai dengan tanggal {{ \Carbon\Carbon::parse($berlaku_sampai)->translatedFormat('d F Y') }}.
    </p>

    <!-- Tanda Tangan -->
    <div class="signature-container">
        <div class="signature-column">
            <div class="signature-box">
                <table>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dikeluarkan di &nbsp;&nbsp;&nbsp;: Sukabumi</td>
                    </tr>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada tanggal &nbsp;&nbsp;&nbsp;&nbsp; :
                            {{ $tanggal_surat ? \Carbon\Carbon::parse($tanggal_surat)->translatedFormat('d F Y') : date('d F Y') }}
                        </td>
                    </tr>
                </table>
                <p style="margin-top: 2mm;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LURAH SUBANGJAYA</strong></p>
                <div class="signature-line"></div>
                <p style="margin-bottom: 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $nama_lurah }}</p>
                <p style="margin-top: 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP. {{ $lurah_nip ?? '_________________' }}</p>
            </div>
        </div>
    </div>
</body>
</html>
