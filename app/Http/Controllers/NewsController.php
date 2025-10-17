<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    // === List Semua Berita ===
    public function index()
    {
        $news = News::latest()->paginate(9);
        return view('community.news', compact('news'));
    }

    // === Detail per Berita ===
    public function show($id)
    {
        $article = News::findOrFail($id);
        return view('community.news-detail', compact('article'));
    }
}