@extends('backend.master')

@section('content')
    <style>
        .file-preview-container {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
        }
        .file-preview {
            max-width: 100%;
            height: auto;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .file-preview:hover {
            transform: scale(1.03);
        }
        .section-title {
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 5px;
            margin-bottom: 20px;
            color: #0d6efd;
        }
        .form-label {
            font-weight: 500;
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
                        <h4 class="mb-0 text-uppercase"><i class="fas fa-edit me-2"></i>EDIT SURAT KETERANGAN USAHA</h4>
                    </div>
                    <div class="card-body">
                          @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Sukses!</strong> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        <form action="{{ route('surat_keterangan_usahas.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Data Pemohon Section -->
                            <h5 class="section-title text-uppercase"><i class="fas fa-user-circle me-2"></i>DATA PEMOHON</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label text-uppercase">NAMA LENGKAP</label>
                                    <input type="text" name="nama" class="form-control text-uppercase" required
                                           value="{{ strtoupper($surat->nama) }}" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nik" class="form-label text-uppercase">NIK</label>
                                    <input type="text" name="nik" class="form-control" required
                                           value="{{ $surat->nik }}" maxlength="16" minlength="16"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="no_hp" class="form-label text-uppercase">NOMOR HP</label>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control" required
                                           value="{{ $surat->no_hp }}" oninput="validateNoHP(this)">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="jenis_kelamin" class="form-label text-uppercase">JENIS KELAMIN</label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="L" {{ $surat->jenis_kelamin == 'L' ? 'selected' : '' }}>LAKI-LAKI</option>
                                        <option value="P" {{ $surat->jenis_kelamin == 'P' ? 'selected' : '' }}>PEREMPUAN</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="kewarganegaraan" class="form-label text-uppercase">KEWARGANEGARAAN</label>
                                    <input type="text" name="kewarganegaraan" class="form-control text-uppercase" required
                                           value="{{ strtoupper($surat->kewarganegaraan) }}" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="pekerjaan" class="form-label text-uppercase">PEKERJAAN</label>
                                    <input type="text" name="pekerjaan" class="form-control text-uppercase" required
                                           value="{{ strtoupper($surat->pekerjaan) }}" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="status_perkawinan" class="form-label text-uppercase">STATUS PERKAWINAN</label>
                                    <select name="status_perkawinan" class="form-select" required>
                                        <option value="BELUM KAWIN" {{ $surat->status_perkawinan == 'BELUM KAWIN' ? 'selected' : '' }}>BELUM KAWIN</option>
                                        <option value="KAWIN" {{ $surat->status_perkawinan == 'KAWIN' ? 'selected' : '' }}>KAWIN</option>
                                        <option value="CERAI HIDUP" {{ $surat->status_perkawinan == 'CERAI HIDUP' ? 'selected' : '' }}>CERAI HIDUP</option>
                                        <option value="CERAI MATI" {{ $surat->status_perkawinan == 'CERAI MATI' ? 'selected' : '' }}>CERAI MATI</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="agama" class="form-label text-uppercase">AGAMA</label>
                                    <select name="agama" class="form-select" required>
                                        <option value="ISLAM" {{ $surat->agama == 'ISLAM' ? 'selected' : '' }}>ISLAM</option>
                                        <option value="KRISTEN" {{ $surat->agama == 'KRISTEN' ? 'selected' : '' }}>KRISTEN</option>
                                        <option value="KATOLIK" {{ $surat->agama == 'KATOLIK' ? 'selected' : '' }}>KATOLIK</option>
                                        <option value="HINDU" {{ $surat->agama == 'HINDU' ? 'selected' : '' }}>HINDU</option>
                                        <option value="BUDDHA" {{ $surat->agama == 'BUDDHA' ? 'selected' : '' }}>BUDDHA</option>
                                        <option value="KONGHUCU" {{ $surat->agama == 'KONGHUCU' ? 'selected' : '' }}>KONGHUCU</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label text-uppercase">ALAMAT LENGKAP</label>
                                    <div class="row g-2">
                                        <div class="col-md-12">
                                            <input type="text" id="tempat" name="tempat" class="form-control text-uppercase"
                                                placeholder="CONTOH: JL. RAYA CIBEUREUM NO. 123" required
                                                value="{{ strtoupper(old('tempat', explode(',', $surat->alamat_lengkap)[0] ?? '')) }}"
                                                oninput="this.value = this.value.toUpperCase()">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Kelurahan</label>
                                            <input type="text" id="kelurahan" name="kelurahan" class="form-control text-uppercase"
                                                placeholder="KELURAHAN" required
                                                value="{{ strtoupper(old('kelurahan', isset(explode(', KEL. ', $surat->alamat_lengkap)[1]) ? explode(' KEC. ', explode(', KEL. ', $surat->alamat_lengkap)[1])[0] : '')) }}"
                                                oninput="this.value = this.value.toUpperCase()">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Kecamatan</label>
                                            <input type="text" id="kecamatan" name="kecamatan" class="form-control text-uppercase"
                                                placeholder="KECAMATAN" required
                                                value="{{ strtoupper(old('kecamatan', isset(explode(' KEC. ', $surat->alamat_lengkap)[1]) ? explode(', KOTA', explode(' KEC. ', $surat->alamat_lengkap)[1])[0] : '')) }}"
                                                oninput="this.value = this.value.toUpperCase()">
                                        </div>
                                       <div class="col-md-4">
                                            <label class="form-label">Kode POS</label>
                                            <input type="text" id="kode_pos" name="kode_pos"
                                                class="form-control angka-saja" placeholder="KODE POS" required
                                                maxlength="5"
                                                value="{{ old('kode_pos', isset(explode(', ', $surat->alamat_lengkap)[4]) ? trim(explode(', ', $surat->alamat_lengkap)[4]) : '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Usaha Section -->
                            <h5 class="section-title text-uppercase"><i class="fas fa-briefcase me-2"></i>DATA USAHA</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_usaha" class="form-label text-uppercase">NAMA USAHA</label>
                                    <input type="text" name="nama_usaha" class="form-control text-uppercase" required
                                           value="{{ strtoupper($surat->nama_usaha) }}" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="jenis_usaha" class="form-label text-uppercase">JENIS USAHA</label>
                                    <input type="text" name="jenis_usaha" class="form-control text-uppercase" required
                                           value="{{ strtoupper($surat->jenis_usaha) }}" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="alamat_usaha" class="form-label text-uppercase">ALAMAT USAHA</label>
                                    <textarea name="alamat_usaha" class="form-control text-uppercase" rows="2" required
                                              oninput="this.value = this.value.toUpperCase()">{{ strtoupper($surat->alamat_usaha) }}</textarea>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="status_bangunan" class="form-label text-uppercase">STATUS BANGUNAN</label>
                                    <select name="status_bangunan" class="form-select" required>
                                        <option value="MILIK SENDIRI" {{ $surat->status_bangunan == 'MILIK SENDIRI' ? 'selected' : '' }}>MILIK SENDIRI</option>
                                        <option value="SEWA" {{ $surat->status_bangunan == 'SEWA' ? 'selected' : '' }}>SEWA</option>
                                        <option value="PINJAM PAKAI" {{ $surat->status_bangunan == 'PINJAM PAKAI' ? 'selected' : '' }}>PINJAM PAKAI</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="no_sppt" class="form-label text-uppercase">NO SPPT PBB</label>
                                    <input type="text" name="no_sppt" class="form-control text-uppercase"
                                           value="{{ strtoupper($surat->no_sppt) }}" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="akta_pendirian_usaha" class="form-label text-uppercase">AKTA PENDIRIAN USAHA</label>
                                    <input type="text" name="akta_pendirian_usaha" class="form-control text-uppercase"
                                           value="{{ strtoupper($surat->akta_pendirian_usaha) }}" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="jumlah_karyawan" class="form-label text-uppercase">JUMLAH KARYAWAN</label>
                                    <input type="number" name="jumlah_karyawan" class="form-control" required
                                           value="{{ $surat->jumlah_karyawan }}" min="0">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pimpinan_usaha" class="form-label text-uppercase">PIMPINAN USAHA</label>
                                    <input type="text" name="pimpinan_usaha" class="form-control text-uppercase" required
                                           value="{{ strtoupper($surat->pimpinan_usaha) }}" oninput="this.value = this.value.toUpperCase()">
                                </div>
                            </div>

                            <!-- Dokumen Pendukung Section -->
                            <h5 class="section-title"><i class="fas fa-file-alt me-2"></i>Dokumen Pendukung</h5>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>Ukuran maksimal file 2MB. Format: JPG, PNG, PDF
                            </div>

                            <div class="row">
                                <!-- KTP -->
                                <div class="col-md-6 mb-4">
                                    <label for="foto_ktp" class="form-label">KTP Pemohon</label>
                                    <input type="file" name="foto_ktp" id="foto_ktp" class="form-control mb-2" accept="image/*">
                                    @if($surat->foto_ktp)
                                    <div class="file-preview-container text-center">
                                        <p class="small text-muted">File saat ini:</p>
                                        <img src="{{ route('file.preview', ['path' => $surat->foto_ktp]) }}"
                                             class="file-preview img-thumbnail"
                                             onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_ktp]) }}', 'KTP')">
                                    </div>
                                    @endif
                                </div>

                                <!-- Kartu Keluarga -->
                                <div class="col-md-6 mb-4">
                                    <label for="foto_kartu_keluarga" class="form-label">Kartu Keluarga</label>
                                    <input type="file" name="foto_kartu_keluarga" id="foto_kartu_keluarga" class="form-control mb-2" accept="image/*">
                                    @if($surat->foto_kartu_keluarga)
                                    <div class="file-preview-container text-center">
                                        <p class="small text-muted">File saat ini:</p>
                                        <img src="{{ route('file.preview', ['path' => $surat->foto_kartu_keluarga]) }}"
                                             class="file-preview img-thumbnail"
                                             onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_kartu_keluarga]) }}', 'Kartu Keluarga')">
                                    </div>
                                    @endif
                                </div>

                                <!-- Pernyataan Tetangga -->
                                <div class="col-md-6 mb-4">
                                    <label for="foto_surat_pernyataan_tetangga" class="form-label">Pernyataan Tetangga</label>
                                    <input type="file" name="foto_surat_pernyataan_tetangga" id="foto_surat_pernyataan_tetangga" class="form-control mb-2" accept="image/*">
                                    @if($surat->foto_surat_pernyataan_tetangga)
                                    <div class="file-preview-container text-center">
                                        <p class="small text-muted">File saat ini:</p>
                                        <img src="{{ route('file.preview', ['path' => $surat->foto_surat_pernyataan_tetangga]) }}"
                                             class="file-preview img-thumbnail"
                                             onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_surat_pernyataan_tetangga]) }}', 'Pernyataan Tetangga')">
                                    </div>
                                    @endif
                                </div>

                                <!-- Pernyataan Usaha -->
                                <div class="col-md-6 mb-4">
                                    <label for="foto_surat_pernyataan_usaha" class="form-label">Pernyataan Usaha</label>
                                    <input type="file" name="foto_surat_pernyataan_usaha" id="foto_surat_pernyataan_usaha" class="form-control mb-2" accept="image/*">
                                    @if($surat->foto_surat_pernyataan_usaha)
                                    <div class="file-preview-container text-center">
                                        <p class="small text-muted">File saat ini:</p>
                                        <img src="{{ route('file.preview', ['path' => $surat->foto_surat_pernyataan_usaha]) }}"
                                             class="file-preview img-thumbnail"
                                             onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_surat_pernyataan_usaha]) }}', 'Pernyataan Usaha')">
                                    </div>
                                    @endif
                                </div>

                                <!-- Foto Usaha -->
                                <div class="col-md-6 mb-4">
                                    <label for="foto_usaha" class="form-label">Foto Usaha</label>
                                    <input type="file" name="foto_usaha" id="foto_usaha" class="form-control mb-2" accept="image/*">
                                    @if($surat->foto_usaha)
                                    <div class="file-preview-container text-center">
                                        <p class="small text-muted">File saat ini:</p>
                                        <img src="{{ route('file.preview', ['path' => $surat->foto_usaha]) }}"
                                             class="file-preview img-thumbnail"
                                             onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_usaha]) }}', 'Foto Usaha')">
                                    </div>
                                    @endif
                                </div>

                                <!-- Pengantar RT/RW -->
                                <div class="col-md-6 mb-4">
                                    <label for="foto_pengantar_rt_rw" class="form-label">Pengantar RT/RW</label>
                                    <input type="file" name="foto_pengantar_rt_rw" id="foto_pengantar_rt_rw" class="form-control mb-2" accept="image/*">
                                    @if($surat->foto_pengantar_rt_rw)
                                    <div class="file-preview-container text-center">
                                        <p class="small text-muted">File saat ini:</p>
                                        <img src="{{ route('file.preview', ['path' => $surat->foto_pengantar_rt_rw]) }}"
                                             class="file-preview img-thumbnail"
                                             onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_pengantar_rt_rw]) }}', 'Pengantar RT/RW')">
                                    </div>
                                    @endif
                                </div>
                            </div>

                                                        <!-- Status dan Catatan Section -->
                            @role('Admin')
                                <!-- Jika Admin, tampilkan dropdown status -->
                                <div class="col-md-12 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="proses" {{ $surat->status == 'proses' ? 'selected' : '' }}>Proses
                                        </option>
                                        <option value="selesai" {{ $surat->status == 'selesai' ? 'selected' : '' }}>Selesai
                                        </option>
                                        <option value="revisi" {{ $surat->status == 'revisi' ? 'selected' : '' }}>Revisi
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="catatan" class="form-label">Catatan Tambahan</label>
                                    <textarea name="catatan" class="form-control" placeholder="Opsional">{{ $surat->catatan }}</textarea>
                                </div>
                            @else
                                <!-- Jika bukan admin, set default status "proses" lewat input hidden -->
                                <input type="hidden" name="status" value="proses">
                            @endrole>

                            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                            @role('Admin')
                                <a href="{{ route('surat_keterangan_usahas.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                            @else
                                <a href="{{ route('surat.saya') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                            @endrole

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="imageModalTitle"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImageContent" src="" class="img-fluid" style="max-height: 70vh;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Phone number validation
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

        // Image modal function
        function showImageModal(imageSrc, title) {
            document.getElementById('modalImageContent').src = imageSrc;
            document.getElementById('imageModalTitle').textContent = title;
            new bootstrap.Modal(document.getElementById('imageModal')).show();
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

        // Handle address components
        document.querySelector('form').addEventListener('submit', function() {
            const alamatDasar = document.getElementById('tempat').value.trim();
            const kelurahan = document.getElementById('kelurahan').value.trim();
            const kecamatan = document.getElementById('kecamatan').value.trim();
            const kode_pos = document.getElementById('kode_pos').value.trim();

            // Combine into alamat_lengkap
            document.querySelector('[name="alamat_lengkap"]').value =
                `${alamatDasar}, Kel. ${kelurahan}, Kec. ${kecamatan}, Kota Sukabumi, ${kode_pos}`;
        });
    </script>
@endsection
