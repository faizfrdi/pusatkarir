<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset modal (redirected to home).
     */
    public function create(): RedirectResponse
    {
        session(['openModal' => 'forgot']);
        return redirect('/');
    }

    /**
     * Handle an incoming password reset link request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        // === Kalau request AJAX (Accept: application/json) ===
        if ($request->expectsJson()) {
            if ($status === Password::RESET_LINK_SENT) {
                return response()->json([
                    'success' => true,
                    'message' => __($status), // "We have emailed your password reset link!"
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => __($status), // "User not found" dsb.
            ], 422);
        }

        // === Fallback untuk non-AJAX (bawaan Laravel) ===
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}