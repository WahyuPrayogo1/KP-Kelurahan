<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganBedaDataKependudukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Http;

class SuratKeteranganBedaDataKependudukanController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(403, 'Unauthorized');
        }

        if ($request->ajax()) {
        $data = SuratKeteranganBedaDataKependudukan::with('user')->get();

        return DataTables::of($data)
            ->addColumn('status', function ($row) {
                $badgeClass = match ($row->status) {
                    'selesai' => 'success',
                    'proses' => 'warning',
                    'ditolak' => 'danger',
                    default => 'secondary',
                };
                return '<span class="text-white badge bg-' . $badgeClass . '">' . ucfirst($row->status) . '</span>';
            })
            ->editColumn('lokasi_perbedaan_nama', function ($row) {
                return $row->lokasi_perbedaan_nama;
            })
            ->addColumn('aksi', function ($row) {
                return view('backend.pages.beda_data_kependudukan.actions', compact('row'));
            })
            ->rawColumns(['status', 'aksi'])
            ->make(true);
    }
        return view('backend.pages.beda_data_kependudukan.index');
    }

    public function create()
    {
        return view('backend.pages.beda_data_kependudukan.create');
    }

    public function store(Request $request)
    {
        // Jika user memilih "Lainnya" dan mengisi nilai manual, pakai nilai tersebut
        if ($request->lokasi_perbedaan_nama === 'Lainnya' && $request->filled('lokasi_perbedaan_nama_lainnya')) {
            $request->merge([
                'lokasi_perbedaan_nama' => $request->lokasi_perbedaan_nama_lainnya
            ]);
        }

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:surat_keterangan_beda_data_kependudukans,nik',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'kewarganegaraan' => 'required|string|max:100',
            'pekerjaan' => 'required|string|max:255',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'agama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'lokasi_perbedaan_nama' => 'required|string|max:255',
            'fc_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'fc_kk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'surat_pernyataan_beda_data' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bukti_beda_data' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pengantar_rt_rw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        foreach ([
            'fc_ktp',
            'fc_kk',
            'surat_pernyataan_beda_data',
            'bukti_beda_data',
            'pengantar_rt_rw'
        ] as $fileField) {
            if ($request->hasFile($fileField)) {
                $validated[$fileField] = $request->file($fileField)->store('uploads', 'private');
            }
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'proses';

        SuratKeteranganBedaDataKependudukan::create($validated);

        return redirect()->route('/dashboard')->with('success', 'Pengajuan berhasil dikirim.');
    }

    public function show($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        $surat = SuratKeteranganBedaDataKependudukan::findOrFail($id);
        return view('backend.pages.beda_data_kependudukan.show', compact('surat'));
    }

    public function edit($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        $surat = SuratKeteranganBedaDataKependudukan::findOrFail($id);
        return view('backend.pages.beda_data_kependudukan.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        $surat = SuratKeteranganBedaDataKependudukan::findOrFail($id);

        if ($request->lokasi_perbedaan_nama === 'Lainnya' && $request->filled('lokasi_perbedaan_nama_lainnya')) {
            $request->merge([
                'lokasi_perbedaan_nama' => $request->lokasi_perbedaan_nama_lainnya
            ]);
        }

        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:surat_keterangan_beda_data_kependudukans,nik,' . $surat->id,
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'kewarganegaraan' => 'required|string|max:100',
            'pekerjaan' => 'required|string|max:255',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'agama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'lokasi_perbedaan_nama' => 'required|string|max:255',
            'status' => 'required|in:proses,selesai,ditolak',
            'catatan' => 'nullable|string',
            'fc_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'fc_kk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'surat_pernyataan_beda_data' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bukti_beda_data' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pengantar_rt_rw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        foreach ([
            'fc_ktp',
            'fc_kk',
            'surat_pernyataan_beda_data',
            'bukti_beda_data',
            'pengantar_rt_rw'
        ] as $field) {
            if ($request->hasFile($field)) {
                if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                    Storage::disk('private')->delete($surat->$field);
                }
                $validatedData[$field] = $request->file($field)->store('uploads', 'private');
            } else {
                $validatedData[$field] = $surat->$field;
            }
        }

        $surat->update($validatedData);

        return redirect()->route('beda-data-kependudukan.index')
            ->with('success', 'Data berhasil diperbarui!');
}

    public function destroy($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(403, 'Unauthorized');
        }

        $surat = SuratKeteranganBedaDataKependudukan::findOrFail($id);

        foreach ([
            'fc_ktp',
            'fc_kk',
            'surat_pernyataan_beda_data',
            'bukti_beda_data',
            'pengantar_rt_rw'
        ] as $fileField) {
            if ($surat->$fileField && Storage::disk('private')->exists($surat->$fileField)) {
                Storage::disk('private')->delete($surat->$fileField);
            }
        }
        $surat->delete();

         return redirect()->route('beda-data-kependudukan.index')->with('success', 'Data berhasil dihapus!');
    }

    public function previewPdf($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        $surat = SuratKeteranganBedaDataKependudukan::findOrFail($id);
        return view('backend.pages.Beda_Data_kependudukan.preview-pdf', compact('surat'));
    }

    public function generatePdf(Request $request, $id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        $surat = SuratKeteranganBedaDataKependudukan::findOrFail($id);

        $data = [
            'surat' => $surat,
            'nomor_surat' => $request->nomor_surat ?? 'PD.PU.08.03 /     /VII/6/KEL.SBJ/' . date('Y'),
            'tanggal_surat' => $request->tanggal_surat ?? now(),
            'nomor_pengantar' => $request->input('nomor_pengantar'),
            'tanggal_pengantar' => $request->input('tanggal_pengantar'),
            'lurah_nip' => $request->lurah_nip,
        ];

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'default_font' => 'times',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,
        ]);

        $html = view('backend.pages.Beda_Data_Kependudukan.pdf.surat', $data)->render();

        $mpdf->WriteHTML($html);

        return $mpdf->Output('Surat-Beda-Data-' . $surat->id . '.pdf', \Mpdf\Output\Destination::INLINE);
    }
}

