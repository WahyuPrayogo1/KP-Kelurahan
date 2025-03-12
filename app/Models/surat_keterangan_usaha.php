<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surat_keterangan_usaha extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan_usaha';
    protected $fillable = [
        'nama', 'user_id', 'nik', 'no_hp', 'jenis_kelamin', 'alamat_lengkap',
        'tempat_lahir', 'foto_ktp', 'foto_kartu_keluarga', 'foto_pernyataan_rt_rw',
        'foto_pengantar_rt_rw', 'foto_foto_usaha', 'status', 'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
