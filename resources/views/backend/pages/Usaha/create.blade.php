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
    </style>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Tambah Surat Keterangan Usaha</h4>
                    </div>
                    <div class="card-body">

                        {{-- Progress Bar --}}
                        <div class="progress mb-4">
                            <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 50%;">
                                Langkah 1 dari 2
                            </div>
                        </div>

                        {{-- Form --}}
                        <form action="{{ route('surat_keterangan_usahas.store') }}" method="POST"
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
                                        <label for="no_hp" class="form-label">No HP</label>
                                        <input type="text" name="no_hp" class="form-control required-step1" required
                                            value="{{ old('no_hp') }}" oninput="validateNoHP(this)"
                                            onkeypress="return isNumberKey(event)">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-select required-step1" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Alamat Lengkap</label>
                                        <div class="row g-2">
                                            <div class="col-md-12">
                                                <input type="text" id="tempat" name="tempat" class="form-control  required-step1"
                                                    placeholder="Contoh: Jl. Raya Cibeureum No. 123" required
                                                    value="{{ old('tempat') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" id="kelurahan" name="kelurahan" class="form-control  required-step1"
                                                    placeholder="Kelurahan" required value="{{ old('kelurahan') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" id="kecamatan" name="kecamatan" class="form-control  required-step1"
                                                    placeholder="Kecamatan" required value="{{ old('kecamatan') }}">
                                            </div>

                                            <div class="col-md-4">
                                                <input type="text" id="kode_pos" name="kode_pos"
                                                    class="form-control  required-step1 angka-saja" placeholder="Kode Pos" required
                                                    maxlength="5" value="{{ old('kode_pos') }}">
                                            </div>
                                        </div>
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
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="button" class="btn btn-primary" onclick="nextStep()">Lanjut</button>
                                </div>
                            </div>

                            {{-- STEP 2: Data Usaha --}}
                            <div id="step2" style="display: none;">
                                <h5 class="mb-3 text-primary">Data Usaha</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_usaha" class="form-label">Nama Usaha</label>
                                        <input type="text" name="nama_usaha" class="form-control required-step2" required
                                            value="{{ old('nama_usaha') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_usaha" class="form-label">Jenis Usaha</label>
                                        <input type="text" name="jenis_usaha" class="form-control required-step2" required
                                            value="{{ old('jenis_usaha') }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="alamat_usaha" class="form-label">Alamat Usaha</label>
                                        <textarea name="alamat_usaha" class="form-control required-step2" rows="2" required>{{ old('alamat_usaha') }}</textarea>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="status_bangunan" class="form-label">Status Bangunan</label>
                                        <select name="status_bangunan" class="form-select required-step2" required>
                                            <option value="">Pilih Status</option>
                                            <option value="Milik Sendiri" {{ old('status_bangunan') == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                            <option value="Sewa" {{ old('status_bangunan') == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                                            <option value="Pinjam Pakai" {{ old('status_bangunan') == 'Pinjam Pakai' ? 'selected' : '' }}>Pinjam Pakai</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="no_sppt" class="form-label">No SPPT PBB</label>
                                        <input type="text" name="no_sppt" class="form-control"
                                            value="{{ old('no_sppt') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="akta_pendirian_usaha" class="form-label">Akta Pendirian Usaha</label>
                                        <input type="text" name="akta_pendirian_usaha" class="form-control"
                                            value="{{ old('akta_pendirian_usaha') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="jumlah_karyawan" class="form-label">Jumlah Karyawan</label>
                                        <input type="number" name="jumlah_karyawan" class="form-control required-step2" required
                                            value="{{ old('jumlah_karyawan') }}" min="0">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="pimpinan_usaha" class="form-label">Pimpinan Usaha</label>
                                        <input type="text" name="pimpinan_usaha" class="form-control required-step2" required
                                            value="{{ old('pimpinan_usaha') }}">
                                    </div>

                                    <h5 class="mt-4 mb-3 text-primary">Dokumen Pendukung</h5>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_ktp" class="form-label">Foto KTP</label>
                                        <input type="file" name="foto_ktp" class="form-control required-step2" required
                                            accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_kartu_keluarga" class="form-label">Foto Kartu Keluarga</label>
                                        <input type="file" name="foto_kartu_keluarga" class="form-control required-step2" required
                                            accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_surat_pernyataan_tetangga" class="form-label">Foto Surat Pernyataan Tetangga</label>
                                        <input type="file" name="foto_surat_pernyataan_tetangga" class="form-control required-step2" required
                                            accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_surat_pernyataan_usaha" class="form-label">Foto Surat Pernyataan Usaha</label>
                                        <input type="file" name="foto_surat_pernyataan_usaha" class="form-control required-step2" required
                                            accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_usaha" class="form-label">Foto Usaha</label>
                                        <input type="file" name="foto_usaha" class="form-control required-step2" required
                                            accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_pengantar_rt_rw" class="form-label">Foto Pengantar RT/RW</label>
                                        <input type="file" name="foto_pengantar_rt_rw" class="form-control required-step2" required
                                            accept="image/*">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="catatan" class="form-label">Catatan Tambahan</label>
                                        <textarea name="catatan" class="form-control">{{ old('catatan') }}</textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 -->
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

            return isValid;
        }

        function validateStep2() {
            let isValid = true;
            const inputs = document.querySelectorAll('#step2 .required-step2');

            inputs.forEach(input => {
                if (!input.value.trim() && input.type !== 'file') {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            // Validasi khusus untuk file input
            const fileInputs = document.querySelectorAll('#step2 input[type="file"]');
            fileInputs.forEach(input => {
                if (!input.files || input.files.length === 0) {
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
                    text: 'Harap isi semua field yang wajib diisi dan unggah semua dokumen yang diperlukan',
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

        // Validasi sebelum submit
        document.getElementById('formWizard').addEventListener('submit', function(e) {
            if (!validateStep2()) {
                e.preventDefault();
            }
        });

        // Validasi No HP
        function validateNoHP(input) {
            let value = input.value;

            // Hapus karakter non-digit
            value = value.replace(/\D/g, '');

            // Maksimal 13 digit
            if (value.length > 13) {
                value = value.slice(0, 13);
            }

            input.value = value;

            // Cek prefix 08 hanya jika sudah 2 digit
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
            // Hanya izinkan 0–9 (charcode 48–57)
            if (charCode < 48 || charCode > 57) {
                evt.preventDefault();
                return false;
            }
            return true;
        }
    </script>

    {{-- SweetAlert untuk Validasi Error --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#d33',
            });
        </script>
    @endif
@endsection
