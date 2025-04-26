@extends('backend.master')

@section('content')
<div class="container">
    <h1>Edit Surat Keterangan Usaha</h1>

    <form action="{{ route('keterangan_usaha.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ $surat->nama }}" required>
        </div>

        <!-- NIK -->
        <div class="form-group mb-3">
            <label for="nik">NIK</label>
            <input type="text" name="nik" id="nik" class="form-control" value="{{ $surat->nik }}" required>
        </div>

        <!-- No HP -->
        <div class="form-group mb-3">
            <label for="no_hp">No HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $surat->no_hp }}" required>
        </div>

        <!-- Jenis Kelamin -->
        <div class="form-group mb-3">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                <option value="L" {{ $surat->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $surat->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <!-- Alamat Lengkap -->
        <div class="form-group mb-3">
            <label for="alamat_lengkap">Alamat Lengkap</label>
            <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" required>{{ $surat->alamat_lengkap }}</textarea>
        </div>

        <!-- Tempat Lahir -->
        <div class="form-group mb-3">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ $surat->tempat_lahir }}" required>
        </div>

        <!-- Foto KTP -->
        <div class="form-group mb-3">
            <label for="foto_ktp">Foto KTP</label>
            <input type="file" name="foto_ktp" id="foto_ktp" class="form-control">
            @if($surat->foto_ktp)
                <div class="mt-2">
                    <img src="{{ route('file.preview', ['path' => $surat->foto_ktp]) }}" alt="Foto KTP" width="150">
                    <small class="text-muted">Jika ingin mengganti, pilih file baru.</small>
                </div>
            @endif
        </div>

        <!-- Foto Kartu Keluarga -->
        <div class="form-group mb-3">
            <label for="foto_kartu_keluarga">Foto Kartu Keluarga</label>
            <input type="file" name="foto_kartu_keluarga" id="foto_kartu_keluarga" class="form-control">
            @if($surat->foto_kartu_keluarga)
                <div class="mt-2">
                    <img src="{{ route('file.preview', ['path' => $surat->foto_kartu_keluarga]) }}" alt="Foto KK" width="150">
                    <small class="text-muted">Jika ingin mengganti, pilih file baru.</small>
                </div>
            @endif
        </div>

        <!-- Foto Pernyataan RT/RW -->
        <div class="form-group mb-3">
            <label for="foto_pernyataan_rt_rw">Foto Pernyataan RT/RW</label>
            <input type="file" name="foto_pernyataan_rt_rw" id="foto_pernyataan_rt_rw" class="form-control">
            @if($surat->foto_pernyataan_rt_rw)
                <div class="mt-2">
                    <img src="{{ route('file.preview', ['path' => $surat->foto_pernyataan_rt_rw]) }}" alt="Foto Pernyataan" width="150">
                    <small class="text-muted">Jika ingin mengganti, pilih file baru.</small>
                </div>
            @endif
        </div>

        <!-- Foto Pengantar RT/RW -->
        <div class="form-group mb-3">
            <label for="foto_pengantar_rt_rw">Foto Pengantar RT/RW</label>
            <input type="file" name="foto_pengantar_rt_rw" id="foto_pengantar_rt_rw" class="form-control">
            @if($surat->foto_pengantar_rt_rw)
                <div class="mt-2">
                    <img src="{{ route('file.preview', ['path' => $surat->foto_pengantar_rt_rw]) }}" alt="Foto Pengantar" width="150">
                    <small class="text-muted">Jika ingin mengganti, pilih file baru.</small>
                </div>
            @endif
        </div>

        <!-- Foto Usaha -->
        <div class="form-group mb-3">
            <label for="foto_usaha">Foto Usaha</label>
            <input type="file" name="foto_usaha" id="foto_usaha" class="form-control">
            @if($surat->foto_usaha)
                <div class="mt-2">
                    <img src="{{ route('file.preview', ['path' => $surat->foto_usaha]) }}" alt="Foto Usaha" width="150">
                    <small class="text-muted">Jika ingin mengganti, pilih file baru.</small>
                </div>
            @endif
        </div>

        <!-- Catatan (Opsional) -->
        <div class="form-group mb-3">
            <label for="catatan">Catatan</label>
            <textarea name="catatan" id="catatan" class="form-control">{{ $surat->catatan }}</textarea>
        </div>

        <!-- Tombol Submit -->
        <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('keterangan_usaha.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
