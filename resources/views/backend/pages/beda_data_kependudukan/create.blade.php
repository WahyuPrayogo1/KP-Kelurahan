@extends('backend.master')

@section('content')
<style>
  .progress { 
    height: 20px; 
  }
  .progress-bar { 
    font-size: 14px; line-height: 20px;
  }
  .form-control.is-invalid {
    border-color: #dc3545; 
  }
  .invalid-feedback { 
    display: block; 
  }
  .form-navigation {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
  }
</style>

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Tambah Surat Keterangan Beda Data Kependudukan</h4>
        </div>
        <div class="card-body">

          {{-- Progress Bar --}}
          <div class="progress mb-4">
            <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 50%;">
              Langkah 1 dari 2
            </div>
          </div>

          <form action="{{ route('beda-data-kependudukan.store') }}" method="POST" enctype="multipart/form-data" id="formWizard">
            @csrf

          {{-- STEP 1 --}}
          <div id="step1">
            <div class="row">
              
              <div class="col-md-6 mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control required-step1 @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap') }}" required>
                @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" name="nik" id="nik" class="form-control required-step1 @error('nik') is-invalid @enderror" value="{{ old('nik') }}" maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)" required>
                @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control required-step1 @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" required>
                @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control required-step1 @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" required>
                @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select required-step1 @error('jenis_kelamin') is-invalid @enderror" required>
                  <option value="">Pilih jenis kelamin</option>
                  <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                  <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                 <input type="text" name="kewarganegaraan" class="form-control required-step1" required
                    value="{{ old('kewarganegaraan', 'Indonesia') }}">
              </div>

              <div class="col-md-6 mb-3">
                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control required-step1 @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan') }}" required>
                @error('pekerjaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                <select name="status_perkawinan" id="status_perkawinan" class="form-select required-step1 @error('status_perkawinan') is-invalid @enderror" required>
                  <option value="">Pilih status perkawinan</option>
                  <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                  <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                  <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                  <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                </select>
                @error('status_perkawinan')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="agama" class="form-label">Agama</label>
                <select name="agama" class="form-select required-step1" required>
                  <option value="">Pilih Agama</option>
                  <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                  <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                  <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                  <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                  <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                  <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
              </select>
              </div>

              <div class="col-md-12 mb-3">
                <label for="lokasi_perbedaan_nama" class="form-label">Lokasi Perbedaan Nama</label>
                <select name="lokasi_perbedaan_nama" id="lokasi_perbedaan_nama" class="form-select required-step1 @error('lokasi_perbedaan_nama') is-invalid @enderror" onchange="toggleLainnya()" required>
                  <option value="">-- Pilih --</option>
                  <option value="Akte Kelahiran" {{ old('lokasi_perbedaan_nama') == 'Akte Kelahiran' ? 'selected' : '' }}>Akte Kelahiran</option>
                  <option value="Ijazah" {{ old('lokasi_perbedaan_nama') == 'Ijazah' ? 'selected' : '' }}>Ijazah</option>
                  <option value="Sertifikat Tanah" {{ old('lokasi_perbedaan_nama') == 'Sertifikat Tanah' ? 'selected' : '' }}>Sertifikat Tanah</option>
                  <option value="Akte Nikah" {{ old('lokasi_perbedaan_nama') == 'Akte Nikah' ? 'selected' : '' }}>Akte Nikah</option>
                  <option value="Akte Cerai" {{ old('lokasi_perbedaan_nama') == 'Akte Cerai' ? 'selected' : '' }}>Akte Cerai</option>
                  <option value="KTP" {{ old('lokasi_perbedaan_nama') == 'KTP' ? 'selected' : '' }}>KTP</option>
                  <option value="KK" {{ old('lokasi_perbedaan_nama') == 'KK' ? 'selected' : '' }}>KK</option>
                  <option value="Lainnya" {{ old('lokasi_perbedaan_nama') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('lokasi_perbedaan_nama')<div class="invalid-feedback">{{ $message }}</div>@enderror

                <div id="lainnyaInput" style="display: none;" class="mt-2">
                  <input type="text" name="lokasi_perbedaan_nama_lainnya" id="lokasi_perbedaan_nama_lainnya"
                    class="form-control @error('lokasi_perbedaan_nama_lainnya') is-invalid @enderror"
                    placeholder="Masukkan lokasi lainnya..." value="{{ old('lokasi_perbedaan_nama_lainnya') }}">
                  @error('lokasi_perbedaan_nama_lainnya')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control required-step1 @error('alamat') is-invalid @enderror" required>{{ old('alamat') }}</textarea>
                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="col-md-3 mb-3">
                <label for="rt" class="form-label">RT</label>
                <input type="text" name="rt" id="rt" class="form-control required-step1 @error('rt') is-invalid @enderror" value="{{ old('rt') }}" required>
                @error('rt')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="col-md-3 mb-3">
                <label for="rw" class="form-label">RW</label>
                <input type="text" name="rw" id="rw" class="form-control required-step1 @error('rw') is-invalid @enderror" value="{{ old('rw') }}" required>
                @error('rw')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="col-md-12 mb-3">
                <label for="catatan" class="form-label">Catatan Tambahan (opsional)</label>
                <textarea name="catatan" id="catatan" class="form-control">{{ old('catatan') }}</textarea>
              </div>

              <div class="d-flex justify-content-end mt-3">
                <button type="button" class="btn btn-primary" onclick="if(validateStep1()) nextStep()">Lanjut</button>
              </div>
            </div>
          </div>

            {{-- STEP 2 --}}
            <div id="step2" style="display: none;">
              <div class="row">

                <div class="col-md-6 mb-3">
                  <label for="fc_ktp" class="form-label">Upload Foto KTP</label>
                  <input type="file" name="fc_ktp" id="fc_ktp" class="form-control @error('fc_ktp') is-invalid @enderror" accept="image/*,application/pdf" required>
                  @error('fc_ktp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="fc_kk" class="form-label">Upload Foto KK</label>
                  <input type="file" name="fc_kk" id="fc_kk" class="form-control @error('fc_kk') is-invalid @enderror" accept="image/*,application/pdf" required>
                  @error('fc_kk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="surat_pernyataan_beda_data" class="form-label">Upload Surat Pernyataan</label>
                  <input type="file" name="surat_pernyataan_beda_data" id="surat_pernyataan_beda_data" class="form-control @error('surat_pernyataan_beda_data') is-invalid @enderror" accept="image/*,application/pdf" required>
                  @error('surat_pernyataan_beda_data')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="bukti_beda_data" class="form-label">Upload Bukti Beda Data</label>
                  <input type="file" name="bukti_beda_data" id="bukti_beda_data" class="form-control @error('bukti_beda_data') is-invalid @enderror" accept="image/*,application/pdf" required>
                  @error('bukti_beda_data')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="pengantar_rt_rw" class="form-label">Upload Surat Pengantar RT/RW</label>
                  <input type="file" name="pengantar_rt_rw" id="pengantar_rt_rw" class="form-control @error('pengantar_rt_rw') is-invalid @enderror" accept="image/*,application/pdf" required>
                  @error('pengantar_rt_rw')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

              </div>

              <div class="form-navigation mt-4">
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Kembali</button>
                <button type="submit" class="btn btn-success">Kirim Pengajuan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- SweetAlert dan Validasi --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    toggleLainnya(); // Tampilkan input 'Lainnya' jika sudah dipilih sebelumnya

    const form = document.getElementById('formWizard');
    if (form) {
      form.addEventListener('submit', function (e) {
        const select = document.getElementById('lokasi_perbedaan_nama');
        const inputLainnya = document.getElementById('lokasi_perbedaan_nama_lainnya');

        if (select && inputLainnya && select.value === 'Lainnya' && inputLainnya.value.trim() !== '') {
          const newValue = inputLainnya.value.trim();
          const tempOption = new Option(newValue, newValue, true, true);
          select.appendChild(tempOption); // Tambah agar tidak error
          select.value = newValue;
        }
      });
    }
  });

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

    const nikInput = document.getElementById('nik');
    const nik = nikInput.value.trim();

    if (!/^\d{16}$/.test(nik)) {
      nikInput.classList.add('is-invalid');
      Swal.fire({
        icon: 'error',
        title: 'NIK Tidak Valid',
        text: 'NIK harus terdiri dari 16 digit angka.',
        confirmButtonColor: '#d33',
      });
      return false;
    } else {
      nikInput.classList.remove('is-invalid');
    }

    if (!isValid) {
      Swal.fire({
        icon: 'error',
        title: 'Form Belum Lengkap',
        text: 'Harap isi semua field yang wajib diisi sebelum melanjutkan.',
        confirmButtonColor: '#d33',
      });
    }

    return isValid;
  }

  function nextStep() {
    if (validateStep1()) {
      document.getElementById('step1').style.display = 'none';
      document.getElementById('step2').style.display = 'block';
      const progressBar = document.getElementById('progressBar');
      progressBar.style.width = '100%';
      progressBar.innerText = 'Langkah 2 dari 2';
    }
  }

  function prevStep() {
    document.getElementById('step2').style.display = 'none';
    document.getElementById('step1').style.display = 'block';
    const progressBar = document.getElementById('progressBar');
    progressBar.style.width = '50%';
    progressBar.innerText = 'Langkah 1 dari 2';
  }

  function toggleLainnya() {
    const select = document.getElementById('lokasi_perbedaan_nama');
    const inputLainnya = document.getElementById('lainnyaInput');

    if (select && inputLainnya) {
      inputLainnya.style.display = (select.value === 'Lainnya') ? 'block' : 'none';
    }
  }
</script>
@endsection

