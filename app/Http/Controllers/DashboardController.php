<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\surat_keterangan_pindah_domisili;
use App\Models\surat_keterangan_usaha;


class DashboardController extends Controller
{
    public function index()
    {
        // Hitung dari surat_keterangan_pindah_domisili
        $prosesPindah = surat_keterangan_pindah_domisili::where('status', 'proses')->count();
        $selesaiPindah = surat_keterangan_pindah_domisili::where('status', 'selesai')->count();
        $ditolakPindah = surat_keterangan_pindah_domisili::where('status', 'ditolak')->count();

        // Hitung dari surat_keterangan_usaha
        $prosesUsaha = surat_keterangan_usaha::where('status', 'proses')->count();
        $selesaiUsaha = surat_keterangan_usaha::where('status', 'selesai')->count();
        $ditolakUsaha = surat_keterangan_usaha::where('status', 'ditolak')->count();

        // Total semua model
        $prosesCount = $prosesPindah + $prosesUsaha;
        $selesaiCount = $selesaiPindah + $selesaiUsaha;
        $ditolakCount = $ditolakPindah + $ditolakUsaha;


        // Ambil semua data status "proses" dari dua model
        $prosesPindah = surat_keterangan_pindah_domisili::where('status', 'proses')->get()->map(function($item) {
            $item->model_type = 'keterangan_domisili';
            return $item;
        });

        $prosesUsaha = surat_keterangan_usaha::where('status', 'proses')->get()->map(function($item) {
            $item->model_type = 'keterangan_usaha';
            return $item;
        });

        // Ambil semua data status "selesai"
        $selesaiPindah = surat_keterangan_pindah_domisili::where('status', 'selesai')->get()->map(function($item) {
            $item->model_type = 'keterangan_domisili';
            return $item;
        });

        $selesaiUsaha = surat_keterangan_usaha::where('status', 'selesai')->get()->map(function($item) {
            $item->model_type = 'keterangan_usaha';
            return $item;
        });

        // Gabungkan
        $prosesItems = $prosesPindah->concat($prosesUsaha);
        $selesaiItems = $selesaiPindah->concat($selesaiUsaha);

        return view('dashboard', compact('prosesCount', 'selesaiCount', 'ditolakCount','prosesItems', 'selesaiItems'));
    }
}
