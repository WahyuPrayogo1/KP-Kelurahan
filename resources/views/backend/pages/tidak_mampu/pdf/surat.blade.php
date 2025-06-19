<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        .signature-container {
            margin-top: 15mm;
            width: 100%;
            text-align: right;
            /* Ini yang akan menggeser ke kanan */
        }

        .signature-box {
            display: inline-block;
            text-align: center;
            width: 45%;
            /* Sesuaikan lebar sesuai kebutuhan */
            margin-left: auto;
            /* Ini membantu mendorong ke kanan */
        }

        .signature-line {
            border-top: 0.5pt solid #000;
            width: 70mm;
            margin: 20mm auto 2mm;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 5mm;
        }

        .header h3 {
            font-size: 11pt;
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
            justify-content: space-between;
            margin-top: 1mm;
        }

        .signature-box {
            text-align: center;
            width: 45%;
        }

        .signature-line {
            border-top: 0.5pt solid #000;
            width: 70mm;
            margin: 20mm auto 2mm;
        }

        .content-block {
            margin-bottom: 1mm;
        }
    </style>
</head>

<body>
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

    <!-- Kop Surat -->
    <div class="header">
        <h3>SURAT KETERANGAN TIDAK MAMPU</h3>
        <p>Nomor : {{ $nomor_surat }}</p>
    </div>

    <!-- Data Pemohon -->
    <div class="content-block">
        <p>Lurah {{ $nama_lurah }} Kecamatan Cikole Kota Sukabumi dengan ini menerangkan bahwa</p>
        <table style="padding-left: 150px; padding-right: 50px">
            <tr>
                <td width="30%">Nama</td>
                <td width="5%">:</td>
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
                <td>{{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d F Y') }}</td>
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
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $surat->pekerjaan }}</td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td>:</td>
                <td>{{ $surat->status_perkawinan }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>{{ $surat->agama }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $surat->alamat }}</td>
            </tr>
        </table>
    </div>

    <!-- Keterangan -->
    <div class="content-block">
        <p style="text-align: justify; text-indent: 25px;">
            Adalah benar-benar warga yang berdomisili di wilayah Kelurahan Subangjaya dan termasuk keluarga kurang
            mampu/tidak mampu.
        </p>
        <p style="text-align: justify; text-indent: 25px;">
            Diterangkan lebih lanjut bahwa yang bersangkutan berdasarkan Surat Pengantar dari Ketua RT/RW setempat
            Nomor. {{ $nomor }} Tanggal : {{ $tanggal }} dan Peryataan diatas Materai tanggal
            {{ $tanggal_materai }} serta sampai dengan dibuatkannya Surat Keterangan ini adalah 'Benar' termasuk
            keluarga Miskin/Tidak mampu dengan penghasilan perbulan sebesar RP.{{ $perbulan_harga }}
        </p>
    </div>
    <!-- Penutup -->
    <div class="content-block">
        <p style="text-align: justify; text-indent: 25px;">
            Surat keterangan ini diperegunakan untuk{{ $digunakan }} atas nama yang bersangkutan /istrinya/anaknya
            bernama {{ $surat->nama }}
        </p>
    </div>

    <!-- Penutup -->
    <div class="content-block">
        <p style="text-align: justify; text-indent: 25px;">
            Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya
        </p>
    </div>

    <!-- Tanda Tangan - Versi Fixed -->
    <div class="signature-container">
        <div class="signature-box">
            <p>Ditetapkan di : Sukabumi</p>
            <p>Pada tanggal : {{ isset($tanggal_surat) ? date('d F Y', strtotime($tanggal_surat)) : '' }}</p>
              <p>Lurah {{ $nama_lurah }}</p>
            <div class="signature-line"></div>

            <p>NIP. {{ $lurah_nip ?? '_________________' }}</p>
        </div>
    </div>

</body>

</html>
