<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPindahDomisiliPerusahaan extends Model
{
    use HasFactory;

     protected $fillable = [
        'nama',
        'nik',
        'user_id',
        'no_hp',
        'jenis_kelamin',
        'alamat_lengkap',
        'tempat_lahir',
        'foto_ktp',
        'foto_kk',
        'foto_pernyataan_pindah',
        'foto_akte_notaris',
        'foto_pengantar_rt_rw',
        'status',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
