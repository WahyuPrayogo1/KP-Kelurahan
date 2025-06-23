<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganBekerjaLuarNegeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Http;

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
        $messages = [
            'nama_pemohon.required' => 'Nama Pemohon wajib diisi.',
            'nama_pemohon.max' => 'Nama Pemohon tidak boleh lebih dari 255 karakter.',

            'nik_pemohon.required' => 'NIK Pemohon wajib diisi.',
            'nik_pemohon.digits' => 'NIK Pemohon harus terdiri dari 16 digit.',

            'tempat_lahir_pemohon.required' => 'Tempat lahir Pemohon wajib diisi.',
            'tempat_lahir_pemohon.max' => 'Tempat lahir Pemohon tidak boleh lebih dari 255 karakter.',

            'tanggal_lahir_pemohon.required' => 'Tanggal lahir Pemohon wajib diisi.',
            'tanggal_lahir_pemohon.date' => 'Tanggal lahir Pemohon harus berupa tanggal yang valid.',

            'pekerjaan_pemohon.required' => 'Pekerjaan Pemohon wajib diisi.',
            'pekerjaan_pemohon.max' => 'Pekerjaan Pemohon tidak boleh lebih dari 255 karakter.',

            'status_perkawinan_pemohon.required' => 'Status perkawinan Pemohon wajib diisi.',
            'status_perkawinan_pemohon.max' => 'Status perkawinan Pemohon tidak boleh lebih dari 255 karakter.',

            'agama_pemohon.required' => 'Agama Pemohon wajib diisi.',
            'agama_pemohon.max' => 'Agama Pemohon tidak boleh lebih dari 100 karakter.',

            'alamat_pemohon.required' => 'Alamat Pemohon wajib diisi.',
            'alamat_pemohon.max' => 'Alamat Pemohon tidak boleh lebih dari 500 karakter.',

            'hubungan_dengan_pekerja.required' => 'Hubungan dengan Pekerja wajib dipilih.',
            'hubungan_dengan_pekerja.in' => 'Hubungan dengan Pekerja tidak valid.',

            'nama_pekerja.required' => 'Nama Pekerja wajib diisi.',
            'nama_pekerja.max' => 'Nama Pekerja tidak boleh lebih dari 255 karakter.',

            'nik_pekerja.required' => 'NIK Pekerja wajib diisi.',
            'nik_pekerja.digits' => 'NIK Pekerja harus terdiri dari 16 digit.',

            'tempat_lahir_pekerja.required' => 'Tempat lahir Pekerja wajib diisi.',
            'tempat_lahir_pekerja.max' => 'Tempat lahir Pekerja tidak boleh lebih dari 255 karakter.',

            'tanggal_lahir_pekerja.required' => 'Tanggal lahir Pekerja wajib diisi.',
            'tanggal_lahir_pekerja.date' => 'Tanggal lahir Pekerja harus berupa tanggal yang valid.',

            'jenis_kelamin_pekerja.required' => 'Jenis kelamin Pekerja wajib dipilih.',
            'jenis_kelamin_pekerja.in' => 'Jenis kelamin Pekerja harus berupa L atau P.',

            'kewarganegaraan_pekerja.required' => 'Kewarganegaraan Pekerja wajib diisi.',
            'kewarganegaraan_pekerja.max' => 'Kewarganegaraan Pekerja tidak boleh lebih dari 100 karakter.',

            'agama_pekerja.required' => 'Agama Pekerja wajib diisi.',
            'agama_pekerja.max' => 'Agama Pekerja tidak boleh lebih dari 100 karakter.',

            'alamat_pekerja.required' => 'Alamat Pekerja wajib diisi.',
            'alamat_pekerja.max' => 'Alamat Pekerja tidak boleh lebih dari 255 karakter.',

            'rt_pekerja.required' => 'RT Pekerja wajib diisi.',
            'rt_pekerja.digits_between' => 'RT Pekerja harus berupa 1 sampai 3 digit angka.',

            'rw_pekerja.required' => 'RW Pekerja wajib diisi.',
            'rw_pekerja.digits_between' => 'RW Pekerja harus berupa 1 sampai 3 digit angka.',

            'negara_tujuan.required' => 'Negara Tujuan wajib diisi.',
            'negara_tujuan.max' => 'Negara Tujuan tidak boleh lebih dari 255 karakter.',

            'fc_ktp.required' => 'Fotokopi KTP wajib diunggah.',
            'fc_ktp.image' => 'Fotokopi KTP harus berupa gambar.',
            'fc_ktp.mimes' => 'Fotokopi KTP harus bertipe file: jpeg, png, jpg.',
            'fc_ktp.max' => 'Ukuran Fotokopi KTP tidak boleh lebih dari 2MB.',

            'fc_kk.required' => 'Fotokopi KK wajib diunggah.',
            'fc_kk.image' => 'Fotokopi KK harus berupa gambar.',
            'fc_kk.mimes' => 'Fotokopi KK harus bertipe file: jpeg, png, jpg.',
            'fc_kk.max' => 'Ukuran Fotokopi KK tidak boleh lebih dari 2MB.',

            'surat_pernyataan_bekerja.required' => 'Surat Pernyataan Bekerja wajib diunggah.',
            'surat_pernyataan_bekerja.image' => 'Surat Pernyataan Bekerja harus berupa gambar.',
            'surat_pernyataan_bekerja.mimes' => 'Surat Pernyataan Bekerja harus bertipe file: jpeg, png, jpg.',
            'surat_pernyataan_bekerja.max' => 'Ukuran Surat Pernyataan Bekerja tidak boleh lebih dari 2MB.',

            'pengantar_rt_rw.required' => 'Surat Pengantar RT/RW wajib diunggah.',
            'pengantar_rt_rw.image' => 'Surat Pengantar RT/RW harus berupa gambar.',
            'pengantar_rt_rw.mimes' => 'Surat Pengantar RT/RW harus bertipe file: jpeg, png, jpg.',
            'pengantar_rt_rw.max' => 'Ukuran Surat Pengantar RT/RW tidak boleh lebih dari 2MB.',
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
            'alamat_pekerja' => 'required|string|max:255',
            'rt_pekerja' => 'required|digits_between:1,3',
            'rw_pekerja' => 'required|digits_between:1,3',
            'negara_tujuan' => 'required|string|max:255',

            'fc_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'fc_kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'surat_pernyataan_bekerja' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], $messages);

        // Gabungkan alamat lengkap pekerja
        $validated['alamat_pekerja'] = $request->alamat_pekerja . ', RT ' . $request->rt_pekerja . '/RW ' . $request->rw_pekerja;

        // Upload file
        foreach ([
            'fc_ktp',
            'fc_kk',
            'surat_pernyataan_bekerja',
            'pengantar_rt_rw'
        ] as $field) {
            $validated[$field] = $request->file($field)->store('uploads', 'private');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'proses';

        // Simpan ke database
        SuratKeteranganBekerjaLuarNegeri::create($validated);

        return redirect()->route('/dashboard')->with('success', 'Pengajuan Surat Keterangan Bekerja Luar Negeri berhasil dikirim.');
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
        $previousStatus = $surat->status; // Simpan status sebelumnya

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
        // Kirim notifikasi hanya jika status berubah
        if ($previousStatus != $request->status) {
            if ($request->status == 'ditolak') {
                $this->sendRejectionNotification($surat);
            } elseif ($request->status == 'selesai') {
                $this->sendSelesaiNotification($surat);
            }
        }

        return redirect()->route('surat-bekerja-luar-negeri.index')
            ->with('success', 'Data surat berhasil diperbarui.');
    }

        protected function sendRejectionNotification(SuratKeteranganBekerjaLuarNegeri $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Mohon maaf, pengajuan Surat Keterangan Bekerja Luar Negeri Anda *DITOLAK*.\n";
        $message .= "Alasan penolakan: {$surat->catatan}\n\n";
        $message .= "Silakan perbaiki dan ajukan kembali.\n\n";
        $message .= "Salam,\nAdmin Subang Jaya";

        try {
            $response = Http::withHeaders([
                'Authorization' => env('WABLAS_TOKEN') . '.' . env('WABLAS_SECRET_KEY'),
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->asForm()->post(env('WABLAS_URL') . '/api/send-message', [
                'phone' => $whatsappNumber,
                'message' => $message
            ]);

            if (!$response->successful()) {
                \Log::error('Gagal mengirim notifikasi penolakan', [
                    'response' => $response->body(),
                    'user_id' => $user->id,
                    'surat_id' => $surat->id
                ]);
            }

        } catch (\Exception $e) {
            \Log::error('Error mengirim notifikasi WhatsApp: ' . $e->getMessage());
        }
    }

    protected function sendSelesaiNotification(SuratKeteranganBekerjaLuarNegeri $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Pengajuan Surat Keterangan Bekerja Luar Negeri *SELESAI*.\n";
        $message .= "Silakan datang ke Kelurahan Subang Jaya untuk mengambil surat tersebut\n\n";
        $message .= "Salam,\nAdmin Subang Jaya";

        try {
            $response = Http::withHeaders([
                'Authorization' => env('WABLAS_TOKEN') . '.' . env('WABLAS_SECRET_KEY'),
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->asForm()->post(env('WABLAS_URL') . '/api/send-message', [
                'phone' => $whatsappNumber,
                'message' => $message
            ]);

            if (!$response->successful()) {
                \Log::error('Gagal mengirim notifikasi penolakan', [
                    'response' => $response->body(),
                    'user_id' => $user->id,
                    'surat_id' => $surat->id
                ]);
            }

        } catch (\Exception $e) {
            \Log::error('Error mengirim notifikasi WhatsApp: ' . $e->getMessage());
        }
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

