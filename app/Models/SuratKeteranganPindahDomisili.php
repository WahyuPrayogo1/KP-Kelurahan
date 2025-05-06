<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganPindahDomisili extends Model
{
    use HasFactory;
    protected $table = 'surat_keterangan_pindah_domisilis';

    protected $fillable = [
        'nama', 'nik', 'no_hp', 'jenis_kelamin', 'alamat_lengkap', 'tempat_lahir',
        'foto_ktp', 'foto_kartu_keluarga', 'foto_pernyataan_rt_rw', 'foto_pengantar_rt_rw',
        'status', 'catatan', 'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
