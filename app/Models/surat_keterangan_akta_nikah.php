<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surat_keterangan_akta_nikah extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan_akta_nikahs'; // jamak

    protected $fillable = [
        'nama',
        'nik',
        'user_id', // ini perlu ada
        'no_hp',
        'jenis_kelamin',
        'alamat_lengkap',
        'tempat_lahir',
        'foto_ktp',
        'foto_kartu_keluarga',
        'foto_akta_kelahiran',
        'foto_ijazah',
        'foto_pengantar_na_rt_rw', // ini yang benar
        'foto_pengantar_rt_rw',
        'status',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
