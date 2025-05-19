<?php

namespace App\Http\Controllers;

use App\Models\PendudukStat;
use App\Models\SektorPekerjaan;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function index() 
    {
        return view('pages.tentang_kami.list');
    }

    public function tentangKami()
    {
        $latest = PendudukStat::orderBy('tahun', 'desc')->first();

        // Ambil data dari database dengan relasi
        $sektors = SektorPekerjaan::with('pekerjaan')->get();

        // Format ulang jadi array seperti sebelumnya (untuk chart)
        $sektorPekerjaan = [];

        foreach ($sektors as $sektor) {
            $sektorPekerjaan[$sektor->nama] = [];

            foreach ($sektor->pekerjaan as $pekerjaan) {
                $sektorPekerjaan[$sektor->nama][$pekerjaan->nama] = $pekerjaan->jumlah;
            }
        }

        return view('pages.tentang_kami.list', compact('latest', 'sektorPekerjaan'));
    }
}
