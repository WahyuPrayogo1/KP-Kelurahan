<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganBekerjaLuarNegeri extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemohon',
        'nik_pemohon',
        'tempat_lahir_pemohon',
        'tanggal_lahir_pemohon',
        'pekerjaan_pemohon',
        'status_perkawinan_pemohon',
        'agama_pemohon',
        'alamat_pemohon',
        'hubungan_dengan_pekerja',
        'nama_pekerja',
        'nik_pekerja',
        'tempat_lahir_pekerja',
        'tanggal_lahir_pekerja',
        'jenis_kelamin_pekerja',
        'kewarganegaraan_pekerja',
        'agama_pekerja',
        'alamat_pekerja',
        'negara_tujuan',
        'fc_ktp',
        'fc_kk',
        'surat_pernyataan_bekerja',
        'pengantar_rt_rw',
        'user_id',
        'status',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
