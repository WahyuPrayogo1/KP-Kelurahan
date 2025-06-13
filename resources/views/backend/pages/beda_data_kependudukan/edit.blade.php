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
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Surat Keterangan Beda Data Kependudukan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('beda-data-kependudukan.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h5 class="section-title"><i class="fas fa-user-circle me-2"></i>Data Pemohon</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" value="{{ $surat->nama_lengkap }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" name="nik" class="form-control" value="{{ $surat->nik }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" value="{{ $surat->tempat_lahir }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" value="{{ $surat->tanggal_lahir }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="L" {{ $surat->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $surat->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kewarganegaraan</label>
                                <input type="text" name="kewarganegaraan" class="form-control" value="{{ $surat->kewarganegaraan }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control" value="{{ $surat->pekerjaan }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Perkawinan</label>
                                <select name="status_perkawinan" class="form-select" required>
                                    @foreach(['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'] as $status)
                                        <option value="{{ $status }}" {{ $surat->status_perkawinan == $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Agama</label>
                                <input type="text" name="agama" class="form-control" value="{{ $surat->agama }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" required>{{ $surat->alamat }}</textarea>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">RT</label>
                                <input type="text" name="rt" class="form-control" value="{{ $surat->rt }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">RW</label>
                                <input type="text" name="rw" class="form-control" value="{{ $surat->rw }}" required>
                            </div>
                        </div>
                        <h5 class="section-title"><i class="fas fa-id-card me-2"></i>Data Perbedaan Kependudukan</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lokasi Perbedaan Nama</label>
                                @php
                                    $lokasiList = ['Akte Kelahiran', 'Ijazah', 'Sertifikat Tanah', 'Akte Nikah', 'Akte Cerai', 'KTP', 'KK', 'Lainnya'];
                                    $isLainnya = !in_array(trim(strtolower($surat->lokasi_perbedaan_nama)), array_map('strtolower', $lokasiList));
                                @endphp

                                <select name="lokasi_perbedaan_nama" class="form-select" required onchange="toggleLainnya(this)">
                                    @foreach ($lokasiList as $lokasi)
                                        <option value="{{ $lokasi }}" 
                                            {{ 
                                                ($isLainnya && $lokasi == 'Lainnya') ? 'selected' : 
                                                ($surat->lokasi_perbedaan_nama == $lokasi ? 'selected' : '') 
                                            }}>
                                            {{ $lokasi }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="lokasi-lainnya-container" class="mt-2" style="{{ $isLainnya ? '' : 'display: none;' }}">
                                    <input type="text" name="lokasi_perbedaan_nama_lainnya" class="form-control" placeholder="Masukkan lokasi lainnya" value="{{ $isLainnya ? $surat->lokasi_perbedaan_nama : '' }}">
                                </div>

                            </div>
                        </div>

                        <!-- Dokumen Pendukung Section -->
                        <h5 class="section-title"><i class="fas fa-file-alt me-2"></i>Dokumen Pendukung</h5>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Ukuran maksimal file 2MB. Format: JPG, PNG
                        </div>

                        <div class="row">
                            <!-- FC KTP -->
                            <div class="col-md-6 mb-4">
                                <label for="fc_ktp" class="form-label">Fotokopi KTP</label>
                                <input type="file" name="fc_ktp" id="fc_ktp" class="form-control mb-2" accept="image/*">
                                @if($surat->fc_ktp)
                                <div class="file-preview-container text-center">
                                    <p class="small text-muted">File saat ini:</p>
                                    <img src="{{ route('file.preview', ['path' => $surat->fc_ktp]) }}" class="file-preview img-thumbnail"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->fc_ktp]) }}', 'KTP')">
                                </div>
                                @endif
                            </div>

                            <!-- FC KK -->
                            <div class="col-md-6 mb-4">
                                <label for="fc_kk" class="form-label">Fotokopi Kartu Keluarga</label>
                                <input type="file" name="fc_kk" id="fc_kk" class="form-control mb-2" accept="image/*">
                                @if($surat->fc_kk)
                                <div class="file-preview-container text-center">
                                    <p class="small text-muted">File saat ini:</p>
                                    <img src="{{ route('file.preview', ['path' => $surat->fc_kk]) }}" class="file-preview img-thumbnail"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->fc_kk]) }}', 'KK')">
                                </div>
                                @endif
                            </div>

                            <!-- Surat Pernyataan Beda Data -->
                            <div class="col-md-6 mb-4">
                                <label for="surat_pernyataan_beda_data" class="form-label">Surat Pernyataan Beda Data</label>
                                <input type="file" name="surat_pernyataan_beda_data" id="surat_pernyataan_beda_data" class="form-control mb-2" accept="image/*">
                                @if($surat->surat_pernyataan_beda_data)
                                <div class="file-preview-container text-center">
                                    <p class="small text-muted">File saat ini:</p>
                                    <img src="{{ route('file.preview', ['path' => $surat->surat_pernyataan_beda_data]) }}" class="file-preview img-thumbnail"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->surat_pernyataan_beda_data]) }}', 'Surat Pernyataan')">
                                </div>
                                @endif
                            </div>

                            <!-- Bukti Beda Data -->
                            <div class="col-md-6 mb-4">
                                <label for="bukti_beda_data" class="form-label">Bukti Pendukung Beda Data</label>
                                <input type="file" name="bukti_beda_data" id="bukti_beda_data" class="form-control mb-2" accept="image/*">
                                @if($surat->bukti_beda_data)
                                <div class="file-preview-container text-center">
                                    <p class="small text-muted">File saat ini:</p>
                                    <img src="{{ route('file.preview', ['path' => $surat->bukti_beda_data]) }}" class="file-preview img-thumbnail"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->bukti_beda_data]) }}', 'Bukti Beda Data')">
                                </div>
                                @endif
                            </div>

                            <!-- Pengantar RT/RW -->
                            <div class="col-md-6 mb-4">
                                <label for="pengantar_rt_rw" class="form-label">Pengantar RT/RW</label>
                                <input type="file" name="pengantar_rt_rw" id="pengantar_rt_rw" class="form-control mb-2" accept="image/*">
                                @if($surat->pengantar_rt_rw)
                                <div class="file-preview-container text-center">
                                    <p class="small text-muted">File saat ini:</p>
                                    <img src="{{ route('file.preview', ['path' => $surat->pengantar_rt_rw]) }}"
                                        class="file-preview img-thumbnail"
                                        onclick="showImageModal('{{ route('file.preview', ['path' => $surat->pengantar_rt_rw]) }}', 'Pengantar RT/RW')">
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

<!-- Modal untuk preview gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Preview Gambar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center">
        <img src="" id="modalImage" class="img-fluid" alt="Preview Gambar">
      </div>
    </div>
  </div>
</div>

<script>
    function showImageModal(imageUrl, title) {
        const modalImage = document.getElementById('modalImage');
        const modalLabel = document.getElementById('imageModalLabel');
        modalImage.src = imageUrl;
        modalLabel.textContent = title;
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
    }
</script>

<script>
function toggleLainnya(selectElement) {
    const lainnyaContainer = document.getElementById('lokasi-lainnya-container');
    if (selectElement.value === 'Lainnya') {
        lainnyaContainer.style.display = 'block';
    } else {
        lainnyaContainer.style.display = 'none';
        // Kosongkan input jika bukan "Lainnya"
        const input = lainnyaContainer.querySelector('input');
        if (input) input.value = '';
    }
}

// Trigger saat halaman dimuat untuk antisipasi data lama dari database
document.addEventListener("DOMContentLoaded", function () {
    const selected = document.querySelector('select[name="lokasi_perbedaan_nama"]');
    toggleLainnya(selected);
});
</script>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('lokasiSelect');
        const input = document.getElementById('lokasiInput');

        select.addEventListener('change', function () {
            if (this.value === 'Lainnya') {
                input.style.display = '';
                input.required = true;
            } else {
                input.style.display = 'none';
                input.required = false;
                input.value = this.value; // sinkronisasi nilai agar tetap terisi saat submit
            }
        });

        // Initial trigger to sync values if needed
        if (select.value !== 'Lainnya') {
            document.getElementById('lokasiInput').value = select.value;
        }
    });
</script>
@endpush

@endsection
