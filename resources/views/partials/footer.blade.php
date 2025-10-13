<footer class="bg-white text-gray-800 border-t border-gray-200 mt-10">
    <div class="w-full max-w-7xl mx-auto px-6 py-10">
        {{-- Grid Wrapper --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

            {{-- === 1. Logo & Alamat === --}}
            <div>
                <img src="{{ asset('images/logo-karier-footbar.png') }}" alt="Logo" class="h-12 mb-3">
                <p class="font-semibold">Alumni Center IKALUIN Jakarta</p>
                <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                    Jl. Kertamukti No.34, Pisangan, Kec. Ciputat Timur,<br>
                    Kota Tangerang Selatan, Banten 15419
                </p>

                {{-- Sosial Media --}}
                <div class="flex flex-wrap gap-3 mt-4">
                    <a href="#" class="text-[#34307A] hover:text-[#4a45a2]"><i class="fab fa-linkedin fa-lg"></i></a>
                    <a href="#" class="text-[#34307A] hover:text-[#4a45a2]"><i class="fab fa-telegram fa-lg"></i></a>
                    <a href="#" class="text-[#34307A] hover:text-[#4a45a2]"><i class="fab fa-youtube fa-lg"></i></a>
                    <a href="#" class="text-[#34307A] hover:text-[#4a45a2]"><i class="fab fa-x-twitter fa-lg"></i></a>
                    <a href="#" class="text-[#34307A] hover:text-[#4a45a2]"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-[#34307A] hover:text-[#4a45a2]"><i class="fab fa-tiktok fa-lg"></i></a>
                </div>
            </div>

            {{-- === 2. What We Do === --}}
            <div>
                <h3 class="font-semibold text-lg mb-3 text-[#34307A]">What We Do</h3>
                <ul class="space-y-1 text-sm">
                    <li><a href="#" class="hover:text-[#4a45a2]">Career Festival</a></li>
                    <li><a href="#" class="hover:text-[#4a45a2]">Pekan Konseling</a></li>
                    <li><a href="#" class="hover:text-[#4a45a2]">Tracer Study</a></li>
                    <li><a href="#" class="hover:text-[#4a45a2]">PERSAMI</a></li>
                    <li><a href="#" class="hover:text-[#4a45a2]">Company Visit</a></li>
                    <li><a href="#" class="hover:text-[#4a45a2]">Growth Buddy</a></li>
                </ul>
            </div>

            {{-- === 3. Institution === --}}
            <div>
                <h3 class="font-semibold text-lg mb-3 text-[#34307A]">Institution</h3>
                <ul class="space-y-1 text-sm">
                    <li><a href="#" class="hover:text-[#4a45a2]">About Us</a></li>
                    <li><a href="#" class="hover:text-[#4a45a2]">Career</a></li>
                    <li><a href="https://uinjkt.ac.id" target="_blank" class="hover:text-[#4a45a2]">
                        UIN Syarif Hidayatullah Jakarta
                    </a></li>
                </ul>
            </div>

            {{-- === 4. Support === --}}
            <div>
                <h3 class="font-semibold text-lg mb-3 text-[#34307A]">Support</h3>
                <ul class="space-y-1 text-sm">
                    <li><a href="#" class="hover:text-[#4a45a2]">FAQ</a></li>
                    <li><a href="#" class="hover:text-[#4a45a2]">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-[#4a45a2]">Business</a></li>
                </ul>
            </div>

            {{-- === 5. Contact === --}}
            <div>
                <h3 class="font-semibold text-lg mb-3 text-[#34307A]">Contact</h3>
                <p class="text-sm">
                    <strong>E-Mail:</strong>
                    <a href="mailto:karir@uinjkt.ac.id" class="hover:text-[#4a45a2]">
                        karir@uinjkt.ac.id
                    </a>
                </p>
                <p class="text-sm mt-1">
                    <strong>Mobile Phone:</strong> +62 813 2430 6918
                </p>
            </div>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="border-t border-gray-200 text-center py-4 text-sm text-gray-600">
        Copyright © {{ date('Y') }} KKN in Pusat Karier
    </div>
</footer>