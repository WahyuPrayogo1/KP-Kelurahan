@extends('backend.master')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Surat Keterangan Usaha</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('keterangan_usaha.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Form 2 kolom -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $surat->nama }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" name="nik" id="nik" class="form-control" value="{{ $surat->nik }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $surat->no_hp }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                            <option value="L" {{ $surat->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $surat->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="3" required>{{ $surat->alamat_lengkap }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ $surat->tempat_lahir }}" required>
                </div>

                <div class="alert alert-info text-center p-2 small my-5" role="alert">
                    Klik gambar untuk memperbesar
                </div>

                <!-- Upload Gambar -->
                <div class="row gallery">
                    <!-- Foto KTP -->
                    <div class="col-md-6 mb-4">
                        <label for="foto_ktp" class="form-label">Foto KTP</label>
                        <input type="file" name="foto_ktp" id="foto_ktp" class="form-control mb-2">
                        @if($surat->foto_ktp)
                            <a href="{{ route('file.preview', ['path' => $surat->foto_ktp]) }}" data-lightbox="image-gallery" data-title="Foto KTP">
                                <img src="{{ route('file.preview', ['path' => $surat->foto_ktp]) }}" alt="Foto KTP" class="img-thumbnail" width="150">
                            </a>
                        @endif
                    </div>

                    <!-- Foto Kartu Keluarga -->
                    <div class="col-md-6 mb-4">
                        <label for="foto_kartu_keluarga" class="form-label">Foto Kartu Keluarga</label>
                        <input type="file" name="foto_kartu_keluarga" id="foto_kartu_keluarga" class="form-control mb-2">
                        @if($surat->foto_kartu_keluarga)
                            <a href="{{ route('file.preview', ['path' => $surat->foto_kartu_keluarga]) }}" data-lightbox="image-gallery" data-title="Foto KK">
                                <img src="{{ route('file.preview', ['path' => $surat->foto_kartu_keluarga]) }}" alt="Foto KK" class="img-thumbnail" width="150">
                            </a>
                        @endif
                    </div>

                    <!-- Foto Pernyataan RT/RW -->
                    <div class="col-md-6 mb-4">
                        <label for="foto_pernyataan_rt_rw" class="form-label">Foto Pernyataan RT/RW</label>
                        <input type="file" name="foto_pernyataan_rt_rw" id="foto_pernyataan_rt_rw" class="form-control mb-2">
                        @if($surat->foto_pernyataan_rt_rw)
                            <a href="{{ route('file.preview', ['path' => $surat->foto_pernyataan_rt_rw]) }}" data-lightbox="image-gallery" data-title="Foto Pernyataan RT/RW">
                                <img src="{{ route('file.preview', ['path' => $surat->foto_pernyataan_rt_rw]) }}" alt="Foto Pernyataan" class="img-thumbnail" width="150">
                            </a>
                        @endif
                    </div>

                    <!-- Foto Pengantar RT/RW -->
                    <div class="col-md-6 mb-4">
                        <label for="foto_pengantar_rt_rw" class="form-label">Foto Pengantar RT/RW</label>
                        <input type="file" name="foto_pengantar_rt_rw" id="foto_pengantar_rt_rw" class="form-control mb-2">
                        @if($surat->foto_pengantar_rt_rw)
                            <a href="{{ route('file.preview', ['path' => $surat->foto_pengantar_rt_rw]) }}" data-lightbox="image-gallery" data-title="Foto Pengantar RT/RW">
                                <img src="{{ route('file.preview', ['path' => $surat->foto_pengantar_rt_rw]) }}" alt="Foto Pengantar" class="img-thumbnail" width="150">
                            </a>
                        @endif
                    </div>

                    <!-- Foto Usaha -->
                    <div class="col-md-6 mb-4">
                        <label for="foto_usaha" class="form-label">Foto Usaha</label>
                        <input type="file" name="foto_usaha" id="foto_usaha" class="form-control mb-2">
                        @if($surat->foto_usaha)
                            <a href="{{ route('file.preview', ['path' => $surat->foto_usaha]) }}" data-lightbox="image-gallery" data-title="Foto Usaha">
                                <img src="{{ route('file.preview', ['path' => $surat->foto_usaha]) }}" alt="Foto Usaha" class="img-thumbnail" width="150">
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Catatan -->
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control" rows="3">{{ $surat->catatan }}</textarea>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('keterangan_usaha.index') }}" class="btn btn-secondary">Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Lightbox CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
@endpush

@push('scripts')
<!-- Lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
@endpush
