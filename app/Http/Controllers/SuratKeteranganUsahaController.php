<?php

namespace App\Http\Controllers;

use App\Models\surat_keterangan_usaha;
use Illuminate\Http\Request;

class SuratKeteranganUsahaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SuratKeteranganUsaha::with('user')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('surat-keterangan-usaha.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="' . $row->id . '">Hapus</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.pages.Keterangan_Usaha.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.Pindah_Domisili.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'nik' => 'required|numeric|unique:surat_keterangan_usahas,nik',
            'no_hp' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pernyataan_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_foto_usaha' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $data = $request->all();
        foreach (['foto_ktp', 'foto_kartu_keluarga', 'foto_pernyataan_rt_rw', 'foto_pengantar_rt_rw', 'foto_foto_usaha'] as $foto) {
            if ($request->hasFile($foto)) {
                $data[$foto] = $request->file($foto)->store('uploads', 'public');
            }
        }

        SuratKeteranganUsaha::create($data);
        return redirect()->route('surat-keterangan-usaha.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(surat_keterangan_usaha $surat_keterangan_usaha)
    {
        //
    }

    public function edit($id)
    {
        $data = SuratKeteranganUsaha::findOrFail($id);
        return view('backend.pages.Keterangan_Usaha.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = SuratKeteranganUsaha::findOrFail($id);
        $request->validate([
            'nama' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'nik' => 'required|numeric|unique:surat_keterangan_usahas,nik,' . $id,
            'no_hp' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string',
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $data->update($request->all());
        return redirect()->route('surat-keterangan-usaha.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        SuratKeteranganUsaha::findOrFail($id)->delete();
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
