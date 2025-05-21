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
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Surat Pengantar Ijin Keramaian</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('surat_pengantar_ijin_keramaian.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Informasi Pemohon Section -->
                            <h5 class="section-title"><i class="fas fa-user-circle me-2"></i>Informasi Pemohon</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_pemohon" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama_pemohon" class="form-control" required value="{{ $surat->nama_pemohon }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="jabatan_pemohon" class="form-label">Jabatan</label>
                                    <input type="text" name="jabatan_pemohon" class="form-control" required value="{{ $surat->jabatan_pemohon }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="no_hp" class="form-label">Nomor HP</label>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control" required
                                           value="{{ $surat->no_hp }}" oninput="validateNoHP(this)">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nama_organisasi" class="form-label">Nama Organisasi</label>
                                    <input type="text" name="nama_organisasi" class="form-control" required value="{{ $surat->nama_organisasi }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="alamat_organisasi" class="form-label">Alamat Organisasi</label>
                                    <textarea name="alamat_organisasi" class="form-control" rows="2">{{ $surat->alamat_organisasi }}</textarea>
                                </div>
                            </div>

                            <!-- Informasi Acara Section -->
                            <h5 class="section-title"><i class="fas fa-calendar-alt me-2"></i>Informasi Acara</h5>
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="mengadakan_keramain" class="form-label">Nama Kegiatan</label>
                                    <input type="text" name="mengadakan_keramain" class="form-control" required value="{{ $surat->mengadakan_keramain }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="hiburan" class="form-label">Jenis Hiburan</label>
                                    <input type="text" name="hiburan" class="form-control" value="{{ $surat->hiburan }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="waktu" class="form-label">Waktu Pelaksanaan</label>
                                    <input type="text" id="waktu" name="waktu" class="form-control" required value="{{ $surat->waktu }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tempat" class="form-label">Tempat Pelaksanaan</label>
                                    <input type="text" name="tempat" class="form-control" required value="{{ $surat->tempat }}">
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
                                    <label for="foto_pernyataan_tetangga" class="form-label">Pernyataan Tetangga</label>
                                    <input type="file" name="foto_pernyataan_tetangga" id="foto_pernyataan_tetangga" class="form-control mb-2" accept="image/*">
                                    @if($surat->foto_pernyataan_tetangga)
                                    <div class="file-preview-container text-center">
                                        <p class="small text-muted">File saat ini:</p>
                                        <img src="{{ route('file.preview', ['path' => $surat->foto_pernyataan_tetangga]) }}"
                                             class="file-preview img-thumbnail"
                                             onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_pernyataan_tetangga]) }}', 'Pernyataan Tetangga')">
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
                            <h5 class="section-title"><i class="fas fa-cog me-2"></i>Status & Catatan</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="proses" {{ $surat->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="selesai" {{ $surat->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="ditolak" {{ $surat->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="catatan" class="form-label">Catatan Tambahan</label>
                                    <textarea name="catatan" class="form-control" placeholder="Opsional">{{ $surat->catatan }}</textarea>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                                <a href="{{ route('surat_pengantar_ijin_keramaian.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
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
        flatpickr("#waktu", {
            enableTime: true,
            dateFormat: "d F Y H:i",
            time_24hr: true,
            minDate: "today",
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
