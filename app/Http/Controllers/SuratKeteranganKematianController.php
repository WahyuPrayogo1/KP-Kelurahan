<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganKematian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Http;

class SuratKeteranganKematianController extends Controller
{
public function index(Request $request)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(403, 'Unauthorized'); // ganti abort 404 jadi 403 sesuai contoh
        }

        if ($request->ajax()) {
            $data = SuratKeteranganKematian::with('user')->get(); // model dari kode pertama
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
                        case 'revisi':
                            $badgeClass = 'danger';
                            break;
                        default:
                            $badgeClass = 'secondary';
                            break;
                    }
                    return '<span class="text-white badge bg-' . $badgeClass . '">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('aksi', function ($row) {
                    return view('backend.pages.keterangan_kematian.actions', compact('row')); // view dari kode pertama
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        }

        return view('backend.pages.keterangan_kematian.index'); // view dari kode pertama
    }


    public function create()
    {
        return view('backend.pages.keterangan_kematian.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'max' => ':attribute maksimal :max karakter.',
            'date' => ':attribute harus berupa tanggal yang valid.',
            'in' => ':attribute tidak valid.',
            'image' => ':attribute harus berupa gambar.',
            'mimes' => ':attribute harus berupa file dengan format jpeg, jpg, atau png.',
            'digits' => ':attribute harus terdiri dari :digits angka.',
            'digits_between' => ':attribute harus terdiri dari antara :min sampai :max digit.',
        ];

        $attributeNames = [
            'nama' => 'Nama Lengkap',
            'jenis_kelamin' => 'Jenis Kelamin',
            'alamat_lengkap' => 'Alamat Lengkap',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'tempat_meninggal' => 'Tempat Meninggal',
            'tanggal_meninggal' => 'Tanggal Meninggal',
            'penyebab_kematian' => 'Penyebab Kematian',
            'kewarganegaraan' => 'Kewarganegaraan',
            'agama' => 'Agama',
            'fc_ktp' => 'Fotokopi KTP',
            'fc_kk' => 'Fotokopi KK',
            'fc_buku_nikah' => 'Fotokopi Buku Nikah',
            'pengantar_kematian_rt_rw' => 'Surat Pengantar Kematian dari RT/RW',
            'alamat' => 'Alamat',
            'rt' => 'RT',
            'rw' => 'RW',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'kode_pos' => 'Kode Pos',
            'catatan' => 'Catatan Tambahan',
        ];

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|in:L,P',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|digits_between:1,3',
            'rw' => 'required|digits_between:1,3',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|digits:5',

            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'tempat_meninggal' => 'required|string|max:255',
            'tanggal_meninggal' => 'required|date',
            'penyebab_kematian' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string|max:100',
            'agama' => 'required|string|max:100',

            'fc_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'fc_kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'fc_buku_nikah' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'pengantar_kematian_rt_rw' => 'required|image|mimes:jpeg,png,jpg|max:2048',

            'catatan' => 'nullable|string',
        ], $messages, $attributeNames);

        // Susun alamat lengkap
        $validated['alamat_lengkap'] = $request->alamat . ', RT ' . $request->rt . '/RW ' . $request->rw . ', Kel. ' . $request->kelurahan . ', Kec. ' . $request->kecamatan . ', Kota Sukabumi, ' . $request->kode_pos;

        // Upload file
        foreach (['fc_ktp', 'fc_kk', 'fc_buku_nikah', 'pengantar_kematian_rt_rw'] as $fileField) {
            $validated[$fileField] = $request->file($fileField)->store('uploads', 'private');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'proses';

        $surat = SuratKeteranganKematian::create($validated);
          // Kirim notifikasi WhatsApp
        $this->sendNewSubmissionNotification($surat);


        return redirect()->route('/dashboard')->with('success', 'Pengajuan berhasil dikirim.');
    }

    protected function sendNewSubmissionNotification(SuratKeteranganKematian $surat)
    {
        $targetNumber = '081222535789'; // Nomor tujuan
        $user = $surat->user;

        $message = "Halo Admin,\n\n";
        $message .= "Ada pengajuan baru Surat Keterangan Kematian dengan detail berikut:\n";
        $message .= "Nama: {$surat->nama}\n";
        $message .= "Tanggal Lahir: {$surat->tanggal_lahir}\n";
        $message .= "Alamat: {$surat->alamat_lengkap}\n\n";
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
        $surat = SuratKeteranganKematian::findOrFail($id);
         if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        return view('backend.pages.keterangan_kematian.show', compact('surat'));
    }

    public function edit($id)
    {
        $surat = SuratKeteranganKematian::findOrFail($id);
        if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        return view('backend.pages.keterangan_kematian.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $surat = SuratKeteranganKematian::findOrFail($id);
         if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        $previousStatus = $surat->status; // Simpan status sebelumnya

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|in:L,P',
            'alamat_lengkap' => 'required|string|max:500',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'tempat_meninggal' => 'required|string|max:255',
            'tanggal_meninggal' => 'required|date',
            'penyebab_kematian' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string|max:100',
            'agama' => 'required|string|max:100',

            'fc_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'fc_kk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'fc_buku_nikah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pengantar_kematian_rt_rw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            'status' => 'required|in:proses,selesai,revisi',
            'catatan' => 'nullable|string',
        ]);

        foreach (['fc_ktp', 'fc_kk', 'fc_buku_nikah', 'pengantar_kematian_rt_rw'] as $fileField) {
            if ($request->hasFile($fileField)) {
                if ($surat->$fileField && Storage::disk('private')->exists($surat->$fileField)) {
                    Storage::disk('private')->delete($surat->$fileField);
                }
                $validated[$fileField] = $request->file($fileField)->store('uploads', 'private');
            } else {
                $validated[$fileField] = $surat->$fileField;
            }
        }

        $surat->update($validated);
        // Kirim notifikasi hanya jika status berubah
        if ($previousStatus != $request->status) {
            if ($request->status == 'revisi') {
                $this->sendRejectionNotification($surat);
            } elseif ($request->status == 'selesai') {
                $this->sendSelesaiNotification($surat);
            }
        }
         if (auth()->user()->hasRole('Admin')) {
            return redirect()->route('surat_keterangan_kematian.index')
                ->with('success', 'Surat Keterangan Kematian berhasil diperbarui.');
        } else {
            return redirect()->back()->with('success', 'Surat berhasil diperbarui.');
        }

    }

    protected function sendRejectionNotification(SuratKeteranganKematian $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Mohon maaf, pengajuan Surat Keterangan Kematian *ditolak*.\n";
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

    protected function sendSelesaiNotification(SuratKeteranganKematian $surat)
    {
        $user = $surat->user;
        $whatsappNumber = $user->whatsapp_number;

        $message = "Halo {$user->name},\n\n";
        $message .= "Pengajuan Surat Keterangan Kematian telah *SELESAI*.\n";
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
        $surat = SuratKeteranganKematian::findOrFail($id);
       if (!auth()->user()->hasRole('Admin') && auth()->user()->id != $surat->user_id) {
                abort(404, 'Maaf, halaman ini tidak tersedia.');
            }


        foreach (['fc_ktp', 'fc_kk', 'fc_buku_nikah', 'pengantar_kematian_rt_rw'] as $fileField) {
            if ($surat->$fileField && Storage::disk('private')->exists($surat->$fileField)) {
                Storage::disk('private')->delete($surat->$fileField);
            }
        }

        $surat->delete();
        if (auth()->user()->hasRole('Admin')) {
            return redirect()->route('surat_keterangan_kematian.index')
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

        $surat = SuratKeteranganKematian::findOrFail($id);
        return view('backend.pages.keterangan_kematian.preview-pdf', compact('surat'));
    }

    public function generatePdf(Request $request, $id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404, 'Maaf, halaman ini tidak tersedia.');
        }

        $validatedData = $request->validate([
            'nomor_surat' => 'required|string',
            'tanggal_surat' => 'required|date',
            'hari_meninggal' => 'required|string',
            'dimakamkan_di' => 'required|string',
            'nomor_surat_pengantar' => 'required|string',
            'lurah_nip' => 'required|string',
            'nama_lurah' => 'required|string|max:255',
        ]);

        $surat = SuratKeteranganKematian::findOrFail($id);

        $data = [
            'surat' => $surat,
            'nomor_surat' => $validatedData['nomor_surat'],
            'tanggal_surat' =>  $validatedData['tanggal_surat'],
            'hari_meninggal' => $validatedData['hari_meninggal'],
            'dimakamkan_di' =>  $validatedData['dimakamkan_di'],
            'nomor_surat_pengantar' =>  $validatedData['nomor_surat_pengantar'],
            'lurah_nip' => $validatedData['lurah_nip'],
            'nama_lurah' => $validatedData['nama_lurah'],
        ];

        $mpdf = new Mpdf([
            'format' => 'A4-P',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 10,
            'margin_bottom' => 10,
        ]);

        $html = view('backend.pages.keterangan_kematian.pdf.surat', $data)->render();

        $mpdf->WriteHTML($html);
        $mpdf->Output('Surat-Keterangan-Kematian-' . $surat->nama . '.pdf', 'I');
    }

}
