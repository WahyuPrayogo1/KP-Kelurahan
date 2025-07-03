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
                        <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Surat Keterangan Pindah Perusahaan</h4>
                    </div>
                    <div class="card-body">
                         @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sukses!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                        <form action="{{ route('surat-pindah-perusahaan.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Informasi Perusahaan Section -->
                            <h5 class="section-title"><i class="fas fa-building me-2"></i>Informasi Perusahaan</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                    <input type="text" name="nama_perusahaan" class="form-control"
                                           required value="{{ $surat->nama_perusahaan }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nama_pemilik" class="form-label">Nama Pemilik Perusahaan</label>
                                    <input type="text" name="nama_pemilik" class="form-control"
                                           required value="{{ $surat->nama_pemilik }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nomor_tdp" class="form-label">Nomor TDP / Nomor Akta Notaris</label>
                                    <input type="number" name="nomor_tdp" class="form-control angka-saja"
                                           required value="{{ $surat->nomor_tdp }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="jenis_usaha" class="form-label">Jenis Usaha</label>
                                    <input type="text" name="jenis_usaha" class="form-control"
                                           required value="{{ $surat->jenis_usaha }}">
                                </div>
                               <div class="col-md-12 mb-3">
                                    <label class="form-label">Alamat Perusahaan</label>
                                    <div class="row g-2">
                                        <div class="col-md-12">
                                            <input type="text" id="alamat_perusahaan" name="alamat_perusahaan" class="form-control required-step1"
                                                placeholder="Contoh: Jl. Merdeka No. 45" required value="{{ old('alamat_perusahaan', $alamat) }}">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="kelurahan_perusahaan" name="kelurahan_perusahaan" class="form-control required-step1"
                                                placeholder="Kelurahan" required value="{{ old('kelurahan_perusahaan', $kelurahan) }}">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="kecamatan_perusahaan" name="kecamatan_perusahaan" class="form-control required-step1"
                                                placeholder="Kecamatan" required value="{{ old('kecamatan_perusahaan', $kecamatan) }}">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" id="rt_perusahaan" name="rt_perusahaan" class="form-control required-step1 angka-saja"
                                                placeholder="RT" required maxlength="3" value="{{ old('rt_perusahaan', $rt) }}">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" id="rw_perusahaan" name="rw_perusahaan" class="form-control required-step1 angka-saja"
                                                placeholder="RW" required maxlength="3" value="{{ old('rw_perusahaan', $rw) }}">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" id="kode_pos_perusahaan" name="kode_pos_perusahaan" class="form-control required-step1 angka-saja"
                                                placeholder="Kode Pos" required maxlength="5" value="{{ old('kode_pos_perusahaan', $kode_pos) }}">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6 mb-3">
                                    <label for="tanggal_pindah" class="form-label">Tanggal Pindah</label>
                                    <input type="date" name="tanggal_pindah" class="form-control"
                                           required value="{{ $surat->tanggal_pindah }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="alamat_pemilik" class="form-label">Alamat Pemilik</label>
                                    <textarea name="alamat_pemilik" class="form-control" rows="2" required>{{ $surat->alamat_pemilik }}</textarea>
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
                                    <label for="foto_ktp" class="form-label">Foto KTP Pemilik</label>
                                    <input type="file" name="foto_ktp" id="foto_ktp" class="form-control mb-2"
                                           accept="image/jpeg, image/png">
                                    @if($surat->foto_ktp)
                                    <div class="file-preview-container text-center">
                                        <p class="small text-muted">File saat ini:</p>
                                        <img src="{{ route('file.preview', ['path' => $surat->foto_ktp]) }}"
                                             class="file-preview img-thumbnail"
                                             onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_ktp]) }}', 'KTP Pemilik')">
                                    </div>
                                    @endif
                                </div>

                                <!-- Kartu Keluarga -->
                                <div class="col-md-6 mb-4">
                                    <label for="foto_kk" class="form-label">Foto Kartu Keluarga</label>
                                    <input type="file" name="foto_kk" id="foto_kk" class="form-control mb-2"
                                           accept="image/jpeg, image/png">
                                    @if($surat->foto_kk)
                                    <div class="file-preview-container text-center">
                                        <p class="small text-muted">File saat ini:</p>
                                        <img src="{{ route('file.preview', ['path' => $surat->foto_kk]) }}"
                                             class="file-preview img-thumbnail"
                                             onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_kk]) }}', 'Kartu Keluarga')">
                                    </div>
                                    @endif
                                </div>

                                <!-- Pernyataan Pindah -->
                                <div class="col-md-6 mb-4">
                                    <label for="foto_pernyataan_pindah" class="form-label">Foto Pernyataan Pindah</label>
                                    <input type="file" name="foto_pernyataan_pindah" id="foto_pernyataan_pindah"
                                           class="form-control mb-2" accept="image/jpeg, image/png">
                                    @if($surat->foto_pernyataan_pindah)
                                    <div class="file-preview-container text-center">
                                        <p class="small text-muted">File saat ini:</p>
                                        <img src="{{ route('file.preview', ['path' => $surat->foto_pernyataan_pindah]) }}"
                                             class="file-preview img-thumbnail"
                                             onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_pernyataan_pindah]) }}', 'Pernyataan Pindah')">
                                    </div>
                                    @endif
                                </div>

                                <!-- Akte Notaris -->
                                <div class="col-md-6 mb-4">
                                    <label for="foto_akte_notaris" class="form-label">Foto Akte Notaris</label>
                                    <input type="file" name="foto_akte_notaris" id="foto_akte_notaris"
                                           class="form-control mb-2" accept="image/jpeg, image/png">
                                    @if($surat->foto_akte_notaris)
                                    <div class="file-preview-container text-center">
                                        <p class="small text-muted">File saat ini:</p>
                                        <img src="{{ route('file.preview', ['path' => $surat->foto_akte_notaris]) }}"
                                             class="file-preview img-thumbnail"
                                             onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_akte_notaris]) }}', 'Akte Notaris')">
                                    </div>
                                    @endif
                                </div>

                                <!-- Pengantar RT/RW -->
                                <div class="col-md-12 mb-4">
                                    <label for="foto_pengantar_rt_rw" class="form-label">Foto Pengantar RT/RW</label>
                                    <input type="file" name="foto_pengantar_rt_rw" id="foto_pengantar_rt_rw"
                                           class="form-control mb-2" accept="image/jpeg, image/png">
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
        <a href="{{ route('surat-pindah-perusahaan.index') }}" class="btn btn-secondary">
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
        // Validasi input angka saja
        document.querySelectorAll('.angka-saja').forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });

        // Validasi file upload
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
