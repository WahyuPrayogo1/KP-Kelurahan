@extends('backend.master')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Surat Keterangan Orang Tua</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('surat-keterangan-orang-tua.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Form data biasa (nama, nik, dst) -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $surat->nama }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="number" name="nik" id="nik" class="form-control" value="{{ $surat->nik }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="number" name="no_hp" id="no_hp" class="form-control" value="{{ $surat->no_hp }}" required>
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


                <!-- Upload Gambar 2 kolom -->
                <div class="row gallery">
                    <!-- Foto KTP -->
                    <div class="col-md-6 mb-4">
                        <label for="fc_ktp" class="form-label">Foto KTP</label>
                        <input type="file" name="fc_ktp" id="fc_ktp" class="form-control mb-2">
                        @if($surat->fc_ktp)
                            <a href="{{ route('file.preview', ['path' => $surat->fc_ktp]) }}" data-lightbox="image-gallery" data-title="Foto KTP">
                                <img src="{{ route('file.preview', ['path' => $surat->fc_ktp]) }}" alt="Foto KTP" class="img-thumbnail" width="150">
                            </a>
                        @endif
                    </div>

                    <!-- Foto Kartu Keluarga -->
                    <div class="col-md-6 mb-4">
                        <label for="fc_kk" class="form-label">Foto Kartu Keluarga</label>
                        <input type="file" name="fc_kk" id="fc_kk" class="form-control mb-2">
                        @if($surat->fc_kk)
                            <a href="{{ route('file.preview', ['path' => $surat->fc_kk]) }}" data-lightbox="image-gallery" data-title="Foto KK">
                                <img src="{{ route('file.preview', ['path' => $surat->fc_kk]) }}" alt="Foto KK" class="img-thumbnail" width="150">
                            </a>
                        @endif
                    </div>

                    <!-- Foto Pernyataan RT/RW -->
                    <div class="col-md-6 mb-4">
                        <label for="fc_akte_lahir" class="form-label">Foto Akte Lahir</label>
                        <input type="file" name="fc_akte_lahir" id="fc_akte_lahir" class="form-control mb-2">
                        @if($surat->fc_akte_lahir)
                            <a href="{{ route('file.preview', ['path' => $surat->fc_akte_lahir]) }}" data-lightbox="image-gallery" data-title="Foto Pernyataan RT/RW">
                                <img src="{{ route('file.preview', ['path' => $surat->fc_akte_lahir]) }}" alt="Foto Pernyataan" class="img-thumbnail" width="150">
                            </a>
                        @endif
                    </div>

                    <!-- Foto Pengantar RT/RW -->
                    <div class="col-md-6 mb-4">
                        <label for="fc_buku_nikah_ortu" class="form-label">Foto Buku Nikah Ortu</label>
                        <input type="file" name="fc_buku_nikah_ortu" id="fc_buku_nikah_ortu" class="form-control mb-2">
                        @if($surat->fc_buku_nikah_ortu)
                            <a href="{{ route('file.preview', ['path' => $surat->fc_buku_nikah_ortu]) }}" data-lightbox="image-gallery" data-title="Foto Pengantar RT/RW">
                                <img src="{{ route('file.preview', ['path' => $surat->fc_buku_nikah_ortu]) }}" alt="Foto Pengantar" class="img-thumbnail" width="150">
                            </a>
                        @endif
                    </div>

                    <!-- Foto Pengantar RT/RW -->
                    <div class="col-md-6 mb-4">
                        <label for="surat_pernyataan_ahli_waris" class="form-label">Foto Pernyataan Ahli Waris</label>
                        <input type="file" name="surat_pernyataan_ahli_waris" id="surat_pernyataan_ahli_waris" class="form-control mb-2">
                        @if($surat->surat_pernyataan_ahli_waris)
                            <a href="{{ route('file.preview', ['path' => $surat->surat_pernyataan_ahli_waris]) }}" data-lightbox="image-gallery" data-title="Foto Pengantar RT/RW">
                                <img src="{{ route('file.preview', ['path' => $surat->surat_pernyataan_ahli_waris]) }}" alt="Foto Pengantar" class="img-thumbnail" width="150">
                            </a>
                        @endif
                    </div>

                     <!-- Foto Pengantar RT/RW -->
                    <div class="col-md-6 mb-4">
                        <label for="pengantar_rt_rw" class="form-label">Foto Pernyataan Ahli Waris</label>
                        <input type="file" name="pengantar_rt_rw" id="pengantar_rt_rw" class="form-control mb-2">
                        @if($surat->pengantar_rt_rw)
                            <a href="{{ route('file.preview', ['path' => $surat->pengantar_rt_rw]) }}" data-lightbox="image-gallery" data-title="Foto Pengantar RT/RW">
                                <img src="{{ route('file.preview', ['path' => $surat->pengantar_rt_rw]) }}" alt="Foto Pengantar" class="img-thumbnail" width="150">
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="proses" {{ $surat->status == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ $surat->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ $surat->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>


                <!-- Catatan -->
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control" rows="3">{{ $surat->catatan }}</textarea>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('keterangan_domisili.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: `
                <ul class="text-left">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonText: 'OK'
        });
    });
</script>
@endif
<!-- Lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
@endpush
