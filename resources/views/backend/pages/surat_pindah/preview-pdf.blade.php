@extends('backend.master')

@section('content')
    <style>
        .file-preview-container {
            border: 1px solid #ddd;
            border-radius: 8px;

            margin-bottom: 15px;
            max-width: 200px;
            /* ✅ batasi lebar kontainer */
        }

        .file-preview {
            max-width: 100%;
            max-height: 200px;
            /* ✅ batasi tinggi gambar */
            height: auto;
            object-fit: contain;
            cursor: pointer;
            transition: transform 0.2s;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .file-preview:hover {
            transform: scale(1.03);
        }

        .required:after {
            content: " *";
            color: red;
        }

        .form-control-sm {
            height: calc(1.5em + 0.5rem + 2px);
            padding: 0.25rem 0.5rem;
        }

        .signature-field {
            border-bottom: 1px dashed #666;
            min-width: 200px;
            display: inline-block;
        }
    </style>

    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-file-pdf me-2"></i>Form Cetak Surat Keterangan Pindah Perusahaan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('surat-pindah-perusahaan.generate-pdf', $surat->id) }}" method="POST" target="_blank">
                    @csrf

                    <!-- Form Input Nomor dan Tanggal Surat -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold required">Nomor Surat</label>
                            <input type="text" name="nomor_surat" class="form-control form-control-sm"
                                value="503/    /Kode Wil/{{ date('Y') }}" required maxlength="50">
                            <small class="text-muted">Contoh: 503/01/Kode Wil/2023</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold required">Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" class="form-control form-control-sm"
                                value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <!-- Data Surat RT/RW -->

                    <div class="row mb-4">
                        {{-- Kolom Gambar --}}
                        <div class="col-md-3 mb-3">
                            <label for="foto_pengantar_rt_rw" class="form-label fw-bold">Foto Pengantar RT/RW</label>
                            @if ($surat->foto_pengantar_rt_rw)
                                <div class="file-preview-container">
                                    <img src="{{ route('file.preview', ['path' => $surat->foto_pengantar_rt_rw]) }}"
                                        class="file-preview img-thumbnail"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_pengantar_rt_rw]) }}', 'Pengantar RT/RW')">
                                </div>
                            @endif
                        </div>

                        {{-- Kolom Inputan --}}
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold required">Nomor Surat RT/RW</label>
                                    <input type="text" name="nomor_surat_rt_rw" class="form-control form-control-sm"
                                        required pattern="[0-9/]+" title="Hanya angka dan garis miring diperbolehkan">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold required">Tanggal Surat RT/RW</label>
                                    <input type="date" name="tanggal_surat_rt_rw" class="form-control form-control-sm"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold required">Tanggal Pernyataan</label>
                                    <input type="date" name="tanggal_pernyataan" class="form-control form-control-sm"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Data Surat Lama -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold required">Nomor Surat Domisili Lama</label>
                            <input type="text" name="nomor_surat_lama" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold required">Tanggal Surat Domisili Lama</label>
                            <input type="date" name="tanggal_surat_lama" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <!-- Tujuan Surat -->
                    <div class="mb-4">
                        <label class="form-label fw-bold required">Tujuan Surat</label>
                        <input type="text" name="tujuan_surat" class="form-control form-control-sm" required>
                    </div>

                    <!-- Tanda Tangan -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Lurah</label>
                            <input type="text" name="nama_lurah" class="form-control form-control-sm" 
                            value="{{ old('nama_lurah', 'JUMYATI') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">NIP Lurah</label>
                            <input type="text" name="lurah_nip" class="form-control form-control-sm"
                            value="{{ old('lurah_nip', '19720412 201001 1 001') }}" required>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-file-pdf me-2"></i> Generate PDF
                        </button>
                        <a href="{{ route('surat-pindah-perusahaan.index') }}" class="btn btn-secondary px-4">
                            <i class="fas fa-times me-2"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="imageModalTitle"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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

    <script>
        // Image modal function
        function showImageModal(imageSrc, title) {
            document.getElementById('modalImageContent').src = imageSrc;
            document.getElementById('imageModalTitle').textContent = title;
            new bootstrap.Modal(document.getElementById('imageModal')).show();
        }
    </script>
@endsection
