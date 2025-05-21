<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPengantarIjinKeramaian extends Model
{
    use HasFactory;
    protected $table = 'surat_pengantar_ijin_keramaians';
    protected $fillable = [
        'nama_pemohon',
        'jabatan_pemohon',
        'user_id',
        'no_hp',
        'nama_organisasi',
        'alamat_organisasi',
        'mengadakan_keramain',
        'hiburan',
        'waktu',
        'tempat',

        'foto_ktp',
        'foto_kartu_keluarga',
        'foto_pernyataan_tetangga',
        'foto_pengantar_rt_rw',
        'status',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
