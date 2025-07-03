<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Keterangan Usaha</title>
  <style>
    body {
      font-family: "Times New Roman", serif;
      margin: 50px;
      color: #000;
      font-size: 10pt;
      line-height: 1.6;
    }

    h2 {
      text-align: center;
      margin-bottom: 0;
      font-size: 12pt;
      text-transform: uppercase;
      text-decoration: underline;
    }

    .nomor {
      text-align: center;
      margin-bottom: 25px;
    }

    .indent {
      text-indent: 10mm;
      text-align: justify;
      margin: 10px 0;
    }

    table.data, table.usaha {
      margin-left: 10mm;
      margin-bottom: 15px;
      width: 90%;
    }

    table td {
      padding: 2px 10px 2px 0;
      vertical-align: top;
    }

    .ttd {
      margin-top: 40px;
      width: 100%;
    }

    .kanan {
      float: right;
      text-align: center;
      width: 50%;
    }

    .underline {
      text-decoration: underline;
      font-weight: bold;
    }

    .bold {
      font-weight: bold;
    }

    .center {
      text-align: center;
    }

    hr {
      width: 200px;
      margin-left: 0;
      border: 0.5px solid #000;
    }
  </style>
</head>
<body>
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

  <h2>SURAT KETERANGAN USAHA</h2>
  <div class="nomor">Nomor : PP.01/07.04.44/ &nbsp;&nbsp;&nbsp; /IV/KEL.SBJ/2024</div>

  <p class="indent">
    Lurah Subangjaya Kecamatan Cikole Kota Sukabumi, dengan ini menerangkan bahwa:
  </p>

  <table class="data">
    <tr><td width="30%">Nama</td><td width="5px">:</td><td>{{ $nama }}</td></tr>
    <tr><td>NIK</td><td>:</td><td>{{ $nik }}</td></tr>
    <tr><td>Tempat, Tgl Lahir</td><td>:</td><td>{{ $alamat_lengkap }}</td></tr>
    <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $jenis_kelamin }}</td></tr>
    <tr><td>Kewarganegaraan</td><td>:</td><td>{{ $kewarganegaraan }}</td></tr>
    <tr><td>Agama</td><td>:</td><td>{{ $agama }}</td></tr>
    <tr><td>Pekerjaan</td><td>:</td><td>{{ $pekerjaan }}</td></tr>
    <tr><td>Alamat</td><td>:</td><td>{{ $alamat_lengkap }}</td></tr>
    <tr><td>Status Perkawinan</td><td>:</td><td>{{ $status_perkawinan }}</td></tr>
  </table>

  <p class="indent">
    Diterangkan lebih lanjut berdasarkan Surat Pengantar dari Ketua RT/RW setempat Nomor: {{ $nomor_pengantar }} dan pernyataan yang bersangkutan di atas materai pada tanggal {{ date('d-m-Y', strtotime($tanggal_pernyataan)) }}, serta sampai dengan diterbitkannya Surat Keterangan ini adalah <strong>"Benar"</strong> mempunyai usaha sebagaimana tersebut di bawah ini:
  </p>

  <table class="usaha">
    <tr><td width="30%">Nama Usaha</td><td width="5px">:</td><td>{{ $nama_usaha }}</td></tr>
    <tr><td>Bidang Jenis Usaha</td><td>:</td><td>{{ $jenis_usaha }}</td></tr>
    <tr><td>Alamat Usaha</td><td>:</td><td>{{ $alamat_usaha }}</td></tr>
    <tr><td>Status Bangunan</td><td>:</td><td>{{ $status_bangunan }}</td></tr>
    <tr><td>No. SPPT</td><td>:</td><td>{{ $no_sppt ?? '-' }}</td></tr>
    <tr><td>Akta Pendirian Usaha</td><td>:</td><td>{{ $akta_pendirian_usaha ?? '-' }}</td></tr>
    <tr><td>Jumlah Karyawan/Anggota</td><td>:</td><td>{{ $jumlah_karyawan }}</td></tr>
    <tr><td>Penanggung Jawab/Pimpinan Usaha</td><td>:</td><td>{{ $pimpinan_usaha }}</td></tr>
  </table>

  <p class="indent">
    Surat Keterangan Usaha ini dibuat untuk keperluan <span class="bold underline">{{ $keperluan }}</span> dan berlaku sampai dengan 1 (satu) bulan setelah dibukanya SKU ini.
  </p>

  <p class="indent">
    Demikian Surat Keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.
  </p>

  <div class="ttd">
    <div class="kanan">
      <p>Ditetapkan di : Sukabumi<br>
      Pada Tanggal : {{ date('d-m-Y', strtotime($tanggal_dikeluarkan)) }}</p>
      <p class="underline">a.n. LURAH SUBANGJAYA</p>
      <br><br>
      <p style="text-align: left; margin-left: 50px;">NIP. {{ $nip_ttd ?? '19601010 198803 1 001' }}</p>
    </div>
  </div>

</body>
</html>
