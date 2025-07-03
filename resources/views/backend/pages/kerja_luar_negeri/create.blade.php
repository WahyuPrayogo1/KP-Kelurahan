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
                        <h4 class="mb-0">Tambah Surat Keterangan Bekerja di Luar Negeri</h4>
                    </div>
                    <div class="card-body">

                        {{-- Progress Bar --}}
                        <div class="progress mb-4">
                            <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 50%;">
                                Langkah 1 dari 2
                            </div>
                        </div>

                        {{-- Form --}}
                        <form action="{{ route('surat-bekerja-luar-negeri.store') }}" method="POST" enctype="multipart/form-data" id="formWizard">
                            @csrf

                            {{-- STEP 1 --}}
                            <div id="step1">
                            <h5 class="mb-3">Data Pemohon</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Pemohon</label>
                                    <input type="text" name="nama_pemohon" class="form-control required-step1" required value="{{ old('nama_pemohon') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK Pemohon</label>
                                    <input type="text" name="nik_pemohon" id="nik_pemohon" class="form-control required-step1" value="{{ old('nik_pemohon') }}" maxlength="16" oninput="validateNumericInput(this)" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir_pemohon" class="form-control required-step1" required value="{{ old('tempat_lahir_pemohon') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir_pemohon" class="form-control required-step1" required value="{{ old('tanggal_lahir_pemohon') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan</label>
                                    <input type="text" name="pekerjaan_pemohon" class="form-control required-step1" required value="{{ old('pekerjaan_pemohon') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status Perkawinan</label>
                                    <select name="status_perkawinan_pemohon" class="form-select required-step1" required>
                                            <option value="">Pilih status perkawinan</option>
                                            <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                            <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                            <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                            <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                        </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Agama</label>
                                    <select name="agama_pemohon" class="form-select required-step1" required>
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
                                    <label class="form-label">Alamat</label>
                                    <textarea name="alamat_pemohon" class="form-control required-step1" rows="2" required>{{ old('alamat_pemohon') }}</textarea>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Data Pekerja</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Pekerja</label>
                                    <input type="text" name="nama_pekerja" class="form-control required-step1" required value="{{ old('nama_pekerja') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK Pekerja</label>
                                    <input type="text" name="nik_pekerja" id="nik_pekerja" class="form-control required-step1" value="{{ old('nik_pekerja') }}" maxlength="16" oninput="validateNumericInput(this)" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tempat Lahir Pekerja</label>
                                    <input type="text" name="tempat_lahir_pekerja" class="form-control required-step1" required value="{{ old('tempat_lahir_pekerja') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Lahir Pekerja</label>
                                    <input type="date" name="tanggal_lahir_pekerja" class="form-control required-step1" required value="{{ old('tanggal_lahir_pekerja') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin_pekerja" class="form-control required-step1" required>
                                        <option value="">Pilih jenis kelamin</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kewarganegaraan</label>
                                    <input type="text" name="kewarganegaraan_pekerja" class="form-control required-step1" required value="{{ old('kewarganegaraan_pekerja', 'Indonesia') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Agama Pekerja</label>
                                    <select name="agama_pekerja" class="form-select required-step1" required>
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Negara Tujuan</label>
                                    <input type="text" name="negara_tujuan" class="form-control required-step1" required value="{{ old('negara_tujuan') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Hubungan dengan Pekerja</label>
                                    <select name="hubungan_dengan_pekerja" class="form-control required-step1" required>
                                        <option value="">Pilih hubungan dengan pekerja</option>
                                        <option value="orang tua">Orang Tua</option>
                                        <option value="suami">Suami</option>
                                        <option value="istri">Istri</option>
                                        <option value="anak">Anak</option>
                                        <option value="saudara">Saudara</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Alamat Jalan Pekerja</label>
                                    <input type="text" name="alamat_pekerja" class="form-control required-step1"
                                        value="{{ old('alamat_pekerja', $alamat_only ?? '') }}" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RT</label>
                                    <input type="text" name="rt_pekerja" class="form-control required-step1"
                                        value="{{ old('rt_pekerja', $rt_only ?? '') }}"
                                        maxlength="3" inputmode="numeric" pattern="[0-9]*" placeholder="contoh: 07" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RW</label>
                                    <input type="text" name="rw_pekerja" class="form-control required-step1"
                                        value="{{ old('rw_pekerja', $rw_only ?? '') }}"
                                        maxlength="3" inputmode="numeric" pattern="[0-9]*" placeholder="contoh: 07" required>
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
                                    <label class="form-label">Foto KTP</label>
                                    <input type="file" name="fc_ktp" class="form-control" required accept="application/pdf,image/jpeg,image/png">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Foto KK</label>
                                    <input type="file" name="fc_kk" class="form-control" required accept="application/pdf,image/jpeg,image/png">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Surat Pernyataan Bekerja</label>
                                    <input type="file" name="surat_pernyataan_bekerja" class="form-control" required accept="application/pdf,image/jpeg,image/png">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pengantar RT/RW</label>
                                    <input type="file" name="pengantar_rt_rw" class="form-control" required accept="application/pdf,image/jpeg,image/png">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Catatan Tambahan</label>
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

function nextStep() {
            if (validateStep1()) {
                document.getElementById('step1').style.display = 'none';
                document.getElementById('step2').style.display = 'block';

                // Update progress bar
                const progressBar = document.getElementById('progressBar');
                progressBar.style.width = '100%';
                progressBar.textContent = 'Langkah 2 dari 2';
            }
        }

        function prevStep() {
            document.getElementById('step2').style.display = 'none';
            document.getElementById('step1').style.display = 'block';

            // Update progress bar
            const progressBar = document.getElementById('progressBar');
            progressBar.style.width = '50%';
            progressBar.textContent = 'Langkah 1 dari 2';
        }

        function validateNumericInput(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }

        function updateProgress(percent, label) {
            const bar = document.getElementById('progressBar');
            bar.style.width = percent + '%';
            bar.textContent = label;
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
