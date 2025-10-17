@extends('layouts.app')

@section('content')
    {{-- HERO SECTION --}}
    <section class="bg-[#34307A]">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between py-16 px-6">
            <div class="md:w-1/2 space-y-6">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight">
                    Ayo Isi Tracer Study
                </h1>
                <p class="text-gray-200 text-lg">
                    Gerakan untuk para alumni UIN Syarif Hidayatullah Jakarta untuk mengisi data Tracer Study kalian
                    sebagai bentuk evaluasi Universitas dalam memajukan kualitas pendidikan.
                </p>
                <a href="/tracer"
                class="inline-block px-6 py-3 bg-white text-[#34307A] rounded-full font-semibold hover:bg-gray-100 transition">
                    Fill Tracer Study
                </a>
            </div>
            <div class="md:w-1/2 mt-10 md:mt-0 flex justify-center">
                <img src="{{ asset('images/graduates.png') }}" 
                    alt="Graduates" 
                    class="rounded-2xl shadow-lg max-h-[400px] object-cover">
            </div>
        </div>
    </section>

    {{-- PARTNER SECTION --}}
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Partner</h2>
            <div class="flex flex-wrap justify-center items-center gap-10 opacity-80">
                <img src="{{ asset('images/logo-toyota.png') }}" class="h-10" alt="Toyota">
                <img src="{{ asset('images/logo-prasmul.png') }}" class="h-10" alt="PrasmulYeli">
                <img src="{{ asset('images/logo-sma-yogyakarta.png') }}" class="h-10" alt="SMA Yogyakarta">
            </div>
        </div>
    </section>

    {{-- HOW CAN WE HELP SECTION --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">How can we help?</h2>
            <p class="text-gray-600 mb-10">
                We provide career and job-related services that can help you.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach([
                    ['image' => 'images/icons/home/counseling.png', 'title' => 'Counseling Services', 'desc' => 'Talk to professionals about your career and education'],
                    ['image' => 'images/icons/home/tracer.png', 'title' => 'Tracer Study', 'desc' => 'Track graduate progress after finishing study'],
                    ['image' => 'images/icons/home/community.png', 'title' => 'PUSKAR Community Service', 'desc' => 'Freelance and volunteer projects'],
                    ['image' => 'images/icons/home/job.png', 'title' => 'Job Vacancy', 'desc' => 'Full-time and internship opportunities'],
                ] as $service)
                    <div class="p-6 bg-white rounded-xl shadow hover:shadow-lg transition transform hover:scale-105">
                        <div class="flex justify-center mb-4">
                            <img src="{{ asset($service['image']) }}" alt="{{ $service['title'] }}" class="w-16 h-16 object-contain drop-shadow-md">
                        </div>
                        <h3 class="font-semibold mb-2 text-lg text-[#34307A]">{{ $service['title'] }}</h3>
                        <p class="text-gray-600 text-sm">{{ $service['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- HEAD OF CAREER CENTER SECTION --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between">
            <!-- Image -->
            <div class="md:w-1/3 flex justify-center mb-8 md:mb-0">
                <img src="{{ asset('images/kepala-puskar.png') }}" 
                     alt="Kepala Pusat Karier UIN Jakarta" 
                     class="rounded-2xl shadow-lg w-full object-cover">
            </div>

            <!-- Text Content -->
            <div class="md:w-2/3 md:pl-10 text-left md:text-left">
                <h2 class="text-3xl font-extrabold text-gray-800 leading-snug mb-4">
                    Make your Opportunities<br>in Pusat Karier UIN Jakarta
                </h2>
                <p class="text-gray-600 mb-6">
                    Pusat Karier UIN Jakarta telah menyelenggarakan berbagai kegiatan pelatihan, seminar,
                    dan koordinasi antar fakultas serta lembaga untuk mendukung kegiatan pengembangan karier
                    yang diselenggarakan oleh pusat karier.
                </p>
            </div>
        </div>
    </section>

    {{-- ARTICLE SECTION --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Latest Article</h2>
                <a href="#" class="text-[#34307A] hover:underline text-sm font-medium">More News Articles →</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($articles as $article)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                        <img src="{{ asset('images/' . $article->image) }}" 
                            alt="{{ $article->title }}" 
                            class="w-full h-48 object-cover">
                        <div class="p-5">
                            <h3 class="font-semibold mb-2 text-gray-800">{{ $article->title }}</h3>
                            <p class="text-xs text-gray-500 mb-3">
                                {{ $article->tag }} · {{ $article->created_at->diffForHumans() }}
                            </p>
                            <a href="#" class="text-sm text-[#34307A] hover:underline font-medium">
                                Read More
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center col-span-3">No articles available yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- COUNSELING CTA --}}
    <section class="bg-[#34307A] text-white py-16">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between px-6">
            <div class="md:w-1/2 space-y-4">
                <h2 class="text-3xl font-bold">Counseling Service</h2>
                <p class="text-gray-200">
                    Pusat Konseling di Pusat Karier UIN Jakarta memberikan layanan seperti konseling karier,
                    konseling akademik, dan konseling sosial.
                </p>
                <a href="/counseling" class="inline-block px-6 py-3 bg-white text-[#34307A] rounded-full font-semibold hover:bg-gray-100 transition">
                    Register Now
                </a>
            </div>
            <div class="md:w-1/2 mt-8 md:mt-0 flex justify-center">
                <img src="{{ asset('images/counseling-banner.png') }}" alt="Counseling" class="rounded-2xl shadow-lg max-h-[350px] object-cover">
            </div>
        </div>
    </section>

    {{-- === AUTO OPEN RESET PASSWORD MODAL === --}}
    @if(isset($openModal) && $openModal === 'resetPassword')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const modal = document.getElementById('resetPasswordModal');
                const content = document.getElementById('resetPasswordModalContent');
                if (modal && content) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    setTimeout(() => {
                        modal.classList.add('opacity-100');
                        content.classList.remove('scale-95', 'opacity-0');
                        content.classList.add('scale-100', 'opacity-100');
                    }, 10);
                }

                // isi otomatis email dan token di form
                const tokenInput = document.getElementById('resetToken');
                const emailInput = document.getElementById('resetEmail');
                @if(isset($resetToken))
                    if (tokenInput) tokenInput.value = "{{ $resetToken }}";
                @endif
                @if(isset($resetEmail))
                    if (emailInput) emailInput.value = "{{ $resetEmail }}";
                @endif
            });
        </script>
    @endif
@endsection