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
                <img src="{{ asset('images/novo.png') }}" alt="Novo Nordisk" class="h-24 object-contain opacity-80">
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

    {{-- Botón flotante WhatsApp --}}
    <a href="https://wa.me/5219618920410?text=Hola,%20tengo%20una%20pregunta%20sobre%20la%20plataforma%20Impact%20Days%20de%20Cruz%20Roja%20Mexicana."
        target="_blank"
        class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg transition-all duration-300 group"
        style="position: fixed; bottom: 24px; left: 24px; z-index: 99999; padding: 14px 20px 14px 16px;">
        <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/>
            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.554 4.118 1.528 5.855L.057 23.882l6.154-1.611A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.891 0-3.667-.498-5.207-1.371l-.373-.221-3.865 1.013 1.033-3.772-.242-.386A9.944 9.944 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
        </svg>
        <span class="text-sm font-semibold">¿Necesitas ayuda?</span>
    </a>
        
</body>
</html>