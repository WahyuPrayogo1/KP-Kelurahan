<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganTentangOrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class SuratKeteranganTentangOrangTuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        if ($request->ajax()) {
            $absens = SuratKeteranganTentangOrangTua::with('user')->get();
            return DataTables::of($absens)
                ->addColumn('status', function($row) {
                    $badgeClass = '';
                    switch ($row->status) {
                        case 'selesai':
                            $badgeClass = 'success';
                            break;
                        case 'proses':
                            $badgeClass = 'warning';
                            break;
                        case 'ditolak':
                            $badgeClass = 'danger';
                            break;
                        default:
                            $badgeClass = 'secondary';
                            break;
                    }
                    return '<span class="text-white badge bg-' . $badgeClass . '">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('aksi', function($row) {
                    return view('backend.pages.Keterangan_Orang_Tua.actions', compact('row'));
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        }
        return view('backend.pages.Keterangan_Orang_Tua.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('backend.pages.Keterangan_Orang_Tua.create');
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:surat_keterangan_tentang_orang_tuas,nik',
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',

            'fc_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'fc_kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'fc_akte_lahir' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'fc_buku_nikah_ortu' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'surat_pernyataan_ahli_waris' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
        ]);

        // Upload file
        $fc_ktp = $request->file('fc_ktp')->store('uploads', 'private');
        $fc_kk = $request->file('fc_kk')->store('uploads', 'private');
        $fc_akte_lahir = $request->file('fc_akte_lahir')->store('uploads', 'private');
        $fc_buku_nikah_ortu = $request->file('fc_buku_nikah_ortu')->store('uploads', 'private');
        $surat_pernyataan_ahli_waris = $request->file('surat_pernyataan_ahli_waris')->store('uploads', 'private');
        $pengantar_rt_rw = $request->file('pengantar_rt_rw')->store('uploads', 'private');

        // Simpan ke database
        SuratKeteranganTentangOrangTua::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'user_id' => auth()->id(), // Pastikan user login
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_lengkap' => $request->alamat_lengkap,
            'tempat_lahir' => $request->tempat_lahir,

            'fc_ktp' => $fc_ktp,
            'fc_kk' => $fc_kk,
            'fc_akte_lahir' => $fc_akte_lahir,
            'fc_buku_nikah_ortu' => $fc_buku_nikah_ortu,
            'surat_pernyataan_ahli_waris' => $surat_pernyataan_ahli_waris,
            'pengantar_rt_rw' => $pengantar_rt_rw,
            'status' => 'proses',
        ]);

        return redirect()->route('/dashboard')->with('success', 'Pengajuan berhasil dikirim.');
    }
   public function edit($id)
    {
        $surat = SuratKeteranganTentangOrangTua::findOrFail($id);
        return view('backend.pages.Keterangan_Orang_Tua.edit', compact('surat'));
    }

    public function update(Request $request, $id)
{
    $surat = SuratKeteranganTentangOrangTua::findOrFail($id);

    try {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:surat_keterangan_tentang_orang_tuas,nik,' . $id,
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'fc_ktp' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'fc_kk' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'fc_akte_lahir' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'fc_buku_nikah_ortu' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'surat_pernyataan_ahli_waris' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'pengantar_rt_rw' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:proses,selesai,ditolak', // tambah validasi status

            'catatan' => 'nullable|string',
        ]);

        foreach (['fc_ktp', 'fc_kk', 'fc_akte_lahir', 'fc_buku_nikah_ortu', 'surat_pernyataan_ahli_waris','pengantar_rt_rw'] as $field) {
            if ($request->hasFile($field)) {
                if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                    Storage::disk('private')->delete($surat->$field);
                }
                $validatedData[$field] = $request->file($field)->store('uploads', 'private');
            }
        }

        $surat->update($validatedData);

        return redirect()->route('surat-keterangan-orang-tua.index')
            ->with('success', 'Data berhasil diupdate.');

    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()
            ->withErrors($e->validator)
            ->withInput();
    }
}

    public function destroy($id)
    {
        $surat = SuratKeteranganTentangOrangTua::findOrFail($id);

        foreach (['fc_ktp', 'fc_kk', 'fc_akte_lahir', 'fc_buku_nikah_ortu', 'surat_pernyataan_ahli_waris','pengantar_rt_rw'] as $field) {
            if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                Storage::disk('private')->delete($surat->$field);
            }
        }

        $surat->delete();
        return redirect()->route('surat-keterangan-orang-tua.index')->with('success', 'Data berhasil dihapus.');
    }
}
