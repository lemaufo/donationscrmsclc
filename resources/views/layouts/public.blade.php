<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logocrm.ico') }}">
    <title>@yield('title', 'Impact Day — Cruz Roja México')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="bg-[#f4f4f5] min-h-screen flex flex-col antialiased">

    {{-- HEADER --}}
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="@yield('header_width', 'max-w-6xl mx-auto') px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

            {{-- Logo Cruz Roja --}}
            <img src="{{ asset('images/crm.png') }}" alt="Cruz Roja Mexicana" class="h-10 object-contain">

            {{-- Centro — SITALEL --}}
            <img src="{{ asset('images/sitalel.png') }}" alt="SITALEL" class="h-14 object-contain hidden sm:block">

            {{-- Derecha — Novo Nordisk + slot --}}
            <div class="flex items-center gap-4">
                @yield('header_right')
                <img src="{{ asset('images/novo.png') }}" alt="Novo Nordisk" class="h-10 object-contain opacity-80">
            </div>

        </div>
    </header>

    {{-- CONTENIDO --}}
    <main class="flex-1 w-full">
        <div class="@yield('content_width', 'max-w-6xl mx-auto') px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <x-footer />

    @livewireScripts
    @stack('scripts')

</body>
</html>