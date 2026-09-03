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
<header id="main-header" class="relative z-50 transition-all duration-300">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-30 grid grid-cols-3 items-center">

        {{-- Cruz Roja — izquierda --}}
        <div class="flex items-center">
            <img src="{{ asset('images/crm.png') }}"
                alt="Cruz Roja Mexicana"
                class="h-10 object-contain">
        </div>

        {{-- SITALEL — centro exacto --}}
        <div class="flex items-center justify-center">
            <img src="{{ asset('images/sitalel.png') }}"
                alt="SITALEL"
                class="h-18 object-contain">
        </div>

        {{-- Novo Nordisk — derecha --}}
        <div class="flex items-center justify-end">
            <img src="{{ asset('images/novo.png') }}"
                alt="Novo Nordisk"
                class="h-10 object-contain opacity-80">
        </div>

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
                            src="https://www.youtube.com/embed/nDf1jnN18fw?si=ta5H1qlzmtZA1uLV"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin"
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

    {{-- INSTRUCTIVO DONANTES --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="text-center mb-8">
            <p class="text-xs font-semibold text-orange-500 uppercase tracking-widest mb-2">¿Cómo donar?</p>
            <h2 class="text-2xl font-black text-gray-800">
                Haz tu donativo en <span class="text-sitalel">3 pasos</span>
            </h2>
            <p class="text-sm text-gray-500 mt-2">Rápido, seguro y deducible de impuestos</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            {{-- Paso 1 --}}
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl border border-white/60 p-6 text-center relative">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-7 h-7 bg-red-600 text-white text-xs font-black rounded-full flex items-center justify-center shadow-sm">1</div>
                <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mx-auto mb-4 mt-2">
                    <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">Abre el link</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Recibe el link personal de un colaborador de Novo Nordisk o escanea su código QR con tu teléfono.</p>
            </div>

            {{-- Paso 2 --}}
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl border border-white/60 p-6 text-center relative">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-7 h-7 bg-red-600 text-white text-xs font-black rounded-full flex items-center justify-center shadow-sm">2</div>
                <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mx-auto mb-4 mt-2">
                    <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">Elige tu monto</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Selecciona el monto que deseas donar: $100, $500, $1,000, $2,500, $6,000 o $10,000 MXN. También puedes ingresar otro monto.</p>
            </div>

            {{-- Paso 3 --}}
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl border border-white/60 p-6 text-center relative">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-7 h-7 bg-red-600 text-white text-xs font-black rounded-full flex items-center justify-center shadow-sm">3</div>
                <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mx-auto mb-4 mt-2">
                    <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">Paga con tarjeta</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Ingresa los datos de tu tarjeta de crédito o débito. El pago es procesado por Stripe con cifrado SSL. ¡Listo, tu donativo llega directo a Cruz Roja!</p>
            </div>

        </div>

        {{-- Nota CFDI --}}
        <div class="mt-4 bg-white/50 backdrop-blur-sm rounded-xl border border-white/60 px-5 py-3 flex items-center gap-3">
            <svg class="w-4 h-4 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-xs text-gray-500">
                ¿Necesitas factura? Durante el proceso puedes solicitar tu <strong class="text-gray-700">comprobante fiscal (CFDI)</strong> — tu donativo es deducible de impuestos.
            </p>
        </div>

    </section>

    {{-- INSTRUCTIVO COLABORADORES --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="text-center mb-8">
            <p class="text-xs font-semibold text-[#1e3a8a] uppercase tracking-widest mb-2">¿Eres colaborador de Novo Nordisk?</p>
            <h2 class="text-2xl font-black text-gray-800">
                Empieza a recaudar en <span class="text-[#1e3a8a]">4 pasos</span>
            </h2>
            <p class="text-sm text-gray-500 mt-2">Tu participación hace la diferencia</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            {{-- Paso 1 --}}
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl border border-white/60 p-5 text-center relative">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-7 h-7 bg-[#1e3a8a] text-white text-xs font-black rounded-full flex items-center justify-center shadow-sm">1</div>
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-3 mt-2">
                    <svg class="w-6 h-6 text-[#1e3a8a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 text-sm mb-1">Regístrate</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Abre el link de invitación que te compartió Cruz Roja o Novo Nordisk y llena tu nombre, correo y departamento.</p>
            </div>

            {{-- Paso 2 --}}
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl border border-white/60 p-5 text-center relative">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-7 h-7 bg-[#1e3a8a] text-white text-xs font-black rounded-full flex items-center justify-center shadow-sm">2</div>
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-3 mt-2">
                    <svg class="w-6 h-6 text-[#1e3a8a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 text-sm mb-1">Obtén tu link y QR</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Al registrarte recibes tu link personal único y tu código QR.</p>
            </div>

            {{-- Paso 3 --}}
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl border border-white/60 p-5 text-center relative">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-7 h-7 bg-[#1e3a8a] text-white text-xs font-black rounded-full flex items-center justify-center shadow-sm">3</div>
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-3 mt-2">
                    <svg class="w-6 h-6 text-[#1e3a8a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 text-sm mb-1">Comparte</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Comparte tu link por WhatsApp, muestra tu QR en el evento o proyéctalo en pantalla para que los donantes escaneen.</p>
            </div>

            {{-- Paso 4 --}}
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl border border-white/60 p-5 text-center relative">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-7 h-7 bg-[#1e3a8a] text-white text-xs font-black rounded-full flex items-center justify-center shadow-sm">4</div>
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-3 mt-2">
                    <svg class="w-6 h-6 text-[#1e3a8a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 text-sm mb-1">Sigue tu impacto</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Desde tu dashboard personal ve en tiempo real cuánto has recaudado y tu posición en el ranking de colaboradores.</p>
            </div>

        </div>

    </section>

    {{-- PREGUNTAS FRECUENTES --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h2 class="text-2xl font-black text-center text-gray-800 mb-8">
            Preguntas <span class="text-sitalel">frecuentes</span>
        </h2>

        <div class="space-y-3" id="faq">

            @foreach([
                [
                    'q' => '¿Qué es Impact Day?',
                    'a' => 'Impact Day es una iniciativa de Cruz Roja Mexicana en colaboración con Novo Nordisk México, donde colaboradores de Novo actúan como agentes de campo recaudando donativos para comunidades vulnerables de San Cristóbal de Las Casas, Chiapas.',
                ],
                [
                    'q' => '¿A dónde va mi donativo?',
                    'a' => 'Tu donativo va directamente a la cuenta institucional de Cruz Roja Mexicana, Delegación San Cristóbal de Las Casas. Ningún peso pasa por cuentas intermedias.',
                ],
                [
                    'q' => '¿Qué métodos de pago se aceptan?',
                    'a' => 'Se aceptan tarjetas de crédito y débito, tanto nacionales como internacionales, físicas o digitales (incluidas las generadas por aplicaciones bancarias con CVV dinámico). No se aceptan pagos en efectivo, depósitos bancarios ni transferencias SPEI directas, por razones de seguridad, trazabilidad y cumplimiento de la normativa de Prevención de Lavado de Dinero (PLD).',
                ],
                [
                    'q' => '¿Cuáles son los montos que puedo donar?',
                    'a' => 'Puedes seleccionar entre los montos sugeridos: $100, $500, $1,000, $2,500, $6,000 o $10,000 MXN. También puedes ingresar cualquier monto desde $50 MXN. El monto máximo por transacción es de $100,000 MXN, y el límite acumulado es de $180,000 MXN por RFC en un período de 6 meses, conforme a la normativa fiscal aplicable.',
                ],
                [
                    'q' => '¿Es seguro pagar con tarjeta en esta plataforma?',
                    'a' => 'Sí. Los pagos son procesados por Stripe, que cuenta con certificación PCI DSS Level 1 — el estándar más alto de seguridad en pagos a nivel mundial. Tus datos de tarjeta nunca son almacenados en nuestros servidores.',
                ],
                [
                    'q' => '¿Puedo obtener un comprobante fiscal (CFDI) por mi donativo?',
                    'a' => 'Sí. Al momento de donar puedes activar la opción de solicitar factura e ingresar tus datos fiscales. El CFDI es emitido por Cruz Roja Mexicana, I.A.P. Tu donativo es deducible de impuestos.',
                ],
                [
                    'q' => '¿Cuáles son los montos que puedo donar?',
                    'a' => 'Puedes seleccionar entre los montos sugeridos: $100, $500, $1,000, $2,500, $6,000 o $10,000 MXN. También puedes ingresar cualquier otro monto desde $50 MXN. El monto máximo por transacción es de $100,000 MXN.',
                ],
                [
                    'q' => '¿Cómo sé que mi donativo fue recibido correctamente?',
                    'a' => 'Al completar tu donativo verás una pantalla de confirmación. Adicionalmente, si proporcionaste tu correo electrónico, recibirás un comprobante de pago.',
                ],
                [
                    'q' => '¿Puedo donar de forma anónima?',
                    'a' => 'Tu nombre es requerido para procesar el donativo, pero no se publica en ningún lugar público de la plataforma. Solo Cruz Roja Mexicana tiene acceso a los datos del donante.',
                ],
                [
                    'q' => '¿En qué se utilizan los donativos?',
                    'a' => 'Los recursos se destinan a programas de atención médica, prevención de enfermedades, educación en salud y cobertura en comunidades vulnerables de San Cristóbal de Las Casas, Chiapas.',
                ],
            ] as $index => $item)
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl border border-white/60 overflow-hidden">
                <button
                    onclick="toggleFaq({{ $index }})"
                    class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-white/80 transition">
                    <span class="font-semibold text-gray-800 text-sm pr-4">{{ $item['q'] }}</span>
                    <svg id="faq-icon-{{ $index }}"
                        class="w-5 h-5 text-orange-500 flex-shrink-0 transition-transform duration-300"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="faq-answer-{{ $index }}" class="hidden px-6 pb-4">
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $item['a'] }}</p>
                </div>
            </div>
            @endforeach

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

    <script>
    function toggleFaq(index) {
        const answer = document.getElementById('faq-answer-' + index);
        const icon   = document.getElementById('faq-icon-' + index);
        const isOpen = !answer.classList.contains('hidden');

        // Cerrar todos
        document.querySelectorAll('[id^="faq-answer-"]').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('[id^="faq-icon-"]').forEach(el => el.style.transform = 'rotate(0deg)');

        // Abrir el seleccionado si estaba cerrado
        if (!isOpen) {
            answer.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        }
    }
</script>

</body>
</html>