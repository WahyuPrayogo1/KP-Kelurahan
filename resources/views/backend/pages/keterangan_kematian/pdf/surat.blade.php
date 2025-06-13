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
            width: 50mm;
            margin-top: 20mm;

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
        .info-table {
            margin: 2mm 50px 4mm 50px;
        }
        .info-table td:first-child {
            width: 140px;
        }
        .line-through {
            text-decoration: line-through;
            color: rgb(0, 0, 0);
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
        <h3 style="margin-bottom: 0;">SURAT KETERANGAN KEMATIAN</h3>
        <p style="margin-top: 0;">Nomor Surat: {{ $nomor_surat }}</p>
    </div>

    <!-- Isi Surat -->
    <p class="indent-justify">
        Lurah Subangjaya Kecamatan Cikole Kota Sukabumi dengan ini menerangkan bahwa:
    </p>

    <table class="info-table">
        <tr><td>Nama</td><td>:</td><td>{{ $surat->nama }}</td></tr>
        <tr><td>Tempat/Tgl Lahir</td><td>:</td><td>{{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d-m-Y') }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $surat->jenis_kelamin }}</td></tr>
        <tr><td>Agama</td><td>:</td><td>{{ $surat->agama }}</td></tr>
        <tr><td>Kewarganegaraan</td><td>:</td><td>{{ $surat->kewarganegaraan }}</td></tr>
        <tr><td>Alamat</td><td>:</td><td>{{ $surat->alamat_lengkap }}</td></tr>
    </table>

    <p class="indent-justify">
        Diterangkan lebih lanjut, berdasarkan Surat Pengantar Laporan Kematian dari Ketua RT. {{ $rt }} RW. {{ $rw }} Nomor: {{ $nomor_surat_pengantar }}, bahwa nama tersebut di atas 'benar' telah meninggal dunia pada hari {{ $hari_meninggal }}, tanggal {{ \Carbon\Carbon::parse($surat->tanggal_meninggal)->format('d-m-Y') }} di alamat tersebut karena {{ $surat->penyebab_kematian }} dan telah dimakamkan di {{ $dimakamkan_di }}.
    </p>

    <p class="indent-justify">
        Surat Keterangan Ini Dipergunakan Untuk : <u>Melengkapi Pembuatan Persyaratan Administrasi. </u>   
    </p>

    <p class="indent-justify">
        Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.
    </p>

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
                <p style="margin-top: 2mm;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LURAH SUBANGJAYA</strong></p>
                <div class="signature-line" style="width: 60mm; margin-top: 30mm; margin-left: 0;"></div>
                <p style="margin-top: 1mm;">&nbsp;&nbsp;&nbsp;&nbsp;NIP. 19720412 201001 1 001</p>
            </div>
        </div>
    </div>
</body>
</html>
