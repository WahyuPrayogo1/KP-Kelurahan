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
              @php
                $fields = [
                  ['nama_lengkap', 'Nama Lengkap'],
                  ['nik', 'NIK'],
                  ['tempat_lahir', 'Tempat Lahir'],
                  ['tanggal_lahir', 'Tanggal Lahir', 'date'],
                  ['jenis_kelamin', 'Jenis Kelamin', 'select', ['Laki-laki' => 'L', 'Perempuan' => 'P']],
                  ['kewarganegaraan', 'Kewarganegaraan'],
                  ['pekerjaan', 'Pekerjaan'],
                  ['status_perkawinan', 'Status Perkawinan', 'select', ['Belum Kawin' => 'Belum Kawin', 'Kawin' => 'Kawin', 'Cerai Hidup' => 'Cerai Hidup', 'Cerai Mati' => 'Cerai Mati']],
                  ['agama', 'Agama'],
                  ['lokasi_perbedaan_nama', 'Lokasi Perbedaan Nama'],
                ];
              @endphp

              @foreach ($fields as $field)
                @php
                  $name = $field[0];
                  $label = $field[1];
                  $type = $field[2] ?? 'text';
                @endphp

                <div class="col-md-{{ $name === 'lokasi_perbedaan_nama' ? '12' : '6' }} mb-3">
                  <label for="{{ $name }}" class="form-label">{{ $label }}</label>

                  {{-- Select Khusus untuk Lokasi Perbedaan Nama --}}
                  @if ($name === 'lokasi_perbedaan_nama')
                    @php
                      $options = ['Akte Kelahiran', 'Ijazah', 'Sertifikat Tanah', 'Akte Nikah', 'Akte Cerai', 'KTP', 'KK', 'Lainnya'];
                    @endphp
                    <select name="{{ $name }}" id="{{ $name }}" class="form-select required-step1 @error($name) is-invalid @enderror" onchange="toggleLainnya()" required>
                      <option value="">-- Pilih --</option>
                      @foreach ($options as $opt)
                        <option value="{{ $opt }}" {{ old($name) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                      @endforeach
                    </select>

                    {{-- Input Tambahan Jika "Lainnya" --}}
                    <div id="lainnyaInput" style="display: none;" class="mt-2">
                      <input type="text" name="lokasi_perbedaan_nama_lainnya" id="lokasi_perbedaan_nama_lainnya"
                        class="form-control @error('lokasi_perbedaan_nama_lainnya') is-invalid @enderror"
                        placeholder="Masukkan lokasi perbedaan data lainnya..."
                        value="{{ old('lokasi_perbedaan_nama_lainnya') }}">
                      @error('lokasi_perbedaan_nama_lainnya')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>

                  {{-- Select Biasa --}}
                  @elseif ($type === 'select')
                    <select name="{{ $name }}" id="{{ $name }}" class="form-select required-step1 @error($name) is-invalid @enderror" required>
                      <option value="">-- Pilih --</option>
                      @foreach ($field[3] as $opt => $val)
                        <option value="{{ $val }}" {{ old($name) == $val ? 'selected' : '' }}>{{ $opt }}</option>
                      @endforeach
                    </select>

                  {{-- Input Text / Date --}}
                  @else
                    <input
                      type="{{ $type }}"
                      name="{{ $name }}"
                      id="{{ $name }}"
                      class="form-control required-step1 @error($name) is-invalid @enderror"
                      value="{{ old($name) }}"
                      required
                      @if($name === 'nik')
                        maxlength="16"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)"
                      @endif
                    >
                  @endif

                  @error($name)
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              @endforeach

              {{-- Alamat, RT, RW --}}
              <div class="col-md-12 mb-3">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control required-step1 @error('alamat') is-invalid @enderror" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-md-3 mb-3">
                    <label for="rt" class="form-label">RT</label>
                    <input type="text" name="rt" id="rt" class="form-control required-step1 @error('rt') is-invalid @enderror" value="{{ old('rt') }}" required>
                    @error('rt')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-md-3 mb-3">
                    <label for="rw" class="form-label">RW</label>
                    <input type="text" name="rw" id="rw" class="form-control required-step1 @error('rw') is-invalid @enderror" value="{{ old('rw') }}" required>
                    @error('rw')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              {{-- Catatan Tambahan --}}
              <div class="col-12 mb-3">
                <label for="catatan" class="form-label">Catatan Tambahan (opsional)</label>
                <textarea name="catatan" id="catatan" rows="2" class="form-control">{{ old('catatan') }}</textarea>
              </div>

              {{-- Tombol Lanjut --}}
              <div class="d-flex justify-content-end mt-3">
                <button type="button" class="btn btn-primary" onclick="if(validateStep1()) nextStep()">Lanjut</button>
              </div>
            </div>
          </div>

            {{-- STEP 2 --}}
            <div id="step2" style="display:none;">
              <div class="row">
                @php
                  $uploads = [
                    ['fc_ktp', 'Upload Foto KTP'],
                    ['fc_kk', 'Upload Foto KK'],
                    ['surat_pernyataan_beda_data', 'Upload Surat Pernyataan'],
                    ['bukti_beda_data', 'Upload Bukti Beda Data'],
                    ['pengantar_rt_rw', 'Upload Surat Pengantar RT/RW'],
                  ];
                @endphp

                @foreach ($uploads as $upload)
                  <div class="col-md-6 mb-3">
                    <label for="{{ $upload[0] }}" class="form-label">{{ $upload[1] }}</label>
                    <input type="file" name="{{ $upload[0] }}" id="{{ $upload[0] }}" class="form-control @error($upload[0]) is-invalid @enderror" accept="image/*,application/pdf" required>
                    @error($upload[0])
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                @endforeach
              </div>

              <div class="form-navigation">
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

