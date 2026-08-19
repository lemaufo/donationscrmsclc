@extends('layouts.public')

@section('title', 'Hacer un donativo — Cruz Roja Mexicana')

@section('content_width', 'max-w-6xl mx-auto')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

    {{-- Columna izquierda — Info de la campaña --}}
    <div class="hidden lg:block">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-4">
            <div class="mb-6">
                @if(isset($campaign) && $campaign->logo_url)
                    <img src="{{ Storage::url($campaign->logo_url) }}" alt="Cruz Roja" class="h-12 object-contain mb-4">
                @endif
                <h2 class="text-2xl font-black text-[#1e3a8a] mb-2">Impact Day 2026</h2>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Una iniciativa de Cruz Roja Mexicana y Novo Nordisk para recaudar donativos destinados a comunidades vulnerables de San Cristóbal de Las Casas, Chiapas.
                </p>
            </div>

            <div class="space-y-3">
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <div class="w-8 h-8 bg-red-50 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <span>Donativo 100% seguro</span>
                </div>
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <div class="w-8 h-8 bg-red-50 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/>
                        </svg>
                    </div>
                    <span>Comprobante fiscal (CFDI) disponible</span>
                </div>
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <div class="w-8 h-8 bg-red-50 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <span>Los fondos van directo a Cruz Roja Mexicana</span>
                </div>
            </div>
        </div>

        @if($collaborator)
        <div class="bg-[#1e3a8a] rounded-2xl p-6 text-white">
            <p class="text-xs text-blue-200 uppercase tracking-widest mb-1">Colaborador</p>
            <p class="text-xl font-bold mb-0.5">{{ $collaborator->name }}</p>
            <p class="text-sm text-blue-200">{{ $collaborator->department }}</p>
            <p class="text-xs font-mono text-blue-300 mt-2 bg-white/10 inline-block px-2 py-0.5 rounded-lg">{{ $collaborator->ref_code }}</p>
        </div>
        @endif
    </div>

    {{-- Columna derecha — Formulario --}}
    <div>
        {{-- Mobile: destino del donativo --}}
        <div class="lg:hidden bg-red-600 rounded-2xl p-4 mb-4 flex items-center gap-3">
            <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs text-red-200">Tu donativo beneficia a</p>
                <p class="font-semibold text-white text-sm">Cruz Roja Mexicana en Chiapas</p>
            </div>
            @if($collaborator)
            <span class="text-xs font-mono text-white bg-white/10 px-2 py-0.5 rounded-lg flex-shrink-0">{{ $collaborator->ref_code }}</span>
            @endif
        </div>

        {{-- Selector de monto --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">Selecciona el monto</p>

            <div class="grid grid-cols-3 gap-2 mb-4">
                @foreach([100, 500, 1000, 2500, 6000, 10000] as $monto)
                <button type="button" onclick="setAmount({{ $monto }})"
                    class="amount-chip border-2 border-gray-100 rounded-xl py-3 text-sm font-semibold text-gray-600 hover:border-red-500 hover:text-red-600 hover:bg-red-50 transition-all">
                    ${{ number_format($monto) }}
                </button>
                @endforeach
            </div>

            <div class="text-center mb-3 py-3 bg-gray-50 rounded-xl">
                <span class="text-4xl font-black text-red-600" id="amount-display">$0</span>
                <span class="text-base text-gray-400 ml-1 font-medium">MXN</span>
            </div>

            <input type="number" id="custom-amount"
                class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-gray-700 text-center focus:outline-none focus:border-red-400 transition hidden"
                placeholder="Otro monto (mín. $50)" min="50" max="100000">
            <button type="button" onclick="focusCustom()"
                class="w-full text-xs text-gray-400 hover:text-red-500 transition mt-2 text-center">
                + Ingresar otro monto
            </button>
        </div>

        <form action="{{ route('donation.store') }}" method="POST" id="donation-form">
            @csrf
            <input type="hidden" name="campaign_id" value="{{ $campaign->id ?? '' }}">
            <input type="hidden" name="collaborator_id" value="{{ $collaborator->id ?? '' }}">
            <input type="hidden" name="amount" id="amount-input" value="0">

            {{-- Datos del donante --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">Tus datos</p>

                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                        Nombre completo <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="donor_name" value="{{ old('donor_name') }}" required
                        class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition @error('donor_name') border-red-400 @enderror"
                        placeholder="Tu nombre completo">
                    @error('donor_name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                        Correo electrónico <span class="text-gray-400 font-normal">(opcional)</span>
                    </label>
                    <input type="email" name="donor_email" value="{{ old('donor_email') }}"
                        class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                        placeholder="tu@correo.com">
                </div>
            </div>

            {{-- Comprobante fiscal --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-5">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" id="wants_invoice" name="wants_invoice" value="1"
                        {{ old('wants_invoice') ? 'checked' : '' }}
                        class="mt-0.5 w-4 h-4 text-red-600 rounded border-gray-300 focus:ring-red-500 flex-shrink-0"
                        onchange="toggleFiscal(this.checked)">
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Solicitar comprobante fiscal (CFDI)</p>
                        <p class="text-xs text-gray-400 mt-0.5">Deducible de impuestos. Emitido por Cruz Roja Mexicana.</p>
                    </div>
                </label>

                <div id="fiscal-fields" class="{{ old('wants_invoice') ? '' : 'hidden' }} mt-4 pt-4 border-t border-gray-100 space-y-3">

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Tipo de persona <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="flex items-center gap-2 border-2 border-gray-100 rounded-xl px-4 py-3 cursor-pointer hover:border-red-300 transition">
                                <input type="radio" name="person_type" value="fisica" {{ old('person_type') == 'fisica' ? 'checked' : '' }} class="text-red-600">
                                <span class="text-sm text-gray-700">Física</span>
                            </label>
                            <label class="flex items-center gap-2 border-2 border-gray-100 rounded-xl px-4 py-3 cursor-pointer hover:border-red-300 transition">
                                <input type="radio" name="person_type" value="moral" {{ old('person_type') == 'moral' ? 'checked' : '' }} class="text-red-600">
                                <span class="text-sm text-gray-700">Moral</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">RFC <span class="text-red-500">*</span></label>
                        <input type="text" name="donor_rfc" value="{{ old('donor_rfc') }}"
                            class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition uppercase @error('donor_rfc') border-red-400 @enderror"
                            placeholder="XAXX010101000" maxlength="13">
                        @error('donor_rfc')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="razon-social-field" class="{{ old('person_type') == 'moral' ? '' : 'hidden' }}">
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Razón social <span class="text-red-500">*</span></label>
                        <input type="text" name="razon_social" value="{{ old('razon_social') }}"
                            class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                            placeholder="Nombre de la empresa">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Régimen fiscal <span class="text-red-500">*</span></label>
                        <select name="regimen_fiscal" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition bg-white">
                            <option value="">Selecciona tu régimen</option>
                            <option value="601" {{ old('regimen_fiscal') == '601' ? 'selected' : '' }}>601 — General de Ley Personas Morales</option>
                            <option value="603" {{ old('regimen_fiscal') == '603' ? 'selected' : '' }}>603 — Personas Morales con Fines no Lucrativos</option>
                            <option value="605" {{ old('regimen_fiscal') == '605' ? 'selected' : '' }}>605 — Sueldos y Salarios</option>
                            <option value="606" {{ old('regimen_fiscal') == '606' ? 'selected' : '' }}>606 — Arrendamiento</option>
                            <option value="608" {{ old('regimen_fiscal') == '608' ? 'selected' : '' }}>608 — Demás ingresos</option>
                            <option value="612" {{ old('regimen_fiscal') == '612' ? 'selected' : '' }}>612 — Actividades Empresariales y Profesionales</option>
                            <option value="616" {{ old('regimen_fiscal') == '616' ? 'selected' : '' }}>616 — Sin obligaciones fiscales</option>
                            <option value="621" {{ old('regimen_fiscal') == '621' ? 'selected' : '' }}>621 — Incorporación Fiscal</option>
                            <option value="626" {{ old('regimen_fiscal') == '626' ? 'selected' : '' }}>626 — Régimen Simplificado de Confianza</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Uso de CFDI <span class="text-red-500">*</span></label>
                        <select name="uso_cfdi" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition bg-white">
                            <option value="">Selecciona el uso</option>
                            <option value="D04" {{ old('uso_cfdi') == 'D04' ? 'selected' : '' }}>D04 — Donativos</option>
                            <option value="G03" {{ old('uso_cfdi') == 'G03' ? 'selected' : '' }}>G03 — Gastos en general</option>
                            <option value="S01" {{ old('uso_cfdi') == 'S01' ? 'selected' : '' }}>S01 — Sin efectos fiscales</option>
                            <option value="P01" {{ old('uso_cfdi') == 'P01' ? 'selected' : '' }}>P01 — Por definir</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Código postal fiscal <span class="text-red-500">*</span></label>
                        <input type="text" name="codigo_postal" value="{{ old('codigo_postal') }}"
                            class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                            placeholder="29000" maxlength="5">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Correo para CFDI <span class="text-red-500">*</span></label>
                        <input type="email" name="fiscal_email" value="{{ old('fiscal_email') }}"
                            class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                            placeholder="facturacion@correo.com">
                    </div>

                    <div class="flex items-start gap-2 bg-amber-50 border border-amber-100 rounded-xl p-3">
                        <svg class="w-4 h-4 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-xs text-amber-700">El CFDI es emitido por Cruz Roja Mexicana. Tus datos se envían al área de facturación para su procesamiento posterior.</p>
                    </div>
                </div>
            </div>

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-4">
                @foreach($errors->all() as $error)
                    <p class="text-sm text-red-600">{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <button type="submit" id="submit-btn"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold rounded-2xl py-4 text-base transition-all shadow-md">
                Donar ahora →
            </button>

            <p class="text-center text-xs text-gray-300 mt-2">
                Monto máximo: $100,000 MXN · Límite fiscal: $180,000 MXN en 6 meses
            </p>

        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
    let selectedAmount = 0;

    function setAmount(val) {
        selectedAmount = val;
        document.getElementById('amount-display').textContent = '$' + val.toLocaleString('es-MX');
        document.getElementById('amount-input').value = val;
        document.getElementById('custom-amount').classList.add('hidden');

        document.querySelectorAll('.amount-chip').forEach(btn => {
            btn.classList.remove('bg-red-600', 'text-white', 'border-red-600');
            btn.classList.add('border-gray-100', 'text-gray-600');
        });

        const amounts = [100, 500, 1000, 2500, 6000, 10000];
        const index = amounts.indexOf(val);
        if (index !== -1) {
            const chips = document.querySelectorAll('.amount-chip');
            chips[index].classList.add('bg-red-600', 'text-white', 'border-red-600');
            chips[index].classList.remove('border-gray-100', 'text-gray-600');
        }
    }

    function focusCustom() {
        document.querySelectorAll('.amount-chip').forEach(btn => {
            btn.classList.remove('bg-red-600', 'text-white', 'border-red-600');
            btn.classList.add('border-gray-100', 'text-gray-600');
        });
        const input = document.getElementById('custom-amount');
        input.classList.remove('hidden');
        input.focus();
    }

    document.getElementById('custom-amount').addEventListener('input', function() {
        const val = parseFloat(this.value) || 0;
        selectedAmount = val;
        document.getElementById('amount-display').textContent = '$' + val.toLocaleString('es-MX');
        document.getElementById('amount-input').value = val;
    });

    function toggleFiscal(show) {
        document.getElementById('fiscal-fields').classList.toggle('hidden', !show);
    }

    document.querySelectorAll('input[name="person_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('razon-social-field').classList.toggle('hidden', this.value !== 'moral');
        });
    });

    document.getElementById('donation-form').addEventListener('submit', function(e) {
        if (selectedAmount < 50) {
            e.preventDefault();
            alert('Por favor selecciona un monto mínimo de $50 MXN');
            return;
        }
        const name = document.querySelector('input[name="donor_name"]').value.trim();
        if (!name) {
            e.preventDefault();
            alert('Por favor ingresa tu nombre completo');
            return;
        }
        const btn = document.getElementById('submit-btn');
        btn.textContent = 'Procesando...';
        btn.disabled = true;
    });
</script>
@endpush