@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-16">
    <div class="max-w-3xl mx-auto px-6">
        {{-- JUDUL --}}
        <h1 class="text-3xl md:text-4xl font-bold text-[#34307A] mb-3">
            {{ $article->title }}
        </h1>

        {{-- TANGGAL --}}
        <p class="text-sm text-gray-500 mb-6">
            Updated on {{ $article->created_at->format('d M, Y') }}
        </p>

        {{-- KATEGORI --}}
        <span class="bg-[#E8E8FF] text-[#34307A] text-xs px-3 py-1 rounded-md mb-4 inline-block">
            {{ $article->category }}
        </span>

        {{-- GAMBAR --}}
        <img src="{{ $article->image ? asset('storage/'.$article->image) : asset('images/default-news.jpg') }}"
             alt="{{ $article->title }}"
             class="w-full rounded-xl mb-8 shadow">

        {{-- KONTEN --}}
        <div class="text-gray-700 leading-relaxed space-y-4 prose max-w-none">
            {!! nl2br(e($article->content)) !!}
        </div>

        {{-- BACK BUTTON --}}
        <div class="mt-10">
            <a href="{{ route('news.index') }}" 
               class="text-[#34307A] font-medium hover:underline">
                ← Back to News
            </a>
        </div>
    </div>
</section>
@endsection