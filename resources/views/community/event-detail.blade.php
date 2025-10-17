@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-16">
    <div class="max-w-3xl mx-auto px-6">
        {{-- Title --}}
        <h1 class="text-3xl md:text-4xl font-bold text-[#34307A] mb-3 leading-snug">
            {{ $event->title }}
        </h1>

        {{-- Date --}}
        @if($event->event_date)
            <p class="text-sm text-gray-500 mb-6">
                Event Date: {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
            </p>
        @endif

        {{-- Category --}}
        <span class="bg-[#E8E8FF] text-[#34307A] text-xs px-3 py-1 rounded-md mb-4 inline-block">
            {{ $event->category }}
        </span>

        {{-- Image --}}
        <img src="{{ $event->image ? asset('storage/'.$event->image) : asset('images/default-event.jpg') }}"
             alt="{{ $event->title }}"
             class="w-full rounded-xl mb-8 shadow">

        {{-- Content --}}
        <div class="text-gray-700 leading-relaxed space-y-4 prose max-w-none">
            {!! nl2br(e($event->content)) !!}
        </div>

        {{-- Back Button --}}
        <div class="mt-10">
            <a href="{{ route('events.index') }}" class="text-[#34307A] font-medium hover:underline">
                ← Back to Events
            </a>
        </div>
    </div>
</section>
@endsection