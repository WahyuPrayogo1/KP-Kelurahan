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
            ['tahun' => 2023, 'laki_laki' => 8100, 'perempuan' => 8075],
            ['tahun' => 2024, 'laki_laki' => 7824, 'perempuan' => 7808],
        ];
        foreach ($data as $item) {
            PendudukStat::create($item);
        }
    }
}
