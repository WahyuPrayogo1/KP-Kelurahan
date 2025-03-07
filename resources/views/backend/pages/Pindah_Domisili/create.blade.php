<!-- resources/views/surat_keterangan_pindah_domisili/create.blade.php -->
@extends('backend.master')

@section('content')
<div class="container">
    <h1>Tambah Surat Keterangan Pindah Domisili</h1>
    <form action="{{ route('keterangan_domisili.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama -->
        <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <!-- NIK -->
        <div class="form-group mb-3">
            <label for="nik">NIK</label>
            <input type="text" name="nik" id="nik" class="form-control" required>
        </div>

        <!-- No HP -->
        <div class="form-group mb-3">
            <label for="no_hp">No HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" required>
        </div>

        <!-- Jenis Kelamin -->
        <div class="form-group mb-3">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <!-- Alamat Lengkap -->
        <div class="form-group mb-3">
            <label for="alamat_lengkap">Alamat Lengkap</label>
            <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" required></textarea>
        </div>

        <!-- Tempat Lahir -->
        <div class="form-group mb-3">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
        </div>

        <!-- Foto KTP -->
        <div class="form-group mb-3">
            <label for="foto_ktp">Foto KTP</label>
            <input type="file" name="foto_ktp" id="foto_ktp" class="form-control" required>
        </div>

        <!-- Foto Kartu Keluarga -->
        <div class="form-group mb-3">
            <label for="foto_kartu_keluarga">Foto Kartu Keluarga</label>
            <input type="file" name="foto_kartu_keluarga" id="foto_kartu_keluarga" class="form-control" required>
        </div>

        <!-- Foto Pernyataan RT/RW -->
        <div class="form-group mb-3">
            <label for="foto_pernyataan_rt_rw">Foto Pernyataan RT/RW</label>
            <input type="file" name="foto_pernyataan_rt_rw" id="foto_pernyataan_rt_rw" class="form-control" required>
        </div>

        <!-- Foto Pengantar RT/RW -->
        <div class="form-group mb-3">
            <label for="foto_pengantar_rt_rw">Foto Pengantar RT/RW</label>
            <input type="file" name="foto_pengantar_rt_rw" id="foto_pengantar_rt_rw" class="form-control" required>
        </div>

        <!-- Tombol Submit -->
        <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('keterangan_domisili.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
