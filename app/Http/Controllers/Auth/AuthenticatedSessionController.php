<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // Di AuthenticatedSessionController.php
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'formatted_whatsapp_number' => ['required', 'string', 'starts_with:628'],
            'password' => ['required'],
        ]);

        $credentials = [
            'whatsapp_number' => $request->formatted_whatsapp_number,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return back()->withErrors([
            'formatted_whatsapp_number' => 'Nomor WhatsApp atau password salah.',
        ])->onlyInput('whatsapp_number');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
