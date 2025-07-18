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

<style>
  .auto-uppercase {
    text-transform: uppercase;
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
                  <input type="text" name="nama" id="nama" class="form-control required-step1 auto-uppercase" value="{{ old('nama') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="agama" class="form-label">Agama</label>
                    <select name="agama" class="form-select required-step1" required>
                      <option value="">Pilih Agama</option>
                      <option value="ISLAM" {{ old('agama') == 'ISLAM' ? 'selected' : '' }}>ISLAM</option>
                      <option value="KRISTEN" {{ old('agama') == 'KRISTEN' ? 'selected' : '' }}>KRISTEN</option>
                      <option value="KATOLIK" {{ old('agama') == 'KATOLIK' ? 'selected' : '' }}>KATOLIK</option>
                      <option value="HINDU" {{ old('agama') == 'HINDU' ? 'selected' : '' }}>HINDU</option>
                      <option value="BUDDHA" {{ old('agama') == 'BUDDHA' ? 'selected' : '' }}>BUDDHA</option>
                      <option value="KONGHUCU" {{ old('agama') == 'KONGHUCU' ? 'selected' : '' }}>KONGHUCU</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="nik" class="form-label">NIK</label>
                  <input type="text" name="nik" id="nik" class="form-control required-step1 auto-uppercase" value="{{ old('nik') }}" maxlength="16" oninput="validateNumericInput(this)" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="no_kk" class="form-label">Nomor Kartu Keluarga</label>
                  <input type="text" name="no_kk" id="no_kk" class="form-control required-step1 auto-uppercase" value="{{ old('no_kk') }}" maxlength="16" oninput="validateNumericInput(this)" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                  <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control required-step1 auto-uppercase" value="{{ old('tempat_lahir') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control required-step1" value="{{ old('tanggal_lahir') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  <select name="jenis_kelamin" class="form-control required-step1" required>
                      <option value="">Pilih jenis kelamin</option>
                      <option value="L" {{ old('jenis_kelamin_pekerja') == 'L' ? 'selected' : '' }}>LAKI-LAKI</option>
                      <option value="P" {{ old('jenis_kelamin_pekerja') == 'P' ? 'selected' : '' }}>PEREMPUAN</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                  <select name="status_perkawinan" id="status_perkawinan" class="form-select required-step1 auto-uppercase" required>
                    <option value="">Pilih status perkawinan</option>
                    <option value="BELUM KAWIN" {{ old('status_perkawinan') == 'BELUM KAWIN' ? 'selected' : '' }}>BELUM KAWIN</option>
                    <option value="KAWIN" {{ old('status_perkawinan') == 'KAWIN' ? 'selected' : '' }}>KAWIN</option>
                    <option value="CERAI HIDUP" {{ old('status_perkawinan') == 'CERAI HIDUP' ? 'selected' : '' }}>CERAI HIDUP</option>
                    <option value="CERAI MATI" {{ old('status_perkawinan') == 'CERAI MATI' ? 'selected' : '' }}>CERAI MATI</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="pekerjaan" class="form-label">Pekerjaan</label>
                  <input type="text" name="pekerjaan" id="pekerjaan" class="form-control required-step1 auto-uppercase" value="{{ old('pekerjaan') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                  <input type="text" name="kewarganegaraan" class="form-control required-step1 auto-uppercase" required
                    value="{{ old('kewarganegaraan', 'INDONESIA') }}">
                </div>
                <div class="row g-2">
                  <div class="col-md-4">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control required-step1 auto-uppercase" placeholder="Contoh: Jl. Raya Cibeureum No. 123" value="{{ old('alamat') }}" required>
                  </div>
                  <div class="col-md-4">
                    <label for="rt" class="form-label">RT</label>
                    <input type="text" name="rt" id="rt" class="form-control required-step1"
                          value="{{ old('rt') }}" placeholder="Contoh: 07" maxlength="3" required>
                  </div>
                  <div class="col-md-4">
                    <label for="rw" class="form-label">RW</label>
                    <input type="text" name="rw" id="rw" class="form-control required-step1"
                          value="{{ old('rw') }}" placeholder="Contoh: 01" maxlength="3" required>
                  </div>
                  <div class="col-md-4">
                      <input type="text" id="kelurahan" name="kelurahan" class="form-control required-step1 auto-uppercase"
                          placeholder="Kelurahan" required value="{{ old('kelurahan', 'Subangjaya') }}">
                  </div>
                  <div class="col-md-4">
                      <input type="text" id="kecamatan" name="kecamatan" class="form-control required-step1 auto-uppercase"
                          placeholder="Kecamatan" required value="{{ old('kecamatan', 'Cikole') }}">
                  </div>
                  <div class="col-md-4">
                      <input type="text" id="kode_pos" name="kode_pos"
                          class="form-control required-step1 angka-saja" placeholder="Kode Pos" required
                          maxlength="5" value="{{ old('kode_pos', '43116') }}">
                  </div>
                </div>

              </div>
              <div class="d-flex justify-content-end mt-3">
                <button type="button" class="btn btn-primary" onclick="if(validateStep1()) nextStep()">Lanjut</button>
              </div>
            </div>

            {{-- STEP 2 --}}
            <div id="step2" style="display: none;">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="foto_ktp" class="form-label">Foto KTP</label>
                        <input type="file" name="foto_ktp" class="form-control required-step1" required
                            accept="image/jpeg, image/png">
                        @error('foto_ktp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="foto_kartu_keluarga" class="form-label">Foto Kartu Keluarga</label>
                        <input type="file" name="foto_kartu_keluarga" class="form-control required-step1" required
                            accept="image/jpeg, image/png">
                        @error('foto_kartu_keluarga')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="foto_surat_pernyataan_nikah" class="form-label">Foto Surat Pernyataan Nikah</label>
                        <input type="file" name="foto_surat_pernyataan_nikah" class="form-control required-step1" required
                            accept="image/jpeg, image/png">
                        @error('foto_surat_pernyataan_nikah')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="foto_surat_pengantar_rt_rw" class="form-label">Foto Surat Pengantar RT/RW</label>
                        <input type="file" name="foto_surat_pengantar_rt_rw" class="form-control required-step1" required
                            accept="image/jpeg, image/png">
                        @error('foto_surat_pengantar_rt_rw')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button type="button" class="btn btn-secondary" onclick="prevStep()">Kembali</button>
                    <button type="submit" class="btn btn-success">Kirim Pengajuan</button>
                    <img src="{{asset('loading.gif')}}" id="submitSpinner" style="display: none; height: 20px;">
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
      return false;
    }

    // Validasi NIK dan KK
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
    }

    return isValid;
  }

  function validateNumericInput(input) {
    input.value = input.value.replace(/\D/g, '');
    if (input.value.length > input.maxLength) {
      input.value = input.value.slice(0, input.maxLength);
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

  // Fungsi untuk auto kapital dan validasi
  document.addEventListener('DOMContentLoaded', function() {
    // Auto kapitalisasi untuk field yang memiliki class auto-uppercase
    const uppercaseInputs = document.querySelectorAll('.auto-uppercase');

    uppercaseInputs.forEach(input => {
      // Tampilkan sebagai uppercase saat mengetik
      input.style.textTransform = 'uppercase';

      // Pastikan value disimpan sebagai uppercase
      input.addEventListener('blur', function() {
        this.value = this.value.toUpperCase();
      });

      // Untuk data yang sudah ada (old input)
      if(input.value) {
        input.value = input.value.toUpperCase();
      }

      // Validasi hanya huruf untuk field tertentu
      if(input.id.match(/(nama|tempat_lahir|pekerjaan|kelurahan|kecamatan)/)) {
        input.addEventListener('input', function() {
          this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        });
      }
    });

    // Validasi NIK dan KK
    document.getElementById('nik').addEventListener('input', function() {
      validateNumericInput(this);
    });

    document.getElementById('no_kk').addEventListener('input', function() {
      validateNumericInput(this);
    });

    // Jika ada error di step 2, langsung tampilkan
    @if($errors->hasAny(['foto_ktp', 'foto_kartu_keluarga', 'foto_surat_pernyataan_nikah', 'foto_surat_pengantar_rt_rw']))
      nextStep();
    @endif
  });
</script>
@endsection
