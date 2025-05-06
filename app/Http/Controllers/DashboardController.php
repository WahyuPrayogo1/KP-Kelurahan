<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeteranganPindahDomisili;
use App\Models\SuratKeteranganUsaha;


class DashboardController extends Controller
{
    public function index()
    {
        // Hitung dari SuratKeteranganPindahDomisili
        $prosesPindah = SuratKeteranganPindahDomisili::where('status', 'proses')->count();
        $selesaiPindah = SuratKeteranganPindahDomisili::where('status', 'selesai')->count();
        $ditolakPindah = SuratKeteranganPindahDomisili::where('status', 'ditolak')->count();

        // Hitung dari SuratKeteranganUsaha
        $prosesUsaha = SuratKeteranganUsaha::where('status', 'proses')->count();
        $selesaiUsaha = SuratKeteranganUsaha::where('status', 'selesai')->count();
        $ditolakUsaha = SuratKeteranganUsaha::where('status', 'ditolak')->count();

        // Total semua model
        $prosesCount = $prosesPindah + $prosesUsaha;
        $selesaiCount = $selesaiPindah + $selesaiUsaha;
        $ditolakCount = $ditolakPindah + $ditolakUsaha;


        // Ambil semua data status "proses" dari dua model
        $prosesPindah = SuratKeteranganPindahDomisili::where('status', 'proses')->get()->map(function($item) {
            $item->model_type = 'keterangan_domisili';
            return $item;
        });

        $prosesUsaha = SuratKeteranganUsaha::where('status', 'proses')->get()->map(function($item) {
            $item->model_type = 'keterangan_usaha';
            return $item;
        });

        // Ambil semua data status "selesai"
        $selesaiPindah = SuratKeteranganPindahDomisili::where('status', 'selesai')->get()->map(function($item) {
            $item->model_type = 'keterangan_domisili';
            return $item;
        });

        $selesaiUsaha = SuratKeteranganUsaha::where('status', 'selesai')->get()->map(function($item) {
            $item->model_type = 'keterangan_usaha';
            return $item;
        });

        // Gabungkan
        $prosesItems = $prosesPindah->concat($prosesUsaha);
        $selesaiItems = $selesaiPindah->concat($selesaiUsaha);

        return view('dashboard', compact('prosesCount', 'selesaiCount', 'ditolakCount','prosesItems', 'selesaiItems'));
    }
}
