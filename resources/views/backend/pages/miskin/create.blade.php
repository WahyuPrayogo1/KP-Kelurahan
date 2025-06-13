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

        .file-preview {
            max-width: 100px;
            max-height: 100px;
            margin-top: 10px;
            display: none;
        }
    </style>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Tambah Surat Keterangan Miskin</h4>
                    </div>
                    <div class="card-body">

                        {{-- Progress Bar --}}
                        <div class="progress mb-4">
                            <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 50%;">
                                Langkah 1 dari 2
                            </div>
                        </div>

                        {{-- Form --}}
                        <form action="{{ route('surat_keterangan_miskin.store') }}" method="POST"
                            enctype="multipart/form-data" id="formWizard">
                            @csrf

                            {{-- STEP 1: Data Pemohon --}}
                            <div id="step1">
                                <h5 class="mb-3 text-primary">Data Pemohon</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control required-step1" required
                                            value="{{ old('nama') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="text" name="nik" class="form-control required-step1" required
                                            value="{{ old('nik') }}" maxlength="16" minlength="16"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control required-step1" required
                                            value="{{ old('tempat_lahir') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control required-step1" required
                                            placeholder="Pilih tanggal" value="{{ old('tanggal_lahir') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-select required-step1" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                                        <input type="text" name="kewarganegaraan" class="form-control required-step1" required
                                            value="{{ old('kewarganegaraan', 'Indonesia') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                        <input type="text" name="pekerjaan" class="form-control required-step1" required
                                            value="{{ old('pekerjaan') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                                        <select name="status_perkawinan" class="form-select required-step1" required>
                                            <option value="">Pilih Status</option>
                                            <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                            <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                            <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                            <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
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
                                        <label class="form-label">Alamat Lengkap</label>
                                        <div class="row g-2">
                                            <div class="col-md-12">
                                                <input type="text" id="tempat" name="tempat" class="form-control required-step1"
                                                    placeholder="Contoh: Jl. Raya Cibeureum No. 123" required
                                                    value="{{ old('tempat') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" id="kelurahan" name="kelurahan" class="form-control required-step1"
                                                    placeholder="Kelurahan" required value="{{ old('kelurahan') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" id="kecamatan" name="kecamatan" class="form-control required-step1"
                                                    placeholder="Kecamatan" required value="{{ old('kecamatan') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" id="kode_pos" name="kode_pos"
                                                    class="form-control required-step1 angka-saja" placeholder="Kode Pos" required
                                                    maxlength="5" value="{{ old('kode_pos') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="button" class="btn btn-primary" onclick="nextStep()">Lanjut</button>
                                </div>
                            </div>

                            {{-- STEP 2: Dokumen Pendukung --}}
                            <div id="step2" style="display: none;">
                                <h5 class="mb-3 text-primary">Dokumen Pendukung</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_ktp" class="form-label">Foto KTP</label>
                                        <input type="file" name="foto_ktp" class="form-control required-step2" required
                                            accept="image/jpeg, image/png" onchange="previewImage(this, 'previewKTP')">
                                        <img id="previewKTP" class="file-preview" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_kk" class="form-label">Foto Kartu Keluarga</label>
                                        <input type="file" name="foto_kk" class="form-control required-step2" required
                                            accept="image/jpeg, image/png" onchange="previewImage(this, 'previewKK')">
                                        <img id="previewKK" class="file-preview" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_pengantar_rt_rw" class="form-label">Foto Pengantar RT/RW</label>
                                        <input type="file" name="foto_pengantar_rt_rw" class="form-control required-step2" required
                                            accept="image/jpeg, image/png" onchange="previewImage(this, 'previewPengantar')">
                                        <img id="previewPengantar" class="file-preview" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="catatan" class="form-label">Catatan Tambahan</label>
                                        <textarea name="catatan" class="form-control">{{ old('catatan') }}</textarea>
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Batasi input hanya angka
        document.querySelectorAll('.angka-saja').forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });

        // Gabungkan alamat saat form submit
        document.querySelector('form').addEventListener('submit', function() {
            const alamatDasar = document.getElementById('tempat').value.trim();
            const kelurahan = document.getElementById('kelurahan').value.trim();
            const kecamatan = document.getElementById('kecamatan').value.trim();
            const kode_pos = document.getElementById('kode_pos').value.trim();

            const alamatLengkap = `${alamatDasar}, Kelurahan ${kelurahan}, Kecamatan ${kecamatan}, Kota Sukabumi, ${kode_pos}`;

            // Buat input hidden untuk alamat lengkap
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'alamat';
            hiddenInput.value = alamatLengkap;
            this.appendChild(hiddenInput);
        });

        // Date picker
        flatpickr("#tanggal_lahir", {
            dateFormat: "d F Y",
            maxDate: "today",
        });

        // Image preview
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(file);
            }
        }

        // Form wizard functions
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

        function validateStep2() {
            let isValid = true;
            const inputs = document.querySelectorAll('#step2 .required-step2');

            inputs.forEach(input => {
                if (!input.value) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Dokumen Belum Lengkap',
                    text: 'Harap unggah semua dokumen yang diperlukan',
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

        // Phone validation
        function validateNoHP(input) {
            let value = input.value.replace(/\D/g, '');
            if (value.length > 13) value = value.slice(0, 13);
            input.value = value;

            if (value.length >= 2 && !value.startsWith('08')) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Format Salah',
                    text: 'Nomor HP harus diawali dengan 08',
                    timer: 2000,
                    showConfirmButton: false
                });
                input.value = '';
            }
        }

        function isNumberKey(evt) {
            const charCode = evt.which ? evt.which : evt.keyCode;
            if (charCode < 48 || charCode > 57) {
                evt.preventDefault();
                return false;
            }
            return true;
        }

        // Show validation errors if any
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#d33',
            });
        @endif
    </script>
@endsection
