@extends('layouts.app')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 text-center">
        
        {{-- === Judul & Deskripsi === --}}
        <h2 class="text-3xl font-bold text-[#34307A] mb-2 capitalize">
            {{ str_replace('-', ' ', $category) }}
        </h2>
        <p class="text-gray-600 mb-10">
            Book a session with our professional {{ strtolower($category) }} counselors
        </p>

        {{-- === Jika belum ada konselor === --}}
        @if($counselors->isEmpty())
            <div class="py-20 text-gray-500 text-lg">
                No counselors available yet.
            </div>
        @else

            {{-- === Grid List Counselor === --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($counselors as $c)
                    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition duration-300 text-left">
                        
                        {{-- FOTO + NAMA --}}
                        <div class="flex items-center mb-4">
                            <img src="{{ $c->photo ? asset('storage/' . $c->photo) : asset('images/default-profile.png') }}" 
                                 alt="{{ $c->name }}" 
                                 class="w-10 h-10 rounded-full object-cover mr-3">
                            <div>
                                <h3 class="font-bold text-[#34307A]">{{ $c->name }}</h3>
                                <p class="text-gray-500 text-sm">{{ $c->title }}</p>
                            </div>
                        </div>

                        {{-- TAGS --}}
                        @if(!empty($c->tags))
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach ($c->tags as $tag)
                                    <span class="bg-[#E8E8FF] text-[#34307A] text-xs px-2 py-1 rounded-md">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        {{-- ORGANISASI --}}
                        @if(!empty($c->organization))
                            <p class="text-sm text-gray-600 mb-2">{{ $c->organization }}</p>
                        @endif

                        {{-- STATUS KETERSEDIAAN --}}
                        <p class="text-sm mb-4">
                            <span class="font-medium text-gray-700">Tersedia:</span>
                            @if($c->availability_status === 'available')
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded">Hari ini</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">
                                    {{ $c->available_date ?? 'Segera' }}
                                </span>
                            @endif
                        </p>

                        {{-- TOMBOL AKSI --}}
                        <div class="flex justify-between items-center">
                            <a href="#" 
                               class="border border-[#34307A] text-[#34307A] px-3 py-2 rounded-md hover:bg-[#34307A] hover:text-white transition text-sm">
                               Konsultasi Online
                            </a>
                            <a href="#" 
                               class="text-[#34307A] font-medium text-sm hover:opacity-80">
                               Pesan Janji Temu
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- === Pagination (selalu tampil) === --}}
            <div class="mt-10 flex justify-center">
                {{ $counselors->appends(request()->query())->links('pagination::tailwind') }}
            </div>

            {{-- Back Button --}}
            <div class="mt-10 justify-self-start">
                <a href="{{ route('counseling') }}" class="text-[#34307A] font-medium hover:underline">
                    ← Back to counseling
                </a>
            </div>
        @endif
    </div>
</section>
@endsection