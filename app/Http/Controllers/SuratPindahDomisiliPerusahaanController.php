<?php

namespace App\Http\Controllers;

use App\Models\SuratPindahDomisiliPerusahaan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Support\Facades\Storage;

class SuratPindahDomisiliPerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SuratPindahDomisiliPerusahaan::with('user')->get();
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
                    return view('backend.pages.surat_pindah.actions', compact('row'));
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        }

        return view('backend.pages.surat_pindah.index');
    }
    public function edit($id)
    {
        $surat = SuratPindahDomisiliPerusahaan::findOrFail($id);
        return view('backend.pages.surat_pindah.edit', compact('surat'));
    }

    public function create()
    {
        return view('backend.pages.surat_pindah.create');
    }

    public function update(Request $request, $id)
    {
        $surat = SuratPindahDomisiliPerusahaan::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:surat_pindah_domisili_perusahaans,nik,' . $id,
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pernyataan_pindah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_akte_notaris' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:proses,selesai,ditolak', // tambah validasi status
            'catatan' => 'nullable|string',
        ]);

        // Hapus dan update file jika ada upload baru
        if ($request->hasFile('foto_ktp')) {
            if ($surat->foto_ktp && Storage::disk('private')->exists($surat->foto_ktp)) {
                Storage::disk('private')->delete($surat->foto_ktp);
            }
            $validatedData['foto_ktp'] = $request->file('foto_ktp')->store('uploads', 'private');
        }

        if ($request->hasFile('foto_kk')) {
            if ($surat->foto_kk && Storage::disk('private')->exists($surat->foto_kk)) {
                Storage::disk('private')->delete($surat->foto_kk);
            }
            $validatedData['foto_kk'] = $request->file('foto_kk')->store('uploads', 'private');
        }

        if ($request->hasFile('foto_akte_notaris')) {
            if ($surat->foto_akte_notaris && Storage::disk('private')->exists($surat->foto_akte_notaris)) {
                Storage::disk('private')->delete($surat->foto_akte_notaris);
            }
            $validatedData['foto_akte_notaris'] = $request->file('foto_akte_notaris')->store('uploads', 'private');
        }

        if ($request->hasFile('foto_pengantar_rt_rw')) {
            if ($surat->foto_pengantar_rt_rw && Storage::disk('private')->exists($surat->foto_pengantar_rt_rw)) {
                Storage::disk('private')->delete($surat->foto_pengantar_rt_rw);
            }
            $validatedData['foto_pengantar_rt_rw'] = $request->file('foto_pengantar_rt_rw')->store('uploads', 'private');
        }

        $surat->update($validatedData);

        return redirect()->route('surat-pindah-perusahaan.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $surat = SuratPindahDomisiliPerusahaan::findOrFail($id);

        // Hapus semua file terkait jika ada
        $fileFields = ['foto_ktp', 'foto_kk', 'foto_akte_notaris', 'foto_pengantar_rt_rw'];

        foreach ($fileFields as $field) {
            if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                Storage::disk('private')->delete($surat->$field);
            }
        }

        // Hapus data dari database
        $surat->delete();

        return redirect()->route('keterangan_domisili.index')->with('success', 'Data berhasil dihapus!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'alamat_pemilik' => 'required|string',
            'nomor_tdp' => 'required|string|max:50',
            'jenis_usaha' => 'required|string|max:100',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pernyataan_pindah' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_akte_notaris' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
        ], [
            'required' => 'Field :attribute wajib diisi',
            'unique' => 'Alamat perusahaan sudah terdaftar',
            'max' => 'Maksimal :max karakter',
            'image' => 'File harus berupa gambar',
            'mimes' => 'Format file harus jpeg, png, atau jpg',
            'foto_ktp.max' => 'Ukuran file tidak boleh lebih dari 2MB',
            'foto_kk.max' => 'Ukuran file tidak boleh lebih dari 2MB',
            'foto_pernyataan_pindah.max' => 'Ukuran file tidak boleh lebih dari 2MB',
            'foto_akte_notaris.max' => 'Ukuran file tidak boleh lebih dari 2MB',
            'foto_pengantar_rt_rw.max' => 'Ukuran file tidak boleh lebih dari 2MB',
        ]);

        // Upload files
        $foto_ktp = $request->file('foto_ktp')->store('uploads/surat_pindah_perusahaan', 'private');
        $foto_kk = $request->file('foto_kk')->store('uploads/surat_pindah_perusahaan', 'private');
        $foto_pernyataan_pindah = $request->file('foto_pernyataan_pindah')->store('uploads/surat_pindah_perusahaan', 'private');
        $foto_akte_notaris = $request->file('foto_akte_notaris')->store('uploads/surat_pindah_perusahaan', 'private');
        $foto_pengantar_rt_rw = $request->file('foto_pengantar_rt_rw')->store('uploads/surat_pindah_perusahaan', 'private');


        $alamatLengkap = $request->alamat_perusahaan
        . ', Kel. ' . $request->kelurahan_perusahaan
        . ', Kec. ' . $request->kecamatan_perusahaan
        . ', RT ' . $request->rt_perusahaan
        . '/RW ' . $request->rw_perusahaan
        . ', Kota Sukabumi'
        . ', ' . $request->kode_pos_perusahaan;
        // Save to database
        SuratPindahDomisiliPerusahaan::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $alamatLengkap,
            'user_id' => auth()->id(),
            'nama_pemilik' => $request->nama_pemilik,
            'alamat_pemilik' => $request->alamat_pemilik,
            'nomor_tdp' => $request->nomor_tdp,
            'jenis_usaha' => $request->jenis_usaha,
            'foto_ktp' => $foto_ktp,
            'foto_kk' => $foto_kk,
            'foto_pernyataan_pindah' => $foto_pernyataan_pindah,
            'foto_akte_notaris' => $foto_akte_notaris,
            'foto_pengantar_rt_rw' => $foto_pengantar_rt_rw,
            'status' => 'proses',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('/dashboard')->with('success', 'Pengajuan surat pindah domisili perusahaan berhasil dikirim.');
    }

       public function show($id)
        {
            $surat = SuratPindahDomisiliPerusahaan::findOrFail($id);
            return view('backend.pages.surat_pindah.show', compact('surat'));
        }


        public function previewPdf($id)
        {
            $surat = SuratPengantarIjinKeramaian::findOrFail($id);
            return view('backend.pages.surat_pindah.preview-pdf', compact('surat'));
        }

        public function generatePdf(Request $request, $id)
        {

        }

}
