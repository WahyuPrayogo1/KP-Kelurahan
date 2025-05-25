<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Keterangan Pindah Domisili Perusahaan/Yayasan</title>
  <style>
    body {
      font-family: "Times New Roman", Times, serif;
      font-size: 11pt;
      line-height: 1.6;
      color: #000;
      padding: 40px;
      background-color: #fff;
    }
    .container { max-width: 800px; margin: 0 auto; }
    .title {
      text-align: center;
      font-weight: bold;
      text-transform: uppercase;
      text-decoration: underline;
      margin-bottom: 5px;
    }
    .nomor { text-align: center; margin-bottom: 20px; }
    .info-table { width: 100%; border-collapse: collapse; margin: 10px 0 20px; }
    .info-table td { padding: 4px 0; vertical-align: top; }
    .underline {
      display: inline-block;
      border-bottom: 1px solid #000;
      min-width: 180px;
      height: 1em;
    }
    .short-underline {
      display: inline-block;
      border-bottom: 1px solid #000;
      min-width: 80px;
      height: 1em;
    }
    .indent { text-indent: 10mm; text-align: justify; margin: 10px 0; }
    .center { text-align: center; margin: 30px 0; }
    .ttd { margin-top: 20px; }
    .ttd p { margin: 5px 0; }
    .ttd-kanan { text-align: right; margin-top: 20px; font-weight: bold; }

    .kop-surat {
  margin-bottom: 20px;
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

  <div class="container">
    <h2 class="title">SURAT KETERANGAN PINDAH DOMISILI PERUSAHAAN / YAYASAN</h2>
    <p class="nomor">Nomor: {{ $nomor_surat }}</p>

    <p class="indent">
      Kelurahan <span class="underline">Subang Jaya</span>
      Kecamatan <span class="underline">Cikole</span>
      Kota Sukabumi, dengan ini menerangkan bahwa:
    </p>

    <table class="info-table">
      <tr>
        <td width="40%">Nama Perusahaan / Yayasan</td>
        <td width="5px">:</td>
        <td><span class="underline">{{ $surat->nama_perusahaan }}</span></td>
      </tr>
      <tr>
        <td>Alamat Perusahaan / Yayasan</td>
        <td>:</td>
        <td><span class="underline">{{ $surat->alamat_perusahaan }}</span></td>
      </tr>
      <tr>
        <td>Nama Pemilik / Penanggung Jawab</td>
        <td>:</td>
        <td><span class="underline">{{ $surat->nama_pemilik }}</span></td>
      </tr>
      <tr>
        <td>Alamat Pemilik</td>
        <td>:</td>
        <td><span class="underline">{{ $surat->alamat_pemilik }}</span></td>
      </tr>
      <tr>
        <td>Tanda Daftar Perusahaan / Akta Notaris</td>
        <td>:</td>
        <td><span class="underline">{{ $surat->nomor_tdp }}</span></td>
      </tr>
      <tr>
        <td>Bidang / Jenis Usaha</td>
        <td>:</td>
        <td><span class="underline">{{ $surat->jenis_usaha }}</span></td>
      </tr>
    </table>

    <p class="indent">
      Diterangkan lebih lanjut berdasarkan Surat Pengantar dari Ketua RT/RW setempat Nomor
      <span class="underline">{{ $nomor_surat_rt_rw }}</span> tanggal
      <span class="underline">{{ \Carbon\Carbon::parse($tanggal_surat_rt_rw)->format('d F Y') }}</span>,
      dan pernyataan yang bersangkutan di atas materai tanggal
      <span class="underline">{{ \Carbon\Carbon::parse($tanggal_pernyataan)->format('d F Y') }}</span>,
      serta sampai dengan dibuatkannya Surat Keterangan Pindah Domisili ini, adalah <strong>benar</strong>
      bahwa alamat perusahaan/yayasan tersebut telah berpindah ke <span class="underline">{{$surat->alamat_perusahaan}}</span>
      sejak <span class="underline">{{ \Carbon\Carbon::parse($surat->tanggal_pindah)->format('d F Y') }}</span>.
      Oleh karena itu, kami mencabut Surat Keterangan Domisili Perusahaan/Yayasan Nomor
      <span class="underline">{{ $nomor_surat_lama }}</span> tanggal
      <span class="underline">{{ \Carbon\Carbon::parse($tanggal_surat_lama)->format('d F Y') }}</span>.
    </p>

    <p class="center">
      <strong>Surat keterangan ini dipergunakan untuk <span class="underline" style="min-width: 300px;">{{ $tujuan_surat }}</span></strong>
    </p>

    <p class="indent">
      Demikian Surat Keterangan Domisili Perusahaan / Yayasan ini dibuat untuk dipergunakan sebagaimana mestinya.
    </p>

    <div class="ttd">
      <div class="ttd-kanan">
        <p>Dikeluarkan di : Sukabumi<br>
          Pada Tanggal : {{ \Carbon\Carbon::parse($tanggal_surat)->format('d F Y') }}</p>
          <br><br><br>
        <p>a.n. LURAH {{ strtoupper($nama_lurah) }}</p>
      </div>
    </div>
  </div>
</body>
</html>
