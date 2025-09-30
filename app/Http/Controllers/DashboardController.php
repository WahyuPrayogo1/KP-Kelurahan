<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeteranganTidakMampu;
use App\Models\SuratKeteranganMiskin;
use App\Models\SuratKeteranganUsaha;
use App\Models\SuratKeteranganAktaNikah;
use App\Models\SuratPengantarIjinKeramaian;
use App\Models\SuratPindahDomisiliPerusahaan;
use App\Models\SuratKeteranganBedaDataKependudukan;
use App\Models\SuratPernyataanTanahTidakSengketa;
use App\Models\SuratKeteranganBekerjaLuarNegeri;
use App\Models\SuratKeteranganKematian;
use App\Models\PendudukStat;
use App\Models\SektorPekerjaan;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index()
    {

          $sektorPekerjaan = SektorPekerjaan::withCount(['pekerjaan as total_pekerjaan' => function($query) {
                $query->select(DB::raw('sum(jumlah)'));
            }])->get()->pluck('total_pekerjaan', 'nama')->toArray();
        // Ambil semua data surat
        $models = [
            ['model' => \App\Models\SuratKeteranganTidakMampu::class, 'label' => 'Tidak Mampu'],
            ['model' => \App\Models\SuratKeteranganMiskin::class, 'label' => 'Miskin'],
            ['model' => \App\Models\SuratKeteranganUsaha::class, 'label' => 'Usaha'],
            ['model' => \App\Models\SuratKeteranganAktaNikah::class, 'label' => 'Akta Nikah'],
            ['model' => \App\Models\SuratPengantarIjinKeramaian::class, 'label' => 'Izin Keramaian'],
            ['model' => \App\Models\SuratPindahDomisiliPerusahaan::class, 'label' => 'Pindah Perusahaan'],
            ['model' => \App\Models\SuratKeteranganBedaDataKependudukan::class, 'label' => 'Beda Data'],
            ['model' => \App\Models\SuratKeteranganBekerjaLuarNegeri::class, 'label' => 'Kerja Luar Negeri'],
            ['model' => \App\Models\SuratKeteranganKematian::class, 'label' => 'Kematian'],
        ];

        // Data per bulan (line chart)
        $monthlyLabels = [];
        $monthlyCounts = [];

        $now = now();
        for ($i = 5; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i)->format('F Y');
            $monthlyLabels[] = $month;

            $count = 0;
            foreach ($models as $entry) {
                $count += $entry['model']::whereMonth('created_at', $now->copy()->subMonths($i)->month)
                    ->whereYear('created_at', $now->copy()->subMonths($i)->year)
                    ->count();
            }
            $monthlyCounts[] = $count;
        }

        // Data per jenis surat (bar chart)
        $jenisLabels = [];
        $jenisCounts = [];

        foreach ($models as $entry) {
            $jenisLabels[] = $entry['label'];
            $jenisCounts[] = $entry['model']::count();
        }

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

        // Hitung dari SuratKeteranganTidakMampu
        $prosesPindah = SuratKeteranganTidakMampu::where('status', 'proses')->count();
        $selesaiPindah = SuratKeteranganTidakMampu::where('status', 'selesai')->count();
        $ditolakPindah = SuratKeteranganTidakMampu::where('status', 'revisi')->count();

        // Hitung dari SuratKeteranganMiskin
        $prosesMiskin = SuratKeteranganMiskin::where('status', 'proses')->count();
        $selesaiMiskin = SuratKeteranganMiskin::where('status', 'selesai')->count();
        $ditolakMiskin = SuratKeteranganMiskin::where('status', 'revisi')->count();


        // Hitung dari SuratKeteranganUsaha
        $prosesUsaha = SuratKeteranganUsaha::where('status', 'proses')->count();
        $selesaiUsaha = SuratKeteranganUsaha::where('status', 'selesai')->count();
        $ditolakUsaha = SuratKeteranganUsaha::where('status', 'revisi')->count();

        // Hitung dari SuratKeteranganAktaNikah
        $prosesNikah = SuratKeteranganAktaNikah::where('status', 'proses')->count();
        $selesaiNikah = SuratKeteranganAktaNikah::where('status', 'selesai')->count();
        $ditolakNikah = SuratKeteranganAktaNikah::where('status', 'revisi')->count();

        // Hitung dari SuratPengantarIjinKeramaian
        $prosesKeramaian = SuratPengantarIjinKeramaian::where('status', 'proses')->count();
        $selesaiKeramaian = SuratPengantarIjinKeramaian::where('status', 'selesai')->count();
        $ditolakKeramaian = SuratPengantarIjinKeramaian::where('status', 'revisi')->count();

        // Hitung dari
        $prosesPerusahaan = SuratPindahDomisiliPerusahaan::where('status', 'proses')->count();
        $selesaiPerusahaan = SuratPindahDomisiliPerusahaan::where('status', 'selesai')->count();
        $ditolakPerusahaan = SuratPindahDomisiliPerusahaan::where('status', 'revisi')->count();

         // Hitung dari
        // $prosesTanah = SuratPernyataanTanahTidakSengketa::where('status', 'proses')->count();
        // $selesaiTanah = SuratPernyataanTanahTidakSengketa::where('status', 'selesai')->count();
        // $ditolakTanah = SuratPernyataanTanahTidakSengketa::where('status', 'ditolak')->count();

          // Beda Penduduk
        $prosesBedaPenduduk = SuratKeteranganBedaDataKependudukan::where('status', 'proses')->count();
        $selesaiBedaPenduduk = SuratKeteranganBedaDataKependudukan::where('status', 'selesai')->count();
        $ditolakBedaPenduduk = SuratKeteranganBedaDataKependudukan::where('status', 'revisi')->count();

        // Bekerja Luar negeri
        $prosesBekerja = SuratKeteranganBekerjaLuarNegeri::where('status', 'proses')->count();
        $selesaiBekerja = SuratKeteranganBekerjaLuarNegeri::where('status', 'selesai')->count();
        $ditolakBekerja = SuratKeteranganBekerjaLuarNegeri::where('status', 'revisi')->count();

        // Keterangan Kematian
        $prosesKematian = SuratKeteranganKematian::where('status', 'proses')->count();
        $selesaiKematian = SuratKeteranganKematian::where('status', 'selesai')->count();
        $ditolakKematian = SuratKeteranganKematian::where('status', 'revisi')->count();

        // Total semua model
        $prosesCount =    $prosesMiskin + $prosesKematian + $prosesBekerja + $prosesPindah + $prosesUsaha + $prosesNikah + $prosesKeramaian + $prosesPerusahaan + $prosesBedaPenduduk;
        $selesaiCount =  $selesaiMiskin + $selesaiKematian + $selesaiBekerja + $selesaiPindah + $selesaiUsaha + $selesaiNikah + $selesaiKeramaian + $selesaiPerusahaan + $selesaiBedaPenduduk;
        $ditolakCount =   $ditolakMiskin + $ditolakKematian + $ditolakBekerja + $ditolakPindah + $ditolakUsaha + $ditolakNikah + $ditolakKeramaian + $ditolakPerusahaan + $ditolakBedaPenduduk;


        // Ambil semua data status "proses" dari semua model
          $prosesBedaPenduduk = SuratKeteranganBedaDataKependudukan::where('status', 'proses')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'beda-data-kependudukan';
                return $item;
            });

        $prosesMiskin = SuratKeteranganMiskin::where('status', 'proses')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat_keterangan_miskin';
                return $item;
        });

        $prosesPindah = SuratKeteranganTidakMampu::where('status', 'proses')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat_keterangan_tidak_mampu';
                return $item;
            });

        $prosesUsaha = SuratKeteranganUsaha::where('status', 'proses')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat_keterangan_usahas';
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
             $selesaiMiskin = SuratKeteranganMiskin::where('status', 'selesai')
                ->get()
                ->map(function ($item) {
                    $item->model_type = 'surat_keterangan_miskin';
                    return $item;
            });

        $selesaiBedaPenduduk = SuratKeteranganBedaDataKependudukan::where('status', 'selesai')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'beda-data-kependudukan';
                return $item;
            });

        $selesaiPindah = SuratKeteranganTidakMampu::where('status', 'selesai')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat_keterangan_tidak_mampu';
                return $item;
            });

        $selesaiUsaha = SuratKeteranganUsaha::where('status', 'selesai')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat_keterangan_usahas';
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

               $ditolakMiskin = SuratKeteranganMiskin::where('status', 'revisi')
                ->get()
                ->map(function ($item) {
                    $item->model_type = 'surat_keterangan_miskin';
                    return $item;
            });
        $ditolakBedaPenduduk = SuratKeteranganBedaDataKependudukan::where('status', 'revisi')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'beda-data-kependudukan';
                return $item;
            });

        $ditolakPindah = SuratKeteranganTidakMampu::where('status', 'revisi')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat_keterangan_tidak_mampu';
                return $item;
            });

        $ditolakUsaha = SuratKeteranganUsaha::where('status', 'revisi')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat_keterangan_usahas';
                return $item;
            });

        $ditolakNikah = SuratKeteranganAktaNikah::where('status', 'revisi')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'keterangan_akta_nikah';
                return $item;
            });

        $ditolakKeramaian = SuratPengantarIjinKeramaian::where('status', 'revisi')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat_pengantar_ijin_keramaian';
                return $item;
            });
        $ditolakPerusahaan = SuratPindahDomisiliPerusahaan::where('status', 'revisi')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat-pindah-perusahaan';
                return $item;
            });
        $ditolakBekerja = SuratKeteranganBekerjaLuarNegeri::where('status', 'revisi')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat-bekerja-luar-negeri';
                return $item;
            });
        $ditolakKematian = SuratKeteranganKematian::where('status', 'revisi')
            ->get()
            ->map(function ($item) {
                $item->model_type = 'surat_keterangan_kematian';
                return $item;
            });


        // Gabungkan semua data
        $prosesItems = $prosesPindah->concat($prosesUsaha)->concat($prosesNikah)->concat($prosesKeramaian)->concat($prosesPerusahaan)->concat($prosesBedaPenduduk)->concat($prosesBekerja)->concat($prosesKematian)->concat($prosesMiskin);
        $selesaiItems = $selesaiPindah->concat($selesaiUsaha)->concat($selesaiNikah)->concat($selesaiKeramaian)->concat($selesaiPerusahaan)->concat($selesaiBedaPenduduk)->concat($selesaiBekerja)->concat($selesaiKematian)->concat($selesaiMiskin);
        $ditolakItems = $ditolakPindah->concat($ditolakUsaha)->concat($ditolakNikah)->concat($ditolakKeramaian)->concat($ditolakPerusahaan)->concat($ditolakBedaPenduduk)->concat($ditolakBekerja)->concat($ditolakKematian)->concat($ditolakMiskin);

        return view('dashboard', compact('prosesCount', 'selesaiCount', 'ditolakCount', 'prosesItems', 'selesaiItems','ditolakItems', 'jumlahLaki', 'jumlahPerempuan', 'tahun', 'pendudukStats', 'chartData', 'monthlyLabels', 'monthlyCounts','jenisLabels', 'jenisCounts','sektorPekerjaan'));
    }
}
