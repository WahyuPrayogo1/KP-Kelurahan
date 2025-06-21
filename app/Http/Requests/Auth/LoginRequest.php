<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'whatsapp_number' => [
                'required',
                'string',
                'max:15',
                'regex:/^08\d{8,13}$/'
            ],
            'password' => ['required'],
        ];
    }

    /**
     * Authenticate the user.
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt([
            'whatsapp_number' => $this->whatsapp_number,
            'password' => $this->password,
        ], $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'whatsapp_number' => __('Nomor WhatsApp atau password salah.'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate-limited.
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        throw ValidationException::withMessages([
            'whatsapp_number' => __('auth.throttle', [
                'seconds' => RateLimiter::availableIn($this->throttleKey()),
            ]),
        ]);
    }

    /**
     * Get the rate limit key for the request.
     */
    public function throttleKey(): string
    {
        return strtolower($this->input('whatsapp_number')).'|'.$this->ip();
    }
}
