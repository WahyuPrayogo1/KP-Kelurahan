<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 10pt;
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

        }
        .signature-column {
            width: 50%;
            float: left;
            box-sizing: border-box;
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
        .pertimbangan-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 2mm;
        }

        ol {
            padding-left: 5mm;
            margin: 2mm 0;
        }
        li {
            margin-bottom: 2mm;
        }
        .content-block {
            margin-bottom: 3mm;
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
        <h3>SURAT PENGANTAR KETERANGAN IJIN KERAMAIAN</h3>
        <p>Nomor : {{ $nomor_surat }}</p>
    </div>

    <!-- Data Pemohon -->
    <p>Lurah Subang jaya Kecamatan Cikole Kota Sukabumi dalam rangka memenuhi permohonan ijin keramaian dari :</p>
    <div style="padding-left: 50px; padding-right: 50px" class="content-block">
        <table>
            <tr>
                <td width="30%">Nama</td>
                <td width="5%">:</td>
                <td>{{ $surat->nama_pemohon }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $surat->jabatan_pemohon }}</td>
            </tr>
            <tr>
                <td>Nama Organisasi</td>
                <td >:</td>
                <td>{{ $surat->nama_organisasi }}</td>
            </tr>
            <tr>
                <td>Alamat Organisasi</td>
                <td>:</td>
                <td>{{ $surat->alamat_organisasi }}</td>
            </tr>
        </table>
    </div>

    <!-- Data Acara -->
    <div style="padding-left: 50px; padding-right: 50px" class="content-block">
        <table>
            <tr>
                <td>Maksud</td>
            </tr>
            <tr>
                <td width="30%">Mengadakan Keramaian</td>
                <td width="5%">:</td>
                <td>{{ $surat->mengadakan_keramain }}</td>
            </tr>
            <tr>
                <td>Hiburan</td>
                <td>:</td>
                <td>{{ $surat->hiburan ?? '-' }}</td>
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

    <!-- Ketentuan -->
    <div class="content-block">
        <p style="text-align: justify;">Dengan ini menerangkan bahwa pada prinsipnya tidak keberatan atas permohonan yang bersangkutan dengan ketentuan sebagai berikut :</p>
        <ol style="text-align: justify; padding-left: 50px; padding-right: 50px" >
            <li>Pada waktu dilaksanakan acara dimaksud harus disertai dengan ketentraman dan ketertiban dalam lingkungan baik hubungan dengan tetangga, menghargai waktu-waktu ibadat dalam menciptakan kerukunan umat beragama maupun kebersihan lingkungan setelah selesai acara.</li>
            <li>Pada waktu dilaksanakan acara tidak dibenarkan/dilarang melakukan hal-hal yang bertentangan dengan ketentuan yang berlaku dan adat istiadat masyarakat setempat.</li>
        </ol>
    </div>

    <!-- Tanda Tangan dalam 2 Kolom -->
    <div class="signature-container">
        <!-- Kolom Kiri -->
        <div class="signature-column">
            <div class="signature-box">
                <p>Mengetahui :</p>
                <p>1. Camat Cikole Kota Sukabumi</p>
                <div class="signature-line"></div>
                <p>NIP. {{ $camat_nip ?? '_________________' }}</p>
            </div>

            <div class="signature-box">
                <p>2. DAN RAMIL KEC. CIKOLE</p>
                <div class="signature-line"></div>
                <p>NRP. {{ $danramil_nrp ?? '_________________' }}</p>
            </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="signature-column">
            <div class="signature-box">
                <p>Sukabumi, {{ isset($tanggal_surat) ? date('d F Y', strtotime($tanggal_surat)) : '_________________' }}</p>
                <p>LURAH SUBANGJAYA</p>
                <div class="signature-line"></div>
                <p>NIP. {{ $lurah_nip ?? '_________________' }}</p>
            </div>

            <div class="signature-box">
                <p>PERTIMBANGAN KAPOLSEK CIKOLE</p>
                 <div style="text-align: center;">
                <table>
                    <tr>
                        <td  width="45%">Nomor</td>
                        <td width="5%">:</td>
                        <td>{{ $kapolsek_nomor ?? '_________________' }}</td>
                    </tr>
                    <tr>
                        <td >Tanggal</td>
                        <td>:</td>
                        <td>{{ isset($kapolsek_tanggal) ? date('d F Y', strtotime($kapolsek_tanggal)) : '_________________' }}</td>
                    </tr>
                    <tr>
                        <td >Atas Permohonannya</td>
                        <td>:</td>
                        <td>{{ $kapolsek_status ?? 'Tidak/Dapat diizinkan' }}</td>
                    </tr>
                    <tr>
                        <td >Dengan catatan</td>
                        <td>:</td>
                        <td>
                            @if(isset($kapolsek_catatan))
                                {!! nl2br(e($kapolsek_catatan)) !!}
                            @else
                                1. .........................................<br>
                                2. .........................................<br>
                                3. .........................................
                            @endif
                        </td>
                    </tr>
                </table>
                 </div>
            </div>
        </div>
    </div>
</body>
</html>
