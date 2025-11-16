<?php
namespace App\Http\Controllers;
use App\Models\Saran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use ReCaptcha\ReCaptcha;



class SaranController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'pesan' => 'required|string',
            'g-recaptcha-response' => 'required|string',
        ]);

        // Verifikasi reCAPTCHA
        $recaptcha = new ReCaptcha(config('services.recaptcha.secret_key'));
        $response = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());

        if (!$response->isSuccess()) {
            return redirect()->back()->withErrors(['captcha' => 'reCAPTCHA validation failed.']);
        }

        Saran::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'pesan' => $validated['pesan'],
        ]);

        return redirect()->back()->with('success', 'Terima kasih atas sarannya!');
    }



    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sarans = Saran::latest()->get();

            // Mengubah format tanggal menggunakan Carbon
            $sarans->transform(function ($saran) {
                $saran->created_at = Carbon::parse($saran->created_at)->timezone('Asia/Jakarta')->format('d-m-Y');
                return $saran;
            });

            return DataTables::of($sarans)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    return view('backend.pages.Saran.action', compact('row'));
                })
                ->rawColumns(['aksi']) // jika ada HTML di kolom aksi
                ->make(true);
        }

        return view('backend.pages.Saran.index');
    }




    public function destroy($id)
    {
        $saran = Saran::findOrFail($id);
        $saran->delete();
        return redirect()->back()->with('success', 'Saran berhasil dihapus!');
    }
}
