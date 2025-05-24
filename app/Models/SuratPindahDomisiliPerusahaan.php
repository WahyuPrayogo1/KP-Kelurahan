<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPindahDomisiliPerusahaan extends Model
{
    use HasFactory;

     protected $fillable = [
        'nama_perusahaan',
        'alamat_perusahaan',
        'user_id',
        'nama_pemilik',
        'alamat_pemilik',
        'nomor_tdp',
        'jenis_usaha',
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
