<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPernyataanTanahTidakSengketa extends Model
{
    use HasFactory;
    protected $table = 'surat_pernyataan_tanah_tidak_sengketas';

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
        'foto_pernyataan_tanah',
        'foto_sppt',
        'foto_ajb_sertifikat',
        'foto_pengantar_rt_rw',
        'status',
        'catatan'
    ];

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
