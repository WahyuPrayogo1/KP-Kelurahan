<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganKematian extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan_kematians';

    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'nama',
        'user_id',
        'jenis_kelamin',
        'alamat_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'tempat_meninggal',
        'tanggal_meninggal',
        'penyebab_kematian',
        'kewarganegaraan',
        'agama',
        'fc_ktp',
        'fc_kk',
        'fc_buku_nikah',
        'pengantar_kematian_rt_rw',
        'status',
        'catatan',
    ];

    // Relasi ke User (asumsi User model ada)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
