<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index() {
        $articles = Article::latest()->take(3)->get();
        return view('home', compact('articles')); // ini buat tampil di home
    }

    public function adminIndex() {
        $articles = Article::latest()->paginate(10);
        return view('admin.article.index', compact('articles'));
    }

    public function create() {
        return view('admin.article.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('articles', 'public') : null;

        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'tag' => $request->tag,
            'image' => $imagePath,
            'published_at' => now(),
        ]);

        return redirect()->route('admin.article.index')->with('success', 'Article created!');
    }
}