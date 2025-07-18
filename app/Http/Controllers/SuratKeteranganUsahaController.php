<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Http;
use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
class SuratKeteranganUsahaController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }
        if ($request->ajax()) {
            $data = SuratKeteranganUsaha::with('user')->get();
            return DataTables::of($data)
                ->addColumn('status', function ($row) {
                    $badgeClass = match ($row->status) {
                        'selesai' => 'success',
                        'proses' => 'warning',
                        'revisi' => 'danger',
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
    $validated = $request->validate([
        // Data Pemohon
        'nama' => 'required|string|max:255',
        'nik' => 'required|digits:16',
        'no_hp' => ['required', 'regex:/^08[0-9]{8,11}$/'],
        'jenis_kelamin' => 'required|in:L,P',
        'kewarganegaraan' => 'required|string|max:255',
        'pekerjaan' => 'required|string|max:255',
        'status_perkawinan' => 'required|string|max:255',
        'agama' => 'required|string|max:255',

        // Alamat (split fields)
        'tempat' => 'required|string|max:255',
        'kelurahan' => 'required|string|max:255',
        'kecamatan' => 'required|string|max:255',
        'kode_pos' => 'required|digits:5',

        // Data Usaha
        'nama_usaha' => 'required|string|max:255',
        'jenis_usaha' => 'required|string|max:255',
        'alamat_usaha' => 'required|string|max:255',
        'status_bangunan' => 'required|string|max:255',
        'no_sppt' => 'nullable|string|max:255',
        'akta_pendirian_usaha' => 'nullable|string|max:255',
        'jumlah_karyawan' => 'required|integer|min:0',
        'pimpinan_usaha' => 'required|string|max:255',

        // Dokumen
        'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'foto_kartu_keluarga' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'foto_surat_pernyataan_tetangga' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'foto_surat_pernyataan_usaha' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'foto_usaha' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'foto_pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',

        'catatan' => 'nullable|string',
    ], [
        // Custom error messages (ubah ke uppercase)
        'nama.required' => 'NAMA LENGKAP WAJIB DIISI.',
        'nik.required' => 'NIK WAJIB DIISI.',
        'nik.digits' => 'NIK HARUS TERDIRI DARI 16 DIGIT.',
        'no_hp.required' => 'NOMOR HP WAJIB DIISI.',
        'no_hp.regex' => 'NOMOR HP HARUS DIMULAI DENGAN 08 DAN TERDIRI DARI 10-13 DIGIT.',
        'jenis_kelamin.required' => 'JENIS KELAMIN WAJIB DIPILIH.',
        'kewarganegaraan.required' => 'KEWARGANEGARAAN WAJIB DIISI.',
        'pekerjaan.required' => 'PEKERJAAN WAJIB DIISI.',
        'status_perkawinan.required' => 'STATUS PERKAWINAN WAJIB DIISI.',
        'agama.required' => 'AGAMA WAJIB DIISI.',

        'tempat.required' => 'ALAMAT JALAN WAJIB DIISI.',
        'kelurahan.required' => 'KELURAHAN WAJIB DIISI.',
        'kecamatan.required' => 'KECAMATAN WAJIB DIISI.',
        'kode_pos.required' => 'KODE POS WAJIB DIISI.',
        'kode_pos.digits' => 'KODE POS HARUS 5 DIGIT.',
        'alamat_usaha'=> 'NAMA USAHA WAJIB DIISI.',

        'nama_usaha.required' => 'NAMA USAHA WAJIB DIISI.',
        'jenis_usaha.required' => 'JENIS USAHA WAJIB DIISI.',
        'status_bangunan.required' => 'STATUS BANGUNAN WAJIB DIISI.',
        'jumlah_karyawan.required' => 'JUMLAH KARYAWAN WAJIB DIISI.',
        'pimpinan_usaha.required' => 'PIMPINAN USAHA WAJIB DIISI.',

        'foto_ktp.required' => 'FOTO KTP WAJIB DIUNGGAH.',
        'foto_kartu_keluarga.required' => 'FOTO KARTU KELUARGA WAJIB DIUNGGAH.',
        'foto_surat_pernyataan_tetangga.required' => 'FOTO SURAT PERNYATAAN TETANGGA WAJIB DIUNGGAH.',
        'foto_surat_pernyataan_usaha.required' => 'FOTO SURAT PERNYATAAN USAHA WAJIB DIUNGGAH.',
        'foto_usaha.required' => 'FOTO USAHA WAJIB DIUNGGAH.',
        'foto_pengantar_rt_rw.required' => 'FOTO PENGANTAR RT/RW WAJIB DIUNGGAH.',

        'foto_ktp.image' => 'FILE KTP HARUS BERUPA GAMBAR.',
        'foto_kartu_keluarga.image' => 'FILE KK HARUS BERUPA GAMBAR.',
        'foto_surat_pernyataan_tetangga.image' => 'FILE PERNYATAAN TETANGGA HARUS BERUPA GAMBAR.',
        'foto_surat_pernyataan_usaha.image' => 'FILE PERNYATAAN USAHA HARUS BERUPA GAMBAR.',
        'foto_usaha.image' => 'FILE FOTO USAHA HARUS BERUPA GAMBAR.',
        'foto_pengantar_rt_rw.image' => 'FILE PENGANTAR RT/RW HARUS BERUPA GAMBAR.',

        'foto_ktp.mimes' => 'FORMAT KTP HARUS JPEG, JPG, ATAU PNG.',
        'foto_kartu_keluarga.mimes' => 'FORMAT KK HARUS JPEG, JPG, ATAU PNG.',
        'foto_surat_pernyataan_tetangga.mimes' => 'FORMAT PERNYATAAN TETANGGA HARUS JPEG, JPG, ATAU PNG.',
        'foto_surat_pernyataan_usaha.mimes' => 'FORMAT PERNYATAAN USAHA HARUS JPEG, JPG, ATAU PNG.',
        'foto_usaha.mimes' => 'FORMAT FOTO USAHA HARUS JPEG, JPG, ATAU PNG.',
        'foto_pengantar_rt_rw.mimes' => 'FORMAT PENGANTAR RT/RW HARUS JPEG, JPG, ATAU PNG.',

        'foto_ktp.max' => 'UKURAN KTP TIDAK BOLEH LEBIH DARI 2MB.',
        'foto_kartu_keluarga.max' => 'UKURAN KK TIDAK BOLEH LEBIH DARI 2MB.',
        'foto_surat_pernyataan_tetangga.max' => 'UKURAN PERNYATAAN TETANGGA TIDAK BOLEH LEBIH DARI 2MB.',
        'foto_surat_pernyataan_usaha.max' => 'UKURAN PERNYATAAN USAHA TIDAK BOLEH LEBIH DARI 2MB.',
        'foto_usaha.max' => 'UKURAN FOTO USAHA TIDAK BOLEH LEBIH DARI 2MB.',
        'foto_pengantar_rt_rw.max' => 'UKURAN PENGANTAR RT/RW TIDAK BOLEH LEBIH DARI 2MB.',
    ]);

    // Konversi semua input text ke UPPERCASE kecuali yang tidak perlu
    $fieldsToUpper = [
        'nama', 'kewarganegaraan', 'pekerjaan', 'status_perkawinan', 'agama',
        'tempat', 'kelurahan', 'kecamatan', 'nama_usaha', 'jenis_usaha',
        'alamat_usaha', 'status_bangunan', 'no_sppt', 'akta_pendirian_usaha',
        'pimpinan_usaha', 'catatan'
    ];

    foreach ($fieldsToUpper as $field) {
        if (isset($validated[$field])) {
            $validated[$field] = strtoupper($validated[$field]);
        }
    }

    // Gabungkan alamat lengkap (dalam uppercase)
    $validated['alamat_lengkap'] = $validated['tempat']
        . ', KEL. ' . $validated['kelurahan']
        . ', KEC. ' . $validated['kecamatan']
        . ', KOTA SUKABUMI'
        . ', ' . $validated['kode_pos'];

    // Simpan file ke folder private
    $fileFields = [
        'foto_ktp',
        'foto_kartu_keluarga',
        'foto_surat_pernyataan_tetangga',
        'foto_surat_pernyataan_usaha',
        'foto_usaha',
        'foto_pengantar_rt_rw'
    ];

    foreach ($fileFields as $field) {
        $validated[$field] = $request->file($field)->store('uploads', 'private');
    }

    $validated['user_id'] = auth()->id();
    $validated['status'] = 'proses'; // Ubah ke uppercase

    $surat = SuratKeteranganUsaha::create($validated);
    $this->sendNewSubmissionNotification($surat);


    return redirect()->route('/dashboard')->with('success', 'PENGAJUAN SURAT KETERANGAN USAHA BERHASIL DIKIRIM.');
}

 protected function sendNewSubmissionNotification(SuratKeteranganUsaha $surat)
    {
        $targetNumber = '081222535789'; // Nomor tujuan
        $user = $surat->user;

        $message = "Halo Admin,\n\n";
        $message .= "Ada pengajuan baru Surat Keterangan Usaha dengan detail berikut:\n";
        $message .= "Nama: {$surat->nama}\n";
        $message .= "NIK: {$surat->nik}\n";
        $message .= "Silakan periksa sistem untuk verifikasi lebih lanjut.\n\n";
        $message .= "Salam,\nSistem Subang Jaya";

        try {
            $response = Http::withHeaders([
                'Authorization' => env('WABLAS_TOKEN') . '.' . env('WABLAS_SECRET_KEY'),
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->asForm()->post(env('WABLAS_URL') . '/api/send-message', [
                'phone' => $targetNumber,
                'message' => $message
            ]);

            if (!$response->successful()) {
                \Log::error('Gagal mengirim notifikasi pengajuan baru', [
                    'response' => $response->body(),
                    'surat_id' => $surat->id
                ]);
            }

        } catch (\Exception $e) {
            \Log::error('Error mengirim notifikasi WhatsApp: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $surat = SuratKeteranganUsaha::findOrFail($id);
        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }
        return view('backend.pages.Usaha.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $surat = SuratKeteranganUsaha::findOrFail($id);
        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }
        $previousStatus = $surat->status;
        $validated = $request->validate([
            // Data Pemohon
            'nama' => 'required|string|max:255',
            'nik' => 'required|digits:16',
            'no_hp' => ['required', 'regex:/^08[0-9]{8,11}$/'],
            'jenis_kelamin' => 'required|in:L,P',
            'kewarganegaraan' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'status_perkawinan' => 'required|string|max:255',
            'agama' => 'required|string|max:255',

            // Alamat (split fields will be combined)
            'tempat' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|digits:5',

            // Data Usaha
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'alamat_usaha' => 'required|string|max:500',
            'status_bangunan' => 'required|string|max:255',
            'no_sppt' => 'nullable|string|max:255',
            'akta_pendirian_usaha' => 'nullable|string|max:255',
            'jumlah_karyawan' => 'required|integer|min:0',
            'pimpinan_usaha' => 'required|string|max:255',

            // Dokumen
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_surat_pernyataan_tetangga' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_surat_pernyataan_usaha' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_usaha' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            'status' => 'required|in:proses,selesai,revisi',
            'catatan' => 'nullable|string',
        ], [
            // Custom error messages
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Nomor HP harus dimulai dengan 08 dan terdiri dari 10-13 digit.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'kewarganegaraan.required' => 'Kewarganegaraan wajib diisi.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'status_perkawinan.required' => 'Status perkawinan wajib diisi.',
            'agama.required' => 'Agama wajib diisi.',

            'tempat.required' => 'Alamat jalan wajib diisi.',
            'kelurahan.required' => 'Kelurahan wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kode_pos.required' => 'Kode pos wajib diisi.',
            'kode_pos.digits' => 'Kode pos harus 5 digit.',

            'nama_usaha.required' => 'Nama usaha wajib diisi.',
            'jenis_usaha.required' => 'Jenis usaha wajib diisi.',
            'alamat_usaha.required' => 'Alamat usaha wajib diisi.',
            'status_bangunan.required' => 'Status bangunan wajib diisi.',
            'jumlah_karyawan.required' => 'Jumlah karyawan wajib diisi.',
            'pimpinan_usaha.required' => 'Pimpinan usaha wajib diisi.',

            'foto_ktp.image' => 'File KTP harus berupa gambar.',
            'foto_kartu_keluarga.image' => 'File KK harus berupa gambar.',
            'foto_surat_pernyataan_tetangga.image' => 'File pernyataan tetangga harus berupa gambar.',
            'foto_surat_pernyataan_usaha.image' => 'File pernyataan usaha harus berupa gambar.',
            'foto_usaha.image' => 'File foto usaha harus berupa gambar.',
            'foto_pengantar_rt_rw.image' => 'File pengantar RT/RW harus berupa gambar.',

            'foto_ktp.mimes' => 'Format KTP harus jpeg, jpg, atau png.',
            'foto_kartu_keluarga.mimes' => 'Format KK harus jpeg, jpg, atau png.',
            'foto_surat_pernyataan_tetangga.mimes' => 'Format pernyataan tetangga harus jpeg, jpg, atau png.',
            'foto_surat_pernyataan_usaha.mimes' => 'Format pernyataan usaha harus jpeg, jpg, atau png.',
            'foto_usaha.mimes' => 'Format foto usaha harus jpeg, jpg, atau png.',
            'foto_pengantar_rt_rw.mimes' => 'Format pengantar RT/RW harus jpeg, jpg, atau png.',

            'foto_ktp.max' => 'Ukuran KTP tidak boleh lebih dari 2MB.',
            'foto_kartu_keluarga.max' => 'Ukuran KK tidak boleh lebih dari 2MB.',
            'foto_surat_pernyataan_tetangga.max' => 'Ukuran pernyataan tetangga tidak boleh lebih dari 2MB.',
            'foto_surat_pernyataan_usaha.max' => 'Ukuran pernyataan usaha tidak boleh lebih dari 2MB.',
            'foto_usaha.max' => 'Ukuran foto usaha tidak boleh lebih dari 2MB.',
            'foto_pengantar_rt_rw.max' => 'Ukuran pengantar RT/RW tidak boleh lebih dari 2MB.',
        ]);

        // Combine address components
        $validated['alamat_lengkap'] = strtoupper($request->tempat)
            . ', KEL. ' . strtoupper($request->kelurahan)
            . ', KEC. ' . strtoupper($request->kecamatan)
            . ', KOTA SUKABUMI'
            . ', ' . $request->kode_pos;

        // Find the existing record
        $surat = SuratKeteranganUsaha::findOrFail($id);
        $previousStatus = $surat->status; // Simpan status sebelumnya

        // Handle file uploads - only update if new file is uploaded
        $fileFields = [
            'foto_ktp',
            'foto_kartu_keluarga',
            'foto_surat_pernyataan_tetangga',
            'foto_surat_pernyataan_usaha',
            'foto_usaha',
            'foto_pengantar_rt_rw'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                    Storage::disk('private')->delete($surat->$field);
                }
                // Store new file
                $validated[$field] = $request->file($field)->store('uploads', 'private');
            } else {
                // Keep existing file if no new upload
                $validated[$field] = $surat->$field;
            }
        }

        // Update the record
        $surat->update($validated);
        if ($previousStatus != $request->status) {
            if ($request->status == 'revisi') {
                $this->sendRejectionNotification($surat);
            } elseif ($request->status == 'selesai') {
                $this->sendSelesaiNotification($surat);
            }
        }

        if (auth()->user()->hasRole('Admin')) {
            return redirect()->route('surat_keterangan_usahas.index')
                ->with('success', 'Surat Keterangan Usaha berhasil diperbarui.');
        } else {
            return redirect()->back()->with('success', 'Surat berhasil diperbarui.');
        }

    }
        protected function sendRejectionNotification(SuratKeteranganUsaha $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Mohon maaf, pengajuan Surat Keterangan Usaha Anda *revisi*.\n";
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

    protected function sendSelesaiNotification(SuratKeteranganUsaha $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Pengajuan Surat Keterangan Usaha Anda telah *SELESAI*.\n";
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
        try {
            // Find the record
            $surat = SuratKeteranganUsaha::findOrFail($id);
            if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
                abort(404, 'Maaf, halaman ini tidak tersedia.');
            }
            // List of file fields to delete
            $fileFields = [
                'foto_ktp',
                'foto_kartu_keluarga',
                'foto_surat_pernyataan_tetangga',
                'foto_surat_pernyataan_usaha',
                'foto_usaha',
                'foto_pengantar_rt_rw'
            ];

            // Delete all associated files
            foreach ($fileFields as $field) {
                if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                    Storage::disk('private')->delete($surat->$field);
                }
            }

            // Delete the record
            $surat->delete();

            if (auth()->user()->hasRole('Admin')) {
            return redirect()->route('surat_keterangan_usahas.index')
                ->with('success', 'Surat Keterangan Usaha berhasil diperbarui.');
            } else {
                return redirect()->back()->with('success', 'Surat berhasil diperbarui.');
            }

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data. Error: ' . $e->getMessage());
        }
    }

     public function show($id)
    {
        $surat = SuratKeteranganUsaha::findOrFail($id);
        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }
        return view('backend.pages.Usaha.show', compact('surat'));
    }

    public function previewPdf($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        $surat = SuratKeteranganUsaha::findOrFail($id);

        // Provide default values for preview
        $data = [
            'surat' => $surat,
            'nomor_surat' => 'PP.01/07.04.44/     /IV/KEL.SBJ/'.date('Y'),
            'tanggal_surat' => now(),
            'nomor_pengantar' => '...',
            'nomor_pengantar2' => '...',
            'tanggal_pernyataan' => now(),
            'no_sppt' => $surat->no_sppt ?? '-',
            'keperluan' => 'Melengkapi Persyaratan Administrasi',
            'tanggal_dikeluarkan' => now(),
            'nama_ttd' => 'Nama Lurah',
            'nip_ttd' => '19601010 198803 1 001',
        ];

        return view('backend.pages.Usaha.preview-pdf', $data);
    }

    public function generatePdf(Request $request, $id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        $surat = SuratKeteranganUsaha::findOrFail($id);

        $data = [
            'nama' => $surat->nama,
            'nik' => $surat->nik,
            'alamat_lengkap' => $surat->alamat_lengkap,
            'jenis_kelamin' => $surat->jenis_kelamin,
            'kewarganegaraan' => $surat->kewarganegaraan,
            'agama' => $surat->agama,
            'pekerjaan' => $surat->pekerjaan,
            'status_perkawinan' => $surat->status_perkawinan,
            'nama_usaha' => $surat->nama_usaha,
            'jenis_usaha' => $surat->jenis_usaha,
            'alamat_usaha' => $surat->alamat_usaha,
            'status_bangunan' => $surat->status_bangunan,
            'no_sppt' => $surat->no_sppt ?? '-',
            'akta_pendirian_usaha' => $surat->akta_pendirian_usaha,
            'jumlah_karyawan' => $surat->jumlah_karyawan,
            'pimpinan_usaha' => $surat->pimpinan_usaha,
            'nomor_surat' => $request->nomor_surat ?? 'PP.01/07.04.44/     /IV/KEL.SBJ/'.date('Y'),
            'nomor_pengantar' => $request->nomor_pengantar,
            'nomor_pengantar2' => $request->nomor_pengantar2,
            'tanggal_pernyataan' => $request->tanggal_pernyataan,
            'keperluan' => $request->keperluan ?? 'Melengkapi Persyaratan Administrasi',
            'tanggal_dikeluarkan' => $request->tanggal_dikeluarkan,
            'nama_ttd' => $request->nama_ttd,
            'nip_ttd' => $request->nip_ttd ?? '19601010 198803 1 001',
        ];

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'default_font' => 'times',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 0,
            'margin_footer' => 0,
        ]);

        $html = view('backend.pages.Usaha.pdf.surat', $data)->render();
        $mpdf->WriteHTML($html);

        return $mpdf->Output('Surat-Keterangan-Usaha-'.$surat->id.'.pdf', \Mpdf\Output\Destination::INLINE);
    }
}
