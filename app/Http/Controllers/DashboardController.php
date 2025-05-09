<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeteranganPindahDomisili;
use App\Models\SuratKeteranganUsaha;
use App\Models\SuratKeteranganAktaNikah;
use App\Models\SuratPengantarIjinKeramaian;
use App\Models\SuratPindahDomisiliPerusahaan;
use App\Models\PendudukStat;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data statistik penduduk
        $pendudukStats = PendudukStat::first();

        // Jika data belum ada, buat record kosong
        if (!$pendudukStats) {
            $pendudukStats = PendudukStat::create([
                'laki_laki' => 0,
                'perempuan' => 0,
                'tahun' => date('Y'), // Tahun sekarang
            ]);
        }

        $jumlahLaki = $pendudukStats->laki_laki;
        $jumlahPerempuan = $pendudukStats->perempuan;
        $tahun = $pendudukStats->tahun;

        // Data untuk chart (jika ingin menampilkan beberapa tahun)
        $pendudukTahunan = PendudukStat::orderBy('tahun')->get();

        $chartData = [
            'labels' => $pendudukTahunan->pluck('tahun')->toArray(),
            'laki' => $pendudukTahunan->pluck('laki_laki')->toArray(),
            'perempuan' => $pendudukTahunan->pluck('perempuan')->toArray(),
        ];

        // Hitung dari SuratKeteranganPindahDomisili
        $prosesPindah = SuratKeteranganPindahDomisili::where('status', 'proses')->count();
        $selesaiPindah = SuratKeteranganPindahDomisili::where('status', 'selesai')->count();
        $ditolakPindah = SuratKeteranganPindahDomisili::where('status', 'ditolak')->count();

        // Hitung dari SuratKeteranganUsaha
        $prosesUsaha = SuratKeteranganUsaha::where('status', 'proses')->count();
        $selesaiUsaha = SuratKeteranganUsaha::where('status', 'selesai')->count();
        $ditolakUsaha = SuratKeteranganUsaha::where('status', 'ditolak')->count();

        // Hitung dari SuratKeteranganAktaNikah
        $prosesNikah = SuratKeteranganAktaNikah::where('status', 'proses')->count();
        $selesaiNikah = SuratKeteranganAktaNikah::where('status', 'selesai')->count();
        $ditolakNikah = SuratKeteranganAktaNikah::where('status', 'ditolak')->count();

        // Hitung dari SuratPengantarIjinKeramaian
        $prosesKeramaian = SuratPengantarIjinKeramaian::where('status', 'proses')->count();
        $selesaiKeramaian = SuratPengantarIjinKeramaian::where('status', 'selesai')->count();
        $ditolakKeramaian = SuratPengantarIjinKeramaian::where('status', 'ditolak')->count();

        // Hitung dari
        $prosesPerusahaan = SuratPindahDomisiliPerusahaan::where('status', 'proses')->count();
        $selesaiPerusahaan = SuratPindahDomisiliPerusahaan::where('status', 'selesai')->count();
        $ditolakPerusahaan = SuratPindahDomisiliPerusahaan::where('status', 'ditolak')->count();

        // Total semua model
        $prosesCount = $prosesPindah + $prosesUsaha + $prosesNikah + $prosesKeramaian + $prosesPerusahaan;
        $selesaiCount = $selesaiPindah + $selesaiUsaha + $selesaiNikah + $selesaiKeramaian + $selesaiPerusahaan;
        $ditolakCount = $ditolakPindah + $ditolakUsaha + $ditolakNikah + $ditolakKeramaian + $ditolakPerusahaan;


        // Ambil semua data status "proses" dari semua model
        $prosesPindah = SuratKeteranganPindahDomisili::where('status', 'proses')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'keterangan_domisili';
                return $item;
            });

        $prosesUsaha = SuratKeteranganUsaha::where('status', 'proses')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'keterangan_usaha';
                return $item;
            });

        $prosesNikah = SuratKeteranganAktaNikah::where('status', 'proses')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'keterangan_akta_nikah';
                return $item;
            });

        $prosesKeramaian = SuratPengantarIjinKeramaian::where('status', 'proses')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat_pengantar_ijin_keramaian';
                return $item;
            });

        $prosesPerusahaan = SuratPindahDomisiliPerusahaan::where('status', 'proses')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat-pindah-perusahaan';
                return $item;
            });

        // Ambil semua data status "selesai" dari semua model
        $selesaiPindah = SuratKeteranganPindahDomisili::where('status', 'selesai')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'keterangan_domisili';
                return $item;
            });

        $selesaiUsaha = SuratKeteranganUsaha::where('status', 'selesai')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'keterangan_usaha';
                return $item;
            });

        $selesaiNikah = SuratKeteranganAktaNikah::where('status', 'selesai')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'keterangan_akta_nikah';
                return $item;
            });

        $selesaiKeramaian = SuratPengantarIjinKeramaian::where('status', 'selesai')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat_pengantar_ijin_keramaian';
                return $item;
            });
        $selesaiPerusahaan = SuratPindahDomisiliPerusahaan::where('status', 'selesai')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat-pindah-perusahaan';
                return $item;
            });



        // Gabungkan semua data
        $prosesItems = $prosesPindah->concat($prosesUsaha)->concat($prosesNikah)->concat($prosesKeramaian)->concat($prosesPerusahaan);
        $selesaiItems = $selesaiPindah->concat($selesaiUsaha)->concat($selesaiNikah)->concat($selesaiKeramaian)->concat($selesaiPerusahaan);

        return view('dashboard', compact('prosesCount', 'selesaiCount', 'ditolakCount', 'prosesItems', 'selesaiItems', 'jumlahLaki', 'jumlahPerempuan', 'tahun', 'pendudukStats', 'chartData'));
    }
}
