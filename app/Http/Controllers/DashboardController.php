<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\surat_keterangan_pindah_domisili;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah setiap status
        $prosesCount = surat_keterangan_pindah_domisili::where('status', 'proses')->count();
        $selesaiCount = surat_keterangan_pindah_domisili::where('status', 'selesai')->count();
        $ditolakCount = surat_keterangan_pindah_domisili::where('status', 'ditolak')->count();

        // Kirim data ke view
        return view('dashboard', compact('prosesCount', 'selesaiCount', 'ditolakCount'));
    }
}
