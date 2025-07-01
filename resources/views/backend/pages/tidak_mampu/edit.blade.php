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
    </style>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sukses!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Surat Keterangan Tidak Mampu</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('surat_keterangan_tidak_mampu.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Informasi Pemohon Section -->
                            <h5 class="section-title"><i class="fas fa-user-circle me-2"></i>Informasi Pemohon</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" required value="{{ $surat->nama }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" name="nik" class="form-control" required
                                           value="{{ $surat->nik }}" maxlength="16" minlength="16"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" required value="{{ $surat->tempat_lahir }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required
                                           value="{{ $surat->tanggal_lahir }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="L" {{ $surat->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ $surat->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                                    <input type="text" name="kewarganegaraan" class="form-control" required value="{{ $surat->kewarganegaraan }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control" required value="{{ $surat->pekerjaan }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                                    <select name="status_perkawinan" class="form-select" required>
                                        <option value="Belum Kawin" {{ $surat->status_perkawinan == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                        <option value="Kawin" {{ $surat->status_perkawinan == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                        <option value="Cerai Hidup" {{ $surat->status_perkawinan == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                        <option value="Cerai Mati" {{ $surat->status_perkawinan == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="agama" class="form-label">Agama</label>
                                    <select name="agama" class="form-select" required>
                                        <option value="Islam" {{ $surat->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ $surat->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ $surat->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ $surat->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ $surat->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Konghucu" {{ $surat->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                                    <textarea name="alamat" class="form-control" rows="3" required>{{ $surat->alamat }}</textarea>
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
                                    <label for="foto_kk" class="form-label">Kartu Keluarga</label>
                                    <input type="file" name="foto_kk" id="foto_kk" class="form-control mb-2" accept="image/*">
                                    @if($surat->foto_kk)
                                    <div class="file-preview-container text-center">
                                        <p class="small text-muted">File saat ini:</p>
                                        <img src="{{ route('file.preview', ['path' => $surat->foto_kk]) }}"
                                             class="file-preview img-thumbnail"
                                             onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_kk]) }}', 'Kartu Keluarga')">
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

                            @role('Admin')
                            <h5 class="section-title"><i class="fas fa-cog me-2"></i>Status & Catatan</h5>

                                <!-- Jika Admin, tampilkan dropdown status -->
                                <div class="col-md-12 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="proses" {{ $surat->status == 'proses' ? 'selected' : '' }}>Proses
                                        </option>
                                        <option value="selesai" {{ $surat->status == 'selesai' ? 'selected' : '' }}>Selesai
                                        </option>
                                        <option value="ditolak" {{ $surat->status == 'ditolak' ? 'selected' : '' }}>Ditolak
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
                            @endrole
                                                        <div class="d-flex justify-content-between mt-4 pt-3 border-top">
    @role('Admin')
        <a href="{{ route('surat_keterangan_tidak_mampu.index') }}" class="btn btn-secondary">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Initialize datepicker
        flatpickr("#tanggal_lahir", {
            dateFormat: "d F Y",
            maxDate: "today",
        });

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
    </script>
@endsection
