@extends('layouts.public')

@section('title', 'Campañas — Impact Day')
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

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-[#1e3a8a]">Campañas</h1>
            <p class="text-xs text-gray-400 mt-0.5">Gestiona las campañas de recaudación</p>
        </div>
        <a href="{{ route('admin.campaigns.create') }}"
            class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-xl transition flex items-center gap-1.5 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nueva campaña
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 rounded-xl p-3 mb-4 text-sm text-green-700">
        {{ session('success') }}
    </div>
    @endif

    <div class="space-y-3">
        @forelse($campaigns as $campaign)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-start justify-between gap-4">

                <div class="flex items-start gap-4 flex-1 min-w-0">
                    {{-- Color indicator --}}
                    <div class="w-10 h-10 rounded-xl flex-shrink-0 border border-gray-100"
                         style="background-color: {{ $campaign->theme_color ?? '#dc2626' }}"></div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <h2 class="font-semibold text-gray-800 truncate">{{ $campaign->name }}</h2>
                            @if($campaign->is_active)
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-medium flex-shrink-0">
                                    ● Activa
                                </span>
                            @else
                                <span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full flex-shrink-0">
                                    Inactiva
                                </span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-400 mb-2">
                            {{ $campaign->event_date->format('d/m/Y') }}
                            @if($campaign->goal_amount)
                                · Meta ${{ number_format($campaign->goal_amount, 0) }} MXN
                            @endif
                        </p>
                        <div class="flex items-center gap-4 text-xs text-gray-500">
                            <span>{{ $campaign->collaborators_count }} colaboradores</span>
                            <span>·</span>
                            <span class="text-red-600 font-medium">${{ number_format($campaign->total_raised ?? 0, 0) }} MXN recaudados</span>
                        </div>

                        {{-- Link de invitación --}}
                        @if($campaign->registration_token)
                        <div class="mt-3 bg-gray-50 rounded-xl px-3 py-2 flex items-center gap-2 border border-gray-200">
                            <code class="text-xs text-gray-500 flex-1 truncate">
                                {{ url('/unirse/' . $campaign->registration_token) }}
                            </code>
                            <button onclick="copyToken('{{ url('/unirse/' . $campaign->registration_token) }}')"
                                class="text-xs text-red-600 hover:text-red-700 font-medium flex-shrink-0">
                                Copiar
                            </button>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Acciones --}}
                <div class="flex items-center gap-2 flex-shrink-0">
                    <a href="{{ route('admin.campaigns.edit', $campaign) }}"
                        class="text-xs border border-gray-200 text-gray-600 hover:border-red-300 hover:text-red-600 px-3 py-1.5 rounded-lg transition">
                        Editar
                    </a>
                    <form action="{{ route('admin.campaigns.toggle', $campaign) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="text-xs border px-3 py-1.5 rounded-lg transition
                                {{ $campaign->is_active
                                    ? 'border-green-200 text-green-700 hover:border-red-300 hover:text-red-600'
                                    : 'border-gray-200 text-gray-500 hover:border-green-300 hover:text-green-600' }}">
                            {{ $campaign->is_active ? 'Desactivar' : 'Activar' }}
                        </button>
                    </form>
                    <a href="{{ route('admin.index') }}?campaign={{ $campaign->id }}"
                        class="text-xs bg-[#1e3a8a] hover:bg-blue-900 text-white px-3 py-1.5 rounded-lg transition">
                        Ver dashboard
                    </a>
                </div>

            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
            <p class="text-gray-400 text-sm">No hay campañas creadas</p>
            <a href="{{ route('admin.campaigns.create') }}" class="text-red-600 text-sm mt-2 inline-block hover:underline">
                Crear primera campaña →
            </a>
        </div>
        @endforelse
    </div>

@endsection

@push('scripts')
<script>
    function copyToken(url) {
        navigator.clipboard.writeText(url).then(() => alert('¡Link copiado!'));
    }
</script>
@endpush