<?php

namespace App\Http\Controllers;

use App\Models\SuratPengantarIjinKeramaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Illuminate\Support\Facades\Http;

class SuratPengantarIjinKeramaianController extends Controller
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
        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'jabatan_pemohon' => 'required|string|max:255',
            'no_hp' => ['required', 'regex:/^08[0-9]{8,11}$/'],
            'nama_organisasi' => 'required|string|max:255',
            'alamat_organisasi' => 'nullable|string|max:500',
            'mengadakan_keramain' => 'required|string|max:255',
            'hiburan' => 'nullable|string|max:255',
            'waktu' => 'required|string|max:255',

            'tempat' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'rt' => 'required|digits_between:1,3',
            'rw' => 'required|digits_between:1,3',
            'kode_pos' => 'required|digits:5',


            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pernyataan_tetangga' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',

            'catatan' => 'nullable|string',
        ], [

            'nama_pemohon.required' => 'Nama pemohon wajib diisi.',
            'jabatan_pemohon.required' => 'Jabatan pemohon wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Nomor HP harus dimulai dengan 08 dan terdiri dari 10 hingga 13 digit.',
            'nama_organisasi.required' => 'Nama organisasi wajib diisi.',
            'mengadakan_keramain.required' => 'Kolom kegiatan yang diadakan wajib diisi.',
            'waktu.required' => 'Waktu pelaksanaan wajib diisi.',

            'foto_ktp.required' => 'Foto KTP wajib diunggah.',
            'foto_kartu_keluarga.required' => 'Foto Kartu Keluarga wajib diunggah.',
            'foto_pernyataan_tetangga.required' => 'Foto Surat Pernyataan Tetangga wajib diunggah.',
            'foto_pengantar_rt_rw.required' => 'Foto Surat Pengantar RT/RW wajib diunggah.',

            'foto_ktp.image' => 'File KTP harus berupa gambar.',
            'foto_kartu_keluarga.image' => 'File KK harus berupa gambar.',
            'foto_pernyataan_tetangga.image' => 'File pernyataan tetangga harus berupa gambar.',
            'foto_pengantar_rt_rw.image' => 'File pengantar RT/RW harus berupa gambar.',

            'foto_ktp.mimes' => 'Format KTP harus jpeg, jpg, atau png.',
            'foto_kartu_keluarga.mimes' => 'Format KK harus jpeg, jpg, atau png.',
            'foto_pernyataan_tetangga.mimes' => 'Format pernyataan tetangga harus jpeg, jpg, atau png.',
            'foto_pengantar_rt_rw.mimes' => 'Format pengantar RT/RW harus jpeg, jpg, atau png.',

            'foto_ktp.max' => 'Ukuran KTP tidak boleh lebih dari 2MB.',
            'foto_kartu_keluarga.max' => 'Ukuran KK tidak boleh lebih dari 2MB.',
            'foto_pernyataan_tetangga.max' => 'Ukuran pernyataan tetangga tidak boleh lebih dari 2MB.',
            'foto_pengantar_rt_rw.max' => 'Ukuran pengantar RT/RW tidak boleh lebih dari 2MB.',
        ]);

            $validated['tempat'] = $request->tempat
        . ', Kel. ' . $request->kelurahan
        . ', Kec. ' . $request->kecamatan
        . ', RT ' . $request->rt
        . '/RW ' . $request->rw
        . ' Kota Sukabumi '
        . ', ' . $request->kode_pos;


        // Simpan file ke folder private
        foreach (['foto_ktp', 'foto_kartu_keluarga', 'foto_pernyataan_tetangga', 'foto_pengantar_rt_rw'] as $field) {
            $validated[$field] = $request->file($field)->store('uploads', 'private');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'proses';

        SuratPengantarIjinKeramaian::create($validated);

        return redirect()->route('/dashboard')->with('success', 'Pengajuan berhasil dikirim.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $surat = SuratPengantarIjinKeramaian::findOrFail($id);
        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }
        return view('backend.pages.Ijin_Keramain.show', compact('surat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $surat = SuratPengantarIjinKeramaian::findOrFail($id);
        // Cek apakah user adalah Admin ATAU user_id yang membuat surat sama dengan id user yang login
        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }


        return view('backend.pages.Ijin_Keramain.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $surat = SuratPengantarIjinKeramaian::findOrFail($id);
        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }
        $previousStatus = $surat->status; // Simpan status sebelumnya

        $validatedData = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'jabatan_pemohon' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'nama_organisasi' => 'required|string|max:255',
            'alamat_organisasi' => 'required|string',
            'mengadakan_keramain' => 'required|string|max:255',
            'hiburan' => 'nullable|string|max:255',
            'waktu' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kartu_keluarga' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pernyataan_tetangga' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pengantar_rt_rw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:proses,selesai,ditolak',
            'catatan' => 'nullable|string',
        ]);

        // Handle file uploads
        foreach (['foto_ktp', 'foto_kartu_keluarga', 'foto_pernyataan_tetangga', 'foto_pengantar_rt_rw'] as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                    Storage::disk('private')->delete($surat->$field);
                }
                // Store new file
                $validatedData[$field] = $request->file($field)->store('uploads', 'private');
            } else {
                // Keep existing file if no new file uploaded
                $validatedData[$field] = $surat->$field;
            }
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
            return redirect()->route('surat_pengantar_ijin_keramaian.index')
                ->with('success', 'Surat pengantar ijin keramaian berhasil diperbarui.');
        } else {
            return redirect()->back()->with('success', 'Surat berhasil diperbarui.');
        }

    }

      protected function sendRejectionNotification(SuratPengantarIjinKeramaian $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Mohon maaf, pengajuan Surat Keterangan Ijin Keramain Anda *ditolak*.\n";
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

    protected function sendSelesaiNotification(SuratPengantarIjinKeramaian $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Pengajuan Surat Keterangan Ijin Keramain Anda telah *SELESAI*.\n";
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $surat = SuratPengantarIjinKeramaian::findOrFail($id);
        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
                abort(404, 'Maaf, halaman ini tidak tersedia.');
            }

        foreach (['foto_ktp', 'foto_kartu_keluarga', 'foto_pernyataan_tetangga', 'foto_pengantar_rt_rw'] as $field) {
            if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                Storage::disk('private')->delete($surat->$field);
            }
        }

        $surat->delete();
        if (auth()->user()->hasRole('Admin')) {
            return redirect()->route('surat_pengantar_ijin_keramaian.index')
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
        $surat = SuratPengantarIjinKeramaian::findOrFail($id);
        return view('backend.pages.Ijin_Keramain.preview-pdf', compact('surat'));
    }

    public function generatePdf(Request $request, $id)
    {
         if (!auth()->user()->hasRole('Admin')) {
              abort(404, 'Maaf, halaman ini tidak tersedia.');
            }
        $surat = SuratPengantarIjinKeramaian::findOrFail($id);

        $data = [
            'surat' => $surat,
            'nomor_surat' => $request->nomor_surat ?? '300 /     / 02.1006 / ' . date('Y'),
            'tanggal_surat' => $request->tanggal_surat ?? now(),
            'lurah_nip' => $request->lurah_nip,
            'camat_nip' => $request->camat_nip,
            'danramil_nrp' => $request->danramil_nrp,
            'kapolsek_nip' => $request->kapolsek_nip,
            'kapolsek_nomor' => $request->kapolsek_nomor,
            'kapolsek_tanggal' => $request->kapolsek_tanggal,
            'kapolsek_status' => $request->kapolsek_status,
            'kapolsek_catatan' => $request->kapolsek_catatan,
        ];

        $mpdf = new Mpdf([
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

        $html = view('backend.pages.Ijin_Keramain.pdf.surat', $data)->render();
        $mpdf->WriteHTML($html);

        return $mpdf->Output('Surat-Ijin-Keramaian-'.$surat->id.'.pdf', \Mpdf\Output\Destination::INLINE);
    }
}
