<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganBedaDataKependudukan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Support\Facades\Storage;

class SuratKeteranganBedaDataKependudukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
                ->addColumn('aksi', function ($row) {
                    return view('backend.pages.beda_data_kependudukan.actions', compact('row'));
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        }

        return view('backend.pages.beda_data_kependudukan.index');
    }
    public function edit($id)
    {
        $surat = SuratKeteranganBedaDataKependudukan::findOrFail($id);
        return view('backend.pages.beda_data_kependudukan.edit', compact('surat'));
    }

    public function create()
    {
        return view('backend.pages.beda_data_kependudukan.create');
    }

    public function update(Request $request, $id)
    {
        $surat = SuratKeteranganBedaDataKependudukan::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:surat_keterangan_beda_data_kependudukans,nik,' . $id,
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'fc_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'fc_kk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'surat_pernyataan_beda_data' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bukti_beda_data' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pengantar_rt_rw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:proses,selesai,ditolak', // tambah validasi status
            'catatan' => 'nullable|string',
        ]);

        // Hapus dan update file jika ada upload baru
        if ($request->hasFile('fc_ktp')) {
            if ($surat->fc_ktp && Storage::disk('private')->exists($surat->fc_ktp)) {
                Storage::disk('private')->delete($surat->fc_ktp);
            }
            $validatedData['fc_ktp'] = $request->file('fc_ktp')->store('uploads', 'private');
        }

        if ($request->hasFile('fc_kk')) {
            if ($surat->fc_kk && Storage::disk('private')->exists($surat->fc_kk)) {
                Storage::disk('private')->delete($surat->fc_kk);
            }
            $validatedData['fc_kk'] = $request->file('fc_kk')->store('uploads', 'private');
        }

        if ($request->hasFile('surat_pernyataan_beda_data')) {
            if ($surat->surat_pernyataan_beda_data && Storage::disk('private')->exists($surat->surat_pernyataan_beda_data)) {
                Storage::disk('private')->delete($surat->surat_pernyataan_beda_data);
            }
            $validatedData['surat_pernyataan_beda_data'] = $request->file('surat_pernyataan_beda_data')->store('uploads', 'private');
        }
        if ($request->hasFile('bukti_beda_data')) {
            if ($surat->bukti_beda_data && Storage::disk('private')->exists($surat->bukti_beda_data)) {
                Storage::disk('private')->delete($surat->bukti_beda_data);
            }
            $validatedData['bukti_beda_data'] = $request->file('bukti_beda_data')->store('uploads', 'private');
        }

        if ($request->hasFile('pengantar_rt_rw')) {
            if ($surat->pengantar_rt_rw && Storage::disk('private')->exists($surat->pengantar_rt_rw)) {
                Storage::disk('private')->delete($surat->pengantar_rt_rw);
            }
            $validatedData['pengantar_rt_rw'] = $request->file('pengantar_rt_rw')->store('uploads', 'private');
        }

        $surat->update($validatedData);

        return redirect()->route('beda-data-kependudukan.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $surat = SuratKeteranganBedaDataKependudukan::findOrFail($id);

        // Hapus semua file terkait jika ada
        $fileFields = ['fc_ktp', 'fc_kk', 'surat_pernyataan_beda_data', 'pengantar_rt_rw','bukti_beda_data'];

        foreach ($fileFields as $field) {
            if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                Storage::disk('private')->delete($surat->$field);
            }
        }

        // Hapus data dari database
        $surat->delete();

        return redirect()->route('beda-data-kependudukan.index')->with('success', 'Data berhasil dihapus!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:surat_keterangan_beda_data_kependudukans,nik',
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'fc_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'fc_kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'surat_pernyataan_beda_data' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'bukti_beda_data' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
        ]);

        // dd($request->all());
        // Upload file
        $fc_ktp = $request->file('fc_ktp')->store('uploads', 'private');
        $fc_kk = $request->file('fc_kk')->store('uploads', 'private');
        $surat_pernyataan_beda_data = $request->file('surat_pernyataan_beda_data')->store('uploads', 'private');
        $bukti_beda_data = $request->file('bukti_beda_data')->store('uploads', 'private');
        $pengantar_rt_rw = $request->file('pengantar_rt_rw')->store('uploads', 'private');

        // Simpan ke database
        SuratKeteranganBedaDataKependudukan::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'user_id' => auth()->id(), // Pastikan user login
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_lengkap' => $request->alamat_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'fc_ktp' => $fc_ktp,
            'fc_kk' => $fc_kk,
            'surat_pernyataan_beda_data' => $surat_pernyataan_beda_data,
            'bukti_beda_data' => $bukti_beda_data,
            'pengantar_rt_rw' => $pengantar_rt_rw,
            'status' => 'proses',
        ]);

        return redirect()->route('/dashboard')->with('success', 'Pengajuan berhasil dikirim.');
    }
}
