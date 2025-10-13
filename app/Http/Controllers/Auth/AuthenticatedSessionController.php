<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan modal login (bukan halaman baru).
     * Modal ini ditrigger via session supaya tetap di halaman home.
     */
    public function create(): RedirectResponse
    {
        session(['openModal' => 'login']);
        return redirect('/');
    }

    /**
     * Handle proses login user (via AJAX di modal login).
     */
    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember', false);

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Kalau AJAX, kirim JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'redirect' => route('home'),
                ]);
            }

            // Kalau non-AJAX (misalnya form biasa)
            return redirect()->intended(route('home'));
        }

        // Kalau gagal login
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'E-mail atau password salah.',
            ], 401);
        }

        return back()->withErrors(['email' => 'E-mail atau password salah.']);
    }

    /**
     * Logout user dan kembali ke halaman home.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // langsung ke home
    }
}