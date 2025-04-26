<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\surat_keterangan_pindah_domisili;

class SuratKeteranganPindahSeeder extends Seeder
{
    public function run(): void
    { for ($i = 1; $i <= 15; $i++) {
        surat_keterangan_pindah_domisili::create([
           'nama' => 'Pemohon Pindah ' . $i,
                'nik' => '320202' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'user_id' => 1,
                'no_hp' => '0821' . rand(10000000, 99999999),
                'jenis_kelamin' => $i % 2 === 0 ? 'P' : 'L',
                'alamat_lengkap' => 'Jl. Pindah No. ' . $i,
                'tempat_lahir' => 'Desa ' . $i,
                'foto_ktp' => 'uploads/dummy_ktp.jpg',
                'foto_kartu_keluarga' => 'uploads/dummy_kk.jpg',
                'foto_pernyataan_rt_rw' => 'uploads/dummy_pernyataan.jpg',
                'foto_pengantar_rt_rw' => 'uploads/dummy_pengantar.jpg',
                'status' => ['proses', 'selesai', 'ditolak'][array_rand(['proses', 'selesai', 'ditolak'])],
                'catatan' => 'Catatan dummy untuk pindah ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
        ]);
    }}
}
