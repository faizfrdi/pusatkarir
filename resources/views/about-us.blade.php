@extends('layouts.app')

@section('content')
    {{-- ABOUT US SECTION --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-[#34307A] mb-6">About Us</h2>
            <p class="text-gray-700 leading-relaxed mb-8">
                Pusat Karier UIN Syarif Hidayatullah Jakarta adalah sebuah unit non-struktural yang diresmikan pada tahun
                2016 dan hadir untuk menjadi wadah mempersiapkan karier yang unggul serta meningkatkan kemampuan diri
                sebelum terjun langsung ke dunia kerja. Pusat Karier juga memberikan solusi dalam bentuk pengembangan
                karier dan pelayanan informasi yang unggul, inovatif, dan bermanfaat bagi mahasiswa serta alumni.
            </p>

            <div class="grid md:grid-cols-2 gap-10">
                <div>
                    <h3 class="text-2xl font-semibold text-[#34307A] mb-3">Visi</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Menjadi pusat yang amanah, unggul, dan inovatif dalam mempersiapkan mahasiswa bersaing di dunia kerja
                        dan memiliki karier yang excellent.
                    </p>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold text-[#34307A] mb-3">Misi</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Menjalankan pelayanan pengembangan karier yang unggul, inovatif, dan bermanfaat bagi mahasiswa dan alumni.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- MEET OUR TEAM SECTION --}}
    <section class="py-16 bg-[#34307A]/10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-[#34307A] mb-12">Meet Our Team</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 justify-center">
                @foreach([
                    ['image' => 'team-kholis.png', 'name' => 'M. Kholis Hamdy', 'position' => 'Head of Pusat Karier'],
                    ['image' => 'team-aziz.png', 'name' => 'Abdul Aziz', 'position' => 'Coordinator of Career Guidance'],
                    ['image' => 'team-nadeen.png', 'name' => 'Nadeen Sarrah', 'position' => 'Coordinator of Recruitment and Partnership'],
                ] as $team)
                    <div class="bg-[#34307A] rounded-2xl shadow-md hover:shadow-lg transition p-6 flex flex-col items-center text-white">
                        <div class="bg-white p-2 rounded-xl mb-5">
                            <img src="{{ asset('images/' . $team['image']) }}" 
                                alt="{{ $team['name'] }}" 
                                class="rounded-lg w-48 h-48 object-cover object-center shadow">
                        </div>
                        <h3 class="font-bold text-lg">{{ $team['name'] }}</h3>
                        <p class="text-gray-200 text-sm">{{ $team['position'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CONTACT SECTION --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="md:w-3/4">
                <h2 class="text-3xl font-bold text-[#34307A] mb-6">Hubungi Kami</h2>
                <p class="text-gray-700 mb-6 leading-relaxed">
                    Bila Anda membutuhkan informasi mengenai Pusat Karier UIN Syarif Hidayatullah atau hendak menyampaikan
                    kritik maupun saran, hubungi kami melalui telepon, email, atau akun media sosial kami.
                </p>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-xl font-semibold text-[#34307A] mb-2">Alamat</h3>
                        <p class="text-gray-700">
                            Jl. Kertamukti No.34, Pisangan, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15419
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-700"><strong>Email:</strong> karier@uinjkt.ac.id</p>
                        <p class="text-gray-700"><strong>Mobile Phone:</strong> +62 813 2403 6916</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection