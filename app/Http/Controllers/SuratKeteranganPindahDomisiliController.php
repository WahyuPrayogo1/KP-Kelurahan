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

    public function create()
    {
        return view('backend.pages.Pindah_Domisili.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:surat_keterangan_pindah_domisilis,nik',
            'no_hp' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pernyataan_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan file upload
        $fotoKtpPath = $request->file('foto_ktp')->store('public/foto_ktp');
        $fotoKkPath = $request->file('foto_kartu_keluarga')->store('public/foto_kartu_keluarga');
        $fotoPernyataanPath = $request->file('foto_pernyataan_rt_rw')->store('public/foto_pernyataan_rt_rw');
        $fotoPengantarPath = $request->file('foto_pengantar_rt_rw')->store('public/foto_pengantar_rt_rw');

        // Simpan data ke database
        surat_keterangan_pindah_domisili::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_lengkap' => $request->alamat_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'foto_ktp' => $fotoKtpPath,
            'foto_kartu_keluarga' => $fotoKkPath,
            'foto_pernyataan_rt_rw' => $fotoPernyataanPath,
            'foto_pengantar_rt_rw' => $fotoPengantarPath,
            'status' => 'proses', // Default status
            'user_id' => auth()->id(), // Ambil ID user yang sedang login
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('keterangan_domisili.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $surat = SuratKeteranganPindahDomisili::findOrFail($id);
        return view('surat_keterangan_pindah_domisili.form', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $surat = SuratKeteranganPindahDomisili::findOrFail($id);
        $validatedData = $request->validate([
            // Sesuaikan dengan validasi yang diperlukan
        ]);

        // Handle file uploads
        if ($request->hasFile('foto_ktp')) {
            $validatedData['foto_ktp'] = $request->file('foto_ktp')->store('foto_ktp');
        }

        // Ulangi untuk file upload lainnya

        $surat->update($validatedData);
        return redirect()->route('surat.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $surat = SuratKeteranganPindahDomisili::findOrFail($id);
        $surat->delete();
        return redirect()->route('surat.index')->with('success', 'Data berhasil dihapus!');
    }

    function createUser()  {
        return view('pages.keterangan_domisili.index');
    }

    public function storeUser(Request $request)
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

        return redirect()->route('surat-keterangan-pindah.create')->with('success', 'Pengajuan berhasil dikirim.');
    }
}
