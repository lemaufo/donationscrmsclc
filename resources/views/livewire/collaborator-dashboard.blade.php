<div>

    {{-- Hero: Total recaudado --}}
    <div class="bg-red-600 rounded-2xl p-6 mb-4 text-white text-center shadow-sm">
        <p class="text-xs uppercase tracking-widest text-red-200 mb-1">Total recaudado</p>
        <p class="text-5xl font-bold">${{ number_format($totalRaised, 0) }}</p>
        <p class="text-red-300 text-sm mt-1">MXN</p>
    </div>

    {{-- Stats secundarios --}}
    <div class="grid grid-cols-2 gap-3 mb-4">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 text-center">
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Donaciones</p>
            <p class="text-3xl font-bold text-gray-800">{{ $donationCount }}</p>
            <p class="text-xs text-gray-400 mt-0.5">en tu link</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 text-center">
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Posición</p>
            <p class="text-3xl font-bold text-gray-800">{{ $ranking }}<span class="text-lg text-gray-400">°</span></p>
            <p class="text-xs text-gray-400 mt-0.5">en el ranking</p>
        </div>
    </div>

    {{-- Meta personal --}}
    @if($collaborator->personal_goal)
        @php
            $progress = min(100, ($totalRaised / $collaborator->personal_goal) * 100);
            $remaining = max(0, $collaborator->personal_goal - $totalRaised);
        @endphp
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
            <div class="flex justify-between items-center mb-2">
                <p class="text-xs text-gray-400 uppercase tracking-wide">Meta personal</p>
                <p class="text-sm font-semibold text-red-600">{{ number_format($progress, 0) }}%</p>
            </div>
            <div class="flex justify-between text-sm text-gray-600 mb-2">
                <span class="font-medium">${{ number_format($totalRaised, 0) }} MXN</span>
                <span class="text-gray-400">meta ${{ number_format($collaborator->personal_goal, 0) }}</span>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-2">
                <div class="bg-red-500 h-2 rounded-full transition-all duration-700"
                     style="width: {{ $progress }}%"></div>
            </div>
            @if($remaining > 0)
            <p class="text-xs text-gray-400 mt-2">${{ number_format($remaining, 0) }} MXN restantes para tu meta</p>
            @else
            <p class="text-xs text-green-600 mt-2 font-medium">✓ ¡Meta alcanzada!</p>
            @endif
        </div>
    @endif

    {{-- Link personal --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
        <p class="text-xs text-gray-400 uppercase tracking-wide mb-3">Tu link personal de donaciones</p>
        <div class="bg-gray-50 rounded-xl px-3 py-2.5 mb-3 border border-gray-200">
            <code class="text-xs text-gray-600 break-all">
                {{ url('/donar') }}?ref={{ $collaborator->ref_code }}
            </code>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <button onclick="copyLink()"
                class="border border-red-200 text-red-600 hover:bg-red-50 font-medium rounded-xl py-2.5 text-sm transition flex items-center justify-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                Copiar
            </button>
            <a href="https://wa.me/?text={{ urlencode('¡Únete a Impact Day y apoya a Cruz Roja México! Haz tu donativo aquí: ' . url('/donar') . '?ref=' . $collaborator->ref_code) }}"
                target="_blank"
                class="bg-green-500 hover:bg-green-600 text-white font-medium rounded-xl py-2.5 text-sm transition flex items-center justify-center gap-1.5">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/>
                </svg>
                WhatsApp
            </a>
        </div>
    </div>

    {{-- QR de donativo --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4 text-center">
        <p class="text-xs text-gray-400 uppercase tracking-wide mb-3">Tu QR de donativo</p>
        <div class="flex justify-center mb-3">
            <img
                src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(url('/donar') . '?ref=' . $collaborator->ref_code) }}&bgcolor=ffffff&color=000000&margin=10"
                alt="QR de donativo"
                class="w-48 h-48 rounded-xl border border-gray-100">
        </div>
        <p class="text-xs text-gray-500 mb-3">
            Muestra este QR para que tus contactos donen directo desde su teléfono
        </p>
    </div>

    {{-- Donaciones recientes --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs text-gray-400 uppercase tracking-wide">Donaciones recientes</p>
            <span class="text-xs text-green-500 flex items-center gap-1">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                En vivo · actualiza cada 10s
            </span>
        </div>

        @if(count($recentDonations) === 0)
            <div class="text-center py-8">
                <p class="text-3xl mb-2">💛</p>
                <p class="text-sm text-gray-400">Aún no hay donaciones</p>
                <p class="text-xs text-gray-300 mt-1">Comparte tu link para empezar</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($recentDonations as $donation)
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-700 truncate">{{ $donation['donor_name'] }}</p>
                        <p class="text-xs text-gray-400">{{ $donation['paid_at'] }}</p>
                    </div>
                    <p class="font-semibold text-red-600 flex-shrink-0">${{ number_format($donation['amount'], 0) }}</p>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Auto-refresh --}}
    <div wire:poll.10000ms="loadData"></div>

</div>