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
                        <h4 class="mb-0">Tambah Surat Keterangan Kematian</h4>
                    </div>
                    <div class="card-body">

                        {{-- Progress Bar --}}
                        <div class="progress mb-4">
                            <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 50%;">
                                Langkah 1 dari 2
                            </div>
                        </div>

                        {{-- Form --}}
                        <form action="{{ route('surat_keterangan_kematian.store') }}" method="POST" enctype="multipart/form-data" id="formWizard">
                            @csrf

                            {{-- STEP 1: Data Almarhum/ah --}}
                            <div id="step1">
                                <h5 class="mb-3 text-primary">Data Almarhum/ah</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" name="nama" class="form-control required-step1" required value="{{ old('nama') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-select required-step1" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control required-step1" required value="{{ old('tempat_lahir') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control required-step1" required placeholder="Pilih tanggal" value="{{ old('tanggal_lahir') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tempat_meninggal" class="form-label">Tempat Meninggal</label>
                                        <input type="text" name="tempat_meninggal" class="form-control required-step1" required value="{{ old('tempat_meninggal') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_meninggal" class="form-label">Tanggal Meninggal</label>
                                        <input type="text" id="tanggal_meninggal" name="tanggal_meninggal" class="form-control required-step1" required placeholder="Pilih tanggal" value="{{ old('tanggal_meninggal') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="penyebab_kematian" class="form-label">Penyebab Kematian</label>
                                        <input type="text" name="penyebab_kematian" class="form-control required-step1" required value="{{ old('penyebab_kematian') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                                        <input type="text" name="kewarganegaraan" class="form-control required-step1" required value="{{ old('kewarganegaraan', 'Indonesia') }}">
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
                                        <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                                        <textarea name="alamat_lengkap" class="form-control required-step1" rows="3" placeholder="Contoh: Jl. Raya Cibeureum No. 123"  required>{{ old('alamat_lengkap') }}</textarea>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="catatan" class="form-label">Catatan Tambahan (Opsional)</label>
                                        <textarea name="catatan" class="form-control">{{ old('catatan') }}</textarea>
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
                                    @php
                                        $dokumen = [
                                            'fc_ktp' => 'Foto KTP',
                                            'fc_kk' => 'Foto Kartu Keluarga',
                                            'fc_buku_nikah' => 'Foto Buku Nikah',
                                            'pengantar_kematian_rt_rw' => 'Surat Pengantar RT/RW',
                                        ];
                                    @endphp

                                    @foreach ($dokumen as $field => $label)
                                        <div class="col-md-6 mb-3">
                                            <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                                            <input type="file" name="{{ $field }}" class="form-control required-step2" required accept="image/*" onchange="previewImage(this, 'preview_{{ $field }}')">
                                            <img id="preview_{{ $field }}" class="file-preview" />
                                        </div>
                                    @endforeach
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

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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

        flatpickr("#tanggal_lahir", {
            dateFormat: "d F Y",
            maxDate: "today"
        });

        flatpickr("#tanggal_meninggal", {
            dateFormat: "d F Y",
            maxDate: "today"
        });

        // Jika ada error validasi dokumen
        @if ($errors->hasAny(['fc_ktp', 'fc_kk', 'fc_buku_nikah', 'pengantar_kematian_rt_rw']))
            document.addEventListener('DOMContentLoaded', () => {
                nextStep();
            });
        @endif

        // Jika ada error validasi server
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
