<?php

namespace App\Http\Controllers;

use App\Models\SuratPengantarIjinKeramaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class SuratPengantarIjinKeramaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $absens = SuratPengantarIjinKeramaian::with('user')->get();
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
                    return view('backend.pages.Ijin_Keramain.actions', compact('row'));
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        }
        return view('backend.pages.Ijin_Keramain.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('backend.pages.Ijin_Keramain.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:surat_pengantar_ijin_keramaians,nik',
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pernyataan_tetangga' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
        ]);

        // Upload file
        $foto_ktp = $request->file('foto_ktp')->store('uploads', 'private');
        $foto_kartu_keluarga = $request->file('foto_kartu_keluarga')->store('uploads', 'private');
        $foto_pernyataan_tetangga = $request->file('foto_pernyataan_tetangga')->store('uploads', 'private');
        $foto_pengantar_rt_rw = $request->file('foto_pengantar_rt_rw')->store('uploads', 'private');

        // Simpan ke database
        SuratPengantarIjinKeramaian::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'user_id' => auth()->id(), // Pastikan user login
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_lengkap' => $request->alamat_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'foto_ktp' => $foto_ktp,
            'foto_kartu_keluarga' => $foto_kartu_keluarga,
            'foto_pernyataan_tetangga' => $foto_pernyataan_tetangga,
            'foto_pengantar_rt_rw' => $foto_pengantar_rt_rw,
            'status' => 'proses',
        ]);

        return redirect()->route('/dashboard')->with('success', 'Pengajuan berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratPengantarIjinKeramaian $suratPengantarIjinKeramaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $surat = SuratPengantarIjinKeramaian::findOrFail($id);
        return view('backend.pages.Ijin_Keramain.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $surat = SuratPengantarIjinKeramaian::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:surat_keterangan_usahas,nik,' . $id,
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pernyataan_tetangga' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:proses,selesai,ditolak', // tambah validasi status
            'catatan' => 'nullable|string',
        ]);

        foreach (['foto_ktp', 'foto_kartu_keluarga', 'foto_pernyataan_tetangga', 'foto_pengantar_rt_rw'] as $field) {
            if ($request->hasFile($field)) {
                if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                    Storage::disk('private')->delete($surat->$field);
                }
                $validatedData[$field] = $request->file($field)->store('uploads', 'private');
            }
        }

        $surat->update($validatedData);
        return redirect()->route('surat_pengantar_ijin_keramaian.index')->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $surat = SuratPengantarIjinKeramaian::findOrFail($id);

        foreach (['foto_ktp', 'foto_kartu_keluarga', 'foto_pernyataan_tetangga', 'foto_pengantar_rt_rw'] as $field) {
            if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                Storage::disk('private')->delete($surat->$field);
            }
        }

        $surat->delete();
        return redirect()->route('surat_pengantar_ijin_keramaian.index')->with('success', 'Data berhasil dihapus.');
    }
}
