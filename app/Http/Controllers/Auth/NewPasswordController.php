<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Article;

class NewPasswordController extends Controller
{
    public function create(Request $request, $token)
    {
        // kirim token & email ke view (buat modal)
        $articles = Article::latest()->take(6)->get();

        return view('home', [
            'articles' => $articles,
            'resetToken' => $token,
            'resetEmail' => $request->query('email'),
            'openModal' => 'resetPassword'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? response()->json(['success' => true, 'message' => 'Password successfully changed.'])
            : response()->json(['success' => false, 'message' => __($status)], 400);
    }
}