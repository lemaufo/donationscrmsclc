<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Impact Day — Cruz Roja México')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="bg-[#f4f4f5] min-h-screen flex flex-col antialiased">

    {{-- HEADER --}}
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="w-full px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between @yield('header_width', 'max-w-2xl mx-auto')">

            {{-- Logo Cruz Roja --}}
            <div class="flex items-center">
                @if(isset($campaign) && $campaign->logo_url)
                    <img src="{{ Storage::url($campaign->logo_url) }}" alt="Cruz Roja Mexicana" class="h-8 object-contain">
                @else
                    <svg class="h-8 w-auto" viewBox="0 0 140 40" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="8" width="8" height="24" fill="#dc2626"/>
                        <rect x="0" y="16" width="24" height="8" fill="#dc2626"/>
                        <text x="30" y="16" font-family="sans-serif" font-size="8" font-weight="700" fill="#dc2626">CRUZ ROJA</text>
                        <text x="30" y="27" font-family="sans-serif" font-size="8" font-weight="700" fill="#dc2626">MEXICANA</text>
                    </svg>
                @endif
            </div>

            {{-- Derecha --}}
            <div class="flex items-center gap-4 text-sm">
                @yield('header_right')
                @hasSection('header_right')
                @else
                    @if(isset($campaign) && $campaign->banner_url)
                        <img src="{{ Storage::url($campaign->banner_url) }}" alt="Sponsor" class="h-5 opacity-60 grayscale object-contain">
                    @else
                        <span class="text-xs text-gray-400"> </span>
                    @endif
                @endif
            </div>

        </div>
    </header>

    {{-- CONTENIDO --}}
    <main class="flex-1 w-full px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        <div class="@yield('content_width', 'max-w-lg mx-auto')">
            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="bg-white border-t border-gray-100 py-4 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-gray-400">
            <span>🔒 Pagos seguros cifrados por Stripe · SSL 256-bit · PCI DSS</span>
            <span>Desarrollado por <a href="https://teknologix.mx" target="_blank" class="hover:text-gray-600 transition">Teknologix</a> · teknologix.mx</span>
        </div>
    </footer>

    @livewireScripts
    @stack('scripts')

</body>
</html>