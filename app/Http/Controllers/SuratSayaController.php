<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeteranganAktaNikah;
use App\Models\SuratKeteranganUsaha;
use App\Models\SuratKeteranganMiskin;
use App\Models\SuratKeteranganTidakMampu;
use App\Models\SuratPengantarIjinKeramaian;
use App\Models\SuratPindahDomisiliPerusahaan;
use App\Models\SuratKeteranganBedaDataKependudukan;
use App\Models\SuratKeteranganKematian;
Use App\Models\SuratKeteranganBekerjaLuarNegeri;





class SuratSayaController extends Controller
{
    public function index()
{
    $user = auth()->user();


     $tidakMampu = SuratKeteranganTidakMampu::where('user_id', $user->id)
        ->orderByDesc('created_at')
        ->get()
        ->map(function ($item) {
            $item->type = 'tidak_mampu';
            return $item;
        });
     $miskin = SuratKeteranganMiskin::where('user_id', $user->id)
        ->orderByDesc('created_at')
        ->get()
        ->map(function ($item) {
            $item->type = 'miskin';
            return $item;
        });

     $bedaDataPenduduk = SuratKeteranganBedaDataKependudukan::where('user_id', $user->id)
        ->orderByDesc('created_at')
        ->get()
        ->map(function ($item) {
            $item->type = 'beda_penduduk';
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

    $perusahaan = SuratPindahDomisiliPerusahaan::where('user_id', $user->id)
        ->orderByDesc('created_at')
        ->get()
        ->map(function ($item) {
            $item->type = 'perusahaan';
            return $item;
        });

    $keteranganKematian = SuratKeteranganKematian::where('user_id', $user->id)
        ->orderByDesc('created_at')
        ->get()
        ->map(function ($item) {
            $item->type = 'keterangan_kematian';
            return $item;
        });
    $bekerjaLuarNegeri = SuratKeteranganBekerjaLuarNegeri::where('user_id', $user->id)
        ->orderByDesc('created_at')
        ->get()
        ->map(function ($item) {
            $item->type = 'bekerja_luar_negeri';
            return $item;
        });



    // Gabungkan dengan concatenate bukan merge
    $suratSaya = collect([])
        ->concat($aktaNikah)
        ->concat($keramain)
        ->concat($usaha)
        ->concat($perusahaan)
        ->concat($bedaDataPenduduk)
        ->concat($keteranganKematian)
        ->concat($miskin)
        ->concat($bekerjaLuarNegeri)
        ->concat($tidakMampu);

    // Urutkan hasil penggabungan
    $suratSaya = $suratSaya->sortByDesc('created_at');

    return view('backend.pages.SuratSaya.index', compact('suratSaya'));
}





}
