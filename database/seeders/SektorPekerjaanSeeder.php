<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SektorPekerjaan;
use App\Models\Pekerjaan;

class SektorPekerjaanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'Sektor Pertanian' => [
                'Petani' => 37,
                'Buruh Tani' => 180,
                'Pemilik Usaha Tani' => 84,
            ],
            'Sektor Peternakan' => [
                'Peternakan Perorangan' => 8,
                'Buruh Usaha Peternakan' => 48,
                'Pemilik Usaha Peternakan' => 0,
            ],
            'Sektor Perikanan' => [
                'Nelayan' => 3,
                'Buruh Usaha Perikanan' => 19,
            ],
            'Sektor Industri Menengah dan Besar' => [
                'Karyawan perusahaan swasta' => 1227,
                'Karyawan perusahaan pemerintah' => 134,
                'Pemilik perusahaan' => 125,
            ],
            'Sektor Perdagangan' => [
                'Karyawan Perdagangan Hasil Bumi' => 850,
                'Buruh Perdagangan Hasil Bumi' => 3507,
                'Pengusaha Perdagangan Hasil Bumi' => 2450,
            ],
            'Sektor Jasa' => [
                'TNI' => 13,
                'POLRI' => 58,
                'Pembantu rumah tangga' => 27,
                'Wiraswasta lainnya' => 2600,
            ],
        ];

        foreach ($data as $sektor => $pekerjaans) {
            $sektorModel = SektorPekerjaan::create(['nama' => $sektor]);

            foreach ($pekerjaans as $nama => $jumlah) {
                Pekerjaan::create([
                    'sektor_id' => $sektorModel->id,
                    'nama' => $nama,
                    'jumlah' => $jumlah,
                ]);
            }
        }
    }
}
