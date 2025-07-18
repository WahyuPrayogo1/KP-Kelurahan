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

        .text-uppercase {
            text-transform: uppercase;
        }
    </style>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">TAMBAH SURAT KETERANGAN USAHA</h4>
                    </div>
                    <div class="card-body">

                        {{-- Progress Bar --}}
                        <div class="progress mb-4">
                            <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 50%;">
                                LANGKAH 1 DARI 2
                            </div>
                        </div>

                        {{-- Form --}}
                        <form action="{{ route('surat_keterangan_usahas.store') }}" method="POST"
                            enctype="multipart/form-data" id="formWizard">
                            @csrf

                            {{-- STEP 1: Data Pemohon --}}
                            <div id="step1">
                                <h5 class="mb-3 text-primary">DATA PEMOHON</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama" class="form-label">NAMA LENGKAP</label>
                                        <input type="text" name="nama" class="form-control required-step1 text-uppercase" required
                                            value="{{ old('nama') }}" oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="text" name="nik" class="form-control required-step1" required
                                            value="{{ old('nik') }}" maxlength="16" minlength="16"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="no_hp" class="form-label">NO HP</label>
                                        <input type="text" name="no_hp" class="form-control required-step1" required
                                            value="{{ old('no_hp') }}" oninput="validateNoHP(this)"
                                            onkeypress="return isNumberKey(event)">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_kelamin" class="form-label">JENIS KELAMIN</label>
                                        <select name="jenis_kelamin" class="form-select required-step1" required>
                                            <option value="">PILIH JENIS KELAMIN</option>
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>LAKI-LAKI</option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>PEREMPUAN</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">ALAMAT LENGKAP</label>
                                        <div class="row g-2">
                                            <div class="col-md-12">
                                                <input type="text" id="tempat" name="tempat" class="form-control required-step1 text-uppercase"
                                                    placeholder="CONTOH: JL. RAYA CIBEUREUM NO. 123" required
                                                    value="{{ old('tempat') }}" oninput="this.value = this.value.toUpperCase()">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Kelurahan</label>

                                                <input type="text" id="kelurahan" name="kelurahan" class="form-control required-step1 text-uppercase"
                                                    placeholder="KELURAHAN" required value="{{ old('kelurahan') }}" oninput="this.value = this.value.toUpperCase()">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Kecamatan</label>

                                                <input type="text" id="kecamatan" name="kecamatan" class="form-control required-step1 text-uppercase"
                                                    placeholder="KECAMATAN" required value="{{ old('kecamatan') }}" oninput="this.value = this.value.toUpperCase()">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Kode POS</label>

                                                <input type="text" id="kode_pos" name="kode_pos"
                                                    class="form-control required-step1 angka-saja" placeholder="KODE POS" required
                                                    maxlength="5" value="{{ old('kode_pos') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="kewarganegaraan" class="form-label">KEWARGANEGARAAN</label>
                                        <input type="text" name="kewarganegaraan" class="form-control required-step1 text-uppercase" required
                                            value="{{ old('kewarganegaraan', 'INDONESIA') }}" oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="pekerjaan" class="form-label">PEKERJAAN</label>
                                        <input type="text" name="pekerjaan" class="form-control required-step1 text-uppercase" required
                                            value="{{ old('pekerjaan') }}" oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="status_perkawinan" class="form-label">STATUS PERKAWINAN</label>
                                        <select name="status_perkawinan" class="form-select required-step1" required>
                                            <option value="">PILIH STATUS</option>
                                            <option value="BELUM KAWIN" {{ old('status_perkawinan') == 'BELUM KAWIN' ? 'selected' : '' }}>BELUM KAWIN</option>
                                            <option value="KAWIN" {{ old('status_perkawinan') == 'KAWIN' ? 'selected' : '' }}>KAWIN</option>
                                            <option value="CERAI HIDUP" {{ old('status_perkawinan') == 'CERAI HIDUP' ? 'selected' : '' }}>CERAI HIDUP</option>
                                            <option value="CERAI MATI" {{ old('status_perkawinan') == 'CERAI MATI' ? 'selected' : '' }}>CERAI MATI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="agama" class="form-label">AGAMA</label>
                                        <select name="agama" class="form-select required-step1" required>
                                            <option value="">PILIH AGAMA</option>
                                            <option value="ISLAM" {{ old('agama') == 'ISLAM' ? 'selected' : '' }}>ISLAM</option>
                                            <option value="KRISTEN" {{ old('agama') == 'KRISTEN' ? 'selected' : '' }}>KRISTEN</option>
                                            <option value="KATOLIK" {{ old('agama') == 'KATOLIK' ? 'selected' : '' }}>KATOLIK</option>
                                            <option value="HINDU" {{ old('agama') == 'HINDU' ? 'selected' : '' }}>HINDU</option>
                                            <option value="BUDDHA" {{ old('agama') == 'BUDDHA' ? 'selected' : '' }}>BUDDHA</option>
                                            <option value="KONGHUCU" {{ old('agama') == 'KONGHUCU' ? 'selected' : '' }}>KONGHUCU</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="button" class="btn btn-primary" onclick="nextStep()">LANJUT</button>
                                </div>
                            </div>

                            {{-- STEP 2: Data Usaha --}}
                            <div id="step2" style="display: none;">
                                <h5 class="mb-3 text-primary">DATA USAHA</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_usaha" class="form-label">NAMA USAHA</label>
                                        <input type="text" name="nama_usaha" class="form-control required-step2 text-uppercase" required
                                            value="{{ old('nama_usaha') }}" oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_usaha" class="form-label">JENIS USAHA</label>
                                        <input type="text" name="jenis_usaha" class="form-control required-step2 text-uppercase" required
                                            value="{{ old('jenis_usaha') }}" oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="alamat_usaha" class="form-label">ALAMAT USAHA</label>
                                        <textarea name="alamat_usaha" class="form-control required-step2 text-uppercase" rows="2" required oninput="this.value = this.value.toUpperCase()">{{ old('alamat_usaha') }}</textarea>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="status_bangunan" class="form-label">STATUS BANGUNAN</label>
                                        <select name="status_bangunan" class="form-select required-step2" required>
                                            <option value="">PILIH STATUS</option>
                                            <option value="MILIK SENDIRI" {{ old('status_bangunan') == 'MILIK SENDIRI' ? 'selected' : '' }}>MILIK SENDIRI</option>
                                            <option value="SEWA" {{ old('status_bangunan') == 'SEWA' ? 'selected' : '' }}>SEWA</option>
                                            <option value="PINJAM PAKAI" {{ old('status_bangunan') == 'PINJAM PAKAI' ? 'selected' : '' }}>PINJAM PAKAI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="no_sppt" class="form-label">NO SPPT PBB</label>
                                        <input type="text" name="no_sppt" class="form-control text-uppercase"
                                            value="{{ old('no_sppt') }}" oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="akta_pendirian_usaha" class="form-label">AKTA PENDIRIAN USAHA</label>
                                        <input type="text" name="akta_pendirian_usaha" class="form-control text-uppercase"
                                            value="{{ old('akta_pendirian_usaha') }}" oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="jumlah_karyawan" class="form-label">JUMLAH KARYAWAN</label>
                                        <input type="number" name="jumlah_karyawan" class="form-control required-step2" required
                                            value="{{ old('jumlah_karyawan') }}" min="0">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="pimpinan_usaha" class="form-label">PIMPINAN USAHA</label>
                                        <input type="text" name="pimpinan_usaha" class="form-control required-step2 text-uppercase" required
                                            value="{{ old('pimpinan_usaha') }}" oninput="this.value = this.value.toUpperCase()">
                                    </div>

                                    <h5 class="mt-4 mb-3 text-primary">DOKUMEN PENDUKUNG</h5>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_ktp" class="form-label">FOTO KTP</label>
                                        <input type="file" name="foto_ktp" class="form-control required-step2" required
                                            accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_kartu_keluarga" class="form-label">FOTO KARTU KELUARGA</label>
                                        <input type="file" name="foto_kartu_keluarga" class="form-control required-step2" required
                                            accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_surat_pernyataan_tetangga" class="form-label">FOTO SURAT PERNYATAAN TETANGGA</label>
                                        <input type="file" name="foto_surat_pernyataan_tetangga" class="form-control required-step2" required
                                            accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_surat_pernyataan_usaha" class="form-label">FOTO SURAT PERNYATAAN USAHA</label>
                                        <input type="file" name="foto_surat_pernyataan_usaha" class="form-control required-step2" required
                                            accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_usaha" class="form-label">FOTO USAHA</label>
                                        <input type="file" name="foto_usaha" class="form-control required-step2" required
                                            accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_pengantar_rt_rw" class="form-label">FOTO PENGANTAR RT/RW</label>
                                        <input type="file" name="foto_pengantar_rt_rw" class="form-control required-step2" required
                                            accept="image/*">
                                    </div>

                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-secondary" onclick="prevStep()">KEMBALI</button>
                                    <button type="submit" class="btn btn-success">KIRIM PENGAJUAN</button>
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
                    title: 'FORM BELUM LENGKAP',
                    text: 'HARAP ISI SEMUA FIELD YANG WAJIB DIISI SEBELUM MELANJUTKAN',
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
                    title: 'FORM BELUM LENGKAP',
                    text: 'HARAP ISI SEMUA FIELD YANG WAJIB DIISI DAN UNGGAH SEMUA DOKUMEN YANG DIPERLUKAN',
                    confirmButtonColor: '#d33',
                });
            }

            return isValid;
        }

        function nextStep() {
            if (!validateStep1()) return;

            document.getElementById('step1').style.display = 'none';
            document.getElementById('step2').style.display = 'block';
            updateProgress(100, 'LANGKAH 2 DARI 2');
        }

        function prevStep() {
            document.getElementById('step2').style.display = 'none';
            document.getElementById('step1').style.display = 'block';
            updateProgress(50, 'LANGKAH 1 DARI 2');
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
                    title: 'FORMAT SALAH',
                    text: 'NOMOR HP HARUS DIAWALI DENGAN 08',
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
                title: 'VALIDASI GAGAL',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#d33',
            });
        </script>
    @endif
@endsection
