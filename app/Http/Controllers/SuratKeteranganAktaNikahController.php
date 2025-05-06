<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganAktaNikah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class SuratKeteranganAktaNikahController extends Controller
{
    // UNTUK ADMIN

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $absens = SuratKeteranganAktaNikah::with('user')->get();
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
                    return view('backend.pages.Akta_Nikah.actions', compact('row'));
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        }
        return view('backend.pages.Akta_Nikah.index');
    }

    public function create()
    {
        return view('backend.pages.Akta_Nikah.create');
    }

    public function edit($id)
    {
        $surat = SuratKeteranganAktaNikah::findOrFail($id);
        return view('backend.pages.Akta_Nikah.edit', compact('surat'));
    }


    public function update(Request $request, $id)
    {
        $surat = SuratKeteranganAktaNikah::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:surat_keterangan_akta_nikahs,nik,' . $id,
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_akta_kelahiran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_ijazah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_na_rt_rw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:proses,selesai,ditolak',
            'catatan' => 'nullable|string',
        ]);

        // Update file jika ada file baru
        $fileFields = [
            'foto_ktp',
            'foto_kartu_keluarga',
            'foto_akta_kelahiran',
            'foto_ijazah',
            'foto_pengantar_na_rt_rw',
            'foto_pengantar_rt_rw'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                    Storage::disk('private')->delete($surat->$field);
                }
                $validatedData[$field] = $request->file($field)->store('uploads', 'private');
            }
        }

        $surat->update($validatedData);

        return redirect()->route('keterangan_akta_nikah.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $surat = SuratKeteranganAktaNikah::findOrFail($id);

        $fileFields = [
            'foto_ktp',
            'foto_kartu_keluarga',
            'foto_akta_kelahiran',
            'foto_ijazah',
            'foto_pengantar_na_rt_rw',
            'foto_pengantar_rt_rw'
        ];

        foreach ($fileFields as $field) {
            if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                Storage::disk('private')->delete($surat->$field);
            }
        }

        $surat->delete();

        return redirect()->route('keterangan_akta_nikah.index')->with('success', 'Data berhasil dihapus!');
    }

    // UNTUK USER

    public function createUser()
    {
        return view('pages.akta_nikah.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:surat_keterangan_akta_nikahs,nik',
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_akta_kelahiran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_ijazah' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_na_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
        ]);

        $data = [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'user_id' => auth()->id(),
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_lengkap' => $request->alamat_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'foto_ktp' => $request->file('foto_ktp')->store('uploads', 'private'),
            'foto_kartu_keluarga' => $request->file('foto_kartu_keluarga')->store('uploads', 'private'),
            'foto_akta_kelahiran' => $request->file('foto_akta_kelahiran')->store('uploads', 'private'),
            'foto_ijazah' => $request->file('foto_ijazah')->store('uploads', 'private'),
            'foto_pengantar_na_rt_rw' => $request->file('foto_pengantar_na_rt_rw')->store('uploads', 'private'),
            'foto_pengantar_rt_rw' => $request->file('foto_pengantar_rt_rw')->store('uploads', 'private'),
            'status' => 'proses',
        ];

        SuratKeteranganAktaNikah::create($data);

        return redirect()->route('/dashboard')->with('success', 'Pengajuan berhasil dikirim.');
        }
}
