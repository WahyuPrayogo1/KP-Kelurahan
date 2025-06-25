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
                        <h4 class="mb-0">Tambah Surat Pengantar Ijin Keramaian</h4>
                    </div>
                    <div class="card-body">

                        {{-- Progress Bar --}}
                        <div class="progress mb-4">
                            <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 50%;">
                                Langkah 1 dari 2
                            </div>
                        </div>

                        {{-- Form --}}
                        <form action="{{ route('surat_pengantar_ijin_keramaian.store') }}" method="POST"
                            enctype="multipart/form-data" id="formWizard">
                            @csrf

                            {{-- STEP 1 --}}
                            <div id="step1">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_pemohon" class="form-label">Nama Pemohon</label>
                                        <input type="text" name="nama_pemohon" class="form-control  required-step1" required
                                            value="{{ old('nama_pemohon') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="jabatan_pemohon" class="form-label">Jabatan Pemohon</label>
                                        <input type="text" name="jabatan_pemohon" class="form-control  required-step1" required
                                            value="{{ old('jabatan_pemohon') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="no_hp" class="form-label">No HP</label>
                                        <input type="number" name="no_hp" id="no_hp" class="form-control  required-step1" required
                                            value="{{ old('no_hp') }}" oninput="validateNoHP(this)"
                                            onkeypress="return isNumberKey(event)">

                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="nama_organisasi" class="form-label">Nama Organisasi</label>
                                        <input type="text" name="nama_organisasi" class="form-control  required-step1" required
                                            value="{{ old('nama_organisasi') }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="alamat_organisasi" class="form-label">Alamat Organisasi</label>
                                        <textarea name="alamat_organisasi" class="form-control  required-step1" rows="2">{{ old('alamat_organisasi') }}</textarea>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="mengadakan_keramain" class="form-label">Kegiatan yang Diadakan</label>
                                        <input type="text" name="mengadakan_keramain" class="form-control  required-step1" required
                                            value="{{ old('mengadakan_keramain') }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="hiburan" class="form-label">Jenis Hiburan</label>
                                        <input type="text" name="hiburan" class="form-control  required-step1"
                                            value="{{ old('hiburan') }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="waktu" class="form-label">Waktu Pelaksanaan</label>
                                        <input type="text" id="waktu" name="waktu" class="form-control  required-step1"
                                            placeholder="Pilih tanggal dan waktu" required>


                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Tempat Pelaksanaan</label>
                                        <div class="row g-2">
                                            <div class="col-md-12">
                                                <input type="text" id="tempat" name="tempat" class="form-control  required-step1"
                                                    placeholder="Contoh: Jl. Raya Cibeureum No. 123" required
                                                    value="{{ old('tempat') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" id="kelurahan" name="kelurahan" class="form-control  required-step1"
                                                    placeholder="Kelurahan" required value="{{ old('kelurahan') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" id="kecamatan" name="kecamatan" class="form-control  required-step1"
                                                    placeholder="Kecamatan" required value="{{ old('kecamatan') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="rt" name="rt"
                                                    class="form-control  required-step1 angka-saja" placeholder="RT" required
                                                    maxlength="3" value="{{ old('rt') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="rw" name="rw"
                                                    class="form-control  required-step1 angka-saja" placeholder="RW" required
                                                    maxlength="3" value="{{ old('rw') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="kode_pos" name="kode_pos"
                                                    class="form-control  required-step1 angka-saja" placeholder="Kode Pos" required
                                                    maxlength="5" value="{{ old('kode_pos') }}">
                                            </div>
                                        </div>
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
                                        <label for="foto_ktp" class="form-label">Foto KTP</label>
                                        <input type="file" name="foto_ktp" class="form-control  required-step1" required
                                           accept="image/jpeg, image/png">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_kartu_keluarga" class="form-label">Foto Kartu Keluarga</label>
                                        <input type="file" name="foto_kartu_keluarga" class="form-control  required-step1" required
                                           accept="image/jpeg, image/png">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_pernyataan_tetangga" class="form-label">Foto Pernyataan
                                            Tetangga</label>
                                        <input type="file" name="foto_pernyataan_tetangga" class="form-control  required-step1"
                                            required accept="image/jpeg, image/png">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto_pengantar_rt_rw" class="form-label">Foto Pengantar RT/RW</label>
                                        <input type="file" name="foto_pengantar_rt_rw" class="form-control  required-step1" required
                                           accept="image/jpeg, image/png">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="catatan" class="form-label">Catatan Tambahan</label>
                                        <textarea name="catatan" class="form-control  required-step1">{{ old('catatan') }}</textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- RT RW Kode POS --}}
    <script>
        // Batasi input hanya angka
        document.querySelectorAll('.angka-saja').forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });

        // Gabungkan isi input saat form akan dikirim
        document.querySelector('form').addEventListener('submit', function() {
            const alamatDasar = document.getElementById('tempat').value.trim();
            const kelurahan = document.getElementById('kelurahan').value.trim();
            const kecamatan = document.getElementById('kecamatan').value.trim();
            const rt = document.getElementById('rt').value.trim();
            const rw = document.getElementById('rw').value.trim();
            const kode_pos = document.getElementById('kode_pos').value.trim();

            const tambahanAlamat =
                `Kelurahan ${kelurahan}, Kecamatan ${kecamatan}, RT ${rt}/RW ${rw}, Kota Sukabumi, ${kode_pos}`;

            // Gabungkan ke input utama
            document.getElementById('tempat').value = `${alamatDasar}, ${tambahanAlamat}`;
        });
    </script>


    {{-- Waktu Pelaksanaan --}}
    <script>
        flatpickr("#waktu", {
            enableTime: true,
            dateFormat: "d F Y H:i",
            time_24hr: true,
            minDate: "today",
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


    {{-- NO HP --}}
    <script>
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
@endsection
