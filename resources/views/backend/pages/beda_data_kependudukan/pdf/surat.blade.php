<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
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

        .indent-justify {
            text-indent: 8mm;
            text-align: justify;
            margin: 1mm 50px 3mm 50px;
        }
    </style>
</head>

<body>

    <!-- Kop Surat -->
    <div style="text-align: center;">
        <table width="100%">
            <tr>
                <td width="150" align="center" style="padding-left: 50px;">
                    <img src="{{ public_path('images/logo.png') }}" width="100">
                </td>

                <td align="center" style="padding-right: 120px;">
                    <div style="font-size: 14pt; font-weight: bold;">PEMERINTAH KOTA SUKABUMI</div>
                    <div style="font-size: 13pt;">KECAMATAN CIKOLE</div>
                    <div style="font-size: 16pt; font-weight: bold;">KELURAHAN SUBANGJAYA</div>
                    <div style="font-size: 11pt;">Jl. Subangjaya No. 41 Telp. (0266) 235 755 Kota Sukabumi</div>
                </td>
            </tr>
        </table>
        <div style="height: 3px; background-color: black; margin: 4px 0;"></div>
        <div style="height: 1px; background-color: black; margin-top: 0;"></div>
    </div>

    <!-- Judul Surat -->
    <div class="header">
        <h3 style="margin-bottom: 0;">SURAT PENGANTAR KETERANGAN BEDA DATA KEPENDUDUKAN</h3>
        <p style="margin-top: 0;">Nomor Surat: {{ $nomor_surat }}</p>
    </div>

    <!-- Isi Surat -->
    <p class="indent-justify">
        Lurah Subangjaya Kecamatan Cikole Kota Sukabumi, dengan ini menerangkan bahwa:</p>

    <div style="padding-left: 50px; padding-right: 50px;" class="content-block">
        <table>
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
                <td>: {{ $surat->alamat }}<br>Kel. Subangjaya, Kec. Cikole, Kota Sukabumi 43116</td>
            </tr>
        </table>
    </div>

        <p class="indent-justify"> Adalah benar warga RT.{{ $surat->rt }}/RW.{{ $surat->rw }} Kelurahan Subangjaya Kecamatan Cikole Kota Sukabumi.</p>

        <p class="indent-justify"> 
            Diterangkan lebih lanjut berdasarkan Surat Pengantar dari Ketua RT/RW setempat Nomor:
            {{ $nomor_pengantar }}, tanggal
            {{ \Carbon\Carbon::parse($tanggal_pengantar)->translatedFormat('d F Y') }}
            dan pernyataan yang bersangkutan di atas materai tanggal
            {{ \Carbon\Carbon::parse($tanggal_surat)->translatedFormat('d F Y') }},
            bahwa data kependudukan tersebut berbeda dengan yang tercantum dalam dokumen:
                @php
                    $lokasi = $surat->lokasi_perbedaan_nama;
                    $opsi = ['Akte Kelahiran', 'Ijazah', 'Sertifikat Tanah', 'Akte Nikah', 'Akte Cerai', 'KTP', 'KK'];
                @endphp
                @if(in_array($lokasi, $opsi))
                    {!! implode(' / ', array_map(function($item) use ($lokasi) {
                        return $item === $lokasi ? $item : "<s>$item</s>";
                    }, $opsi)) !!}
                @else
                    {!! implode(' / ', array_map(fn($item) => "<s>$item</s>", $opsi)) !!} / {{ $lokasi }}
                @endif.
            Namun orang yang dimaksud adalah orang yang sama.
        </p>

        <p class="indent-justify">Surat keterangan ini dipergunakan untuk: <u>melengkapi persyaratan administrasi</u>.</p>

        <p class="indent-justify"> Demikian surat ini dibuat untuk digunakan sebagaimana mestinya dan berlaku sampai dengan tanggal
            {{ \Carbon\Carbon::parse($surat->masa_berlaku)->translatedFormat('d F Y') }}.</p><br><br>

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
                <p style="margin-bottom: 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $nama_lurah ?? '____________________' }}</p>
                <p style="margin-top: 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP. {{ $lurah_nip ?? '____________________' }}</p>
            </div>
        </div>
    </div>

</body>

</html>
