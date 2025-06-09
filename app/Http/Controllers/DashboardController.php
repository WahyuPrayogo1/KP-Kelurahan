<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeteranganPindahDomisili;
use App\Models\SuratKeteranganUsaha;
use App\Models\SuratKeteranganAktaNikah;
use App\Models\SuratPengantarIjinKeramaian;
use App\Models\SuratPindahDomisiliPerusahaan;
use App\Models\SuratKeteranganBedaDataKependudukan;
use App\Models\SuratPernyataanTanahTidakSengketa; 
use App\Models\SuratKeteranganBekerjaLuarNegeri;
use App\Models\SuratKeteranganKematian;
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

         // Hitung dari
        $prosesTanah = SuratPernyataanTanahTidakSengketa::where('status', 'proses')->count();
        $selesaiTanah = SuratPernyataanTanahTidakSengketa::where('status', 'selesai')->count();
        $ditolakTanah = SuratPernyataanTanahTidakSengketa::where('status', 'ditolak')->count();

          // Beda Penduduk
        $prosesBedaPenduduk = SuratKeteranganBedaDataKependudukan::where('status', 'proses')->count();
        $selesaiBedaPenduduk = SuratKeteranganBedaDataKependudukan::where('status', 'selesai')->count();
        $ditolakBedaPenduduk = SuratKeteranganBedaDataKependudukan::where('status', 'ditolak')->count();

        // Bekerja Luar negeri
        $prosesBekerja = SuratKeteranganBekerjaLuarNegeri::where('status', 'proses')->count();
        $selesaiBekerja = SuratKeteranganBekerjaLuarNegeri::where('status', 'selesai')->count();
        $ditolakBekerja = SuratKeteranganBekerjaLuarNegeri::where('status', 'ditolak')->count();

        // Keterangan Kematian
        $prosesKematian = SuratKeteranganKematian::where('status', 'proses')->count();
        $selesaiKematian = SuratKeteranganKematian::where('status', 'selesai')->count();
        $ditolakKematian = SuratKeteranganKematian::where('status', 'ditolak')->count();

        // Total semua model
        $prosesCount =  $prosesKematian + $prosesBekerja + $prosesPindah + $prosesUsaha + $prosesNikah + $prosesKeramaian + $prosesPerusahaan + $prosesTanah + $prosesBedaPenduduk;
        $selesaiCount = $selesaiKematian + $selesaiBekerja + $selesaiPindah + $selesaiUsaha + $selesaiNikah + $selesaiKeramaian + $selesaiPerusahaan + $selesaiTanah + $selesaiBedaPenduduk;
        $ditolakCount = $ditolakKematian + $ditolakBekerja + $ditolakPindah + $ditolakUsaha + $ditolakNikah + $ditolakKeramaian + $ditolakPerusahaan + $ditolakTanah + $ditolakBedaPenduduk;


        // Ambil semua data status "proses" dari semua model
          $prosesBedaPenduduk = SuratKeteranganBedaDataKependudukan::where('status', 'proses')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'beda-data-kependudukan';
                return $item;
            });

         $prosesTanah = SuratPernyataanTanahTidakSengketa::where('status', 'proses')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat-tanah-tidak-sengketa';
                return $item;
            });

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

        $prosesBekerja = SuratKeteranganBekerjaLuarNegeri::where('status', 'proses')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat-bekerja-luar-negeri';
                return $item;
            });
        $prosesKematian = SuratKeteranganKematian::where('status', 'proses')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat_keterangan_kematian';
                return $item;
            });


         // Ambil semua data status "selesai" dari semua model
        $selesaiBedaPenduduk = SuratKeteranganBedaDataKependudukan::where('status', 'selesai')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'beda-data-kependudukan';
                return $item;
            });

        $selesaiPindah = SuratKeteranganPindahDomisili::where('status', 'selesai')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'keterangan_domisili';
                return $item;
            });

        $selesaiTanah = SuratPernyataanTanahTidakSengketa::where('status', 'selesai')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat-tanah-tidak-sengketa';
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
        $selesaiBekerja = SuratKeteranganBekerjaLuarNegeri::where('status', 'selesai')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat-bekerja-luar-negeri';
                return $item;
            });
        $selesaiKematian = SuratKeteranganKematian::where('status', 'selesai')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'ssurat_keterangan_kematian';
                return $item;
            });




            // DITOLAK

             // Ambil semua data status "ditolak" dari semua model
        $ditolakBedaPenduduk = SuratKeteranganBedaDataKependudukan::where('status', 'ditolak')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'beda-data-kependudukan';
                return $item;
            });

        $ditolakPindah = SuratKeteranganPindahDomisili::where('status', 'ditolak')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'keterangan_domisili';
                return $item;
            });

        $ditolakTanah = SuratPernyataanTanahTidakSengketa::where('status', 'ditolak')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat-tanah-tidak-sengketa';
                return $item;
            });

        $ditolakUsaha = SuratKeteranganUsaha::where('status', 'ditolak')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'keterangan_usaha';
                return $item;
            });

        $ditolakNikah = SuratKeteranganAktaNikah::where('status', 'ditolak')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'keterangan_akta_nikah';
                return $item;
            });

        $ditolakKeramaian = SuratPengantarIjinKeramaian::where('status', 'ditolak')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat_pengantar_ijin_keramaian';
                return $item;
            });
        $ditolakPerusahaan = SuratPindahDomisiliPerusahaan::where('status', 'ditolak')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat-pindah-perusahaan';
                return $item;
            });
        $ditolakBekerja = SuratKeteranganBekerjaLuarNegeri::where('status', 'ditolak')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat-bekerja-luar-negeri';
                return $item;
            });
        $ditolakKematian = SuratKeteranganKematian::where('status', 'ditolak')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat_keterangan_kematian';
                return $item;
            });


        // Gabungkan semua data
        $prosesItems = $prosesPindah->concat($prosesUsaha)->concat($prosesNikah)->concat($prosesKeramaian)->concat($prosesPerusahaan)->concat($prosesTanah)->concat($prosesBedaPenduduk)->concat($prosesBekerja)->concat($prosesKematian);
        $selesaiItems = $selesaiPindah->concat($selesaiUsaha)->concat($selesaiNikah)->concat($selesaiKeramaian)->concat($selesaiPerusahaan)->concat($selesaiTanah)->concat($selesaiBedaPenduduk)->concat($selesaiBekerja)->concat($selesaiKematian);
        $ditolakItems = $ditolakPindah->concat($ditolakUsaha)->concat($ditolakNikah)->concat($ditolakKeramaian)->concat($ditolakPerusahaan)->concat($ditolakTanah)->concat($ditolakBedaPenduduk)->concat($ditolakBekerja)->concat($ditolakKematian);

        return view('dashboard', compact('prosesCount', 'selesaiCount', 'ditolakCount', 'prosesItems', 'selesaiItems','ditolakItems', 'jumlahLaki', 'jumlahPerempuan', 'tahun', 'pendudukStats', 'chartData'));
    }
}
