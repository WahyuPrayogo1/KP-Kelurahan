@extends('backend.master')

@section('title', 'Edit Surat Keterangan Kematian')

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
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Surat Keterangan Kematian</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('surat_keterangan_kematian.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h5 class="section-title"><i class="fas fa-user-circle me-2"></i>Data Almarhum/ah</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" required value="{{ old('nama', $surat->nama) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="L" {{ old('jenis_kelamin', $surat->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $surat->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" required value="{{ old('tempat_lahir', $surat->tempat_lahir) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" required value="{{ old('tanggal_lahir', \Illuminate\Support\Carbon::parse($surat->tanggal_lahir)->format('Y-m-d')) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat Meninggal</label>
                                <input type="text" name="tempat_meninggal" class="form-control" required value="{{ old('tempat_meninggal', $surat->tempat_meninggal) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Meninggal</label>
                                <input type="date" name="tanggal_meninggal" class="form-control" required value="{{ old('tanggal_meninggal', \Illuminate\Support\Carbon::parse($surat->tanggal_meninggal)->format('Y-m-d')) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Penyebab Kematian</label>
                                <input type="text" name="penyebab_kematian" class="form-control" required value="{{ old('penyebab_kematian', $surat->penyebab_kematian) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Agama</label>
                                <input type="text" name="agama" class="form-control" required value="{{ old('agama', $surat->agama) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kewarganegaraan</label>
                                <input type="text" name="kewarganegaraan" class="form-control" required value="{{ old('kewarganegaraan', $surat->kewarganegaraan) }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" class="form-control" rows="3" required>{{ old('alamat_lengkap', $surat->alamat_lengkap) }}</textarea>
                            </div>
                        </div>

                        <h5 class="section-title"><i class="fas fa-file-alt me-2"></i>Upload Dokumen</h5>
                        <div class="row">
                            @php
                                use Illuminate\Support\Facades\Storage;
                            @endphp
                            @foreach ([
                                'fc_ktp' => 'Fotokopi KTP',
                                'fc_kk' => 'Fotokopi KK',
                                'fc_buku_nikah' => 'Fotokopi Buku Nikah',
                                'pengantar_kematian_rt_rw' => 'Surat Pengantar RT/RW'
                            ] as $field => $label)
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">{{ $label }}</label>
                                    <input type="file" name="{{ $field }}" class="form-control mb-2" accept="image/*,application/pdf">
                                    @if($surat->$field)
                                        <div class="file-preview-container text-center">
                                            <p class="small text-muted">File saat ini:</p>
                                            @if(\Illuminate\Support\Str::endsWith($surat->$field, ['.pdf']))
                                                {{-- Link untuk PDF masih pakai asset biasa --}}
                                                <a href="{{ asset('storage/' . $surat->$field) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-file-pdf me-1"></i>Lihat PDF
                                                </a>
                                            @else
                                                @php
                                                    // Cek file ada di disk private dan ambil isi file
                                                    if (Storage::disk('private')->exists($surat->$field)) {
                                                        $image = Storage::disk('private')->get($surat->$field);
                                                        $type = Storage::disk('private')->mimeType($surat->$field);
                                                        $base64 = 'data:' . $type . ';base64,' . base64_encode($image);
                                                    } else {
                                                        $base64 = null;
                                                    }
                                                @endphp
                                                @if($base64)
                                                    <img src="{{ $base64 }}" alt="{{ $label }}" class="file-preview img-thumbnail"
                                                        onclick="showImageModal('{{ $base64 }}', '{{ $label }}')"
                                                        style="max-width: 300px; cursor: pointer;">
                                                @else
                                                    <p class="text-danger">File tidak ditemukan.</p>
                                                @endif
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endforeach
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
                                        <option value="revisi" {{ $surat->status == 'revisi' ? 'selected' : '' }}>revisi
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

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                                <a href="{{ route('surat_keterangan_kematian.index') }}" class="btn btn-secondary">
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

<!-- Modal preview gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Pratinjau Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Preview" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
    function showImageModal(imageUrl, title) {
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('imageModalLabel');
        modalImage.src = imageUrl;
        modalTitle.textContent = title;
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }
</script>
@endsection
