<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display login modal instead of standalone page.
     * This is used only when someone manually visits /login.
     */
    public function create(): \Illuminate\Http\RedirectResponse
    {
        session(['openModal' => 'login']);
        return redirect('/');
    }

    /**
     * Handle user login (via AJAX modal).
     */
    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember', false);

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // If AJAX request
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'redirect' => route('home'),
                ]);
            }

            // If normal form submission
            return redirect()->intended(route('home'));
        }

        // If login fails (invalid credentials)
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password.',
            ], 401);
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    /**
     * Logout user and redirect to home.
     */
    public function destroy(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}