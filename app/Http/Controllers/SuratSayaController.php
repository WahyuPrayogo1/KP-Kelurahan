<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratSayaController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Ambil semua surat berdasarkan relasi yang ada di user
        $pindahDomisili = $user->suratKeteranganPindahDomisili;
        $aktaNikah = $user->suratKeteranganAktaNikah;
        $usaha = $user->suratKeteranganUsaha;

        // Gabungkan semua surat dan urutkan berdasarkan tanggal
        $suratSaya = $pindahDomisili
            ->merge($aktaNikah)
            ->merge($usaha)
            ->sortByDesc('created_at');

        return view('backend.pages.SuratSaya.index', compact('suratSaya'));
    }



}
