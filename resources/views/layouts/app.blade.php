<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Karier UIN Jakarta</title>

    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/png">

    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-50 min-h-screen flex flex-col justify-between pt-16">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Konten Utama --}}
    {{-- Konten Utama (dibungkus biar bisa digeser turun) --}}
    <div id="main-content" class="transition-all duration-300 ease-in-out">
        <main class="flex-grow">
            @yield('content')
        </main>
        @include('partials.footer')
    </div>

    {{-- === JAVASCRIPT UTAMA === --}}
    @vite(['resources/js/app.js', 'resources/js/navbar.js', 'resources/js/auth.js'])
</body>
</html>