@extends('backend.master')

@section('content')
<style>
  .progress {
    height: 20px;
  }
  .progress-bar {
    font-size: 14px;
    line-height: 20px;
  }
  .is-invalid {
    border-color: red;
  }
</style>

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Tambah Surat Keterangan Status Nikah</h4>
        </div>
        <div class="card-body">

          {{-- Tampilkan error validasi --}}
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          {{-- Progress Bar --}}
          <div class="progress mb-4">
            <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 50%;">
              Langkah 1 dari 2
            </div>
          </div>

          <form action="{{ route('keterangan_akta_nikah.store') }}" method="POST" enctype="multipart/form-data" id="formWizard">
            @csrf

            {{-- STEP 1 --}}
            <div id="step1">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" name="nama" id="nama" class="form-control required-step1" value="{{ old('nama') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="agama" class="form-label">Agama</label>
                  <input type="text" name="agama" id="agama" class="form-control required-step1" value="{{ old('agama') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="nik" class="form-label">NIK</label>
                  <input type="text" name="nik" id="nik" class="form-control required-step1" value="{{ old('nik') }}" maxlength="16" oninput="validateNumericInput(this)" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="no_kk" class="form-label">Nomor Kartu Keluarga</label>
                  <input type="text" name="no_kk" id="no_kk" class="form-control required-step1" value="{{ old('no_kk') }}" maxlength="16" oninput="validateNumericInput(this)" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                  <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control required-step1" value="{{ old('tempat_lahir') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control required-step1" value="{{ old('tanggal_lahir') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  <select name="jenis_kelamin" class="form-control required-step1" required>
                      <option value="">-- Pilih --</option>
                      <option value="L" {{ old('jenis_kelamin_pekerja') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                      <option value="P" {{ old('jenis_kelamin_pekerja') == 'P' ? 'selected' : '' }}>Perempuan</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                  <select name="status_perkawinan" id="status_perkawinan" class="form-select required-step1" required>
                    <option value="">-- Pilih --</option>
                    <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                    <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                    <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                    <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="pekerjaan" class="form-label">Pekerjaan</label>
                  <input type="text" name="pekerjaan" id="pekerjaan" class="form-control required-step1" value="{{ old('pekerjaan') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                  <input type="text" name="kewarganegaraan" id="kewarganegaraan" class="form-control required-step1" value="{{ old('kewarganegaraan') }}" required>
                </div>
                <div class="col-12 mb-3">
                  <label for="alamat" class="form-label">Alamat Lengkap</label>
                  <textarea name="alamat_lengkap" id="alamat" rows="3" class="form-control required-step1" required>{{ old('alamat_lengkap') }}</textarea>
                </div>
                <div class="col-12 mb-3">
                  <label for="catatan" class="form-label">Catatan Tambahan (opsional)</label>
                  <textarea name="catatan" id="catatan" rows="2" class="form-control">{{ old('catatan') }}</textarea>
                </div>
              </div>
              <div class="d-flex justify-content-end mt-3">
                <button type="button" class="btn btn-primary" onclick="if(validateStep1()) nextStep()">Lanjut</button>
              </div>
            </div>

            {{-- STEP 2 --}}
            <div id="step2" style="display: none;">
              <div class="row">
                @php
                  $fileFields = [
                    'foto_ktp' => 'Foto KTP',
                    'foto_kartu_keluarga' => 'Foto Kartu Keluarga',
                    'foto_surat_pernyataan_nikah' => 'Foto Surat Pernyataan Nikah',
                    'foto_surat_pengantar_rt_rw' => 'Foto Surat Pengantar RT/RW',
                  ];
                @endphp

                @foreach ($fileFields as $field => $label)
                  <div class="col-md-6 mb-3">
                    <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                    <input type="file" name="{{ $field }}" id="{{ $field }}" class="form-control" required>
                    @error($field)
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                @endforeach
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function validateStep1() {
    let isValid = true;
    const inputs = document.querySelectorAll('#step1 .required-step1');

    inputs.forEach(input => {
      if (!input.value.trim()) {
        input.classList.add('is-invalid');
        isValid = false;
      } else {
        input.classList.remove('is-invalid');
      }
    });

    if (!isValid) {
      Swal.fire({
        icon: 'error',
        title: 'Form Belum Lengkap',
        text: 'Harap isi semua field yang wajib diisi sebelum melanjutkan',
        confirmButtonColor: '#d33',
      });
    }

    // Validasi khusus untuk NIK dan No KK
    if (isValid) {
      const nik = document.getElementById('nik').value.trim();
      const noKk = document.getElementById('no_kk').value.trim();

      if (nik.length !== 16 || isNaN(nik)) {
        Swal.fire({
          icon: 'error',
          title: 'NIK Tidak Valid',
          text: 'NIK harus terdiri dari 16 digit angka.',
          confirmButtonColor: '#d33',
        });
        document.getElementById('nik').classList.add('is-invalid');
        isValid = false;
      } else {
        document.getElementById('nik').classList.remove('is-invalid');
      }

      if (noKk.length !== 16 || isNaN(noKk)) {
        Swal.fire({
          icon: 'error',
          title: 'Nomor KK Tidak Valid',
          text: 'Nomor KK harus terdiri dari 16 digit angka.',
          confirmButtonColor: '#d33',
        });
        document.getElementById('no_kk').classList.add('is-invalid');
        isValid = false;
      } else {
        document.getElementById('no_kk').classList.remove('is-invalid');
      }
    }

    return isValid;
  }

  function validateNumericInput(input) {
    // Hapus semua karakter bukan angka
    input.value = input.value.replace(/\D/g, '');

    // Batasi panjang input maksimal 16 karakter
    if (input.value.length > 16) {
      input.value = input.value.slice(0, 16);
    }
  }

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

  // Jika ada error validasi file di step 2, langsung tampilkan step 2 saat reload
  @if($errors->hasAny(['foto_ktp', 'foto_kartu_keluarga', 'foto_surat_pernyataan_nikah', 'foto_surat_pengantar_rt_rw']))
    document.addEventListener('DOMContentLoaded', function() {
      nextStep();
    });
  @endif
</script>
@endsection
