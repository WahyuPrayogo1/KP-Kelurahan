<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganTidakMampu extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan_tidak_mampus';

    protected $fillable = [
        'nama',
        'nik',
        'user_id',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'kewarganegaraan',
        'pekerjaan',
        'status_perkawinan',
        'agama',
        'alamat',
        'foto_ktp',
        'foto_kk',
        'foto_pengantar_rt_rw',
        'status',
        'catatan'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
