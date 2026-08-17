@extends('layouts.public')

@section('title', 'Confirmar donativo — Impact Day')
@section('content_width', 'max-w-6xl mx-auto')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

    {{-- Columna izquierda — Resumen --}}
    <div class="space-y-4">

        <div class="bg-[#1e3a8a] rounded-2xl p-8 text-white">
            <p class="text-xs text-blue-300 uppercase tracking-widest mb-3">Resumen del donativo</p>
            <p class="text-6xl font-black mb-1">${{ number_format($donation->amount, 0) }}</p>
            <p class="text-blue-300 text-lg">MXN</p>

            <div class="mt-6 pt-6 border-t border-blue-700 space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-blue-300">Beneficiario</span>
                    <span class="font-semibold">Cruz Roja Mexicana en Chiapas</span>
                </div>
                @if($donation->donor_name)
                <div class="flex justify-between text-sm">
                    <span class="text-blue-300">Donante</span>
                    <span class="font-semibold">{{ $donation->donor_name }}</span>
                </div>
                @endif
                @if($donation->collaborator)
                <div class="flex justify-between text-sm">
                    <span class="text-blue-300">Referido por</span>
                    <span class="font-semibold">{{ $donation->collaborator->name }}</span>
                </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">Tu donativo contribuye a</p>
            <div class="space-y-3">
                @foreach([
                    ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'text' => 'Atención médica gratuita en comunidades'],
                    ['icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'text' => 'Programas de salud preventiva'],
                    ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'text' => 'Apoyo a familias vulnerables de Chiapas'],
                ] as $item)
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <div class="w-8 h-8 bg-red-50 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                        </svg>
                    </div>
                    {{ $item['text'] }}
                </div>
                @endforeach
            </div>
        </div>

        <a href="javascript:history.back()" class="flex items-center gap-1.5 text-xs text-gray-400 hover:text-red-600 transition">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Cambiar monto o datos
        </a>
    </div>

    {{-- Columna derecha — Pago --}}
    <div class="space-y-4">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-5">Datos de pago</p>
            <div id="payment-element"></div>
        </div>

        <div id="payment-message" class="hidden bg-red-50 border border-red-100 rounded-xl p-3 text-sm text-red-600 text-center"></div>

        <button id="submit-btn"
            class="w-full bg-red-600 hover:bg-red-700 text-white font-bold rounded-2xl py-4 text-base transition-all shadow-md disabled:opacity-50">
            <span id="btn-text">Completar donativo →</span>
            <span id="btn-spinner" class="hidden">Procesando...</span>
        </button>

        <div class="flex items-center justify-center gap-3 text-xs text-gray-400">
            <span class="flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                SSL 256-bit
            </span>
            <span>·</span>
            <span>PCI DSS</span>
            <span>·</span>
            <span>Powered by Stripe</span>
        </div>

    </div>

</div>

@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ $stripe_key }}');
    const elements = stripe.elements({
        clientSecret: '{{ $client_secret }}',
        appearance: {
            theme: 'stripe',
            variables: {
                colorPrimary: '#dc2626',
                borderRadius: '12px',
                fontFamily: 'system-ui, sans-serif',
            }
        }
    });

    const paymentElement = elements.create('payment');
    paymentElement.mount('#payment-element');

    document.getElementById('submit-btn').addEventListener('click', async () => {
        setLoading(true);
        const { error } = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url: '{{ route("donation.success", $donation->id) }}',
            }
        });
        if (error) {
            showMessage(error.message);
            setLoading(false);
        }
    });

    function setLoading(isLoading) {
        document.getElementById('submit-btn').disabled = isLoading;
        document.getElementById('btn-text').classList.toggle('hidden', isLoading);
        document.getElementById('btn-spinner').classList.toggle('hidden', !isLoading);
    }

    function showMessage(msg) {
        const el = document.getElementById('payment-message');
        el.textContent = msg;
        el.classList.remove('hidden');
    }
</script>
@endpush