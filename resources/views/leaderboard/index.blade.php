@extends('layouts.public')

@section('title', 'Leaderboard — {{ $campaign->name }}')
@section('content_width', 'max-w-6xl mx-auto')
@section('header_width', 'max-w-6xl mx-auto')

@section('header_right')
    <div class="flex items-center gap-3">
        @if($campaign->banner_url)
            <img src="{{ Storage::url($campaign->banner_url) }}" alt="Sponsor" class="h-5 object-contain opacity-50 grayscale">
        @else
            <span class="text-xs text-gray-400">Novo Nordisk</span>
        @endif
        <span class="text-xs text-green-500 flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
            En vivo
        </span>
    </div>
@endsection

@section('content')

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-[#1e3a8a]">{{ $campaign->name }}</h1>
            <p class="text-xs text-gray-400 mt-0.5">San Cristóbal de Las Casas, Chiapas</p>
        </div>
        <p class="text-xs text-gray-400">Actualiza cada 15s</p>
    </div>

    {{-- KPIs --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-6">
        <div class="bg-red-600 rounded-2xl p-4 text-center text-white col-span-2 sm:col-span-1">
            <p class="text-xs text-red-200 uppercase tracking-wide mb-1">Total recaudado</p>
            <p class="text-3xl font-black">${{ number_format($totalRaised, 0) }}</p>
            <p class="text-red-300 text-xs mt-0.5">MXN</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 text-center">
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Donativos</p>
            <p class="text-3xl font-black text-gray-800">{{ $totalDonations }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 text-center">
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Colaboradores</p>
            <p class="text-3xl font-black text-gray-800">{{ $leaderboard->count() }}</p>
        </div>
    </div>

    {{-- Meta de campaña con cruz animada --}}
    @if($goalAmount > 0)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6">
        <div class="flex items-center gap-6">
            <div class="flex-shrink-0 text-center">
                <svg viewBox="0 0 100 100" class="w-24 h-24" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <clipPath id="cruz-shape">
                            <rect x="33" y="5"  width="34" height="90" rx="4"/>
                            <rect x="5"  y="33" width="90" height="34" rx="4"/>
                        </clipPath>
                        <linearGradient id="cruz-grad" x1="0" y1="1" x2="0" y2="0">
                            <stop offset="0%"   stop-color="#b91c1c"/>
                            <stop offset="100%" stop-color="#ef4444"/>
                        </linearGradient>
                    </defs>
                    <rect x="33" y="5"  width="34" height="90" rx="4" fill="#f3f4f6"/>
                    <rect x="5"  y="33" width="90" height="34" rx="4" fill="#f3f4f6"/>
                    <g clip-path="url(#cruz-shape)">
                        <rect id="cruz-fill" x="0" y="100" width="100" height="0" fill="url(#cruz-grad)"/>
                    </g>
                    <text id="cruz-pct" x="50" y="55"
                          text-anchor="middle" font-size="16" font-weight="900"
                          font-family="Inter, sans-serif" fill="#dc2626">0%</text>
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-sm font-semibold text-[#1e3a8a] mb-1">Meta de campaña</p>
                <p class="text-xs text-gray-500 mb-3">
                    Recauda ${{ number_format($goalAmount, 0) }} MXN entre todos los colaboradores
                </p>
                <div class="flex justify-between text-sm mb-1.5">
                    <span class="font-semibold text-gray-700">${{ number_format($totalRaised, 0) }} MXN</span>
                    <span class="font-bold text-red-600">{{ number_format($progress, 0) }}%</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden mb-3">
                    <div id="progress-bar" class="bg-red-500 h-2.5 rounded-full" style="width: 0%"></div>
                </div>
                <div class="grid grid-cols-3 gap-3 text-center">
                    <div>
                        <p class="text-xs text-gray-400">Recaudado</p>
                        <p class="text-sm font-bold text-red-600">${{ number_format($totalRaised, 0) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Faltante</p>
                        <p class="text-sm font-bold text-gray-700">${{ number_format(max(0, $goalAmount - $totalRaised), 0) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Avance</p>
                        <p class="text-sm font-bold text-gray-700">{{ number_format($progress, 0) }}%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Ranking top 10 sin montos --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs text-gray-400 uppercase tracking-wide">Top 10 colaboradores</p>
            <div class="flex items-center gap-1.5 text-xs text-green-500">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                En vivo
            </div>
        </div>

        @if($leaderboard->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-300 text-sm">Sin datos aún</p>
            </div>
        @else
            <div class="space-y-2">
                @foreach($leaderboard->take(10) as $index => $collaborator)
                @php
                    $medals  = ['🥇', '🥈', '🥉'];
                    $isTop3  = $index < 3;
                    $maxDonations = $leaderboard->first()->paid_donations_count ?? 1;
                    $barWidth = $maxDonations > 0
                        ? ($collaborator->paid_donations_count / $maxDonations) * 100
                        : 0;
                @endphp
                <div class="flex items-center gap-3 {{ $isTop3 ? 'bg-red-50 border border-red-100' : 'bg-gray-50 border border-gray-100' }} rounded-xl px-3 py-3">

                    {{-- Posición --}}
                    <div class="w-8 text-center flex-shrink-0">
                        @if(isset($medals[$index]))
                            <span class="text-xl">{{ $medals[$index] }}</span>
                        @else
                            <span class="text-sm font-bold text-gray-400">{{ $index + 1 }}</span>
                        @endif
                    </div>

                    {{-- Avatar con iniciales --}}
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0
                        {{ $isTop3 ? 'bg-red-500 text-white' : 'bg-red-100 text-red-600' }}">
                        {{ $collaborator->initials ?? strtoupper(substr($collaborator->name, 0, 3)) }}
                    </div>

                    {{-- Identificador + barra --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-800">
                            {{ $collaborator->initials ?? strtoupper(substr($collaborator->name, 0, 3)) }}
                        </p>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="flex-1 bg-gray-200 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-red-500 h-1.5 rounded-full transition-all duration-700"
                                     style="width: {{ $barWidth }}%"></div>
                            </div>
                            <span class="text-xs text-gray-400 flex-shrink-0">
                                {{ $collaborator->paid_donations_count }} don.
                            </span>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection

@push('scripts')
<script>
    // Animación de la cruz y barra de progreso al cargar
    const targetProgress = {{ $progress }};

window.addEventListener('load', () => {
    setTimeout(() => {

        // Animar barra horizontal
        const bar = document.getElementById('progress-bar');
        if (bar) {
            bar.style.transition = 'width 1.5s cubic-bezier(0.4,0,0.2,1)';
            bar.style.width = targetProgress + '%';
        }

        // Animar cruz SVG con JS puro
        const cruzFill = document.getElementById('cruz-fill');
        const cruzPct  = document.getElementById('cruz-pct');

        if (cruzFill) {
            const duration  = 1500; // ms
            const startTime = performance.now();

            function animateCruz(currentTime) {
                const elapsed  = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);

                // easeOutCubic
                const eased = 1 - Math.pow(1 - progress, 3);
                const current = eased * targetProgress;

                const fillHeight = current;
                const startY     = 100 - fillHeight;

                cruzFill.setAttribute('y', startY);
                cruzFill.setAttribute('height', fillHeight);

                if (cruzPct) {
                    cruzPct.textContent = Math.round(current) + '%';
                    cruzPct.setAttribute('fill', current > 45 ? 'white' : '#dc2626');
                }

                if (progress < 1) {
                    requestAnimationFrame(animateCruz);
                }
            }

            requestAnimationFrame(animateCruz);
        }

    }, 300);
});

setTimeout(() => location.reload(), 15000);
</script>
@endpush