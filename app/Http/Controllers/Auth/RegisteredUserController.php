<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan modal register di halaman home.
     */
    public function create(): RedirectResponse
    {
        session(['openModal' => 'register']);
        return redirect('/');
    }

    /**
     * Handle pendaftaran user baru (user, alumni, employer).
     */
    public function store(Request $request)
    {
        // ======== DETEKSI ROLE & VALIDASI BERDASARKAN ROLE ========
        $role = $request->role ?? 'user';

        $rules = match ($role) {
            // === Default user register ===
            'user' => [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],

            // === Alumni / Candidate ===
            'alumni' => [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:20'],
                'region' => ['required', 'string', 'max:100'],
                'nationality' => ['required', 'string', 'max:100'],
                // optional
                'email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            ],

            // === Employer / Company ===
            'employer' => [
                'company_name' => ['required', 'string', 'max:255'],
                'registration_number' => ['required', 'string', 'max:255'],
                'company_website' => ['nullable', 'string', 'max:255'],
                'industry' => ['required', 'string', 'max:255'],
                'photo' => ['nullable', 'image', 'max:2048'],
                'company_profile' => ['required', 'string'],
                'email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            ],

            // === Default fallback ===
            default => [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
        };

        $validated = $request->validate($rules);

        // ======== PEMBUATAN USER BERDASARKAN ROLE ========
        switch ($role) {
            case 'alumni':
                $user = User::create([
                    'name' => trim($validated['first_name'] . ' ' . $validated['last_name']),
                    'email' => $validated['email'] ?? "{$validated['first_name']}@noemail.local",
                    'password' => Hash::make('password'), // default password (bisa diubah nanti)
                    'extra_data' => json_encode([
                        'phone' => $validated['phone'] ?? null,
                        'region' => $validated['region'] ?? null,
                        'nationality' => $validated['nationality'] ?? null,
                    ]),
                ]);
                break;

            case 'employer':
                // simpan foto kalau ada
                $photoPath = null;
                if ($request->hasFile('photo')) {
                    $photoPath = $request->file('photo')->store('employer_photos', 'public');
                }

                $user = User::create([
                    'name' => $validated['company_name'],
                    'email' => $validated['email'] ?? "{$validated['company_name']}@company.local",
                    'password' => Hash::make('password'),
                    'extra_data' => json_encode([
                        'registration_number' => $validated['registration_number'] ?? null,
                        'company_website' => $validated['company_website'] ?? null,
                        'industry' => $validated['industry'] ?? null,
                        'company_profile' => $validated['company_profile'] ?? null,
                        'photo' => $photoPath,
                    ]),
                ]);
                break;

            default: // 'user'
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                ]);
                break;
        }

        // ======== ASSIGN ROLE, LOGIN, & RESPONSE ========
        $user->assignRole($role);
        event(new Registered($user));
        Auth::login($user);

        // Respon JSON untuk AJAX
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'redirect' => route('home'),
            ]);
        }

        // Redirect standar
        return redirect(route('home'));
    }
}