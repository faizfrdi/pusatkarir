<nav class="bg-[#34307A] text-white shadow fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">

        {{-- === KIRI: Logo === --}}
        <div class="flex items-center space-x-3">
            <a href="/" class="flex items-center space-x-2 shrink-0">
                <img src="{{ asset('images/logo-karier-navbar.png') }}" alt="Logo" class="h-10">
            </a>
        </div>

        {{-- === TENGAH: Search (Desktop) === --}}
        <div class="hidden md:flex flex-1 justify-center">
            <div class="flex items-center space-x-2">
                <input
                    type="text"
                    placeholder="Search"
                    class="pl-4 pr-4 py-2 rounded-md text-gray-200 bg-[#3B368A] border border-gray-500 focus:outline-none focus:ring focus:ring-blue-400 w-80 placeholder:text-gray-400"
                >
                <button class="p-2 bg-[#3B368A] hover:bg-[#4a45a2] rounded-md transition">
                    <i class="fa-solid fa-magnifying-glass text-white"></i>
                </button>
            </div>
        </div>

        {{-- === KANAN: Menu + Profile === --}}
        {{-- === KANAN: Menu + Profile === --}}
        <div class="flex items-center space-x-5">
            {{-- Tombol Burger (Mobile) --}}
            <button id="mobile-menu-toggle" class="md:hidden focus:outline-none">
                <span></span><span></span><span></span>
            </button>

            {{-- Menu Desktop --}}
            <ul class="hidden md:flex items-center space-x-6 font-medium">
                <li><a href="/" class="hover:text-gray-200">Home</a></li>

                {{-- === Dropdown Jobs === --}}
                <li class="relative">
                    <button onclick="toggleDropdown('jobsDropdown')" class="hover:text-gray-200 flex items-center focus:outline-none">
                        Jobs <i class="ml-1 fa-solid fa-chevron-down text-xs"></i>
                    </button>
                    <ul id="jobsDropdown"
                        class="hidden absolute bg-[#3B368A] p-3 rounded-lg mt-2 w-40 shadow-md transition-all duration-200">
                        <li><a href="/jobs" class="block hover:underline">Vacancies</a></li>
                        <li><a href="/companies" class="block hover:underline">Companies</a></li>
                    </ul>
                </li>

                {{-- === Dropdown Community === --}}
                <li class="relative">
                    <button onclick="toggleDropdown('communityDropdown')" class="hover:text-gray-200 flex items-center focus:outline-none">
                        Community <i class="ml-1 fa-solid fa-chevron-down text-xs"></i>
                    </button>
                    <ul id="communityDropdown"
                        class="hidden absolute bg-[#3B368A] p-3 rounded-lg mt-2 w-40 shadow-md transition-all duration-200">
                        <li><a href="/event" class="block hover:underline">Event</a></li>
                        <li><a href="/news" class="block hover:underline">News</a></li>
                        <li><a href="/forum" class="block hover:underline">Forum</a></li>
                    </ul>
                </li>

                <li><a href="/counseling" class="hover:text-gray-200">Counseling</a></li>
                <li><a href="/tracer" class="hover:text-gray-200">Tracer Study</a></li>
                <li><a href="/about" class="hover:text-gray-200">About Us</a></li>

                {{-- Profil --}}
                @auth
                <li class="relative">
                    <button onclick="toggleDropdown('profileDropdown')" class="flex items-center space-x-2 focus:outline-none">
                        <img src="{{ Auth::user()->profile_photo_url ?? asset('images/default-profile.png') }}"
                            alt="User"
                            class="h-8 w-8 rounded-full border border-gray-300 cursor-pointer object-cover">
                        <span>{{ Auth::user()->name }}</span>
                    </button>

                    <ul id="profileDropdown"
                        class="hidden absolute bg-[#3B368A] p-3 rounded-lg mt-3 w-36 right-0 shadow-md transition-all duration-200">
                        <li><a href="{{ route('profile.edit') }}" class="block hover:underline">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-left w-full hover:underline">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth

                {{-- Jika belum login --}}
                @guest
                <li>
                    <button id="openLoginModal"
                    class="px-4 py-2 bg-[#3B368A] border border-gray-400 rounded-md hover:bg-[#4a45a2] transition">
                        Login
                    </button>
                </li>
                @endguest
            </ul>
        </div>
    </div>

    {{-- === LOGIN MODAL === --}}
    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div id="loginModalContent" class="bg-white rounded-2xl shadow-2xl w-[90%] max-w-md relative p-8 transform transition-all duration-300 scale-95 opacity-0">
            {{-- Tombol close --}}
            <button id="closeLoginModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

            {{-- Logo --}}
            <div class="flex justify-end mb-4">
                <img src="{{ asset('images/logo-karier-footbar.png') }}" alt="Logo" class="h-10">
            </div>

            {{-- Teks judul --}}
            <h2 class="text-3xl font-extrabold text-[#34307A] mb-2">Welcome back!</h2>
            <p class="text-gray-600 mb-6 text-sm">Enter your credentials to access your account</p>

            {{-- Form login --}}
            <form id="ajaxLoginForm" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email address</label>
                    <input type="email" name="email" placeholder="Enter your email"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A] 
                        text-gray-800 placeholder:text-gray-400 py-2 px-3">
                </div>

                <div class="relative">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input id="loginPassword" type="password" name="password" placeholder="Password"
                        class="w-full border border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3 pr-10">
                    
                    {{-- Tombol show/hide password --}}
                    <button type="button" id="toggleLoginPassword"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 mt-[24px] text-gray-500 hover:text-[#34307A] focus:outline-none">
                        <i class="fa-solid fa-eye text-lg"></i>
                    </button>
                </div>

                <div id="loginError" class="hidden text-red-700 text-left"></div>

                <div class="flex justify-between items-center text-sm">
                    <label class="flex items-center text-gray-700">
                        <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 text-[#34307A] focus:ring-[#34307A]">
                        Remember me
                    </label>
                    <button type="button" id="openForgotPasswordModal"
                        class="text-[#34307A] hover:underline font-medium focus:outline-none">
                        Forgot password?
                    </button>
                </div>

                <button type="submit" 
                    class="w-full bg-[#34307A] hover:bg-[#4a45a2] text-white font-semibold py-2 rounded-md transition">
                    Login
                </button>

                <p class="text-center text-sm text-gray-600">
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="text-[#34307A] hover:underline font-medium">Sign Up</a>
                </p>
            </form>
        </div>
    </div>

    {{-- === SIGN UP MODAL === --}}
    <div id="registerModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div id="registerModalContent" 
            class="bg-white rounded-2xl shadow-2xl w-[90%] max-w-md relative p-8 transform transition-all duration-300 scale-95 opacity-0">
            
            {{-- Tombol close --}}
            <button id="closeRegisterModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

            {{-- Logo --}}
            <div class="flex justify-end mb-4">
                <img src="{{ asset('images/logo-karier-footbar.png') }}" alt="Logo" class="h-10">
            </div>

            {{-- Judul --}}
            <h2 class="text-3xl font-extrabold text-[#34307A] mb-2">Sign Up</h2>

            {{-- Form register --}}
            <form id="ajaxRegisterForm" method="POST" action="{{ route('register') }}" class="space-y-5 mt-6" novalidate>
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" placeholder="Enter your full name"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" placeholder="Enter your email"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" placeholder="Enter your password"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm your password"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3" required>
                </div>

                {{-- Error Message --}}
                <div id="registerError" class="hidden text-red-700 text-left text-sm"></div>

                {{-- Remember + Sign Up --}}
                <div class="flex justify-between items-center text-sm">
                    <label class="flex items-center text-gray-700">
                        <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 text-[#34307A] focus:ring-[#34307A]">
                        Remember me
                    </label>

                    {{-- Tombol Sign Up default = user --}}
                    <button type="submit" name="role" value="user"
                        class="px-4 py-2 bg-[#34307A] hover:bg-[#4a45a2] text-white font-semibold rounded-md transition">
                        Sign Up
                    </button>
                </div>

                <hr class="my-4 border-gray-300">

                {{-- Sign Up as Candidate/Employer --}}
                <div class="flex flex-col sm:flex-row justify-between gap-3">
                    <button type="submit" name="role" value="alumni"
                        class="flex-1 bg-[#34307A] hover:bg-[#4a45a2] text-white font-semibold py-2 rounded-md transition">
                        Continue as Candidate
                    </button>
                    <button type="submit" name="role" value="employer"
                        class="flex-1 bg-[#34307A] hover:bg-[#4a45a2] text-white font-semibold py-2 rounded-md transition">
                        Continue as Employer
                    </button>
                </div>

                <p class="text-center text-sm text-gray-600 mt-4">
                    Already have an account?
                    <button type="button" id="switchToLogin" class="text-[#34307A] hover:underline font-medium">Log in</button>
                </p>
            </form>
        </div>
    </div>

    {{-- === CANDIDATE SIGNUP MODAL === --}}
    <div id="candidateModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div id="candidateModalContent"
            class="bg-white rounded-2xl shadow-2xl w-[95%] sm:w-[80%] md:w-[60%] lg:w-[50%] relative p-8 transform transition-all duration-300 scale-95 opacity-0">

            {{-- Tombol Close --}}
            <button id="closeCandidateModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

            {{-- Header --}}
            <div class="flex justify-between items-start mb-6">
                <h2 class="text-3xl font-extrabold text-[#34307A]">Sign up as Candidate</h2>
                <img src="{{ asset('images/logo-karier-footbar.png') }}" alt="Logo" class="h-12">
            </div>

            {{-- Form --}}
            <form id="ajaxCandidateForm" method="POST" action="{{ route('register') }}" class="grid grid-cols-1 md:grid-cols-2 gap-5" novalidate>
                @csrf
                <input type="hidden" name="role" value="alumni">

                {{-- Pronoun --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Pronoun</label>
                    <input type="text" name="pronoun" placeholder="Enter the text"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3">
                </div>

                {{-- Empty Spacer for Layout --}}
                <div></div>

                {{-- First Name --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">First Name</label>
                    <input type="text" name="first_name" placeholder="Enter the text"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3" required>
                </div>

                {{-- Last Name --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="last_name" placeholder="Enter the text"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3" required>
                </div>

                {{-- Phone Number --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Phone Number</label>
                    <input type="text" name="phone" placeholder="Enter your name"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3">
                </div>

                {{-- Empty spacer --}}
                <div></div>

                {{-- Region --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Region</label>
                    <select name="region"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3">
                        <option value="">*dropdown</option>
                        <option value="Jakarta">Jakarta</option>
                        <option value="Bandung">Bandung</option>
                    </select>
                </div>

                {{-- Nationality --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nationality</label>
                    <select name="nationality"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3">
                        <option value="">*dropdown</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                {{-- Error Message --}}
                <div id="candidateError" class="hidden text-red-700 text-left text-sm col-span-2"></div>

                {{-- Submit --}}
                <div class="col-span-2 flex justify-end mt-4">
                    <button type="submit"
                        class="bg-[#34307A] hover:bg-[#4a45a2] text-white font-semibold py-2 px-6 rounded-md transition">
                        Sign Up
                    </button>
                </div>

                <p class="col-span-2 text-center text-sm text-gray-600 mt-4">
                    Already have an account?
                    <button type="button" id="switchToLoginFromCandidate"
                        class="text-[#34307A] hover:underline font-medium">Log in</button>
                </p>
            </form>
        </div>
    </div>

    {{-- === EMPLOYER SIGNUP MODAL === --}}
    <div id="employerModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div id="employerModalContent"
            class="bg-white rounded-2xl shadow-2xl w-[95%] sm:w-[80%] md:w-[60%] lg:w-[50%] relative p-8 transform transition-all duration-300 scale-95 opacity-0">

            {{-- Tombol Close --}}
            <button id="closeEmployerModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

            {{-- Header --}}
            <div class="flex justify-between items-start mb-6">
                <h2 class="text-3xl font-extrabold text-[#34307A]">Sign up as Employer</h2>
                <img src="{{ asset('images/logo-karier-footbar.png') }}" alt="Logo" class="h-12">
            </div>

            {{-- Form --}}
            <form id="ajaxEmployerForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-2 gap-5" novalidate>
                @csrf
                <input type="hidden" name="role" value="employer">

                {{-- Company Name --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Company Name</label>
                    <input type="text" name="company_name" placeholder="Enter the text"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3" required>
                </div>

                {{-- Company Registration Number --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Company Registration Number</label>
                    <input type="text" name="registration_number" placeholder="Enter the text"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3" required>
                </div>

                {{-- Company Website --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Company Website</label>
                    <input type="url" name="website" placeholder="Enter the text"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3">
                </div>

                {{-- Industry --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Industry</label>
                    <input type="text" name="industry" placeholder="Enter the text"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3">
                </div>

                {{-- Photo Profile --}}
                <div class="flex flex-col items-center mt-3">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Photo Profile</label>
                    <div class="flex items-center space-x-4">
                        <img id="previewPhoto" src="{{ asset('images/default-profile.png') }}" alt="Preview"
                            class="h-20 w-20 rounded-full object-cover border border-gray-300">
                        <label for="photo" class="bg-[#34307A] hover:bg-[#4a45a2] text-white text-sm font-medium px-4 py-2 rounded-md cursor-pointer transition">
                            Upload Photo
                        </label>
                        <input type="file" id="photo" name="photo" accept="image/*" class="hidden">
                    </div>
                </div>

                {{-- Company Profile --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Company Profile</label>
                    <textarea name="company_profile" placeholder="Enter your information"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3 h-24 resize-none"></textarea>
                </div>

                {{-- Error Message --}}
                <div id="employerError" class="hidden text-red-700 text-left text-sm col-span-2"></div>

                {{-- Submit --}}
                <div class="col-span-2 flex justify-end mt-4">
                    <button type="submit"
                        class="bg-[#34307A] hover:bg-[#4a45a2] text-white font-semibold py-2 px-6 rounded-md transition">
                        Sign Up
                    </button>
                </div>

                <p class="col-span-2 text-center text-sm text-gray-600 mt-4">
                    Already have an account?
                    <button type="button" id="switchToLoginFromEmployer"
                        class="text-[#34307A] hover:underline font-medium">Log in</button>
                </p>
            </form>
        </div>
    </div>

    {{-- === FORGOT PASSWORD MODAL === --}}
    <div id="forgotPasswordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div id="forgotPasswordModalContent"
            class="bg-white rounded-2xl shadow-2xl w-[90%] max-w-md relative p-8 transform transition-all duration-300 scale-95 opacity-0">

            {{-- Tombol Close --}}
            <button id="closeForgotPasswordModal"
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

            {{-- Logo --}}
            <div class="flex justify-end mb-4">
                <img src="{{ asset('images/logo-karier-footbar.png') }}" alt="Logo" class="h-10">
            </div>

            {{-- Judul --}}
            <h2 class="text-3xl font-extrabold text-[#34307A] mb-2">Forgot Password?</h2>
            <p class="text-gray-600 mb-6 text-sm">
                Enter your email address and we’ll send you a link to reset your password.
            </p>

            {{-- Form --}}
            <form id="ajaxForgotPasswordForm" method="POST" action="{{ route('password.email') }}" class="space-y-5" novalidate>
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email address</label>
                    <input type="email" name="email" placeholder="Enter your email"
                        class="w-full border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A]
                        text-gray-800 placeholder:text-gray-400 py-2 px-3" required>
                </div>

                <div id="forgotError" class="hidden text-red-700 text-left text-sm"></div>
                <div id="forgotSuccess" class="hidden text-green-700 text-left text-sm"></div>

                <button type="submit"
                    class="w-full bg-[#34307A] hover:bg-[#4a45a2] text-white font-semibold py-2 rounded-md transition">
                    Send Reset Link
                </button>

                <p class="text-center text-sm text-gray-600 mt-4">
                    Remember your password?
                    <button type="button" id="switchForgotToLogin"
                        class="text-[#34307A] hover:underline font-medium">Log in</button>
                </p>
            </form>
        </div>
    </div>

    {{-- === RESET PASSWORD MODAL === --}}
    <div id="resetPasswordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div id="resetPasswordModalContent" class="bg-white rounded-2xl shadow-2xl w-[90%] max-w-md relative p-8 transform transition-all duration-300 scale-95 opacity-0">
            
            {{-- Tombol Close --}}
            <button id="closeResetPasswordModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

            {{-- Logo --}}
            <div class="flex justify-end mb-4">
                <img src="{{ asset('images/logo-karier-footbar.png') }}" alt="Logo" class="h-10">
            </div>

            {{-- Judul --}}
            <h2 class="text-3xl font-extrabold text-[#34307A] mb-2">Reset Your Password</h2>
            <p class="text-gray-600 mb-6 text-sm">
                Enter your new password below to regain access.
            </p>

            {{-- Form --}}
            <form id="ajaxResetPasswordForm" method="POST" action="{{ route('password.update') }}" class="space-y-5" novalidate>
                @csrf

                <input type="hidden" name="token" id="resetToken" value="{{ $resetToken ?? '' }}">
                <input type="hidden" name="email" id="resetEmail" value="{{ $resetEmail ?? '' }}">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">New Password</label>
                    <input id="resetPassword" type="password" name="password" placeholder="Enter new password"
                        class="w-full border border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A] text-gray-800 placeholder:text-gray-400 py-2 px-3 pr-10">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Confirm Password</label>
                    <input id="resetConfirmPassword" type="password" name="password_confirmation" placeholder="Confirm new password"
                        class="w-full border border-gray-300 rounded-md focus:ring-[#34307A] focus:border-[#34307A] text-gray-800 placeholder:text-gray-400 py-2 px-3 pr-10">
                </div>

                <div id="resetError" class="hidden text-red-700 text-left text-sm"></div>
                <div id="resetSuccess" class="hidden text-green-700 text-left text-sm"></div>

                <button type="submit" class="w-full bg-[#34307A] hover:bg-[#4a45a2] text-white font-semibold py-2 rounded-md transition">
                    Update Password
                </button>
            </form>
        </div>
    </div>

    {{-- === MENU MOBILE === --}}
    <div id="mobile-menu"
        class="md:hidden bg-[#3B368A] text-white px-6 py-4 font-semibold">
        
        <div class="relative mb-4 flex space-x-2">
            <input type="text" placeholder="Search"
                class="flex-1 pl-4 pr-4 py-2 rounded-md text-gray-200 bg-[#34307A] border border-gray-500 
                    focus:outline-none placeholder:text-gray-400 transition-all duration-300 focus:ring focus:ring-blue-400">
            <button class="p-2 bg-[#34307A] hover:bg-[#4a45a2] rounded-md transition duration-300 hover:scale-110">
                <i class="fa-solid fa-magnifying-glass text-white"></i>
            </button>
        </div>

        <div class="space-y-2">
            <a href="/" class="block hover:text-gray-200 transition-all duration-300 hover:translate-x-1">Home</a>

            {{-- === Jobs Dropdown === --}}
            <div>
                <button onclick="toggleMobileDropdown('jobsMobile')" 
                    class="w-full flex justify-between items-center hover:text-gray-200 transition-all duration-300">
                    Jobs <i id="jobsIcon" class="fa-solid fa-chevron-down text-xs transition-transform duration-300"></i>
                </button>
                <div id="jobsMobile"
                    class="hidden ml-4 overflow-hidden transition-all duration-500 ease-in-out transform scale-y-95 origin-top opacity-0">
                    <a href="/jobs" class="block hover:underline hover:translate-x-1 transition">Vacancies</a>
                    <a href="/companies" class="block hover:underline hover:translate-x-1 transition">Companies</a>
                </div>
            </div>

            {{-- === Community Dropdown === --}}
            <div>
                <button onclick="toggleMobileDropdown('communityMobile')" 
                    class="w-full flex justify-between items-center hover:text-gray-200 transition-all duration-300">
                    Community <i id="communityIcon" class="fa-solid fa-chevron-down text-xs transition-transform duration-300"></i>
                </button>
                <div id="communityMobile"
                    class="hidden ml-4 overflow-hidden transition-all duration-500 ease-in-out transform scale-y-95 origin-top opacity-0">
                    <a href="/community/event" class="block hover:underline hover:translate-x-1 transition">Event</a>
                    <a href="/community/news" class="block hover:underline hover:translate-x-1 transition">News</a>
                    <a href="/community/forum" class="block hover:underline hover:translate-x-1 transition">Forum</a>
                </div>
            </div>

            <a href="/counseling" class="block hover:text-gray-200 transition hover:translate-x-1">Counseling</a>
            <a href="/tracer" class="block hover:text-gray-200 transition hover:translate-x-1">Tracer Study</a>
            <a href="/about" class="block hover:text-gray-200 transition hover:translate-x-1">About Us</a>

            <hr class="border-gray-500 my-4">

            @auth
                <div class="flex items-center space-x-3">
                    <img src="{{ Auth::user()->profile_photo_url ?? asset('images/default-profile.png') }}"
                        alt="User" class="h-10 w-10 rounded-full border border-gray-300 object-cover">
                    <div>
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-gray-300 hover:text-white">Logout</button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <button id="openLoginModalMobile"
                    class="w-full px-4 py-2 bg-[#34307A] border border-gray-400 rounded-md hover:bg-[#4a45a2] transition">
                    Login
                </button>
            @endguest
        </div>
    </div>
</nav>