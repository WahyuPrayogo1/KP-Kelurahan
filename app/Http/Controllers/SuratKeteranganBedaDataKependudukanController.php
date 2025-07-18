<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganBedaDataKependudukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Http;

class SuratKeteranganBedaDataKependudukanController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(403, 'Unauthorized');
        }

        if ($request->ajax()) {
            $data = SuratKeteranganBedaDataKependudukan::with('user')->get();

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
                ->editColumn('lokasi_perbedaan_nama', function ($row) {
                    return $row->lokasi_perbedaan_nama;
                })
                ->addColumn('aksi', function ($row) {
                    return view('backend.pages.beda_data_kependudukan.actions', compact('row'));
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        }
        return view('backend.pages.beda_data_kependudukan.index');
    }

    public function create()
    {
        return view('backend.pages.beda_data_kependudukan.create');
    }
    public function store(Request $request)
{
    // Handle opsi "Lainnya"
    if ($request->lokasi_perbedaan_nama === 'Lainnya' && $request->filled('lokasi_perbedaan_nama_lainnya')) {
        $request->merge([
            'lokasi_perbedaan_nama' => $request->lokasi_perbedaan_nama_lainnya,
        ]);
    }

  $messages = [
    'required' => 'Isian :attribute harus diisi, tidak boleh kosong.',
    'size' => 'Isian :attribute harus tepat :size angka/huruf.',
    'max.string' => 'Isian :attribute terlalu panjang (maksimal :max huruf).',
    'max.file' => 'File :attribute terlalu besar (maksimal :max KB).',
    'date' => 'Format tanggal di :attribute tidak benar.',
    'before_or_equal' => 'Tanggal di :attribute tidak boleh lebih baru dari hari ini.',
    'in' => 'Pilihan di :attribute tidak tersedia.',
    'mimes' => 'File :attribute harus berbentuk :values.',
    'file' => ':attribute harus berupa file (bukan teks).',
    'digits_between' => 'Isian :attribute harus antara :min sampai :max angka.',
];

    $attributes = [
        'nama_lengkap' => 'Nama Lengkap',
        'nik' => 'NIK',
        'tempat_lahir' => 'Tempat Lahir',
        'tanggal_lahir' => 'Tanggal Lahir',
        'jenis_kelamin' => 'Jenis Kelamin',
        'kewarganegaraan' => 'Kewarganegaraan',
        'pekerjaan' => 'Pekerjaan',
        'status_perkawinan' => 'Status Perkawinan',
        'agama' => 'Agama',
        'lokasi_perbedaan_nama' => 'Lokasi Perbedaan Nama',
        'fc_ktp' => 'Foto KTP',
        'fc_kk' => 'Foto KK',
        'surat_pernyataan_beda_data' => 'Surat Pernyataan Beda Data',
        'bukti_beda_data' => 'Bukti Beda Data',
        'pengantar_rt_rw' => 'Surat Pengantar RT/RW',
        'tempat' => 'Alamat',
        'rt' => 'RT',
        'rw' => 'RW',
        'kelurahan' => 'Kelurahan',
        'kecamatan' => 'Kecamatan',
        'kode_pos' => 'Kode Pos',
    ];

    $validated = $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'nik' => 'required|string|size:16',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date|before_or_equal:today',
        'jenis_kelamin' => 'required|in:L,P',
        'kewarganegaraan' => 'required|string|max:100',
        'pekerjaan' => 'required|string|max:255',
        'status_perkawinan' => 'required|in:BELUM KAWIN,KAWIN,CERAI HIDUP,CERAI MATI',
        'agama' => 'required|string|in:ISLAM,KRISTEN,KATOLIK,HINDU,BUDDHA,KONGHUCU',
        'lokasi_perbedaan_nama' => 'required|string|max:255',
        'fc_ktp' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        'fc_kk' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        'surat_pernyataan_beda_data' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        'bukti_beda_data' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        'pengantar_rt_rw' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        'tempat' => 'required|string|max:255',
        'rt' => 'required|string|max:3',
        'rw' => 'required|string|max:3',
        'kelurahan' => 'required|string|max:255',
        'kecamatan' => 'required|string|max:255',
        'kode_pos' => 'required|string|size:5',
    ], $messages, $attributes);

    // Membuat alamat lengkap
    $validated['alamat'] = $request->tempat . ', RT ' . $request->rt . '/RW ' . $request->rw . ', Kel. ' .
                          $request->kelurahan . ', Kec. ' . $request->kecamatan . ', Kota Sukabumi, ' .
                          $request->kode_pos;

   foreach (['fc_ktp', 'fc_kk', 'surat_pernyataan_beda_data', 'bukti_beda_data', 'pengantar_rt_rw'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $validated[$fileField] = $request->file($fileField)->store('uploads', 'private');
            }
        }

    $validated['user_id'] = auth()->id();
    $validated['status'] = 'proses';

   $surat =  SuratKeteranganBedaDataKependudukan::create($validated);
    $this->sendNewSubmissionNotification($surat);

    return redirect()->route('/dashboard')->with('success', 'Pengajuan berhasil dikirim.');
}

protected function sendNewSubmissionNotification(SuratKeteranganBedaDataKependudukan $surat)
    {
        $targetNumber = '081222535789'; // Nomor tujuan
        $user = $surat->user;

        $message = "Halo Admin,\n\n";
        $message .= "Ada pengajuan baru Surat Keterangan Beda Data Kependudukan dengan detail berikut:\n";
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


    public function show($id)
    {
        $surat = SuratKeteranganBedaDataKependudukan::findOrFail($id);
         if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        return view('backend.pages.beda_data_kependudukan.show', compact('surat'));
    }


    public function edit($id)
{
    $surat = SuratKeteranganBedaDataKependudukan::findOrFail($id);

    if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
        abort(404, 'Maaf, halaman ini tidak tersedia.');
    }

    // Parse alamat dari database
    $alamatParts = $this->parseAlamat($surat->alamat);

    return view('backend.pages.beda_data_kependudukan.edit', [
        'surat' => $surat,
        'alamatParts' => $alamatParts
    ]);
}

protected function parseAlamat($alamat)
{
    $default = [
        'tempat' => '',
        'rt' => '',
        'rw' => '',
        'kelurahan' => 'SUBANGJAYA',
        'kecamatan' => 'CIKOLE',
        'kode_pos' => '43116'
    ];

    if (empty($alamat)) {
        return $default;
    }

    $parts = explode(', ', $alamat);

    if (count($parts) < 6) {
        return $default;
    }

    // Parse tempat
    $default['tempat'] = $parts[0];

    // Parse RT/RW - format: "RT 122/RW 111"
    $rtRwPart = $parts[1];
    if (preg_match('/RT\s*(\d+)\/RW\s*(\d+)/i', $rtRwPart, $matches)) {
        $default['rt'] = $matches[1]; // Group 1: RT value
        $default['rw'] = $matches[2]; // Group 2: RW value
    }

    // Parse kelurahan
    $default['kelurahan'] = str_replace('Kel.', '', $parts[2]);

    // Parse kecamatan
    $default['kecamatan'] = str_replace('Kec.', '', $parts[3]);

    // Kode pos (asumsi bagian terakhir)
    $default['kode_pos'] = $parts[5];

    return $default;
}

public function update(Request $request, $id)
{

    $surat = SuratKeteranganBedaDataKependudukan::findOrFail($id);
    if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
        abort(404, 'Maaf, halaman ini tidak tersedia.');
    }

    $previousStatus = $surat->status;

    // Handle opsi "Lainnya"
    if ($request->lokasi_perbedaan_nama === 'Lainnya' && $request->filled('lokasi_perbedaan_nama_lainnya')) {
        $request->merge([
            'lokasi_perbedaan_nama' => $request->lokasi_perbedaan_nama_lainnya,
        ]);
    }

    $validatedData = $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'nik' => 'required|string|max:20|unique:surat_keterangan_beda_data_kependudukans,nik,'.$surat->id,
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:L,P',
        'kewarganegaraan' => 'required|string|max:100',
        'pekerjaan' => 'required|string|max:255',
        'status_perkawinan' => 'required|in:BELUM KAWIN,KAWIN,CERAI HIDUP,CERAI MATI',
        'agama' => 'required|string|max:100',
        'tempat' => 'required|string|max:255',
        'rt' => 'required|string|max:3',
        'rw' => 'required|string|max:3',
        'kelurahan' => 'required|string|max:255',
        'kecamatan' => 'required|string|max:255',
        'kode_pos' => 'required|string|size:5',
        'lokasi_perbedaan_nama' => 'required|string|max:255',
        'status' => 'required|in:proses,selesai,revisi',
        'catatan' => 'nullable|string',
        'fc_ktp' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        'fc_kk' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        'surat_pernyataan_beda_data' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        'bukti_beda_data' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        'pengantar_rt_rw' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
    ]);

    // Membuat alamat lengkap dari komponen
    $validatedData['alamat'] = $request->tempat . ', RT ' . $request->rt . '/RW ' . $request->rw . ', Kel. ' .
                              $request->kelurahan . ', Kec. ' . $request->kecamatan . ', Kota Sukabumi, ' .
                              $request->kode_pos;

    // Handle file uploads
    foreach (['fc_ktp', 'fc_kk', 'surat_pernyataan_beda_data', 'bukti_beda_data', 'pengantar_rt_rw'] as $field) {
        if ($request->hasFile($field)) {
            // Hapus file lama jika ada
            if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                Storage::disk('private')->delete($surat->$field);
            }
            $validatedData[$field] = $request->file($field)->store('uploads', 'private');
        } else {
            // Pertahankan file yang sudah ada
            $validatedData[$field] = $surat->$field;
        }
    }

    $surat->update($validatedData);

    // Kirim notifikasi jika status berubah
    if ($previousStatus != $request->status) {
        if ($request->status == 'revisi') {
            $this->sendRejectionNotification($surat);
        } elseif ($request->status == 'selesai') {
            $this->sendSelesaiNotification($surat);
        }
    }

    if (auth()->user()->hasRole('Admin')) {
        return redirect()->route('beda-data-kependudukan.index')
            ->with('success', 'Surat Keterangan Beda Kependudukan berhasil diperbarui.');
    } else {
        return redirect()->back()->with('success', 'Surat berhasil diperbarui.');
    }
}

        protected function sendRejectionNotification(SuratKeteranganBedaDataKependudukan $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Mohon maaf, pengajuan Surat Keterangan Beda Data Kependudukan Anda *revisi*.\n";
        $message .= "Alasan penolakan: {$surat->catatan}\n\n";
        $message .= "Silakan perbaiki dan ajukan kembali.\n\n";
        $message .= "Salam,\nAdmin";

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

    protected function sendSelesaiNotification(SuratKeteranganBedaDataKependudukan $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Pengajuan Surat Keterangan Beda Data Kependudukan Anda telah *SELESAI*.\n";
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
        $surat = SuratKeteranganBedaDataKependudukan::findOrFail($id);
         if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }


        foreach (['fc_ktp', 'fc_kk', 'surat_pernyataan_beda_data', 'bukti_beda_data', 'pengantar_rt_rw'] as $fileField) {
            if ($surat->$fileField && Storage::disk('private')->exists($surat->$fileField)) {
                Storage::disk('private')->delete($surat->$fileField);
            }
        }
        $surat->delete();
        if (auth()->user()->hasRole('Admin')) {
            return redirect()->route('beda-data-kependudukan.index')
                ->with('success', 'Surat Beda Kependudukan berhasil diperbarui.');
        } else {
            return redirect()->back()->with('success', 'Surat berhasil diperbarui.');
        }

    }

    public function previewPdf($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        $surat = SuratKeteranganBedaDataKependudukan::findOrFail($id);
        return view('backend.pages.Beda_Data_kependudukan.preview-pdf', compact('surat'));
    }

    public function generatePdf(Request $request, $id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        $surat = SuratKeteranganBedaDataKependudukan::findOrFail($id);

        $data = [
            'surat' => $surat,
            'nomor_surat' => $request->nomor_surat ?? 'PD.PU.08.03 /     /VII/6/KEL.SBJ/' . date('Y'),
            'tanggal_surat' => $request->tanggal_surat ?? now(),
            'nomor_pengantar' => $request->input('nomor_pengantar'),
            'tanggal_pengantar' => $request->input('tanggal_pengantar'),
            'lurah_nip' => $request->lurah_nip,
            'nama_lurah' => $request->nama_lurah,
        ];

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

        $html = view('backend.pages.Beda_Data_Kependudukan.pdf.surat', $data)->render();

        $mpdf->WriteHTML($html);

        return $mpdf->Output('Surat-Beda-Data-' . $surat->id . '.pdf', \Mpdf\Output\Destination::INLINE);
    }
}
