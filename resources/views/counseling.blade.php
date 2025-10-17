@extends('layouts.app')

@section('content')
    {{-- ===== HERO SECTION ===== --}}
    <section class="bg-[#34307A] text-white py-16">
        <div class="max-w-7xl mx-auto px-6 md:px-8 lg:px-12 flex flex-col md:flex-row items-center justify-between gap-8">
            {{-- Text --}}
            <div class="flex-1 space-y-6">
                <h1 class="text-3xl md:text-4xl font-bold leading-tight">
                    Share Your Concerns and <br> Find the Best Solutions
                </h1>
                <p class="text-gray-200 max-w-xl">
                    We offer professional counseling services both online and offline, ready to be your companion in
                    sharing stories and finding solutions to every problem you face.
                </p>
            </div>

            {{-- Illustration --}}
            <div class="flex-1 flex justify-center">
                <img src="{{ asset('images/counseling.png') }}" 
                     alt="Counseling Illustration" 
                     class="max-h-80 md:max-h-96">
            </div>
        </div>
    </section>

    {{-- ===== SERVICE CARDS ===== --}}
    <section class="bg-gradient-to-b from-white to-[#f5f6ff] py-20">
        <div class="max-w-7xl mx-auto px-6 md:px-8 lg:px-12 text-center">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- Career Advice --}}
                <a href="{{ route('counseling.category', 'career') }}" 
                   class="block bg-white p-8 rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300">
                    <div class="mb-6">
                        <img src="{{ asset('images/icons/counseling/counseling-career.png') }}" 
                             alt="Career Advice" 
                             class="mx-auto rounded-xl h-40 w-auto object-cover">
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-[#34307A]">Career Advice</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Talk to trained professionals about your career direction, job challenges, 
                        and how to grow your professional potential.
                    </p>
                </a>

                {{-- Academic Counseling --}}
                <a href="{{ route('counseling.category', 'academic') }}" 
                   class="block bg-white p-8 rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300">
                    <div class="mb-6">
                        <img src="{{ asset('images/icons/counseling/counseling-academic.png') }}" 
                             alt="Academic Counseling" 
                             class="mx-auto rounded-xl h-40 w-auto object-cover">
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-[#34307A]">Academic Counseling</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Discuss your academic performance, study difficulties, or how to plan 
                        your education goals with expert counselors.
                    </p>
                </a>

                {{-- Mental Health --}}
                <a href="{{ route('counseling.category', 'mental') }}" 
                   class="block bg-white p-8 rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300">
                    <div class="mb-6">
                        <img src="{{ asset('images/icons/counseling/counseling-mental.png') }}" 
                             alt="Mental Health" 
                             class="mx-auto rounded-xl h-40 w-auto object-cover">
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-[#34307A]">Mental Health</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Get professional mental health support to manage stress, anxiety, and 
                        emotional challenges in a safe environment.
                    </p>
                </a>

            </div>
        </div>
    </section>
@endsection