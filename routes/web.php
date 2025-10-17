<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CounselingController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Models\Article;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route web publik dan privat ada di sini.
| Dibagi per bagian biar gampang maintain.
|--------------------------------------------------------------------------
*/

// ==============================
// PUBLIC PAGES
// ==============================

// Home Page
Route::get('/', function () {
    $articles = Article::latest()->take(6)->get(); // ambil 6 artikel terbaru
    return view('home', compact('articles'));
})->name('home');

// About Us
Route::view('/about', 'about-us')->name('about-us');

// Tracer Study
Route::view('/tracer', 'tracer-study')->name('tracer');

// Counseling 
Route::view('/counseling', 'counseling')->name('counseling');
Route::get('/counseling/{category}', [CounselingController::class, 'index'])
    ->whereIn('category', ['career', 'academic', 'mental'])
    ->name('counseling.category');

// News
Route::get('/community/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/community/news/{id}', [NewsController::class, 'show'])->name('news.show');

// Events
Route::get('/community/event', [EventController::class, 'index'])->name('events.index');
Route::get('/community/event/{id}', [EventController::class, 'show'])->name('events.show');

// ==============================
// AUTHENTICATION & PASSWORD
// ==============================

// Forgot Password
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    // Reset Password
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});


// ==============================
// PROTECTED (USER LOGIN REQUIRED)
// ==============================
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ==============================
// AUTH SYSTEM (Laravel Breeze / Fortify / Jetstream)
// ==============================
require __DIR__.'/auth.php';