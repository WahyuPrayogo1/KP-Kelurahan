<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganTidakMampu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Illuminate\Support\Facades\Http;

class SuratKeteranganTidakMampuController extends Controller
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
            $absens = SuratKeteranganTidakMampu::with('user')->get();
            return DataTables::of($absens)
                ->addColumn('status', function ($row) {
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
                    return view('backend.pages.tidak_mampu.actions', compact('row'));
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        }
        return view('backend.pages.tidak_mampu.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.tidak_mampu.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                // Data Pemohon
                'nama' => 'required|string|max:255',
                'nik' => 'required|digits:16',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:L,P',
                'kewarganegaraan' => 'required|string|max:255',
                'pekerjaan' => 'required|string|max:255',
                'status_perkawinan' => 'required|string|max:255',
                'agama' => 'required|string|max:255',

                // Alamat (dari form yang digabungkan)
                'tempat' => 'required|string|max:255',
                'kelurahan' => 'required|string|max:255',
                'kecamatan' => 'required|string|max:255',
                'kode_pos' => 'required|digits:5',

                // Dokumen
                'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'foto_kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'foto_pengantar_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',

                'catatan' => 'nullable|string',
            ],
            [
                // Custom error messages
                'nama.required' => 'Nama lengkap wajib diisi.',
                'nik.required' => 'NIK wajib diisi.',
                'nik.unique' => 'NIK sudah terdaftar.',
                'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
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

                'foto_ktp.required' => 'Foto KTP wajib diunggah.',
                'foto_kk.required' => 'Foto Kartu Keluarga wajib diunggah.',
                'foto_pengantar_rt_rw.required' => 'Foto Pengantar RT/RW wajib diunggah.',

                'foto_ktp.image' => 'File KTP harus berupa gambar.',
                'foto_kk.image' => 'File KK harus berupa gambar.',
                'foto_pengantar_rt_rw.image' => 'File pengantar RT/RW harus berupa gambar.',

                'foto_ktp.mimes' => 'Format KTP harus jpeg, jpg, atau png.',
                'foto_kk.mimes' => 'Format KK harus jpeg, jpg, atau png.',
                'foto_pengantar_rt_rw.mimes' => 'Format pengantar RT/RW harus jpeg, jpg, atau png.',

                'foto_ktp.max' => 'Ukuran KTP tidak boleh lebih dari 2MB.',
                'foto_kk.max' => 'Ukuran KK tidak boleh lebih dari 2MB.',
                'foto_pengantar_rt_rw.max' => 'Ukuran pengantar RT/RW tidak boleh lebih dari 2MB.',
            ],
        );

        // Gabungkan alamat lengkap
        $validated['alamat'] = $request->tempat . ', Kel. ' . $request->kelurahan . ', Kec. ' . $request->kecamatan . ', Kota Sukabumi' . ', ' . $request->kode_pos;

        // Simpan file ke folder private
        $fileFields = ['foto_ktp', 'foto_kk', 'foto_pengantar_rt_rw'];
        foreach ($fileFields as $field) {
            $validated[$field] = $request->file($field)->store('uploads/sktm', 'private');
        }

        // Tambahkan data otomatis
        $validated['user_id'] = auth()->id();
        $validated['status'] = 'proses';

        // Simpan ke database
        SuratKeteranganTidakMampu::create($validated);

        return redirect()->route('/dashboard')->with('success', 'Pengajuan Surat Keterangan Tidak Mampu berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $surat = SuratKeteranganTidakMampu::findOrFail($id);
        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }
        return view('backend.pages.tidak_mampu.show', compact('surat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $surat = SuratKeteranganTidakMampu::findOrFail($id);
        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }
        return view('backend.pages.tidak_mampu.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $surat = SuratKeteranganTidakMampu::findOrFail($id);

        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }
        $previousStatus = $surat->status; // Simpan status sebelumnya
        $validated = $request->validate(
            [
                // Data Pemohon
                'nama' => 'required|string|max:255',
                'nik' => 'required|digits:16|unique:surat_keterangan_tidak_mampus,nik,' . $id,
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',

                'jenis_kelamin' => 'required|in:L,P',
                'kewarganegaraan' => 'required|string|max:255',
                'pekerjaan' => 'required|string|max:255',
                'status_perkawinan' => 'required|string|max:255',
                'agama' => 'required|string|max:255',
                'alamat' => 'required|string|max:500',

                // Dokumen
                'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'foto_kk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'foto_pengantar_rt_rw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

                'status' => 'required|in:proses,selesai,ditolak',
                'catatan' => 'nullable|string',
            ],
            [
                // Custom error messages
                'nama.required' => 'Nama lengkap wajib diisi.',
                'nik.required' => 'NIK wajib diisi.',
                'nik.digits' => 'NIK harus terdiri dari 16 digit.',
                'nik.unique' => 'NIK sudah terdaftar.',
                'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',

                'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
                'kewarganegaraan.required' => 'Kewarganegaraan wajib diisi.',
                'pekerjaan.required' => 'Pekerjaan wajib diisi.',
                'status_perkawinan.required' => 'Status perkawinan wajib diisi.',
                'agama.required' => 'Agama wajib diisi.',
                'alamat.required' => 'Alamat wajib diisi.',

                'foto_ktp.image' => 'File KTP harus berupa gambar.',
                'foto_kk.image' => 'File KK harus berupa gambar.',
                'foto_pengantar_rt_rw.image' => 'File pengantar RT/RW harus berupa gambar.',

                'foto_ktp.mimes' => 'Format KTP harus jpeg, jpg, atau png.',
                'foto_kk.mimes' => 'Format KK harus jpeg, jpg, atau png.',
                'foto_pengantar_rt_rw.mimes' => 'Format pengantar RT/RW harus jpeg, jpg, atau png.',

                'foto_ktp.max' => 'Ukuran KTP tidak boleh lebih dari 2MB.',
                'foto_kk.max' => 'Ukuran KK tidak boleh lebih dari 2MB.',
                'foto_pengantar_rt_rw.max' => 'Ukuran pengantar RT/RW tidak boleh lebih dari 2MB.',

                'status.required' => 'Status wajib dipilih.',
            ],
        );



        // Handle file uploads
        $fileFields = ['foto_ktp', 'foto_kk', 'foto_pengantar_rt_rw'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($surat->$field && Storage::disk('private')->exists($surat->$field)) {
                    Storage::disk('private')->delete($surat->$field);
                }
                // Store new file
                $validated[$field] = $request->file($field)->store('uploads/sktm', 'private');
            } else {
                // Keep existing file if no new upload
                $validated[$field] = $surat->$field;
            }
        }

        // Update the record
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
            return redirect()->route('surat_keterangan_tidak_mampu.index')
                ->with('success', 'Surat Keterangan Tidak Mampu berhasil diperbarui.');
        } else {
            return redirect()->back()->with('success', 'Surat berhasil diperbarui.');
        }

    }

     protected function sendRejectionNotification(SuratKeteranganTidakMampu $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Mohon maaf, pengajuan Surat Keterangan Tidak Mampu *ditolak*.\n";
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

    protected function sendSelesaiNotification(SuratKeteranganTidakMampu $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Pengajuan Surat Surat Keterangan Tidak Mampu telah *SELESAI*.\n";
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
        try {
            // Find the record
            $sktm = SuratKeteranganTidakMampu::findOrFail($id);
             if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $sktm->user_id) {
                abort(404, 'Maaf, halaman ini tidak tersedia.');
            }

            // List of file fields to delete
            $fileFields = ['foto_ktp', 'foto_kk', 'foto_pengantar_rt_rw'];

            // Delete all associated files
            foreach ($fileFields as $field) {
                if ($sktm->$field && Storage::disk('private')->exists($sktm->$field)) {
                    Storage::disk('private')->delete($sktm->$field);
                }
            }

            // Delete the record
            $sktm->delete();
            if (auth()->user()->hasRole('Admin')) {
                return redirect()->route('surat_keterangan_tidak_mampu.index')
                    ->with('success', 'Surat Keterangan Tidak Mampu berhasil diperbarui.');
                } else {
                    return redirect()->back()->with('success', 'Surat berhasil diperbarui.');
                }
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus data. Error: ' . $e->getMessage());
        }
    }

    public function previewPdf($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }
        $surat = SuratKeteranganTidakMampu::findOrFail($id);
        return view('backend.pages.tidak_mampu.preview-pdf', compact('surat'));
    }

    public function generatePdf(Request $request, $id)
{
    if (!auth()->user()->hasRole('Admin')) {
        abort(404, 'Maaf, halaman ini tidak tersedia.');
    }

    $surat = SuratKeteranganTidakMampu::findOrFail($id);

    // Format the dates
    $tanggal_surat_pengantar = \Carbon\Carbon::parse($request->tanggal_surat_pengantar)->format('d F Y');
    $tanggal_materai = \Carbon\Carbon::parse($request->tanggal_materai)->format('d F Y');

    // Format the number with thousand separators
    $penghasilan_perbulan = number_format($request->penghasilan_perbulan, 0, ',', '.');

    $data = [
        'surat' => $surat,
        'nomor_surat' => $request->nomor_surat ?? '300 /     / 02.1006 / ' . date('Y'),
        'tanggal_surat' => $request->tanggal_surat ?? now(),
        'lurah_nip' => $request->lurah_nip,
        'nama_lurah' => $request->nama_lurah,
        'nomor' => $request->nomor_surat_pengantar,
        'tanggal' => $tanggal_surat_pengantar,
        'tanggal_materai' => $tanggal_materai,
        'perbulan_harga' => $penghasilan_perbulan,
        'digunakan' => $request->digunakan_untuk,
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

    $html = view('backend.pages.tidak_mampu.pdf.surat', $data)->render();
    $mpdf->WriteHTML($html);

    return $mpdf->Output('Surat-Keterangan-Tidak-Mampu-'.$surat->id.'.pdf', \Mpdf\Output\Destination::INLINE);
}
}
