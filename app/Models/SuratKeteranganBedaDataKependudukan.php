<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganBedaDataKependudukan extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan_beda_data_kependudukans';

    protected $fillable = [
        'nama_lengkap',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'kewarganegaraan',
        'pekerjaan',
        'status_perkawinan',
        'agama',
        'alamat',
        'lokasi_perbedaan_nama',
        'fc_ktp',
        'fc_kk',
        'surat_pernyataan_beda_data',
        'bukti_beda_data',
        'pengantar_rt_rw',
        'status',
        'catatan',
        'user_id', 
    ];

        public function user()
    {
        return $this->belongsTo(User::class);
    }
}
