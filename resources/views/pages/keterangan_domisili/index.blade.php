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
                <form action="{{ route('surat-keterangan-pindah.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor HP</label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto KTP</label>
                        <input type="file" name="foto_ktp" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Kartu Keluarga</label>
                        <input type="file" name="foto_kartu_keluarga" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Pernyataan RT/RW</label>
                        <input type="file" name="foto_pernyataan_rt_rw" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Pengantar RT/RW</label>
                        <input type="file" name="foto_pengantar_rt_rw" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
