@extends('backend.master')

@section('title', 'Edit Surat Keterangan Akta Nikah')

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
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Surat Keterangan Status Nikah</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('keterangan_akta_nikah.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h5 class="section-title"><i class="fas fa-user-circle me-2"></i>Informasi Pemohon</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control" required value="{{ old('nama', $surat->nama) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control" required value="{{ old('nik', $surat->nik) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_kk" class="form-label">No KK</label>
                                <input type="text" name="no_kk" id="no_kk" class="form-control" required value="{{ old('no_kk', $surat->no_kk) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required value="{{ old('tempat_lahir', $surat->tempat_lahir) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required
                                       value="{{ old('tanggal_lahir', \Illuminate\Support\Carbon::parse($surat->tanggal_lahir)->format('Y-m-d')) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label d-block">Jenis Kelamin</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="L" {{ old('jenis_kelamin', $surat->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="laki">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" {{ old('jenis_kelamin', $surat->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="agama" class="form-label">Agama</label>
                                <input type="text" name="agama" id="agama" class="form-control" required value="{{ old('agama', $surat->agama) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                                <input type="text" name="status_perkawinan" id="status_perkawinan" class="form-control" required value="{{ old('status_perkawinan', $surat->status_perkawinan) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" required value="{{ old('pekerjaan', $surat->pekerjaan) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                                <input type="text" name="kewarganegaraan" id="kewarganegaraan" class="form-control" required value="{{ old('kewarganegaraan', $surat->kewarganegaraan) }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="3" required>{{ old('alamat_lengkap', $surat->alamat_lengkap) }}</textarea>
                            </div>
                        </div>

                        <!-- Upload Dokumen -->
                        <h5 class="section-title"><i class="fas fa-file-alt me-2"></i>Upload Dokumen</h5>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Ukuran maksimal file 2MB. Format: JPG, PNG
                        </div>
                        <div class="row">
                            <!-- Foto KTP -->
                            <div class="col-md-6 mb-4">
                                <label for="foto_ktp" class="form-label">Foto KTP</label>
                                <input type="file" name="foto_ktp" id="foto_ktp" class="form-control mb-2" accept="image/jpeg,image/png">
                                @if($surat->foto_ktp)
                                <div class="file-preview-container text-center">
                                    <p class="small text-muted">File saat ini:</p>
                                    <img src="{{ route('file.preview', ['path' => $surat->foto_ktp]) }}"
                                        alt="Foto KTP" class="file-preview img-thumbnail"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_ktp]) }}', 'Foto KTP')">
                                </div>
                                @endif
                            </div>

                            <!-- Foto KK -->
                            <div class="col-md-6 mb-4">
                                <label for="foto_kartu_keluarga" class="form-label">Foto Kartu Keluarga</label>
                                <input type="file" name="foto_kartu_keluarga" id="foto_kartu_keluarga" class="form-control mb-2" accept="image/jpeg,image/png">
                                @if($surat->foto_kartu_keluarga)
                                <div class="file-preview-container text-center">
                                    <p class="small text-muted">File saat ini:</p>
                                    <img src="{{ route('file.preview', ['path' => $surat->foto_kartu_keluarga]) }}"
                                        alt="Foto KK" class="file-preview img-thumbnail"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_kartu_keluarga]) }}', 'Foto KK')">
                                </div>
                                @endif
                            </div>

                            <!-- Surat Pernyataan Nikah -->
                            <div class="col-md-6 mb-4">
                                <label for="foto_surat_pernyataan_nikah" class="form-label">Surat Pernyataan Nikah</label>
                                <input type="file" name="foto_surat_pernyataan_nikah" id="foto_surat_pernyataan_nikah" class="form-control mb-2" accept="image/jpeg,image/png">
                                @if($surat->foto_surat_pernyataan_nikah)
                                <div class="file-preview-container text-center">
                                    <p class="small text-muted">File saat ini:</p>
                                    <img src="{{ route('file.preview', ['path' => $surat->foto_surat_pernyataan_nikah]) }}"
                                        alt="Surat Pernyataan Nikah" class="file-preview img-thumbnail"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_surat_pernyataan_nikah]) }}', 'Surat Pernyataan Nikah')">
                                </div>
                                @endif
                            </div>

                            <!-- Surat Pengantar RT/RW -->
                            <div class="col-md-6 mb-4">
                                <label for="foto_surat_pengantar_rt_rw" class="form-label">Surat Pengantar RT/RW</label>
                                <input type="file" name="foto_surat_pengantar_rt_rw" id="foto_surat_pengantar_rt_rw" class="form-control mb-2" accept="image/jpeg,image/png">
                                @if($surat->foto_surat_pengantar_rt_rw)
                                <div class="file-preview-container text-center">
                                    <p class="small text-muted">File saat ini:</p>
                                    <img src="{{ route('file.preview', ['path' => $surat->foto_surat_pengantar_rt_rw]) }}"
                                        alt="Surat Pengantar RT/RW" class="file-preview img-thumbnail"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->foto_surat_pengantar_rt_rw]) }}', 'Surat Pengantar RT/RW')">
                                </div>
                                @endif
                            </div>
                        </div>

                        <h5 class="section-title"><i class="fas fa-cog me-2"></i>Status & Catatan</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="proses" {{ $surat->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="selesai" {{ $surat->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="ditolak" {{ $surat->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea name="catatan" id="catatan" class="form-control" rows="2">{{ old('catatan', $surat->catatan) }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('keterangan_akta_nikah.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for image preview -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imagePreviewLabel">Preview Gambar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center">
        <img src="" alt="Preview" id="previewImage" class="img-fluid rounded">
      </div>
    </div>
  </div>
</div>

<script>
    function showImageModal(src, title) {
        const modalTitle = document.getElementById('imagePreviewLabel');
        const previewImage = document.getElementById('previewImage');
        modalTitle.textContent = title;
        previewImage.src = src;
        const modal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
        modal.show();
    }
</script>
@endsection