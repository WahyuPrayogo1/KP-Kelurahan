<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PendudukStat;


class PendudukStatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['tahun' => 2020, 'laki_laki' => 100, 'perempuan' => 390],
            ['tahun' => 2021, 'laki_laki' => 225, 'perempuan' => 295],
            ['tahun' => 2022, 'laki_laki' => 590, 'perempuan' => 100],
            ['tahun' => 2023, 'laki_laki' => 500, 'perempuan' => 410],
            ['tahun' => 2024, 'laki_laki' => 110, 'perempuan' => 220],
        ];
        foreach ($data as $item) {
            PendudukStat::create($item);
        }
    }
}
