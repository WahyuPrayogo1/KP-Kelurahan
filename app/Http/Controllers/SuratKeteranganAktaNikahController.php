<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganAktaNikah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Http;

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
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'nik.required' => 'NIK wajib diisi.',
            'nik.max' => 'NIK tidak boleh lebih dari 16 karakter.',

            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 255 karakter.',

            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa format tanggal yang valid.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus berupa L atau P.',

            'agama.required' => 'Agama wajib diisi.',
            'agama.max' => 'Agama tidak boleh lebih dari 100 karakter.',

            'status_perkawinan.required' => 'Status perkawinan wajib dipilih.',
            'status_perkawinan.in' => 'Status perkawinan tidak valid.',

            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'pekerjaan.max' => 'Pekerjaan tidak boleh lebih dari 255 karakter.',

            'kewarganegaraan.required' => 'Kewarganegaraan wajib diisi.',
            'kewarganegaraan.max' => 'Kewarganegaraan tidak boleh lebih dari 100 karakter.',

            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',

            'rt.required' => 'RT wajib diisi.',
            'rt.digits_between' => 'RT harus berupa 1 sampai 3 digit angka.',

            'rw.required' => 'RW wajib diisi.',
            'rw.digits_between' => 'RW harus berupa 1 sampai 3 digit angka.',

            'no_kk.required' => 'Nomor KK wajib diisi.',
            'no_kk.max' => 'Nomor KK tidak boleh lebih dari 16 karakter.',

            'no_pengantar_rt_rw.max' => 'Nomor surat pengantar RT/RW tidak boleh lebih dari 255 karakter.',
            'tanggal_pengantar_rt_rw.date' => 'Tanggal surat pengantar RT/RW harus berupa tanggal yang valid.',

            'foto_ktp.required' => 'Foto KTP wajib diunggah.',
            'foto_ktp.image' => 'Foto KTP harus berupa gambar.',
            'foto_ktp.mimes' => 'Foto KTP harus bertipe file: jpeg, png, jpg.',
            'foto_ktp.max' => 'Ukuran Foto KTP tidak boleh lebih dari 2MB.',

            'foto_kartu_keluarga.required' => 'Foto Kartu Keluarga wajib diunggah.',
            'foto_kartu_keluarga.image' => 'Foto Kartu Keluarga harus berupa gambar.',
            'foto_kartu_keluarga.mimes' => 'Foto Kartu Keluarga harus bertipe file: jpeg, png, jpg.',
            'foto_kartu_keluarga.max' => 'Ukuran Foto Kartu Keluarga tidak boleh lebih dari 2MB.',

            'foto_surat_pernyataan_nikah.required' => 'Foto Surat Pernyataan Nikah wajib diunggah.',
            'foto_surat_pernyataan_nikah.image' => 'Foto Surat Pernyataan Nikah harus berupa gambar.',
            'foto_surat_pernyataan_nikah.mimes' => 'Foto Surat Pernyataan Nikah harus bertipe file: jpeg, png, jpg.',
            'foto_surat_pernyataan_nikah.max' => 'Ukuran Foto Surat Pernyataan Nikah tidak boleh lebih dari 2MB.',

            'foto_surat_pengantar_rt_rw.required' => 'Foto Surat Pengantar RT/RW wajib diunggah.',
            'foto_surat_pengantar_rt_rw.image' => 'Foto Surat Pengantar RT/RW harus berupa gambar.',
            'foto_surat_pengantar_rt_rw.mimes' => 'Foto Surat Pengantar RT/RW harus bertipe file: jpeg, png, jpg.',
            'foto_surat_pengantar_rt_rw.max' => 'Ukuran Foto Surat Pengantar RT/RW tidak boleh lebih dari 2MB.',

            'catatan.string' => 'Catatan harus berupa teks.',
        ];

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:100',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string|max:100',

            'alamat' => 'required|string|max:255',
            'rt' => 'required|digits_between:1,3',
            'rw' => 'required|digits_between:1,3',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|digits:5',

            'no_kk' => 'required|string|max:16',
            'no_pengantar_rt_rw' => 'nullable|string|max:255',
            'tanggal_pengantar_rt_rw' => 'nullable|date',

            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_surat_pernyataan_nikah' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_surat_pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',

            'catatan' => 'nullable|string',
        ], $messages);

        // Gabungkan alamat_lengkap
        $validated['alamat_lengkap'] = $request->alamat . ', RT ' . $request->rt . '/RW ' . $request->rw . $request->rw . ', Kel. ' . $request->kelurahan . ', Kec. ' . $request->kecamatan . ', Kota Sukabumi' . ', ' . $request->kode_pos;

        // Upload file ke storage
        foreach ([
            'foto_ktp',
            'foto_kartu_keluarga',
            'foto_surat_pernyataan_nikah',
            'foto_surat_pengantar_rt_rw'
        ] as $field) {
            $validated[$field] = $request->file($field)->store('uploads', 'private');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'proses';

        SuratKeteranganAktaNikah::create($validated);

        return redirect()->route('/dashboard')->with('success', 'Pengajuan Surat Keterangan Akta Nikah berhasil dikirim.');
    }

    public function show($id)
    {

        $surat = SuratKeteranganAktaNikah::findOrFail($id);
        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        return view('backend.pages.akta_nikah.show', compact('surat'));
    }

    public function edit($id)
    {
        $surat = SuratKeteranganAktaNikah::findOrFail($id);
        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        return view('backend.pages.akta_nikah.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {

        $surat = SuratKeteranganAktaNikah::findOrFail($id);
         if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }
        $previousStatus = $surat->status; // Simpan status sebelumnya

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:100',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string|max:100',
            'alamat_lengkap' => 'required|string',
            'no_kk' => 'required|string|max:16',
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
        ] as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                    Storage::disk('private')->delete($surat->$field);
                }
                // Store new file
                $validated[$field] = $request->file($field)->store('uploads', 'private');
            } else {
                // Keep existing file if no new file uploaded
                $validated[$field] = $surat->$field;
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

       if (auth()->user()->hasRole('Admin')) {
            return redirect()->route('keterangan_akta_nikah.index')
                ->with('success', 'Surat Keterangan Akta Nikah berhasil diperbarui.');
        } else {
            return redirect()->back()->with('success', 'Surat berhasil diperbarui.');
        }
    }

    protected function sendRejectionNotification(SuratKeteranganAktaNikah $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Mohon maaf, pengajuan Surat Keterangan Akta Nikah Anda *ditolak*.\n";
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

    protected function sendSelesaiNotification(SuratKeteranganAktaNikah $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Pengajuan Surat Keterangan Akta Nikah Anda telah *SELESAI*.\n";
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

        $surat = SuratKeteranganAktaNikah::findOrFail($id);
         if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
                abort(404, 'Maaf, halaman ini tidak tersedia.');
            }

        foreach ([
            'foto_ktp',
            'foto_kartu_keluarga',
            'foto_surat_pernyataan_nikah',
            'foto_surat_pengantar_rt_rw'
        ] as $field) {
            if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                Storage::disk('private')->delete($surat->$field);
            }
        }

        $surat->delete();
         if (auth()->user()->hasRole('Admin')) {
            return redirect()->route('keterangan_akta_nikah.index')
                ->with('success', 'Surat pengantar ijin keramaian berhasil diperbarui.');
        } else {
            return redirect()->back()->with('success', 'Surat berhasil diperbarui.');
        }

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
            'lurah_nip' => 'required|string',
            'nama_lurah' => 'required|string|max:255',  
        ], [
            'nomor_surat.required' => 'Nomor Surat wajib diisi.',
            'tanggal_surat.required' => 'Tanggal Surat wajib diisi.',
            'nomor_surat_pengantar.required' => 'Nomor Surat Pengantar RT/RW wajib diisi.',
            'tanggal_surat_pengantar.required' => 'Tanggal Surat Pengantar RT/RW wajib diisi.',
            'lurah_nip.required' => 'NIP Lurah wajib diisi.',
            'nama_lurah.required' => 'Nama Lurah wajib diisi.',
        ]);

        // Ambil data utama dari database
        $surat = SuratKeteranganAktaNikah::findOrFail($id);

        // Siapkan data untuk view PDF (termasuk input dari request)
        $data = [
            'surat' => $surat,
            'nomor_surat' => $validatedData['nomor_surat'],
            'lurah_nip' => $validatedData['lurah_nip'],
            'nama_lurah' => $validatedData['nama_lurah'],
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
