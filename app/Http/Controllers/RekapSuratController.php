<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon;

// Import semua model surat
use App\Models\SuratKeteranganTidakMampu;
use App\Models\SuratKeteranganMiskin;
use App\Models\SuratKeteranganUsaha;
use App\Models\SuratKeteranganAktaNikah;
use App\Models\SuratPengantarIjinKeramaian;
use App\Models\SuratPindahDomisiliPerusahaan;
use App\Models\SuratKeteranganBedaDataKependudukan;
use App\Models\SuratKeteranganBekerjaLuarNegeri;
use App\Models\SuratKeteranganKematian;

class RekapSuratController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->input('jenis', 'semua');
        $rentang = $request->input('rentang', '1bulan');

        $rekapData = $this->filterData($jenis, $rentang);

        return view('backend.pages.laporan.index', compact('rekapData', 'jenis', 'rentang'));
    }

    public function export(Request $request)
{
    $jenis = $request->input('jenis', 'semua');
    $rentang = $request->input('rentang', '1bulan');
    $rekapData = $this->filterData($jenis, $rentang);

    $filename = 'rekap_surat_' . now()->format('Ymd_His') . '.csv';
    $filePath = storage_path("app/public/{$filename}");

    // siapkan data untuk CSV
    $data = [];

    if ($jenis === 'semua') {
        foreach ($rekapData as $item) {
            $data[] = [
                'Jenis Surat' => $item->jenis_surat ?? '-',
                'Nama Pemohon' => $item->nama ?? '-',
                'Status' => ucfirst($item->status ?? '-'),
                'Tanggal Pengajuan' => \Carbon\Carbon::parse($item->created_at)->format('d-m-Y'),
            ];
        }
    } else {
        foreach ($rekapData as $item) {
            $data[] = [
                'Nama Pemohon' => $item->nama ?? '-',
                'Status' => ucfirst($item->status ?? '-'),
                'Tanggal Pengajuan' => \Carbon\Carbon::parse($item->created_at)->format('d-m-Y'),
            ];
        }
    }

    SimpleExcelWriter::create($filePath)->addRows($data);

    return response()->download($filePath)->deleteFileAfterSend();
}


    public function filterData($jenis, $rentang)
    {
        $tanggalMulai = now();
        if ($rentang === '1bulan') $tanggalMulai->subMonth();
        elseif ($rentang === '3bulan') $tanggalMulai->subMonths(3);
        elseif ($rentang === '6bulan') $tanggalMulai->subMonths(6);
        elseif ($rentang === '1tahun') $tanggalMulai->subYear();

        $rekapData = collect();

        if ($jenis === 'semua') {
            $models = [
                ['model' => SuratKeteranganTidakMampu::class, 'label' => 'Surat Tidak Mampu'],
                ['model' => SuratKeteranganMiskin::class, 'label' => 'Surat Miskin'],
                ['model' => SuratKeteranganUsaha::class, 'label' => 'Surat Usaha'],
                ['model' => SuratKeteranganAktaNikah::class, 'label' => 'Akta Nikah'],
                ['model' => SuratPengantarIjinKeramaian::class, 'label' => 'Izin Keramaian'],
                ['model' => SuratPindahDomisiliPerusahaan::class, 'label' => 'Pindah Perusahaan'],
                ['model' => SuratKeteranganBedaDataKependudukan::class, 'label' => 'Beda Data'],
                ['model' => SuratKeteranganBekerjaLuarNegeri::class, 'label' => 'Kerja Luar Negeri'],
                ['model' => SuratKeteranganKematian::class, 'label' => 'Kematian'],
            ];

            foreach ($models as $entry) {
                $items = $entry['model']::where('created_at', '>=', $tanggalMulai)
                    ->get()
                    ->map(function ($item) use ($entry) {
                        $item->jenis_surat = $entry['label'];
                        return $item; // ✅ penting: harus return item
                    });

                $rekapData = $rekapData->concat($items);
            }

            $rekapData = $rekapData->sortByDesc('created_at')->values();
        } else {
            $modelMap = [
                'surat_keterangan_tidak_mampu' => SuratKeteranganTidakMampu::class,
                'surat_keterangan_miskin' => SuratKeteranganMiskin::class,
                'surat_keterangan_usaha' => SuratKeteranganUsaha::class,
                'surat_keterangan_akta_nikah' => SuratKeteranganAktaNikah::class,
                'surat_pengantar_ijin_keramaian' => SuratPengantarIjinKeramaian::class,
                'surat_pindah_perusahaan' => SuratPindahDomisiliPerusahaan::class,
                'surat_beda_data' => SuratKeteranganBedaDataKependudukan::class,
                'surat_bekerja_luar_negeri' => SuratKeteranganBekerjaLuarNegeri::class,
                'surat_keterangan_kematian' => SuratKeteranganKematian::class,
            ];

            if (array_key_exists($jenis, $modelMap)) {
                $rekapData = $modelMap[$jenis]::where('created_at', '>=', $tanggalMulai)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }

        return $rekapData;
    }
}
