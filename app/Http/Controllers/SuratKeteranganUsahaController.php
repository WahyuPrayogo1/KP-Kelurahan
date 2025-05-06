<?php

namespace App\Http\Controllers;

use App\Models\surat_keterangan_usaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SuratKeteranganUsahaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = surat_keterangan_usaha::with('user')->get();
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
                    return view('backend.pages.Usaha.action', compact('row'));
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        }

        return view('backend.pages.Usaha.index');
    }

    public function create()
    {
        return view('backend.pages.Usaha.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:surat_keterangan_usahas,nik',
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pernyataan_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_usaha' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
        ]);

        $data = [];
        foreach (['foto_ktp', 'foto_kartu_keluarga', 'foto_pernyataan_rt_rw', 'foto_pengantar_rt_rw', 'foto_usaha'] as $field) {
            $data[$field] = $request->file($field)->store('uploads', 'private');
        }

        surat_keterangan_usaha::create(array_merge([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'user_id' => auth()->id(),
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_lengkap' => $request->alamat_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'status' => 'proses',
            'catatan' => $request->catatan,
        ], $data));

        return redirect()->route('/dashboard')->with('success', 'Pengajuan surat berhasil dikirim.');
    }

    public function edit($id)
    {
        $surat = surat_keterangan_usaha::findOrFail($id);
        return view('backend.pages.Usaha.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $surat = surat_keterangan_usaha::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:surat_keterangan_usahas,nik,' . $id,
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pernyataan_rt_rw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_usaha' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
        ]);

        foreach (['foto_ktp', 'foto_kartu_keluarga', 'foto_pernyataan_rt_rw', 'foto_pengantar_rt_rw', 'foto_usaha'] as $field) {
            if ($request->hasFile($field)) {
                if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                    Storage::disk('private')->delete($surat->$field);
                }
                $validatedData[$field] = $request->file($field)->store('uploads', 'private');
            }
        }

        $surat->update($validatedData);
        return redirect()->route('keterangan_usaha.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $surat = surat_keterangan_usaha::findOrFail($id);

        foreach (['foto_ktp', 'foto_kartu_keluarga', 'foto_pernyataan_rt_rw', 'foto_pengantar_rt_rw', 'foto_usaha'] as $field) {
            if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                Storage::disk('private')->delete($surat->$field);
            }
        }

        $surat->delete();
        return redirect()->route('keterangan_usaha.index')->with('success', 'Data berhasil dihapus.');
    }

    // Untuk User
    public function createUser()
    {
        return view('pages.keterangan_usaha.index');
    }

    public function storeUser(Request $request)
    {
        $this->store($request); // Reuse fungsi store
    }
}
