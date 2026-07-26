@extends('layouts.public')

@section('title', '¡Gracias! — Impact Day')

@section('content')

    {{-- Ícono de confirmación --}}
    <div class="text-center mb-6">
        <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-800">¡Gracias por tu donativo!</h1>
        <p class="text-gray-500 mt-1">Tu apoyo salva vidas en Chiapas</p>
    </div>

    {{-- Resumen --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-4 text-center">
        <p class="text-5xl font-bold text-red-600">${{ number_format($donation->amount, 0) }}</p>
        <p class="text-gray-400 text-sm mt-1">MXN · donación confirmada</p>

        @if($donation->collaborator)
        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-center gap-2">
            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <p class="text-sm text-gray-600">
                Donativo confirmado a <span class="font-semibold text-gray-800">Cruz Roja Mexicana en Chiapas</span>
            </p>
        </div>
        @endif
    </div>

    {{-- Compartir en WhatsApp --}}
    @if($donation->collaborator)
    <a href="https://wa.me/?text={{ urlencode('¡Acabo de hacer un donativo de $' . number_format($donation->amount, 0) . ' MXN para Cruz Roja México en Impact Day! Tú también puedes apoyar: ' . url('/donar') . '?ref=' . $donation->collaborator->ref_code) }}"
        target="_blank"
        class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold rounded-2xl py-4 text-base transition-all shadow-sm flex items-center justify-center gap-2 mb-3">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.136.564 4.14 1.545 5.875L.057 23.854a.75.75 0 00.916.928l6.204-1.63A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.75a9.713 9.713 0 01-4.953-1.355l-.353-.21-3.664.964.979-3.572-.23-.368A9.715 9.715 0 012.25 12C2.25 6.615 6.615 2.25 12 2.25S21.75 6.615 21.75 12 17.385 21.75 12 21.75z"/>
        </svg>
        Compartir en WhatsApp
    </a>
    @endif

    {{-- Copiar link --}}
    @if($donation->collaborator)
    <button onclick="copyLink('{{ url('/donar') }}?ref={{ $donation->collaborator->ref_code }}')"
        class="w-full border border-red-200 text-red-600 hover:bg-red-50 font-medium rounded-2xl py-3 text-sm transition-all flex items-center justify-center gap-2 mb-4">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
        </svg>
        Copiar link de campaña
    </button>
    @endif

    {{-- Donar de nuevo --}}
    <div class="text-center">
        <a href="{{ url('/donar') }}{{ $donation->collaborator ? '?ref=' . $donation->collaborator->ref_code : '' }}"
            class="text-sm text-gray-400 hover:text-gray-600 transition underline underline-offset-2">
            Hacer otro donativo
        </a>
    </div>

@endsection

@push('scripts')
<script>
    function copyLink(url) {
        navigator.clipboard.writeText(url).then(() => {
            alert('¡Link copiado!');
        });
    }
</script>
@endpush