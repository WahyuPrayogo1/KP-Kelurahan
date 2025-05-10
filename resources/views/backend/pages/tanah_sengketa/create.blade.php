@extends('backend.master')

@section('content')
<style>
    .progress {
      height: 20px; /* Ukuran tinggi progress bar */
    }

    .progress-bar {
      font-size: 14px; /* Ukuran teks di dalam progress bar */
      line-height: 30px; /* Menjaga posisi teks agar tetap di tengah */
    }
  </style>

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Tambah Surat Kepilikan Tanah Tidak Sengketa</h4>
        </div>
        <div class="card-body">

          {{-- Progress Bar --}}
          <div class="progress mb-4">
            <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 50%;">
              Langkah 1 dari 2
            </div>
          </div>

          <form action="{{ route('surat-kepemilikan-tanah.store') }}" method="POST" enctype="multipart/form-data" id="formWizard">
            @csrf

            {{-- STEP 1 --}}
            <div id="step1">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="nama" class="form-label">Nama Pemohon</label>
                  <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="nik" class="form-label">NIK Pemohon</label>
                  <input type="number" name="nik" id="nik" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="no_hp" class="form-label">No HP</label>
                  <input type="number" name="no_hp" id="no_hp" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
                  </div>
                <div class="col-md-12 mb-3">
                  <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                  <textarea name="alamat_lengkap" id="alamat_lengkap" rows="3" class="form-control" required></textarea>
                </div>
              </div>
              <div class="d-flex justify-content-end mt-3">
                <button type="button" class="btn btn-primary" onclick="nextStep()">Lanjut</button>
              </div>
            </div>

            {{-- STEP 2 --}}
            <div id="step2" style="display: none;">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="foto_ktp" class="form-label">Foto KTP</label>
                  <input type="file" name="foto_ktp" id="foto_ktp" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="foto_kartu_keluarga" class="form-label">Foto Kartu Keluarga</label>
                  <input type="file" name="foto_kartu_keluarga" id="foto_kartu_keluarga" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="foto_pernyataan_tanah" class="form-label">Foto Pernyataan Tanah</label>
                  <input type="file" name="foto_pernyataan_tanah" id="foto_pernyataan_tanah" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="foto_sppt" class="form-label">Foto SPPT</label>
                  <input type="file" name="foto_sppt" id="foto_sppt" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="foto_ajb_sertifikat" class="form-label">Foto AJB Sertifikat</label>
                  <input type="file" name="foto_ajb_sertifikat" id="foto_ajb_sertifikat" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="foto_pengantar_rt_rw" class="form-label">Foto Pengantar Rt Rw</label>
                  <input type="file" name="foto_pengantar_rt_rw" id="foto_pengantar_rt_rw" class="form-control" required>
                </div>
              </div>
              <div class="d-flex justify-content-between mt-3">
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Kembali</button>
                <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Script --}}
<script>
  function nextStep() {
    document.getElementById('step1').style.display = 'none';
    document.getElementById('step2').style.display = 'block';
    updateProgress(100, 'Langkah 2 dari 2');
  }

  function prevStep() {
    document.getElementById('step2').style.display = 'none';
    document.getElementById('step1').style.display = 'block';
    updateProgress(50, 'Langkah 1 dari 2');
  }

  function updateProgress(percent, label) {
    const bar = document.getElementById('progressBar');
    bar.style.width = percent + '%';
    bar.textContent = label;
  }
</script>
@endsection
