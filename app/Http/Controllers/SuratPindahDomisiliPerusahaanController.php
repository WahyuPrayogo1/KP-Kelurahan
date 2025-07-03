<?php

namespace App\Http\Controllers;

use App\Models\SuratPindahDomisiliPerusahaan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class SuratPindahDomisiliPerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if (!auth()->user()->hasRole('Admin')) {
              abort(404, 'Maaf, halaman ini tidak tersedia.');
            }
        if ($request->ajax()) {
            $data = SuratPindahDomisiliPerusahaan::with('user')->get();
            return DataTables::of($data)
                ->addColumn('status', function ($row) {
                    $badgeClass = match ($row->status) {
                        'selesai' => 'success',
                        'proses' => 'warning',
                        'ditolak' => 'danger',
                        default => 'secondary',
                    };
                    return '<span class="text-white badge bg-' . $badgeClass . '">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('aksi', function ($row) {
                    return view('backend.pages.surat_pindah.actions', compact('row'));
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        }

        return view('backend.pages.surat_pindah.index');
    }

    public function edit($id)
    {
        $surat = SuratPindahDomisiliPerusahaan::findOrFail($id);
        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        // Pisahkan alamat lengkap menjadi bagian-bagian
        $alamatParts = explode(', ', $surat->alamat_perusahaan);

        $alamat = $alamatParts[0] ?? '';
        $kelurahan = str_replace('Kel. ', '', $alamatParts[1] ?? '');
        $kecamatan = str_replace('Kec. ', '', $alamatParts[2] ?? '');

        preg_match('/RT (\d+)\/RW (\d+)/', $alamatParts[3] ?? '', $rtRwMatch);
        $rt = $rtRwMatch[1] ?? '';
        $rw = $rtRwMatch[2] ?? '';

        $kode_pos = $alamatParts[5] ?? '';

        return view('backend.pages.surat_pindah.edit', compact('surat', 'alamat', 'kelurahan', 'kecamatan', 'rt', 'rw', 'kode_pos'));
    }



    public function create()
    {
        return view('backend.pages.surat_pindah.create');
    }

    public function update(Request $request, $id)
    {
        $surat = SuratPindahDomisiliPerusahaan::findOrFail($id);
        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }
        $previousStatus = $surat->status; // Simpan status sebelumnya

        $validatedData = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'alamat_pemilik' => 'required|string',
            'tanggal_pindah' => 'required|string',
            'nomor_tdp' => 'required|string|max:50',
            'jenis_usaha' => 'required|string|max:100',
            'status' => 'required|in:proses,selesai,ditolak',
            'foto_ktp' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kk' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pernyataan_pindah' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'foto_akte_notaris' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
        ], [
            'required' => 'Field :attribute wajib diisi',
            'max' => 'Maksimal :max karakter',
            'image' => 'File harus berupa gambar',
            'mimes' => 'Format file harus jpeg, png, atau jpg',
        ]);

        // Handle upload dan hapus file lama jika ada yang baru
        $fileFields = [
            'foto_ktp',
            'foto_kk',
            'foto_pernyataan_pindah',
            'foto_akte_notaris',
            'foto_pengantar_rt_rw'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                    Storage::disk('private')->delete($surat->$field);
                }

                $validatedData[$field] = $request->file($field)->store('uploads/surat_pindah_perusahaan', 'private');
            }
        }

        // Jika kamu mau perbarui alamat lengkap seperti di store()
        $alamatLengkap = $request->alamat_perusahaan;
        if ($request->has(['kelurahan_perusahaan', 'kecamatan_perusahaan', 'rt_perusahaan', 'rw_perusahaan', 'kode_pos_perusahaan'])) {
            $alamatLengkap .= ', Kel. ' . $request->kelurahan_perusahaan
                . ', Kec. ' . $request->kecamatan_perusahaan
                . ', RT ' . $request->rt_perusahaan
                . '/RW ' . $request->rw_perusahaan
                . ', Kota Sukabumi'
                . ', ' . $request->kode_pos_perusahaan;

            $validatedData['alamat_perusahaan'] = $alamatLengkap;
        }

        $surat->update($validatedData);
         // Kirim notifikasi hanya jika status berubah
        if ($previousStatus != $request->status) {
            if ($request->status == 'ditolak') {
                $this->sendRejectionNotification($surat);
            } elseif ($request->status == 'selesai') {
                $this->sendSelesaiNotification($surat);
            }
        }

        if (auth()->user()->hasRole('Admin')) {
            return redirect()->route('surat-pindah-perusahaan.index')
                ->with('success', 'Surat pengantar ijin keramaian berhasil diperbarui.');
        } else {
            return redirect()->back()->with('success', 'Surat berhasil diperbarui.');
        }
    }

      protected function sendRejectionNotification(SuratPindahDomisiliPerusahaan $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Mohon maaf, pengajuan Surat Keterangan Pindah Domisili Anda *ditolak*.\n";
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

    protected function sendSelesaiNotification(SuratPindahDomisiliPerusahaan $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Pengajuan Surat Keterangan Pindah Domisili Anda telah *SELESAI*.\n";
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
        $surat = SuratPindahDomisiliPerusahaan::findOrFail($id);
        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        // Hapus semua file terkait jika ada
        $fileFields = ['foto_ktp', 'foto_kk', 'foto_akte_notaris', 'foto_pengantar_rt_rw'];

        foreach ($fileFields as $field) {
            if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                Storage::disk('private')->delete($surat->$field);
            }
        }

        // Hapus data dari database
        $surat->delete();

        if (auth()->user()->hasRole('Admin')) {
            return redirect()->route('keterangan_domisili.index')
                ->with('success', 'Surat Keterangan Domisili berhasil diperbarui.');
        } else {
            return redirect()->back()->with('success', 'Surat berhasil diperbarui.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'alamat_pemilik' => 'required|string',
            'tanggal_pindah' => 'required|string',
            'nomor_tdp' => 'required|string|max:50',
            'jenis_usaha' => 'required|string|max:100',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pernyataan_pindah' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_akte_notaris' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
        ], [
            'required' => 'Field :attribute wajib diisi',
            'unique' => 'Alamat perusahaan sudah terdaftar',
            'max' => 'Maksimal :max karakter',
            'image' => 'File harus berupa gambar',
            'mimes' => 'Format file harus jpeg, png, atau jpg',
            'foto_ktp.max' => 'Ukuran file tidak boleh lebih dari 2MB',
            'foto_kk.max' => 'Ukuran file tidak boleh lebih dari 2MB',
            'foto_pernyataan_pindah.max' => 'Ukuran file tidak boleh lebih dari 2MB',
            'foto_akte_notaris.max' => 'Ukuran file tidak boleh lebih dari 2MB',
            'foto_pengantar_rt_rw.max' => 'Ukuran file tidak boleh lebih dari 2MB',
        ]);

        // Upload files
        $foto_ktp = $request->file('foto_ktp')->store('uploads/surat_pindah_perusahaan', 'private');
        $foto_kk = $request->file('foto_kk')->store('uploads/surat_pindah_perusahaan', 'private');
        $foto_pernyataan_pindah = $request->file('foto_pernyataan_pindah')->store('uploads/surat_pindah_perusahaan', 'private');
        $foto_akte_notaris = $request->file('foto_akte_notaris')->store('uploads/surat_pindah_perusahaan', 'private');
        $foto_pengantar_rt_rw = $request->file('foto_pengantar_rt_rw')->store('uploads/surat_pindah_perusahaan', 'private');


        $alamatLengkap = $request->alamat_perusahaan
        . ', Kel. ' . $request->kelurahan_perusahaan
        . ', Kec. ' . $request->kecamatan_perusahaan
        . ', RT ' . $request->rt_perusahaan
        . '/RW ' . $request->rw_perusahaan
        . ', Kota Sukabumi'
        . ', ' . $request->kode_pos_perusahaan;
        // Save to database
        SuratPindahDomisiliPerusahaan::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $alamatLengkap,
            'user_id' => auth()->id(),
            'nama_pemilik' => $request->nama_pemilik,
            'tanggal_pindah' => $request->tanggal_pindah,
            'alamat_pemilik' => $request->alamat_pemilik,
            'nomor_tdp' => $request->nomor_tdp,
            'jenis_usaha' => $request->jenis_usaha,
            'foto_ktp' => $foto_ktp,
            'foto_kk' => $foto_kk,
            'foto_pernyataan_pindah' => $foto_pernyataan_pindah,
            'foto_akte_notaris' => $foto_akte_notaris,
            'foto_pengantar_rt_rw' => $foto_pengantar_rt_rw,
            'status' => 'proses',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('/dashboard')->with('success', 'Pengajuan surat pindah domisili perusahaan berhasil dikirim.');
    }

       public function show($id)
        {
            $surat = SuratPindahDomisiliPerusahaan::findOrFail($id);
            if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
                abort(404, 'Maaf, halaman ini tidak tersedia.');
            }
            return view('backend.pages.surat_pindah.show', compact('surat'));
        }


        public function previewPdf($id)
        {
             if (!auth()->user()->hasRole('Admin')) {
              abort(404, 'Maaf, halaman ini tidak tersedia.');
            }
            $surat = SuratPindahDomisiliPerusahaan::findOrFail($id);
            return view('backend.pages.surat_pindah.preview-pdf', compact('surat'));
        }

        public function generatePdf(Request $request, $id)
        {
             if (!auth()->user()->hasRole('Admin')) {
              abort(404, 'Maaf, halaman ini tidak tersedia.');
            }
            try {
                $surat = SuratPindahDomisiliPerusahaan::findOrFail($id);

                // Validasi input
                $validated = $request->validate([
                    'nomor_surat' => 'required|string|max:50',
                    'tanggal_surat' => 'required|date',

                    'nomor_surat_rt_rw' => 'required|string|max:50',
                    'tanggal_surat_rt_rw' => 'required|date',
                    'tanggal_pernyataan' => 'required|date',
                    'nomor_surat_lama' => 'required|string|max:50',
                    'tanggal_surat_lama' => 'required|date',
                    'tujuan_surat' => 'required|string|max:255',
                    'nama_lurah' => 'required|string|max:100'
                ]);

                $data = [
                    'surat' => $surat,
                    'nomor_surat' => $validated['nomor_surat'] ?? '503/    /Kode Wil/'.date('Y'),
                    'tanggal_surat' => $validated['tanggal_surat'] ?? now(),

                    'nomor_surat_rt_rw' => $validated['nomor_surat_rt_rw'],
                    'tanggal_surat_rt_rw' => $validated['tanggal_surat_rt_rw'],
                    'tanggal_pernyataan' => $validated['tanggal_pernyataan'],
                    'nomor_surat_lama' => $validated['nomor_surat_lama'],
                    'tanggal_surat_lama' => $validated['tanggal_surat_lama'],
                    'tujuan_surat' => $validated['tujuan_surat'],
                    'nama_lurah' => $validated['nama_lurah'],
                ];

                // Konfigurasi PDF
                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
                    'format' => 'A4',
                    'orientation' => 'P',
                    'default_font' => 'times',
                    'margin_left' => 10,  // Diperkecil
                    'margin_right' => 10,
                    'margin_top' => 10,
                    'margin_bottom' => 0,
                    'margin_header' => 0,
                    'margin_footer' => 0,
                ]);

                // Generate PDF
                $html = view('backend.pages.surat_pindah.pdf.surat', $data)->render();
                $mpdf->WriteHTML($html);

                // Return PDF
                $filename = 'Surat-Pindah-Perusahaan-'.$surat->id.'-'.date('YmdHis').'.pdf';
                return $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);

            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                abort(404, 'Data surat tidak ditemukan');
            } catch (\Exception $e) {
                Log::error('Error generating PDF: '.$e->getMessage());
                return back()->withError('Terjadi kesalahan saat membuat PDF');
            }
        }

}
