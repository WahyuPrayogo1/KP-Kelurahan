<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganAktaNikah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Mpdf\Mpdf;

class SuratKeteranganAktaNikahController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(403, 'Unauthorized');
        }

        if ($request->ajax()) {
            $data = SuratKeteranganAktaNikah::with('user')->get();
            return DataTables::of($data)
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
                ->addColumn('aksi', function ($row) {
                    return view('backend.pages.akta_nikah.actions', compact('row'));
                })
                ->rawColumns(['status', 'aksi']) // ini yang benar
                ->make(true);
        }

        return view('backend.pages.akta_nikah.index');
    }

    public function create()
    {
        return view('backend.pages.akta_nikah.create');
    }

    public function store(Request $request)
    {
         $messages = [
        'foto_ktp.image' => 'Foto KTP harus berupa gambar.',
        'foto_ktp.mimes' => 'Foto KTP harus bertipe file: jpeg, png, jpg.',
        
        'foto_kartu_keluarga.image' => 'Foto Kartu Keluarga harus berupa gambar.',
        'foto_kartu_keluarga.mimes' => 'Foto Kartu Keluarga harus bertipe file: jpeg, png, jpg.',

        'foto_surat_pernyataan_nikah.image' => 'Foto Surat Pernyataan Nikah harus berupa gambar.',
        'foto_surat_pernyataan_nikah.mimes' => 'Foto Surat Pernyataan Nikah harus bertipe file: jpeg, png, jpg.',

        'foto_surat_pengantar_rt_rw.image' => 'Foto Surat Pengantar RT/RW harus berupa gambar.',
        'foto_surat_pengantar_rt_rw.mimes' => 'Foto Surat Pengantar RT/RW harus bertipe file: jpeg, png, jpg.',
    ];
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:255|unique:surat_keterangan_akta_nikahs,nik',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:100',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string|max:100',
            'alamat_lengkap' => 'required|string',
            'no_kk' => 'required|string|max:255',
            'no_pengantar_rt_rw' => 'nullable|string|max:255',
            'tanggal_pengantar_rt_rw' => 'nullable|date',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_surat_pernyataan_nikah' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_surat_pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
        ], $messages);

        // Upload files ke storage disk 'public' (atau disk sesuai konfigurasi Anda)
        foreach ([
            'foto_ktp',
            'foto_kartu_keluarga',
            'foto_surat_pernyataan_nikah',
            'foto_surat_pengantar_rt_rw'
        ] as $fileField) {
            $validated[$fileField] = $request->file($fileField)->store('uploads/akta_nikah', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'proses';

        SuratKeteranganAktaNikah::create($validated);

        return redirect()->route('/dashboard')->with('success', 'Pengajuan Surat Keterangan Akta Nikah berhasil dikirim.');
    }

    public function show($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(403, 'Unauthorized');
        }

        $surat = SuratKeteranganAktaNikah::findOrFail($id);

        return view('backend.pages.akta_nikah.show', compact('surat'));
    }

    public function edit($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(403, 'Unauthorized');
        }

        $surat = SuratKeteranganAktaNikah::findOrFail($id);

        return view('backend.pages.akta_nikah.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(403, 'Unauthorized');
        }

        $surat = SuratKeteranganAktaNikah::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:255|unique:surat_keterangan_akta_nikahs,nik,' . $surat->id,
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:100',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string|max:100',
            'alamat_lengkap' => 'required|string',
            'no_kk' => 'required|string|max:255',
            'no_pengantar_rt_rw' => 'nullable|string|max:255',
            'tanggal_pengantar_rt_rw' => 'nullable|date',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_surat_pernyataan_nikah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_surat_pengantar_rt_rw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:proses,selesai,ditolak',
            'catatan' => 'nullable|string',
            'tanggal_dikeluarkan' => 'nullable|date',
        ]);

        // Cek dan update file jika ada upload baru, hapus file lama
        foreach ([
            'foto_ktp',
            'foto_kartu_keluarga',
            'foto_surat_pernyataan_nikah',
            'foto_surat_pengantar_rt_rw'
        ] as $fileField) {
            if ($request->hasFile($fileField)) {
                if ($surat->$fileField && Storage::disk('public')->exists($surat->$fileField)) {
                    Storage::disk('public')->delete($surat->$fileField);
                }
                $validated[$fileField] = $request->file($fileField)->store('uploads/akta_nikah', 'public');
            } else {
                $validated[$fileField] = $surat->$fileField;
            }
        }

        $surat->update($validated);

        return redirect()->route('keterangan_akta_nikah.index')->with('success', 'Data Surat Keterangan Akta Nikah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(403, 'Unauthorized');
        }

        $surat = SuratKeteranganAktaNikah::findOrFail($id);

        foreach ([
            'foto_ktp',
            'foto_kartu_keluarga',
            'foto_surat_pernyataan_nikah',
            'foto_surat_pengantar_rt_rw'
        ] as $fileField) {
            if ($surat->$fileField && Storage::disk('public')->exists($surat->$fileField)) {
                Storage::disk('public')->delete($surat->$fileField);
            }
        }

        $surat->delete();

        return redirect()->route('keterangan_akta_nikah.index')->with('success', 'Data berhasil dihapus.');
    }

    public function previewPdf($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        $surat = SuratKeteranganAktaNikah::findOrFail($id);

        return view('backend.pages.akta_nikah.preview-pdf', compact('surat'));
    }

    public function generatePdf(Request $request, $id)
    {
        // Cek hanya untuk admin
        if (!auth()->user()->hasRole('Admin')) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        // Validasi input dari form
        $validatedData = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'nomor_surat_pengantar' => 'required|string|max:255',
            'tanggal_surat_pengantar' => 'required|date',
        ], [
            'nomor_surat.required' => 'Nomor Surat wajib diisi.',
            'tanggal_surat.required' => 'Tanggal Surat wajib diisi.',
            'nomor_surat_pengantar.required' => 'Nomor Surat Pengantar RT/RW wajib diisi.',
            'tanggal_surat_pengantar.required' => 'Tanggal Surat Pengantar RT/RW wajib diisi.',
        ]);

        // Ambil data utama dari database
        $surat = SuratKeteranganAktaNikah::findOrFail($id);

        // Siapkan data untuk view PDF (termasuk input dari request)
        $data = [
            'surat' => $surat,
            'nomor_surat' => $validatedData['nomor_surat'],
            'tanggal_surat' => $validatedData['tanggal_surat'],
            'nomor_surat_pengantar' => $validatedData['nomor_surat_pengantar'],
            'tanggal_surat_pengantar' => $validatedData['tanggal_surat_pengantar'],
        ];

        // Konfigurasi PDF
        $mpdf = new \Mpdf\Mpdf([
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

        // Render Blade template menjadi HTML
        $html = view('backend.pages.akta_nikah.pdf.surat', $data)->render();
        $mpdf->WriteHTML($html);

        // Tampilkan PDF langsung di browser
        return $mpdf->Output('Surat-Keterangan-Akta-Nikah-' . $surat->id . '.pdf', \Mpdf\Output\Destination::INLINE);
    }

}
