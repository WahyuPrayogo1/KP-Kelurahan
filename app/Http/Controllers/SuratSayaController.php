<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeteranganPindahDomisili;
use App\Models\SuratKeteranganAktaNikah;
use App\Models\SuratKeteranganUsaha;
use App\Models\SuratPengantarIjinKeramaian;



class SuratSayaController extends Controller
{
    public function index()
{
    $user = auth()->user();

    // Ambil semua surat dengan cara yang lebih baik
    $pindahDomisili = SuratKeteranganPindahDomisili::where('user_id', $user->id)
        ->orderByDesc('created_at')
        ->get()
        ->map(function ($item) {
            $item->type = 'pindah_domisili';
            return $item;
        });

    $aktaNikah = SuratKeteranganAktaNikah::where('user_id', $user->id)
        ->orderByDesc('created_at')
        ->get()
        ->map(function ($item) {
            $item->type = 'akta_nikah';
            return $item;
        });

    $usaha = SuratKeteranganUsaha::where('user_id', $user->id)
        ->orderByDesc('created_at')
        ->get()
        ->map(function ($item) {
            $item->type = 'usaha';
            return $item;
        });
    $keramain = SuratPengantarIjinKeramaian::where('user_id', $user->id)
        ->orderByDesc('created_at')
        ->get()
        ->map(function ($item) {
            $item->type = 'ijin_keramain';
            return $item;
        });


    // Gabungkan dengan concatenate bukan merge
    $suratSaya = collect([])
        ->concat($pindahDomisili)
        ->concat($aktaNikah)
        ->concat($keramain)
        ->concat($usaha);

    // Urutkan hasil penggabungan
    $suratSaya = $suratSaya->sortByDesc('created_at');

    return view('backend.pages.SuratSaya.index', compact('suratSaya'));
}





}
