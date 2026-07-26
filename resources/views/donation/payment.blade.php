@extends('layouts.public')

@section('title', 'Confirmar donativo — Impact Day')

@section('content')

    {{-- Resumen del donativo --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-4 text-center">
        <p class="text-xs text-gray-400 uppercase tracking-wide mb-2">Total a donar</p>
        <p class="text-5xl font-bold text-red-600">${{ number_format($donation->amount, 0) }}</p>
        <p class="text-lg text-red-400 mt-1">MXN</p>

        @if($donation->donor_name)
        <div class="mt-3 pt-3 border-t border-gray-100">
            <p class="text-sm text-gray-500">de <span class="font-medium text-gray-700">{{ $donation->donor_name }}</span></p>
        </div>
        @endif

        <div class="mt-2">
            <p class="text-sm text-gray-400">
                a <span class="font-medium text-gray-600">Cruz Roja Mexicana en Chiapas</span>
            </p>
        </div>
    </div>

    {{-- Stripe Elements --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
        <p class="text-xs text-gray-400 uppercase tracking-wide mb-4">Datos de pago</p>
        <div id="payment-element"></div>
    </div>

    {{-- Mensaje de error --}}
    <div id="payment-message" class="hidden bg-red-50 border border-red-100 rounded-xl p-3 mb-4 text-sm text-red-600 text-center"></div>

    {{-- Botón --}}
    <button id="submit-btn"
        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl py-4 text-base transition-all shadow-sm disabled:opacity-50">
        <span id="btn-text">Completar donativo →</span>
        <span id="btn-spinner" class="hidden">Procesando...</span>
    </button>

    {{-- Seguridad --}}
    <div class="mt-4 flex items-center justify-center gap-4 text-xs text-gray-400">
        <span>🔒 SSL 256-bit</span>
        <span>·</span>
        <span>PCI DSS</span>
        <span>·</span>
        <span>Stripe</span>
    </div>

    {{-- Volver --}}
    <div class="text-center mt-4">
        <a href="javascript:history.back()" class="text-xs text-gray-400 hover:text-gray-600 transition">
            ← Cambiar monto
        </a>
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
                spacingUnit: '4px',
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