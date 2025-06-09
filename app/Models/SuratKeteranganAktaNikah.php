<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganAktaNikah extends Model
{
    use HasFactory;

    // Nama tabel (opsional, Laravel bisa mendeteksi dari nama model)
    protected $table = 'surat_keterangan_akta_nikahs';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'kewarganegaraan',
        'alamat_lengkap',
        'no_kk',
        'no_pengantar_rt_rw',
        'tanggal_pengantar_rt_rw',
        'user_id',
        'foto_ktp',
        'foto_kartu_keluarga',
        'foto_surat_pernyataan_nikah',
        'foto_surat_pengantar_rt_rw',
        'status',
        'catatan',
        'tanggal_dikeluarkan',
    ];

    /**
     * Relasi ke tabel users.
     * Setiap surat akta nikah dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
