@extends('layouts.app')

@section('content')
<section class="py-16 bg-[#f7f7ff] min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        {{-- Judul --}}
        <h2 class="text-3xl font-bold text-[#34307A] text-center mb-12">EVENTS</h2>

        {{-- Jika kosong --}}
        @if($events->isEmpty())
            <div class="text-center text-gray-500 text-lg py-32">
                No events available yet.
            </div>
        @else
            {{-- Grid Event --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                    <a href="{{ route('events.show', $event->id) }}" 
                       class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 p-4 text-left">
                        
                        {{-- Thumbnail --}}
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('images/default-event.jpg') }}"
                             alt="{{ $event->title }}"
                             class="w-full h-52 object-cover rounded-xl mb-4">

                        {{-- Title --}}
                        <h3 class="font-semibold text-lg text-gray-800 leading-snug mb-2 line-clamp-2">
                            {{ $event->title }}
                        </h3>

                        {{-- Category & Date --}}
                        <div class="flex items-center gap-3 mb-3">
                            <span class="bg-[#E8E8FF] text-[#34307A] text-xs px-3 py-1 rounded-full">
                                {{ $event->category ?? 'General' }}
                            </span>
                            @if($event->event_date)
                                <span class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                </span>
                            @endif
                        </div>

                        {{-- Excerpt --}}
                        @if($event->excerpt)
                            <p class="text-sm text-gray-600 line-clamp-3">
                                {{ $event->excerpt }}
                            </p>
                        @endif
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-10 flex justify-center">
                {{ $events->appends(request()->query())->onEachSide(1)->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</section>
@endsection