<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Models\Article;

// Home Page
Route::get('/', function () {
    // Ambil data artikel dari database
    $articles = Article::latest()->take(6)->get(); // ambil 6 artikel terbaru

    return view('home', compact('articles'));
})->name('home');

// About Us Page
Route::view('/about', 'about-us')->name('about-us');

// Tracer Study Page
Route::view('/tracer', 'tracer-study')->name('tracer');

// Profile (Hanya untuk user login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth system (login, register, dll)
require __DIR__.'/auth.php';