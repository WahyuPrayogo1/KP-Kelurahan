<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganTentangOrangTua extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan_tentang_orang_tuas';

    protected $fillable = [
        'nama',
        'nik',
        'user_id',
        'no_hp',
        'jenis_kelamin',
        'alamat_lengkap',
        'tempat_lahir',
        'fc_ktp',
        'fc_kk',
        'fc_akte_lahir',
        'fc_buku_nikah_ortu',
        'surat_pernyataan_ahli_waris',
        'pengantar_rt_rw',
        'status',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
