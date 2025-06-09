<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganBekerjaLuarNegeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Mpdf\Mpdf;

class SuratKeteranganBekerjaLuarNegeriController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(403, 'Unauthorized');
        }

        if ($request->ajax()) {
            $data = SuratKeteranganBekerjaLuarNegeri::with('user')->get();
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
                    return view('backend.pages.kerja_luar_negeri.actions', compact('row'));
                })
                ->rawColumns(['status', 'aksi']) // ini yang benar
                ->make(true);
        }

        return view('backend.pages.kerja_luar_negeri.index');
    }

    public function create()
    {
        return view('backend.pages.kerja_luar_negeri.create');
    }

    public function store(Request $request)
    {
        $customMessages = [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'max' => ':attribute maksimal :max karakter.',
            'digits' => ':attribute harus terdiri dari :digits digit.',
            'date' => ':attribute harus berupa tanggal yang valid.',
            'in' => ':attribute tidak valid.',
            'file' => ':attribute harus berupa file.',
            'mimes' => ':attribute harus berupa file dengan format jpeg, jpg, atau png.',
        ];

        $attributeNames = [
            'nama_pemohon' => 'Nama Pemohon',
            'nik_pemohon' => 'NIK Pemohon',
            'tempat_lahir_pemohon' => 'Tempat Lahir Pemohon',
            'tanggal_lahir_pemohon' => 'Tanggal Lahir Pemohon',
            'pekerjaan_pemohon' => 'Pekerjaan Pemohon',
            'status_perkawinan_pemohon' => 'Status Perkawinan Pemohon',
            'agama_pemohon' => 'Agama Pemohon',
            'alamat_pemohon' => 'Alamat Pemohon',
            'hubungan_dengan_pekerja' => 'Hubungan dengan Pekerja',
            'nama_pekerja' => 'Nama Pekerja',
            'nik_pekerja' => 'NIK Pekerja',
            'tempat_lahir_pekerja' => 'Tempat Lahir Pekerja',
            'tanggal_lahir_pekerja' => 'Tanggal Lahir Pekerja',
            'jenis_kelamin_pekerja' => 'Jenis Kelamin Pekerja',
            'kewarganegaraan_pekerja' => 'Kewarganegaraan Pekerja',
            'agama_pekerja' => 'Agama Pekerja',
            'alamat_pekerja' => 'Alamat Pekerja',
            'negara_tujuan' => 'Negara Tujuan',
            'fc_ktp' => 'Fotokopi KTP',
            'fc_kk' => 'Fotokopi KK',
            'surat_pernyataan_bekerja' => 'Surat Pernyataan Bekerja',
            'pengantar_rt_rw' => 'Surat Pengantar RT/RW',
        ];

        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'nik_pemohon' => 'required|digits:16',
            'tempat_lahir_pemohon' => 'required|string|max:255',
            'tanggal_lahir_pemohon' => 'required|date',
            'pekerjaan_pemohon' => 'required|string|max:255',
            'status_perkawinan_pemohon' => 'required|string|max:255',
            'agama_pemohon' => 'required|string|max:100',
            'alamat_pemohon' => 'required|string|max:500',
            'hubungan_dengan_pekerja' => 'required|in:orang tua,suami,istri,anak,saudara',
            'nama_pekerja' => 'required|string|max:255',
            'nik_pekerja' => 'required|digits:16',
            'tempat_lahir_pekerja' => 'required|string|max:255',
            'tanggal_lahir_pekerja' => 'required|date',
            'jenis_kelamin_pekerja' => 'required|in:L,P',
            'kewarganegaraan_pekerja' => 'required|string|max:100',
            'agama_pekerja' => 'required|string|max:100',
            'alamat_pekerja' => 'required|string|max:500',
            'negara_tujuan' => 'required|string|max:255',
            'fc_ktp' => 'required|file|mimes:jpeg,jpg,png|max:2048',
            'fc_kk' => 'required|file|mimes:jpeg,jpg,png|max:2048',
            'surat_pernyataan_bekerja' => 'required|file|mimes:jpeg,jpg,png|max:2048',
            'pengantar_rt_rw' => 'required|file|mimes:jpeg,jpg,png|max:2048',
        ], $customMessages, $attributeNames);

        // Upload dokumen
        foreach (['fc_ktp', 'fc_kk', 'surat_pernyataan_bekerja', 'pengantar_rt_rw'] as $field) {
            $validated[$field] = $request->file($field)->store('uploads', 'private');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'proses';

        SuratKeteranganBekerjaLuarNegeri::create($validated);

        return redirect()->route('/dashboard')->with('success', 'Pengajuan berhasil dikirim.');
    }

    public function show($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404);
        }

        $surat = SuratKeteranganBekerjaLuarNegeri::findOrFail($id);
        return view('backend.pages.kerja_luar_negeri.show', compact('surat'));
    }

    public function edit($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404);
        }

        $surat = SuratKeteranganBekerjaLuarNegeri::findOrFail($id);
        return view('backend.pages.kerja_luar_negeri.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404);
        }

        $surat = SuratKeteranganBekerjaLuarNegeri::findOrFail($id);

        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'nik_pemohon' => 'required|digits:16',
            'tempat_lahir_pemohon' => 'required|string|max:255',
            'tanggal_lahir_pemohon' => 'required|date',
            'pekerjaan_pemohon' => 'required|string|max:255',
            'status_perkawinan_pemohon' => 'required|string|max:255',
            'agama_pemohon' => 'required|string|max:100',
            'alamat_pemohon' => 'required|string|max:500',
            'hubungan_dengan_pekerja' => 'required|in:orang tua,suami,istri,anak,saudara',
            'nama_pekerja' => 'required|string|max:255',
            'nik_pekerja' => 'required|digits:16',
            'tempat_lahir_pekerja' => 'required|string|max:255',
            'tanggal_lahir_pekerja' => 'required|date',
            'jenis_kelamin_pekerja' => 'required|in:L,P',
            'kewarganegaraan_pekerja' => 'required|string|max:100',
            'agama_pekerja' => 'required|string|max:100',
            'alamat_pekerja' => 'required|string|max:500',
            'negara_tujuan' => 'required|string|max:255',
            'status' => 'required|in:proses,selesai,ditolak',
            'catatan' => 'nullable|string|max:1000',
            'fc_ktp' => 'nullable|file|mimes:jpeg,jpg,png|max:2048',
            'fc_kk' => 'nullable|file|mimes:jpeg,jpg,png|max:2048',
            'surat_pernyataan_bekerja' => 'nullable|file|mimes:jpeg,jpg,png|max:2048',
            'pengantar_rt_rw' => 'nullable|file|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Jika ada file baru, hapus yang lama dan upload yang baru
        foreach (['fc_ktp', 'fc_kk', 'surat_pernyataan_bekerja', 'pengantar_rt_rw'] as $file) {
            if ($request->hasFile($file)) {
                if ($surat->$file && Storage::disk('private')->exists($surat->$file)) {
                    Storage::disk('private')->delete($surat->$file);
                }
                $validated[$file] = $request->file($file)->store('uploads', 'private');
            } else {
                // Jangan timpa field jika tidak upload baru
                unset($validated[$file]);
            }
        }

        $surat->update($validated);

        return redirect()->route('surat-bekerja-luar-negeri.index')
            ->with('success', 'Data surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404);
        }

        $surat = SuratKeteranganBekerjaLuarNegeri::findOrFail($id);

        foreach (['fc_ktp', 'fc_kk', 'surat_pernyataan_bekerja', 'pengantar_rt_rw'] as $file) {
            if ($surat->$file && Storage::disk('private')->exists($surat->$file)) {
                Storage::disk('private')->delete($surat->$file);
            }
        }

        $surat->delete();

        return redirect()->route('surat-bekerja-luar-negeri.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    public function previewPdf($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        $surat = SuratKeteranganBekerjaLuarNegeri::findOrFail($id);

        return view('backend.pages.kerja_luar_negeri.preview-pdf', compact('surat'));
    }

public function generatePDF(Request $request, $id)
{
    // Cek hanya untuk admin
    if (!auth()->check() || !auth()->user()->hasRole('Admin')) {
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }

    // Validasi input dari form
    $validatedData = $request->validate([
        'nomor_surat' => 'required|string|max:255',
        'tanggal_surat' => 'required|date',
        'nomor_pengantar_rt_rw' => 'required|string|max:255',
        'tanggal_pengantar_rt_rw' => 'required|date',
        'rt' => 'required|string|max:10',
        'rw' => 'required|string|max:10',
        'berlaku_sampai' => 'required|date',
    ], [
        'nomor_surat.required' => 'Nomor Surat wajib diisi.',
        'tanggal_surat.required' => 'Tanggal Surat wajib diisi.',
        'nomor_pengantar_rt_rw.required' => 'Nomor Pengantar RT/RW wajib diisi.',
        'tanggal_pengantar_rt_rw.required' => 'Tanggal Pengantar RT/RW wajib diisi.',
        'rt.required' => 'RT wajib diisi.',
        'rw.required' => 'RW wajib diisi.',
        'berlaku_sampai.required' => 'Tanggal berlaku sampai wajib diisi.',
    ]);

    // Ambil data dari model
    $surat = SuratKeteranganBekerjaLuarNegeri::findOrFail($id);

    // Gabungkan data ke view
    $data = [
        'surat' => $surat,
        'nomor_surat' => $validatedData['nomor_surat'],
        'tanggal_surat' => $validatedData['tanggal_surat'],
        'nomor_pengantar_rt_rw' => $validatedData['nomor_pengantar_rt_rw'],
        'tanggal_pengantar_rt_rw' => $validatedData['tanggal_pengantar_rt_rw'],
        'rt' => $validatedData['rt'],
        'rw' => $validatedData['rw'],
        'berlaku_sampai' => $validatedData['berlaku_sampai'],
    ];

    // Konfigurasi mPDF
    $mpdf = new Mpdf([
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

    // Render Blade template ke HTML
    $html = view('backend.pages.kerja_luar_negeri.pdf.surat', $data)->render();
    $mpdf->WriteHTML($html);

    // Tampilkan PDF di browser
    return $mpdf->Output('Surat-Keterangan-Bekerja-Luar-Negeri-' . $surat->id . '.pdf', \Mpdf\Output\Destination::INLINE);
}

}

