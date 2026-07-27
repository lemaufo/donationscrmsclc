@extends('layouts.public')

@section('title', 'Admin — Impact Day')
@section('content_width', 'max-w-6xl mx-auto')
@section('header_width', 'max-w-6xl mx-auto')

@section('header_right')
    <div class="flex items-center gap-3 text-sm">
        <span class="text-gray-600 font-medium">{{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-xs text-gray-400 hover:text-gray-600 transition flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Cerrar sesión
            </button>
        </form>
    </div>
@endsection

@section('content')

    {{-- Header del panel --}}
    <div class="flex items-start justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-[#1e3a8a]">{{ $campaign->name }}</h1>
            <p class="text-xs text-gray-400 mt-0.5">San Cristóbal de Las Casas, Chiapas · Panel de administración</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-xs text-gray-400 flex items-center gap-1">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                Act. cada 30s
            </span>
            <a href="{{ route('admin.export') }}"
                class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-xl transition flex items-center gap-1.5 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Exportar CSV
            </a>
            @if(auth()->user()->isSuperAdmin())
            <a href="{{ route('admin.users.index') }}"
                class="border border-gray-200 text-gray-600 hover:border-red-300 hover:text-red-600 text-sm font-medium px-4 py-2 rounded-xl transition flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Usuarios
            </a>
            @endif
            <a href="{{ route('admin.campaigns.index') }}"
                class="border border-gray-200 text-gray-600 hover:border-red-300 hover:text-red-600 text-sm font-medium px-4 py-2 rounded-xl transition flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                Campañas
            </a>
        </div>
    </div>

    {{-- KPIs globales --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <p class="text-xs text-gray-400 uppercase tracking-wide">Total recaudado</p>
            </div>
            <p class="text-2xl font-bold text-red-600">${{ number_format($totalRaised, 0) }}</p>
            <p class="text-xs text-gray-400 mt-0.5">MXN</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <p class="text-xs text-gray-400 uppercase tracking-wide">Donaciones</p>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ $totalDonations }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <p class="text-xs text-gray-400 uppercase tracking-wide">Colaboradores</p>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ $totalCollaborators }}</p>
            <p class="text-xs text-gray-400 mt-0.5">de 500 activos</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <p class="text-xs text-gray-400 uppercase tracking-wide">Donación prom.</p>
            </div>
            <p class="text-2xl font-bold text-gray-800">
                ${{ $totalDonations > 0 ? number_format($totalRaised / $totalDonations, 0) : 0 }}
            </p>
            <p class="text-xs text-gray-400 mt-0.5">MXN</p>
        </div>
    </div>

    {{-- Meta de campaña --}}
    @if($campaign->goal_amount)
    @php $progress = min(100, ($totalRaised / $campaign->goal_amount) * 100); @endphp
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6">
        <div class="flex items-start gap-5">
            {{-- Cruz animada --}}
            <div class="relative w-16 h-16 flex-shrink-0">
                <svg viewBox="0 0 64 64" class="w-16 h-16">
                    <clipPath id="cruz-clip">
                        <rect x="20" y="4" width="24" height="56"/>
                        <rect x="4" y="20" width="56" height="24"/>
                    </clipPath>
                    <rect x="20" y="4" width="24" height="56" fill="#e5e7eb" rx="2"/>
                    <rect x="4" y="20" width="56" height="24" fill="#e5e7eb" rx="2"/>
                    <rect x="20" y="{{ 60 - ($progress * 0.56) }}" width="24" height="{{ $progress * 0.56 }}" fill="#dc2626"/>
                    <rect x="4" y="20" width="{{ $progress * 0.56 }}" height="24" fill="#dc2626"/>
                </svg>
                <p class="text-xs font-bold text-red-600 text-center mt-1">{{ number_format($progress, 0) }}%</p>
            </div>
            <div class="flex-1">
                <p class="text-sm font-semibold text-[#1e3a8a] mb-1">Meta de campaña</p>
                <p class="text-xs text-gray-500 mb-3">
                    Recauda ${{ number_format($campaign->goal_amount, 0) }} MXN entre todos los colaboradores de Novo Nordisk
                </p>
                <div class="flex justify-between text-sm text-gray-600 mb-1.5">
                    <span class="font-medium">${{ number_format($totalRaised, 0) }} MXN</span>
                    <span class="text-red-600 font-semibold">{{ number_format($progress, 0) }}%</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2 mb-3">
                    <div class="bg-red-500 h-2 rounded-full transition-all duration-700"
                         style="width: {{ $progress }}%"></div>
                </div>
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="text-xs text-gray-400">Recaudado</p>
                        <p class="text-sm font-semibold text-red-600">${{ number_format($totalRaised, 0) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Faltante</p>
                        <p class="text-sm font-semibold text-gray-700">${{ number_format(max(0, $campaign->goal_amount - $totalRaised), 0) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Avance</p>
                        <p class="text-sm font-semibold text-gray-700">{{ number_format($progress, 0) }}%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Ranking y recientes --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">

        {{-- Top colaboradores --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs text-gray-400 uppercase tracking-wide">Top colaboradores</p>
                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>

            @if($leaderboard->isEmpty())
                <p class="text-center text-gray-300 py-8 text-sm">Sin datos aún</p>
            @else
                <div class="space-y-3">
                    @foreach($leaderboard->take(10) as $index => $collaborator)
                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0
                            {{ $index === 0 ? 'bg-yellow-100 text-yellow-600' : ($index === 1 ? 'bg-gray-100 text-gray-500' : ($index === 2 ? 'bg-amber-100 text-amber-600' : 'bg-gray-50 text-gray-400')) }}">
                            {{ $index === 0 ? '🥇' : ($index === 1 ? '🥈' : ($index === 2 ? '🥉' : $index + 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-700 truncate">{{ $collaborator->name }}</p>
                            <p class="text-xs text-gray-400">{{ $collaborator->department }} · {{ $collaborator->paid_donations_count }} don.</p>
                        </div>
                        <p class="font-semibold text-red-600 text-sm flex-shrink-0">
                            ${{ number_format($collaborator->total_raised ?? 0, 0) }}
                        </p>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Donaciones recientes --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs text-gray-400 uppercase tracking-wide">Donaciones recientes</p>
                <span class="text-xs text-green-500 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                    En vivo
                </span>
            </div>

            @if($recentDonations->isEmpty())
                <p class="text-center text-gray-300 py-8 text-sm">Sin donaciones aún</p>
            @else
                <div class="space-y-3">
                    @foreach($recentDonations as $donation)
                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-700 truncate">
                                {{ $donation->donor_name ?? 'Anónimo' }}
                            </p>
                            <p class="text-xs text-gray-400">
                                → {{ $donation->collaborator?->name }} · {{ $donation->paid_at?->diffForHumans() }}
                            </p>
                        </div>
                        <p class="font-semibold text-red-600 text-sm flex-shrink-0">
                            ${{ number_format($donation->amount, 0) }}
                        </p>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

@endsection

@push('scripts')
<script>
    setTimeout(() => location.reload(), 30000);
</script>
@endpush