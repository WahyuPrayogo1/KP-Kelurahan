<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SuratKeteranganUsahaSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            DB::table('surat_keterangan_usahas')->insert([
                'nama' => 'Pemohon Usaha ' . $i,
                'nik' => '320101' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'user_id' => 1, // ubah sesuai user yang ada
                'no_hp' => '0812' . rand(10000000, 99999999),
                'jenis_kelamin' => $i % 2 === 0 ? 'L' : 'P',
                'alamat_lengkap' => 'Jl. Usaha No. ' . $i,
                'tempat_lahir' => 'Kota ' . $i,
                'foto_ktp' => 'uploads/dummy_ktp.jpg',
                'foto_kartu_keluarga' => 'uploads/dummy_kk.jpg',
                'foto_pernyataan_rt_rw' => 'uploads/dummy_pernyataan.jpg',
                'foto_pengantar_rt_rw' => 'uploads/dummy_pengantar.jpg',
                'foto_usaha' => 'uploads/dummy_usaha.jpg',
                'status' => ['proses', 'selesai', 'ditolak'][array_rand(['proses', 'selesai', 'ditolak'])],
                'catatan' => 'Catatan dummy untuk usaha ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
