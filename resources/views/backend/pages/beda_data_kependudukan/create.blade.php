@extends('backend.master')

@section('content')
    <style>
        .progress {
            height: 20px;
            border-radius: 4px;
        }

        .progress-bar {
            font-size: 14px;
            line-height: 20px;
            transition: width 0.5s ease;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875em;
        }

        .form-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .step {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
        }

        .card-header {
            border-radius: 10px 10px 0 0 !important;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .required-field::after {
            content: " *";
            color: #dc3545;
        }

        .file-upload-info {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        .text-uppercase {
            text-transform: uppercase;
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Progress Bar --}}
                        <div class="progress mb-4">
                            <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 50%;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                Langkah 1 dari 2
                            </div>
                        </div>

                        <form action="{{ route('beda-data-kependudukan.store') }}" method="POST"
                            enctype="multipart/form-data" id="formWizard" novalidate>
                            @csrf

                            {{-- STEP 1 --}}
                            <div id="step1" class="step">
                                <div class="row">

                                    <!-- Nama Lengkap -->
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_lengkap" class="form-label required-field">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" id="nama_lengkap"
                                            class="form-control required-step1 text-uppercase @error('nama_lengkap') is-invalid @enderror"
                                            value="{{ old('nama_lengkap') }}"
                                            oninput="this.value = this.value.toUpperCase()" required>
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="nik" class="form-label required-field">NIK</label>
                                        <input type="text" name="nik" id="nik"
                                            class="form-control required-step1 @error('nik') is-invalid @enderror"
                                            value="{{ old('nik') }}" maxlength="16"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)" required>
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tempat Lahir -->
                                    <div class="col-md-6 mb-3">
                                        <label for="tempat_lahir" class="form-label required-field">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" id="tempat_lahir"
                                            class="form-control required-step1 text-uppercase @error('tempat_lahir') is-invalid @enderror"
                                            value="{{ old('tempat_lahir') }}"
                                            oninput="this.value = this.value.toUpperCase()" required>
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_lahir" class="form-label required-field">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                            class="form-control required-step1 @error('tanggal_lahir') is-invalid @enderror"
                                            value="{{ old('tanggal_lahir') }}" max="{{ date('Y-m-d') }}" required>
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_kelamin" class="form-label required-field">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin"
                                            class="form-select required-step1 @error('jenis_kelamin') is-invalid @enderror"
                                            required>
                                            <option value="" disabled selected>Pilih jenis kelamin</option>
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="kewarganegaraan"
                                            class="form-label required-field">Kewarganegaraan</label>
                                        <input type="text" name="kewarganegaraan" class="form-control required-step1"
                                            required value="{{ old('kewarganegaraan', 'Indonesia') }}">
                                    </div>

                                    <!-- Pekerjaan -->
                                    <div class="col-md-6 mb-3">
                                        <label for="pekerjaan" class="form-label required-field">Pekerjaan</label>
                                        <input type="text" name="pekerjaan" id="pekerjaan"
                                            class="form-control required-step1 text-uppercase @error('pekerjaan') is-invalid @enderror"
                                            value="{{ old('pekerjaan') }}"
                                            oninput="this.value = this.value.toUpperCase()" required>
                                        @error('pekerjaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="status_perkawinan" class="form-label required-field">Status
                                            Perkawinan</label>
                                        <select name="status_perkawinan" id="status_perkawinan"
                                            class="form-select required-step1 @error('status_perkawinan') is-invalid @enderror"
                                            required>
                                            <option value="" disabled selected>Pilih status perkawinan</option>
                                            <option value="BELUM KAWIN"
                                                {{ old('status_perkawinan') == 'BELUM KAWIN' ? 'selected' : '' }}>Belum
                                                Kawin</option>
                                            <option value="KAWIN"
                                                {{ old('status_perkawinan') == 'KAWIN' ? 'selected' : '' }}>Kawin</option>
                                            <option value="CERAI HIDUP"
                                                {{ old('status_perkawinan') == 'CERAI HIDUP' ? 'selected' : '' }}>Cerai
                                                Hidup</option>
                                            <option value="CERAI MATI"
                                                {{ old('status_perkawinan') == 'CERAI MATI' ? 'selected' : '' }}>Cerai Mati
                                            </option>
                                        </select>
                                        @error('status_perkawinan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="agama" class="form-label required-field">Agama</label>
                                        <select name="agama" class="form-select required-step1" required>
                                            <option value="" disabled selected>Pilih Agama</option>
                                            <option value="ISLAM" {{ old('agama') == 'ISLAM' ? 'selected' : '' }}>ISLAM
                                            </option>
                                            <option value="KRISTEN" {{ old('agama') == 'KRISTEN' ? 'selected' : '' }}>
                                                KRISTEN</option>
                                            <option value="KATOLIK" {{ old('agama') == 'KATOLIK' ? 'selected' : '' }}>
                                                KATOLIK</option>
                                            <option value="HINDU" {{ old('agama') == 'HINDU' ? 'selected' : '' }}>HINDU
                                            </option>
                                            <option value="BUDDHA" {{ old('agama') == 'BUDDHA' ? 'selected' : '' }}>BUDDHA
                                            </option>
                                            <option value="KONGHUCU" {{ old('agama') == 'KONGHUCU' ? 'selected' : '' }}>
                                                KONGHUCU</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="lokasi_perbedaan_nama" class="form-label required-field">Lokasi
                                            Perbedaan Nama</label>
                                        <select name="lokasi_perbedaan_nama" id="lokasi_perbedaan_nama"
                                            class="form-select required-step1 @error('lokasi_perbedaan_nama') is-invalid @enderror"
                                            onchange="toggleLainnya()" required>
                                            <option value="" disabled selected>-- Pilih --</option>
                                            <option value="AKTE KELAHIRAN"
                                                {{ old('lokasi_perbedaan_nama') == 'AKTE KELAHIRAN' ? 'selected' : '' }}>
                                                AKTE KELAHIRAN</option>
                                            <option value="IJAZAH"
                                                {{ old('lokasi_perbedaan_nama') == 'IJAZAH' ? 'selected' : '' }}>IJAZAH
                                            </option>
                                            <option value="SERTIFIKAT TANAH"
                                                {{ old('lokasi_perbedaan_nama') == 'SERTIFIKAT TANAH' ? 'selected' : '' }}>
                                                SERTIFIKAT TANAH</option>
                                            <option value="AKTE NIKAH"
                                                {{ old('lokasi_perbedaan_nama') == 'AKTE NIKAH' ? 'selected' : '' }}>AKTE
                                                NIKAH</option>
                                            <option value="AKTE CERAI"
                                                {{ old('lokasi_perbedaan_nama') == 'AKTE CERAI' ? 'selected' : '' }}>AKTE
                                                CERAI</option>
                                            <option value="KTP"
                                                {{ old('lokasi_perbedaan_nama') == 'KTP' ? 'selected' : '' }}>KTP</option>
                                            <option value="KK"
                                                {{ old('lokasi_perbedaan_nama') == 'KK' ? 'selected' : '' }}>KK</option>
                                            <option value="Lainnya"
                                                {{ old('lokasi_perbedaan_nama') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                            </option>
                                        </select>
                                        @error('lokasi_perbedaan_nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <div id="lainnyaInput" style="display: none;" class="mt-2">
                                            <input type="text" name="lokasi_perbedaan_nama_lainnya"
                                                id="lokasi_perbedaan_nama_lainnya"
                                                class="form-control text-uppercase @error('lokasi_perbedaan_nama_lainnya') is-invalid @enderror"
                                                placeholder="Masukkan lokasi lainnya..."
                                                oninput="this.value = this.value.toUpperCase()"
                                                value="{{ old('lokasi_perbedaan_nama_lainnya') }}">
                                            @error('lokasi_perbedaan_nama_lainnya')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Alamat Lengkap</label>
                                        <div class="row g-2">
                                            <!-- Alamat -->
                                            <div class="col-md-4">
                                                <input type="text" id="tempat" name="tempat"
                                                    class="form-control required-step1 text-uppercase"
                                                    placeholder="Contoh: Jl. Raya Cibeureum No. 123"
                                                    oninput="this.value = this.value.toUpperCase()" required
                                                    value="{{ old('tempat') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" id="rt" name="rt"
                                                    class="form-control required-step1" placeholder="Rt.07"
                                                    maxlength="3" required value="{{ old('rt') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" id="rw" name="rw"
                                                    class="form-control required-step1" placeholder="Rw.01"
                                                    maxlength="3" required value="{{ old('rw') }}">
                                            </div>
                                            <!-- Kelurahan -->
                                            <div class="col-md-4">
                                                <input type="text" id="kelurahan" name="kelurahan"
                                                    class="form-control required-step1 text-uppercase"
                                                    placeholder="Kelurahan"
                                                    oninput="this.value = this.value.toUpperCase()" required
                                                    value="{{ old('kelurahan', 'SUBANGJAYA') }}">
                                            </div>

                                            <!-- Kecamatan -->
                                            <div class="col-md-4">
                                                <input type="text" id="kecamatan" name="kecamatan"
                                                    class="form-control required-step1 text-uppercase"
                                                    placeholder="Kecamatan"
                                                    oninput="this.value = this.value.toUpperCase()" required
                                                    value="{{ old('kecamatan', 'CIKOLE') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" id="kode_pos" name="kode_pos"
                                                    class="form-control required-step1 angka-saja" placeholder="Kode Pos"
                                                    required maxlength="5" value="{{ old('kode_pos', '43116') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="button" class="btn btn-primary px-4" onclick="validateStep1()">
                                            Lanjut <i class="fas fa-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- STEP 2 --}}
                            <div id="step2" class="step">
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label for="fc_ktp" class="form-label required-field">Upload Foto KTP</label>
                                        <input type="file" name="fc_ktp" id="fc_ktp"
                                            class="form-control @error('fc_ktp') is-invalid @enderror"
                                            accept="image/*,.pdf" required>
                                        <div class="file-upload-info"></div>
                                        <small>Ukuran Gambar tidak boleh lebih dari 2mb</small>
                                        @error('fc_ktp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="fc_kk" class="form-label required-field">Upload Foto KK</label>
                                        <input type="file" name="fc_kk" id="fc_kk"
                                            class="form-control @error('fc_kk') is-invalid @enderror"
                                            accept="image/*,.pdf" required>
                                        <div class="file-upload-info"></div>
                                        <small>Ukuran Gambar tidak boleh lebih dari 2mb</small>
                                        @error('fc_kk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="surat_pernyataan_beda_data" class="form-label required-field">Upload
                                            Surat Pernyataan</label>
                                        <input type="file" name="surat_pernyataan_beda_data"
                                            id="surat_pernyataan_beda_data"
                                            class="form-control @error('surat_pernyataan_beda_data') is-invalid @enderror"
                                            accept="image/*,.pdf" required>
                                        <div class="file-upload-info"></div>
                                        <small>Ukuran Gambar tidak boleh lebih dari 2mb</small>
                                        @error('surat_pernyataan_beda_data')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="bukti_beda_data" class="form-label required-field">Upload Bukti Beda
                                            Data</label>
                                        <input type="file" name="bukti_beda_data" id="bukti_beda_data"
                                            class="form-control @error('bukti_beda_data') is-invalid @enderror"
                                            accept="image/*,.pdf" required>
                                        <div class="file-upload-info"></div>
                                        <small>Ukuran Gambar tidak boleh lebih dari 2mb</small>
                                        @error('bukti_beda_data')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="pengantar_rt_rw" class="form-label required-field">Upload Surat
                                            Pengantar RT/RW</label>
                                        <input type="file" name="pengantar_rt_rw" id="pengantar_rt_rw"
                                            class="form-control @error('pengantar_rt_rw') is-invalid @enderror"
                                            accept="image/*,.pdf" required>
                                        <div class="file-upload-info"></div>
                                        <small>Ukuran Gambar tidak boleh lebih dari 2mb</small>
                                        @error('pengantar_rt_rw')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-navigation">
                                    <button type="button" class="btn btn-secondary"
                                        onclick="prevStep()">Kembali</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <script>
        // Show first step on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('step1').style.display = 'block';
            toggleLainnya(); // Initialize the "Lainnya" field visibility

            // Add input validation for RT/RW
            const rtInput = document.getElementById('rt');
            const rwInput = document.getElementById('rw');

            if (rtInput) {
                rtInput.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3);
                });
            }

            if (rwInput) {
                rwInput.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3);
                });
            }
        });

        function toggleLainnya() {
            const select = document.getElementById('lokasi_perbedaan_nama');
            const lainnyaDiv = document.getElementById('lainnyaInput');

            if (select && lainnyaDiv) {
                lainnyaDiv.style.display = (select.value === 'Lainnya') ? 'block' : 'none';

                // Clear the "Lainnya" input when another option is selected
                if (select.value !== 'Lainnya') {
                    document.getElementById('lokasi_perbedaan_nama_lainnya').value = '';
                }
            }
        }

        function validateStep1() {
            let isValid = true;
            const requiredFields = document.querySelectorAll('#step1 .required-step1');

            // Reset validation
            requiredFields.forEach(field => {
                field.classList.remove('is-invalid');
            });

            // Validate each required field
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                }
            });

            // Special validation for NIK (16 digits)
            const nik = document.getElementById('nik').value.trim();
            if (!/^\d{16}$/.test(nik)) {
                document.getElementById('nik').classList.add('is-invalid');
                showError('NIK Tidak Valid', 'NIK harus terdiri dari 16 digit angka.');
                return false;
            }

            // Special validation for date (not in future)
            const tanggalLahir = document.getElementById('tanggal_lahir').value;
            const today = new Date().toISOString().split('T')[0];
            if (tanggalLahir > today) {
                document.getElementById('tanggal_lahir').classList.add('is-invalid');
                showError('Tanggal Tidak Valid', 'Tanggal lahir tidak boleh lebih dari hari ini.');
                return false;
            }

            // Special validation for RT/RW (numeric only, max 3 digits)
            const rt = document.getElementById('rt').value.trim();
            const rw = document.getElementById('rw').value.trim();

            if (!/^\d{1,3}$/.test(rt)) {
                document.getElementById('rt').classList.add('is-invalid');
                showError('RT Tidak Valid', 'RT harus berupa angka (1-3 digit).');
                return false;
            }

            if (!/^\d{1,3}$/.test(rw)) {
                document.getElementById('rw').classList.add('is-invalid');
                showError('RW Tidak Valid', 'RW harus berupa angka (1-3 digit).');
                return false;
            }

            if (!isValid) {
                showError('Form Belum Lengkap', 'Harap isi semua field yang wajib diisi sebelum melanjutkan.');
                return false;
            }

            // If all validations pass, proceed to next step
            nextStep();
            return true;
        }

        function nextStep() {
            document.getElementById('step1').style.display = 'none';
            document.getElementById('step2').style.display = 'block';

            // Update progress bar
            const progressBar = document.getElementById('progressBar');
            progressBar.style.width = '100%';
            progressBar.innerText = 'Langkah 2 dari 2';
            progressBar.setAttribute('aria-valuenow', '100');

            // Scroll to top of form
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function prevStep() {
            document.getElementById('step2').style.display = 'none';
            document.getElementById('step1').style.display = 'block';

            // Update progress bar
            const progressBar = document.getElementById('progressBar');
            progressBar.style.width = '50%';
            progressBar.innerText = 'Langkah 1 dari 2';
            progressBar.setAttribute('aria-valuenow', '50');

            // Scroll to top of form
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function showError(title, message) {
            Swal.fire({
                icon: 'error',
                title: title,
                text: message,
                confirmButtonColor: '#d33',
            });
        }

        // Form submission validation
        document.getElementById('formWizard').addEventListener('submit', function(e) {
            // Capitalize fields before submission
            const fieldsToCapitalize = [
                'nama_lengkap',
                'tempat_lahir',
                'pekerjaan',
                'tempat',
                'kelurahan',
                'kecamatan',
                'lokasi_perbedaan_nama_lainnya'
            ];

            fieldsToCapitalize.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.value = field.value.toUpperCase();
                }
            });

            // Handle "Lainnya" field
            const select = document.getElementById('lokasi_perbedaan_nama');
            const inputLainnya = document.getElementById('lokasi_perbedaan_nama_lainnya');

            if (select && inputLainnya && select.value === 'Lainnya' && inputLainnya.value.trim() !== '') {
                select.value = inputLainnya.value.trim().toUpperCase();
            }
        });
    </script>
@endsection
