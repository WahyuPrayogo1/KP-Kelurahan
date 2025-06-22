<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showForm()
    {
        return view('auth.forgot-password-wa');
    }

public function sendResetLink(Request $request)
{
    $validated = $request->validate([
        'whatsapp_number' => 'required|string|min:10',
    ]);

    // Format nomor secara konsisten
    $whatsappNumber = preg_replace('/[^0-9]/', '', $validated['whatsapp_number']);
    $whatsappNumber = ltrim($whatsappNumber, '0');

    if (!str_starts_with($whatsappNumber, '62')) {
        $whatsappNumber = '62' . $whatsappNumber;
    }

    // Validasi format akhir harus 628...
    if (!str_starts_with($whatsappNumber, '628')) {
        return back()->with('error', 'Format nomor WhatsApp harus dimulai dengan 628');
    }

    $user = User::where('whatsapp_number', $whatsappNumber)->first();

    if (!$user) {
        return back()->with('error', 'Nomor WhatsApp tidak terdaftar.');
    }

    $token = Str::random(60);

    DB::table('password_reset_tokens')->updateOrInsert(
        ['whatsapp_number' => $whatsappNumber],
        [
            'token' => hash('sha256', $token),
            'created_at' => Carbon::now(),
        ]
    );

    $resetUrl = url('/reset-password?token='.$token.'&wa='.$whatsappNumber);

    $message = "Halo $user->name,\n\nReset password Anda: $resetUrl\n\nLink berlaku 10 menit.";

    try {
        $response = Http::withHeaders([
            'Authorization' => env('WABLAS_TOKEN') . '.' . env('WABLAS_SECRET_KEY'),
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->asForm()->post(env('WABLAS_URL') . '/api/send-message', [
            'phone' => $whatsappNumber,
            'message' => $message
        ]);

        if (!$response->successful()) {
            throw new \Exception('Gagal mengirim WhatsApp');
        }

        return back()->with('success', 'Link reset telah dikirim via WhatsApp.');

    } catch (\Exception $e) {
        return back()->with('error', 'Gagal mengirim link reset. Silakan coba lagi.');
    }
}

    public function showResetForm(Request $request)
    {
        return view('auth.reset-password', [
            'token' => $request->token,
            'whatsappNumber' => $request->wa
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'whatsapp_number' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $tokenData = DB::table('password_reset_tokens')
            ->where('whatsapp_number', $request->whatsapp_number)
            ->first();

        // Perbaikan sintaks di sini:
        if (!$tokenData || !hash_equals($tokenData->token, hash('sha256', $request->token))) {
            return back()->with('error', 'Token tidak valid!');
        }

        if (Carbon::parse($tokenData->created_at)->addMinutes(10)->isPast()) {
            return back()->with('error', 'Token sudah kadaluarsa!');
        }

        User::where('whatsapp_number', $request->whatsapp_number)
            ->update(['password' => bcrypt($request->password)]);

        DB::table('password_reset_tokens')
            ->where('whatsapp_number', $request->whatsapp_number)
            ->delete();

        return redirect()->route('login')->with('success', 'Password berhasil direset!');
    }
}
