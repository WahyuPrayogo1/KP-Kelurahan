<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
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

        .indent-justify {
            text-indent: 8mm;
            text-align: justify;
            margin: 1mm 50px 3mm 50px;
        }

        .signature-container {
            display: flex; 
        }

        .signature-column {
            width: 40%;
            float: right;   /* Ubah dari kiri ke kanan */
            box-sizing: border-box;
            text-align: right;  /* agar teks tanda tangan rata kanan */
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
    </style>
</head>

<body>
    <!-- Kop Surat -->
    <div style="text-align: center;">
        <table>
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

    <!-- Judul -->
    <div class="header">
        <h3 style="margin-bottom: 0;">SURAT KETERANGAN TIDAK MAMPU</h3>
        <p style="margin-top: 0;">Nomor: {{ $nomor_surat }}</p>
    </div>

    <!-- Isi -->
    <p class="indent-justify">
        Lurah Subangjaya Kecamatan Cikole Kota Sukabumi, dengan ini menerangkan bahwa:
    </p>

    <div style="margin-left: 50px; margin-right: 50px;" class="content-block">
        <table>
            <tr><td width="30%">Nama</td><td width="5%">:</td><td>{{ $surat->nama }}</td></tr>
            <tr><td>NIK</td><td>:</td><td>{{ $surat->nik }}</td></tr>
            <tr><td>Tempat/Tgl Lahir</td><td>:</td><td>{{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d F Y') }}</td></tr>
            <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $surat->jenis_kelamin }}</td></tr>
            <tr><td>Kewarganegaraan</td><td>:</td><td>{{ $surat->kewarganegaraan }}</td></tr>
            <tr><td>Pekerjaan</td><td>:</td><td>{{ $surat->pekerjaan }}</td></tr>
            <tr><td>Status Perkawinan</td><td>:</td><td>{{ $surat->status_perkawinan }}</td></tr>
            <tr><td>Agama</td><td>:</td><td>{{ $surat->agama }}</td></tr>
            <tr><td>Alamat</td><td>:</td><td>{{ $surat->alamat }}</td></tr>
        </table>
    </div>

    <p class="indent-justify">
        Adalah benar-benar warga yang berdomisili di wilayah Kelurahan Subangjaya dan termasuk keluarga kurang mampu/tidak mampu.
    </p>

    <p class="indent-justify">
        Diterangkan lebih lanjut bahwa yang bersangkutan berdasarkan Surat Pengantar dari Ketua RT/RW setempat Nomor {{ $nomor }} tanggal {{ $tanggal }} dan pernyataan di atas materai tanggal {{ $tanggal_materai }}, serta sampai dengan dibuatkannya surat ini, adalah <strong>benar</strong> termasuk keluarga tidak mampu, dengan penghasilan per bulan sebesar Rp{{ $perbulan_harga }}.
    </p>

    <p class="indent-justify">
        Surat keterangan ini dipergunakan untuk {{ $digunakan }} atas nama yang bersangkutan/istrinya/anaknya bernama {{ $surat->nama }}.
    </p>

    <p class="indent-justify">
        Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.
    </p><br>

    <!-- Tanda Tangan -->
    <div class="signature-container">
        <div class="signature-column">
            <div class="signature-box" style="text-align: left;">
                <table>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dikeluarkan di &nbsp;&nbsp;: Sukabumi</td>
                    </tr>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada Tanggal &nbsp;&nbsp;&nbsp; : 
                            {{ $tanggal_surat ? \Carbon\Carbon::parse($tanggal_surat)->translatedFormat('d-m-Y') : date('d-m-Y') }}
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
