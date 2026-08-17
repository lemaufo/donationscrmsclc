@extends('layouts.public')

@section('title', '¡Gracias! — Impact Day')
@section('content_width', 'max-w-6xl mx-auto')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

    {{-- Columna izquierda — Confirmación --}}
    <div class="space-y-4">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center">
            <div class="w-20 h-20 bg-red-50 rounded-2xl flex items-center justify-center mx-auto mb-5">
                <svg class="w-10 h-10 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-black text-gray-800 mb-2">¡Gracias por tu donativo!</h1>
            <p class="text-gray-500">Tu apoyo salva vidas en San Cristóbal de Las Casas, Chiapas.</p>
        </div>

        <div class="bg-red-600 rounded-2xl p-8 text-white">
            <p class="text-xs text-red-200 uppercase tracking-widest mb-3">Donación confirmada</p>
            <p class="text-6xl font-black mb-1">${{ number_format($donation->amount, 0) }}</p>
            <p class="text-red-300 text-lg mb-5">MXN</p>

            <div class="pt-5 border-t border-red-500 space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-red-300">Beneficiario</span>
                    <span class="font-semibold">Cruz Roja Mexicana en Chiapas</span>
                </div>
                @if($donation->donor_name)
                <div class="flex justify-between text-sm">
                    <span class="text-red-300">Donante</span>
                    <span class="font-semibold">{{ $donation->donor_name }}</span>
                </div>
                @endif
                @if($donation->collaborator)
                <div class="flex justify-between text-sm">
                    <span class="text-red-300">Referido por</span>
                    <span class="font-semibold">{{ $donation->collaborator->name }}</span>
                </div>
                @endif
                <div class="flex items-center gap-2 text-xs text-red-300 pt-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Pago procesado y confirmado por Stripe
                </div>
            </div>
        </div>

    </div>

    {{-- Columna derecha — Compartir --}}
    <div class="space-y-4">

        @if($donation->collaborator)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-5">Comparte e invita a más personas</p>
            <p class="text-sm text-gray-500 mb-4">Tu impacto crece cuando invitas a más personas a donar. Comparte tu link y ayuda a Cruz Roja Mexicana a llegar a más familias.</p>

            <a href="https://wa.me/?text={{ urlencode('¡Acabo de donar $' . number_format($donation->amount, 0) . ' MXN a Cruz Roja Mexicana en Chiapas! Únete al Impact Day y haz tu donativo aquí: ' . url('/donar') . '?ref=' . $donation->collaborator->ref_code) }}"
                target="_blank"
                class="w-full bg-green-500 hover:bg-green-600 text-white font-bold rounded-2xl py-4 flex items-center justify-center gap-2 transition shadow-sm mb-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/>
                </svg>
                Compartir en WhatsApp
            </a>

            <button onclick="copyLink('{{ url('/donar') }}?ref={{ $donation->collaborator->ref_code }}')"
                class="w-full border-2 border-red-200 text-red-600 hover:bg-red-50 font-medium rounded-2xl py-3 flex items-center justify-center gap-2 transition text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                Copiar link de campaña
            </button>
        </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">¿Quieres donar de nuevo?</p>
            <p class="text-sm text-gray-500 mb-4">Cada donativo suma. Puedes realizar otro donativo en cualquier momento.</p>
            <a href="{{ url('/donar') }}{{ $donation->collaborator ? '?ref=' . $donation->collaborator->ref_code : '' }}"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold rounded-2xl py-4 flex items-center justify-center gap-2 transition shadow-sm text-sm">
                Hacer otro donativo →
            </a>
        </div>

        <div class="bg-gray-50 rounded-2xl border border-gray-100 p-5 text-center">
            <p class="text-xs text-gray-400">
                ¿Necesitas tu comprobante fiscal? El CFDI será emitido por Cruz Roja Mexicana.<br>
                Contacta a <a href="mailto:crmsancristobal@gmail.com" class="text-red-600 hover:underline">crmsancristobal@gmail.com</a>
            </p>
        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
    function copyLink(url) {
        navigator.clipboard.writeText(url).then(() => alert('¡Link copiado!'));
    }
</script>
@endpush