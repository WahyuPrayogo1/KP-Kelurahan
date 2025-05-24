@extends('backend.master')

@section('content')
    <style>
        .progress {
            height: 20px;
        }

        .progress-bar {
            font-size: 14px;
            line-height: 30px;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .is-invalid:focus {
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, .25) !important;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }
    </style>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Tambah Surat Keterangan Pindah Perusahaan</h4>
                    </div>
                    <div class="card-body">

                        {{-- Progress Bar --}}
                        <div class="progress mb-4">
                            <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 50%;">
                                Langkah 1 dari 2
                            </div>
                        </div>

                        {{-- Form --}}
                        <form action="{{ route('surat-pindah-perusahaan.store') }}" method="POST"
                            enctype="multipart/form-data" id="formWizard">
                            @csrf

                            {{-- STEP 1 --}}
                            <div id="step1">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                        <input type="text" name="nama_perusahaan" class="form-control  required-step1"
                                            required value="{{ old('nama_perusahaan') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_pemilik" class="form-label">Nama Pemilik Perusahaan</label>
                                        <input type="text" name="nama_pemilik" class="form-control  required-step1"
                                            required value="{{ old('nama_pemilik') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nomor_tdp" class="form-label">Nomor TDP / Nomor Akta Notaris</label>
                                        <input type="number" name="nomor_tdp" class="form-control  required-step1 angka-saja" required
                                            value="{{ old('nomor_tdp') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_usaha" class="form-label">Jenis Usaha</label>
                                        <input type="text" name="jenis_usaha" class="form-control  required-step1"
                                            required value="{{ old('jenis_usaha') }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Alamat Perusahaan</label>
                                        <div class="row g-2">
                                            <div class="col-md-12">
                                                <input type="text" id="alamat_perusahaan" name="alamat_perusahaan" class="form-control required-step1"
                                                    placeholder="Contoh: Jl. Merdeka No. 45" required value="{{ old('alamat_perusahaan') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" id="kelurahan_perusahaan" name="kelurahan_perusahaan" class="form-control required-step1"
                                                    placeholder="Kelurahan" required value="{{ old('kelurahan_perusahaan') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" id="kecamatan_perusahaan" name="kecamatan_perusahaan" class="form-control required-step1"
                                                    placeholder="Kecamatan" required value="{{ old('kecamatan_perusahaan') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="rt_perusahaan" name="rt_perusahaan" class="form-control required-step1 angka-saja"
                                                    placeholder="RT" required maxlength="3" value="{{ old('rt_perusahaan') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="rw_perusahaan" name="rw_perusahaan" class="form-control required-step1 angka-saja"
                                                    placeholder="RW" required maxlength="3" value="{{ old('rw_perusahaan') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="kode_pos_perusahaan" name="kode_pos_perusahaan" class="form-control required-step1 angka-saja"
                                                    placeholder="Kode Pos" required maxlength="5" value="{{ old('kode_pos_perusahaan') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="alamat_pemilik" class="form-label">Alamat Pemilik</label>
                                        <textarea name="alamat_pemilik" class="form-control  required-step1" rows="2" required>{{ old('alamat_pemilik') }}</textarea>
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
                                        <label for="foto_ktp" class="form-label">Foto KTP Pemilik</label>
                                        <input type="file" name="foto_ktp" class="form-control  required-step1" required
                                              accept="image/jpeg, image/png">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_kk" class="form-label">Foto Kartu Keluarga</label>
                                        <input type="file" name="foto_kk" class="form-control  required-step1" required
                                              accept="image/jpeg, image/png">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_pernyataan_pindah" class="form-label">Foto Pernyataan
                                            Pindah</label>
                                        <input type="file" name="foto_pernyataan_pindah"
                                            class="form-control  required-step1" required   accept="image/jpeg, image/png">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_akte_notaris" class="form-label">Foto Akte Notaris</label>
                                        <input type="file" name="foto_akte_notaris" class="form-control  required-step1"
                                            required   accept="image/jpeg, image/png">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="foto_pengantar_rt_rw" class="form-label">Foto Pengantar RT/RW</label>
                                        <input type="file" name="foto_pengantar_rt_rw"
                                            class="form-control  required-step1" required   accept="image/jpeg, image/png">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="catatan" class="form-label">Catatan Tambahan</label>
                                        <textarea name="catatan" class="form-control  required-step1">{{ old('catatan') }}</textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-secondary"
                                        onclick="prevStep()">Kembali</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Untuk Gambar --}}

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const fileInputs = document.querySelectorAll('input[type="file"]');
            let isValid = true;

            fileInputs.forEach(input => {
                if (input.files.length > 0) {
                    const file = input.files[0];
                    const validTypes = ['image/jpeg', 'image/png'];

                    if (!validTypes.includes(file.type)) {
                        isValid = false;
                        input.classList.add('is-invalid');

                        // Tampilkan pesan error
                        const errorMsg = document.createElement('div');
                        errorMsg.className = 'invalid-feedback';
                        errorMsg.textContent = 'Hanya file JPG/PNG yang diperbolehkan';
                        input.parentNode.appendChild(errorMsg);
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Format File Tidak Valid',
                    text: 'Hanya file JPG/PNG yang diperbolehkan',
                    confirmButtonColor: '#d33',
                });
            }
        });
    </script>

    <script>
        document.querySelectorAll('.angka-saja').forEach(input => {
            input.addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>

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

            return isValid;
        }

        function nextStep() {
            if (!validateStep1()) return;

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
    </script>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonColor: '#d33',
                });
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#28a745',
                });
            });
        </script>
    @endif
@endsection
