@extends('layouts.app')

@section('content')
<section class="py-16 bg-[#f7f7ff] min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        {{-- Judul --}}
        <h2 class="text-3xl font-bold text-[#34307A] text-center mb-12">NEWS</h2>

        {{-- Jika kosong --}}
        @if($news->isEmpty())
            <div class="text-center text-gray-500 text-lg py-32">
                No news available yet.
            </div>
        @else
            {{-- Grid News --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($news as $item)
                    <a href="{{ route('news.show', $item->id) }}" 
                    class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 p-4 text-left">
                        
                        {{-- Thumbnail --}}
                        <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default-news.jpg') }}"
                            alt="{{ $item->title }}"
                            class="w-full h-52 object-cover rounded-xl mb-4">

                        {{-- Title --}}
                        <h3 class="font-semibold text-lg text-gray-800 leading-snug mb-2 line-clamp-2">
                            {{ $item->title }}
                        </h3>

                        {{-- Category & Date --}}
                        <div class="flex items-center gap-3 mb-3">
                            <span class="bg-[#E8E8FF] text-[#34307A] text-xs px-3 py-1 rounded-full">
                                {{ $item->category ?? 'General' }}
                            </span>
                            <span class="text-xs text-gray-500">
                                {{ $item->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-10 flex justify-center">
                {{ $news->appends(request()->query())->onEachSide(1)->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</section>
@endsection