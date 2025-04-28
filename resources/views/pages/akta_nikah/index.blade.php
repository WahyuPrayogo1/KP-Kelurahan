<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan Surat Pindah Domisili</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">Form Pengajuan Surat Pind222ah Domisili</div>
            <div class="card-body">
                <div class="container">
                    <h1>Tambah Surat Keterangan Akta Nikah</h1>
                    <form action="{{ route('surat-keterangan-akta-nikah.store') }}" method="POST"
                        enctype="multipart/form-data">
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
                            <input type="file" name="foto_kartu_keluarga" id="foto_kartu_keluarga"
                                class="form-control" required>
                        </div>

                        <!-- Foto Akta Kelahiran -->
                        <div class="form-group mb-3">
                            <label for="foto_akta_kelahiran">Foto Akta Kelahiran</label>
                            <input type="file" name="foto_akta_kelahiran" id="foto_akta_kelahiran"
                                class="form-control" required>
                        </div>

                        <!-- Foto Ijazah -->
                        <div class="form-group mb-3">
                            <label for="foto_ijazah">Foto Ijazah</label>
                            <input type="file" name="foto_ijazah" id="foto_ijazah" class="form-control" required>
                        </div>

                        <!-- Foto Pengantar RT/RW -->
                        <div class="form-group mb-3">
                            <label for="foto_pengantar_na_rt_rw">Foto Pengantar NA RT/RW</label>
                            <input type="file" name="foto_pengantar_na_rt_rw" id="foto_pengantar_na_rt_rw"
                                class="form-control" required>
                        </div>

                        <!-- Foto Pengantar RT/RW (duplicated field) -->
                        <div class="form-group mb-3">
                            <label for="foto_pengantar_rt_rw">Foto Pengantar RT/RW</label>
                            <input type="file" name="foto_pengantar_rt_rw" id="foto_pengantar_rt_rw"
                                class="form-control" required>
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>

                        <!-- Catatan (optional) -->
                        <div class="form-group mb-3">
                            <label for="catatan">Catatan</label>
                            <textarea name="catatan" id="catatan" class="form-control"></textarea>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('keterangan_akta_nikah.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>
