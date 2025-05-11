<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganBedaDataKependudukan extends Model
{
    use HasFactory;
    protected $table = 'surat_keterangan_beda_data_kependudukans';


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
        'surat_pernyataan_beda_data',
        'bukti_beda_data',
        'pengantar_rt_rw',
        'status',
        'catatan'
    ];

        public function user()
    {
        return $this->belongsTo(User::class);
    }
}
