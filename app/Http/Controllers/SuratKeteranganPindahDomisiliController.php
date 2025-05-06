<?php

namespace App\Http\Controllers;

use App\Models\surat_keterangan_pindah_domisili;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class SuratKeteranganPindahDomisiliController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $absens = surat_keterangan_pindah_domisili::with('user')->get();
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
                    return view('backend.pages.Pindah_Domisili.actions', compact('row'));
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        }
        return view('backend.pages.Pindah_Domisili.index');
    }



    public function edit($id)
    {
        $surat = surat_keterangan_pindah_domisili::findOrFail($id);
        return view('backend.pages.Pindah_Domisili.edit', compact('surat'));
    }

    public function create(){
        return view('backend.pages.Pindah_Domisili.create');
    }

    public function update(Request $request, $id)
    {
        $surat = surat_keterangan_pindah_domisili::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:surat_keterangan_pindah_domisilis,nik,' . $id,
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pernyataan_rt_rw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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

        if ($request->hasFile('foto_kartu_keluarga')) {
            if ($surat->foto_kartu_keluarga && Storage::disk('private')->exists($surat->foto_kartu_keluarga)) {
                Storage::disk('private')->delete($surat->foto_kartu_keluarga);
            }
            $validatedData['foto_kartu_keluarga'] = $request->file('foto_kartu_keluarga')->store('uploads', 'private');
        }

        if ($request->hasFile('foto_pernyataan_rt_rw')) {
            if ($surat->foto_pernyataan_rt_rw && Storage::disk('private')->exists($surat->foto_pernyataan_rt_rw)) {
                Storage::disk('private')->delete($surat->foto_pernyataan_rt_rw);
            }
            $validatedData['foto_pernyataan_rt_rw'] = $request->file('foto_pernyataan_rt_rw')->store('uploads', 'private');
        }

        if ($request->hasFile('foto_pengantar_rt_rw')) {
            if ($surat->foto_pengantar_rt_rw && Storage::disk('private')->exists($surat->foto_pengantar_rt_rw)) {
                Storage::disk('private')->delete($surat->foto_pengantar_rt_rw);
            }
            $validatedData['foto_pengantar_rt_rw'] = $request->file('foto_pengantar_rt_rw')->store('uploads', 'private');
        }

        $surat->update($validatedData);

        return redirect()->route('keterangan_domisili.index')->with('success', 'Data berhasil diupdate!');
    }



    public function destroy($id)
    {
        $surat = surat_keterangan_pindah_domisili::findOrFail($id);

        // Hapus semua file terkait jika ada
        $fileFields = [
            'foto_ktp',
            'foto_kartu_keluarga',
            'foto_pernyataan_rt_rw',
            'foto_pengantar_rt_rw',
        ];

        foreach ($fileFields as $field) {
            if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                Storage::disk('private')->delete($surat->$field);
            }
        }

        // Hapus data dari database
        $surat->delete();

        return redirect()->route('keterangan_domisili.index')->with('success', 'Data berhasil dihapus!');
    }




    // UNTUK USER

    function createUser()  {
        return view('pages.keterangan_domisili.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:surat_keterangan_pindah_domisilis,nik',
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pernyataan_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
        ]);

        // Upload file
        $foto_ktp = $request->file('foto_ktp')->store('uploads', 'private');
        $foto_kartu_keluarga = $request->file('foto_kartu_keluarga')->store('uploads', 'private');
        $foto_pernyataan_rt_rw = $request->file('foto_pernyataan_rt_rw')->store('uploads', 'private');
        $foto_pengantar_rt_rw = $request->file('foto_pengantar_rt_rw')->store('uploads', 'private');

        // Simpan ke database
        surat_keterangan_pindah_domisili::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'user_id' => auth()->id(), // Pastikan user login
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_lengkap' => $request->alamat_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'foto_ktp' => $foto_ktp,
            'foto_kartu_keluarga' => $foto_kartu_keluarga,
            'foto_pernyataan_rt_rw' => $foto_pernyataan_rt_rw,
            'foto_pengantar_rt_rw' => $foto_pengantar_rt_rw,
            'status' => 'proses',
        ]);

        return redirect()->route('/dashboard')->with('success', 'Pengajuan berhasil dikirim.');
    }
}
