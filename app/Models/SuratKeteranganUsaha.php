<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganUsaha extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan_usahas';

    protected $fillable = [
        'nama',
        'nik',
        'user_id',
        'no_hp',
        'jenis_kelamin',
        'alamat_lengkap',
        'kewarganegaraan',
        'pekerjaan',
        'status_perkawinan',
        'agama',
        'nama_usaha',
        'jenis_usaha',
        'alamat_usaha',
        'status_bangunan',
        'no_sppt',
        'akta_pendirian_usaha',
        'jumlah_karyawan',
        'pimpinan_usaha',
        'foto_ktp',
        'foto_kartu_keluarga',
        'foto_surat_pernyataan_tetangga',
        'foto_surat_pernyataan_usaha',
        'foto_usaha',
        'foto_pengantar_rt_rw',
        'status',
        'catatan',
    ];

    protected $casts = [
        'jenis_kelamin' => 'string', // or you could create a custom cast if needed
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
