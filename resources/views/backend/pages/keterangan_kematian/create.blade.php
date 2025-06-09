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
          <h4 class="mb-0">Tambah Surat Keterangan Kematian</h4>
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

          <form action="{{ route('surat_keterangan_kematian.store') }}" method="POST" enctype="multipart/form-data" id="formWizard">
            @csrf

            {{-- STEP 1 --}}
            <div id="step1">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" name="nama" id="nama" class="form-control required-step1 @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                  @error('nama')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  <select name="jenis_kelamin" id="jenis_kelamin" class="form-control required-step1 @error('jenis_kelamin') is-invalid @enderror" required>
                    <option value="">-- Pilih --</option>
                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                  </select>
                  @error('jenis_kelamin')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                  <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control required-step1 @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" required>
                  @error('tempat_lahir')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control required-step1 @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" required>
                  @error('tanggal_lahir')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="tempat_meninggal" class="form-label">Tempat Meninggal</label>
                  <input type="text" name="tempat_meninggal" id="tempat_meninggal" class="form-control required-step1 @error('tempat_meninggal') is-invalid @enderror" value="{{ old('tempat_meninggal') }}" required>
                  @error('tempat_meninggal')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="tanggal_meninggal" class="form-label">Tanggal Meninggal</label>
                  <input type="date" name="tanggal_meninggal" id="tanggal_meninggal" class="form-control required-step1 @error('tanggal_meninggal') is-invalid @enderror" value="{{ old('tanggal_meninggal') }}" required>
                  @error('tanggal_meninggal')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="penyebab_kematian" class="form-label">Penyebab Kematian</label>
                  <input type="text" name="penyebab_kematian" id="penyebab_kematian" class="form-control required-step1 @error('penyebab_kematian') is-invalid @enderror" value="{{ old('penyebab_kematian') }}" required>
                  @error('penyebab_kematian')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                  <input type="text" name="kewarganegaraan" id="kewarganegaraan" class="form-control required-step1 @error('kewarganegaraan') is-invalid @enderror" value="{{ old('kewarganegaraan') }}" required>
                  @error('kewarganegaraan')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="agama" class="form-label">Agama</label>
                  <input type="text" name="agama" id="agama" class="form-control required-step1 @error('agama') is-invalid @enderror" value="{{ old('agama') }}" required>
                  @error('agama')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="col-12 mb-3">
                  <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                  <textarea name="alamat_lengkap" id="alamat_lengkap" rows="3" class="form-control required-step1 @error('alamat_lengkap') is-invalid @enderror" required>{{ old('alamat_lengkap') }}</textarea>
                  @error('alamat_lengkap')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="col-12 mb-3">
                  <label for="catatan" class="form-label">Catatan Tambahan (opsional)</label>
                  <textarea name="catatan" id="catatan" rows="2" class="form-control @error('catatan') is-invalid @enderror">{{ old('catatan') }}</textarea>
                  @error('catatan')<small class="text-danger">{{ $message }}</small>@enderror
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
                    'fc_ktp' => 'Foto KTP',
                    'fc_kk' => 'Foto Kartu Keluarga',
                    'fc_buku_nikah' => 'Foto Buku Nikah',
                    'pengantar_kematian_rt_rw' => 'Surat Pengantar RT/RW',
                  ];
                @endphp

                @foreach ($fileFields as $field => $label)
                  <div class="col-md-6 mb-3">
                    <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                    <input type="file" name="{{ $field }}" id="{{ $field }}" class="form-control @error($field) is-invalid @enderror" required>
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
    document.querySelectorAll('#step1 .required-step1').forEach(input => {
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
    return isValid;
  }

  function nextStep() {
    document.getElementById('step1').style.display = 'none';
    document.getElementById('step2').style.display = 'block';
    const progressBar = document.getElementById('progressBar');
    progressBar.style.width = '100%';
    progressBar.textContent = 'Langkah 2 dari 2';
  }

  function prevStep() {
    document.getElementById('step2').style.display = 'none';
    document.getElementById('step1').style.display = 'block';
    const progressBar = document.getElementById('progressBar');
    progressBar.style.width = '50%';
    progressBar.textContent = 'Langkah 1 dari 2';
  }

  // Jika ada error validasi file di step 2, langsung tampilkan step 2 saat reload
  @if($errors->hasAny(['foto_ktp', 'foto_kartu_keluarga', 'foto_buku_nikah', 'foto_surat_pengantar_rt_rw']))
    document.addEventListener('DOMContentLoaded', function() {
      nextStep();
    });
  @endif
</script>
@endsection
