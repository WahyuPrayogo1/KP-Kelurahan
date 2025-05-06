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
        'tempat_lahir',
        'foto_ktp',
        'foto_kartu_keluarga',
        'foto_pernyataan_rt_rw',
        'foto_pengantar_rt_rw',
        'foto_usaha',
        'status',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
