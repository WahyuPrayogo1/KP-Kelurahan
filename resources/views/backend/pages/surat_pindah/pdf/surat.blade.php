<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Keterangan Pindah Domisili Perusahaan/Yayasan</title>
  <style>
    body {
      font-family: "Times New Roman", Times, serif;
      font-size: 11pt;
      line-height: 1.3;
      margin: 0;
      padding: 0;
      color: #000;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    td {
      padding: 0.5mm 0;
      vertical-align: top;
    }

    .header {
      text-align: center;
      margin-bottom: 5mm;
    }

    .header h3 {
      font-size: 12pt;
      font-weight: bold;
      text-decoration: underline;
      margin: 2mm 0;
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
      margin-left: auto;
      text-align: left;
    }

    .signature-line {
      border-top: 0.5pt solid #000;
      width: 65mm;
      margin: 25mm auto 1mm;
    }

    .underline {
      display: inline-block;
      border-bottom: 1px solid #000;
      min-width: 180px;
      height: 1em;
    }

    .center {
      text-align: center;
      margin: 10mm 0 5mm;
    }
      table.info-table {
    width: 100%;
    border-collapse: collapse;
    }

    .info-table td {
      padding: 2px 0;
      vertical-align: top;
      white-space: nowrap;
    }

    .info-table td.label {
      width: 40%;
    }

    .info-table td.colon {
      width: 5%;
    }

    .info-table td.value {
      white-space: normal; /* agar nilai bisa wrapping jika panjang */
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
  <h3>SURAT KETERANGAN PINDAH DOMISILI PERUSAHAAN / YAYASAN</h3>
  <p>Nomor: {{ $nomor_surat }}</p>
</div>

<!-- Isi Surat -->
<p class="indent-justify">
  Lurah Subangjaya Kecamatan Cikole Kota Sukabumi, dengan ini menerangkan bahwa:
</p>

<div style="padding-left: 50px; padding-right: 50px;" class="content-block">
    <table class="info-table">
    <tr>
      <td class="label">Nama Perusahaan / Yayasan</td>
      <td class="colon">:</td>
      <td class="value">{{ $surat->nama_perusahaan }}</td>
    </tr>
    <tr>
      <td class="label">Alamat Perusahaan / Yayasan</td>
      <td class="colon">:</td>
      <td class="value">{{ $surat->alamat_perusahaan }}</td>
    </tr>
    <tr>
      <td class="label">Nama Pemilik / Penanggung Jawab</td>
      <td class="colon">:</td>
      <td class="value">{{ $surat->nama_pemilik }}</td>
    </tr>
    <tr>
      <td class="label">Alamat Pemilik</td>
      <td class="colon">:</td>
      <td class="value">{{ $surat->alamat_pemilik }}</td>
    </tr>
    <tr>
      <td class="label">Tanda Daftar Perusahaan / Akta Notaris</td>
      <td class="colon">:</td>
      <td class="value">{{ $surat->nomor_tdp }}</td>
    </tr>
    <tr>
      <td class="label">Bidang / Jenis Usaha</td>
      <td class="colon">:</td>
      <td class="value">{{ $surat->jenis_usaha }}</td>
    </tr>
  </table>
</div>

<p class="indent-justify">
  Diterangkan lebih lanjut berdasarkan Surat Pengantar dari Ketua RT/RW setempat Nomor 
  {{ $nomor_surat_rt_rw }} tanggal 
  {{ \Carbon\Carbon::parse($tanggal_surat_rt_rw)->translatedFormat('d F Y') }},
  dan pernyataan yang bersangkutan di atas materai tanggal 
  {{ \Carbon\Carbon::parse($tanggal_pernyataan)->translatedFormat('d F Y') }},
  serta sampai dengan dibuatkannya Surat Keterangan Pindah Domisili ini, adalah <strong>benar</strong> bahwa alamat perusahaan/yayasan tersebut telah berpindah ke 
  {{ $surat->alamat_perusahaan }} sejak 
  {{ \Carbon\Carbon::parse($surat->tanggal_pindah)->translatedFormat('d F Y') }}.
  Oleh karena itu, kami mencabut Surat Keterangan Domisili Perusahaan/Yayasan Nomor 
  {{ $nomor_surat_lama }} tanggal 
  {{ \Carbon\Carbon::parse($tanggal_surat_lama)->translatedFormat('d F Y') }}.
</p>

<p class="indent-justify">
  Surat keterangan ini dipergunakan untuk <u>{{ $tujuan_surat }}</u>
</p>

<p class="indent-justify">
  Demikian Surat Keterangan Domisili Perusahaan / Yayasan ini dibuat untuk dipergunakan sebagaimana mestinya.
</p>

<!-- Tanda Tangan -->
<div class="signature-container">
  <div class="signature-column">
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

</body>
</html>
