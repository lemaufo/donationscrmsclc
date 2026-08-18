<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logocrm.ico') }}">
    <title>Impact Day 2026 — Cruz Roja México × Novo Nordisk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
        * { font-family: 'Inter', sans-serif; }
        .bg-landing { background: linear-gradient(135deg, #EEF2FF 0%, #F0F9FF 50%, #FFF7ED 100%); }
        .text-sitalel { color: #F97316; }
        .bg-sitalel { background-color: #F97316; }
        .bg-sitalel:hover { background-color: #EA6F0A; }
        .border-sitalel { border-color: #F97316; }

        .bg-landing {
            background-color: #EEF2FF;
            background-image:
                linear-gradient(135deg, #EEF2FF 0%, #F0F9FF 50%, #FFF7ED 100%),
                linear-gradient(rgba(99, 102, 241, 0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99, 102, 241, 0.07) 1px, transparent 1px);
            background-size: cover, 40px 40px, 40px 40px;
            background-blend-mode: normal, normal, normal;
        }

        .grid-bg {
            background-color: #EEF2FF;
            background-image:
                linear-gradient(rgba(99, 102, 241, 0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99, 102, 241, 0.08) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .header-glass {
            backdrop-filter: blur(12px) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            background-color: rgba(255, 255, 255, 0.5) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.4) !important;
            box-shadow: 0 2px 20px rgba(0,0,0,0.06) !important;
        }
    </style>
</head>
<body class="grid-bg min-h-screen">

    {{-- HEADER --}}
    <header id="main-header" class="relative top-5 z-50 transition-all duration-300">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

        {{-- Cruz Roja — pequeño izquierda --}}
        <img src="{{ asset('images/crm.png') }}"
            alt="Cruz Roja Mexicana"
            class="h-10 object-contain flex-shrink-0">

        {{-- SITALEL — grande centro --}}
        <img src="{{ asset('images/sitalel.png') }}"
            alt="SITALEL"
            class="h-22 object-contain flex-shrink-0">

        {{-- Novo Nordisk — pequeño derecha --}}
        <img src="{{ asset('images/novo.png') }}"
            alt="Novo Nordisk"
            class="h-11 object-contain flex-shrink-0 opacity-80">

    </div>
</header>

    {{-- HERO --}}
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
    <div class="flex flex-col items-center text-center">

        <div class="inline-flex items-center gap-2 bg-orange-50 border border-orange-200 rounded-full px-4 py-1.5 mb-5">
            <span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></span>
            <span class="text-xs font-semibold text-orange-600 uppercase tracking-wide">Campaña activa</span>
        </div>

        <h1 class="text-5xl sm:text-6xl font-black text-[#1e3a8a] leading-none mb-2">
            Impact Day
        </h1>
        <h2 class="text-5xl sm:text-6xl font-black text-sitalel italic leading-none mb-6">
            2026
        </h2>

        <p class="text-gray-600 text-lg mb-6 leading-relaxed max-w-2xl">
            Unidos por Chiapas. Colaboradores de
            <span class="font-semibold text-[#1e3a8a]">Novo Nordisk y Cruz Roja Mexicana</span>
            recaudando donativos para comunidades que más lo necesitan.
        </p>

        {{-- Contador --}}
        @if(isset($campaign) && $campaign && $campaign->starts_at)
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl border border-white/60 p-5 mb-6 shadow-sm">
            <p class="text-xs font-semibold text-orange-500 uppercase tracking-widest mb-3 text-center">
                @if(now()->lt($campaign->starts_at))
                    Faltan para el evento
                @else
                    Evento en curso
                @endif
            </p>
            @if(now()->lt($campaign->starts_at))
            <div class="flex gap-5 justify-center">
                <div class="text-center">
                    <p class="text-3xl font-black text-[#1e3a8a]" id="days">--</p>
                    <p class="text-xs text-gray-400 uppercase tracking-wide">Días</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-black text-[#1e3a8a]" id="hours">--</p>
                    <p class="text-xs text-gray-400 uppercase tracking-wide">Horas</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-black text-[#1e3a8a]" id="minutes">--</p>
                    <p class="text-xs text-gray-400 uppercase tracking-wide">Minutos</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-black text-[#1e3a8a]" id="seconds">--</p>
                    <p class="text-xs text-gray-400 uppercase tracking-wide">Segundos</p>
                </div>
            </div>
            @else
            <p class="text-[#1e3a8a] font-bold text-center">
                {{ $campaign->ends_at?->format('d/m/Y') ?? 'Activo' }}
            </p>
            @endif
        </div>
        @endif

        <a href="{{ url('/donar') }}"
            class="bg-sitalel inline-flex items-center gap-3 text-white font-bold rounded-2xl px-8 py-4 text-base transition shadow-lg hover:shadow-xl">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            DONA AHORA →
        </a>

    </div>
</section>  

    {{-- VIDEO + DESCRIPCIÓN --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">

                <div class="flex items-center justify-center p-6 bg-gray-50 border-b lg:border-b-0 lg:border-r border-gray-100">
                    <div class="relative w-full rounded-xl overflow-hidden shadow-sm" style="padding-bottom: 56.25%">
                        <iframe
                            class="absolute inset-0 w-full h-full rounded-xl"
                            src="https://www.youtube.com/embed/nDf1jnN18fw?modestbranding=1&rel=0"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>

                {{-- Descripción --}}
                <div class="p-8 flex flex-col justify-center">
                    <h2 class="text-2xl font-black text-[#1e3a8a] mb-2">
                        Conoce el impacto
                    </h2>
                    <h3 class="text-2xl font-black mb-4">
                        de <span class="text-sitalel">tu donativo</span>
                    </h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Cruz Roja Mexicana en Chiapas trabaja día a día brindando atención médica, apoyo en desastres y programas de salud comunitaria a las poblaciones más vulnerables del estado.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Tu donativo este Impact Day hace posible continuar con esta misión.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- ¿QUÉ HACEMOS CON TU APOYO? --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h2 class="text-2xl font-black text-center text-gray-800 mb-8">
            ¿Qué hacemos con <span class="text-sitalel">tu apoyo</span>?
        </h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
                <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <p class="font-bold text-gray-800 text-sm mb-1">Atención médica</p>
                <p class="text-xs text-gray-500">Brigadas de salud con consultas y pruebas para detección oportuna.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
                <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <p class="font-bold text-gray-800 text-sm mb-1">Prevención</p>
                <p class="text-xs text-gray-500">Enfoque en diabetes, hipertensión y obesidad.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
                <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <p class="font-bold text-gray-800 text-sm mb-1">Educación en salud</p>
                <p class="text-xs text-gray-500">Talleres y capacitación para una vida más saludable.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
                <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <p class="font-bold text-gray-800 text-sm mb-1">Cobertura en comunidades</p>
                <p class="text-xs text-gray-500">Llegamos a donde más se necesita.</p>
            </div>

        </div>
    </section>

    {{-- CTA FINAL --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white rounded-3xl border border-orange-100 shadow-sm p-8">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-orange-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-black text-gray-800 text-lg">Cada donativo <span class="text-sitalel">transforma vidas</span></p>
                        <p class="text-gray-500 text-sm">Gracias por ser parte del cambio.</p>
                    </div>
                </div>
                <a href="{{ url('/donar') }}"
                    class="bg-sitalel text-white font-bold rounded-2xl px-8 py-4 transition shadow-lg hover:shadow-xl flex items-center gap-2 flex-shrink-0">
                    DONA AHORA →
                </a>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <x-footer />

    @if(isset($campaign) && $campaign && $campaign->starts_at && now()->lt($campaign->starts_at))
    <script>
        const eventDate = new Date('{{ $campaign->starts_at->toIso8601String() }}');

        function updateCountdown() {
            const now  = new Date();
            const diff = eventDate - now;

            if (diff <= 0) { location.reload(); return; }

            const days    = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours   = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            document.getElementById('days').textContent    = String(days).padStart(2, '0');
            document.getElementById('hours').textContent   = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    </script>
    @endif

</body>
</html>