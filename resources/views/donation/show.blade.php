@extends('layouts.public')

@section('title', 'Donar — Impact Day')

@section('content')

    {{-- Card Cruz Roja --}}
    @if($collaborator)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-4 flex items-center gap-4">
        <div class="w-11 h-11 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-0.5">Tu donativo apoya a</p>
            <p class="font-semibold text-gray-800">Cruz Roja Mexicana en Chiapas</p>
            <p class="text-sm text-gray-500">San Cristóbal de Las Casas, Chiapas</p>
        </div>
    </div>
    @endif

    {{-- Selector de monto --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
        <p class="text-xs text-gray-400 uppercase tracking-wide mb-3">Elige tu donativo</p>

        <div class="grid grid-cols-3 gap-2 mb-4">
            @foreach([100, 500, 1000, 2500, 6000, 10000] as $monto)
            <button type="button" onclick="setAmount({{ $monto }})"
                class="amount-chip border border-gray-200 rounded-full py-2.5 text-sm font-medium text-gray-600 hover:border-red-500 hover:text-red-600 transition-all">
                ${{ number_format($monto) }}
            </button>
            @endforeach
        </div>

        <div class="text-center mb-4">
            <span class="text-4xl font-bold text-red-600" id="amount-display">$0</span>
            <span class="text-lg text-red-400 ml-1">MXN</span>
        </div>

        <input type="number" id="custom-amount"
            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 text-center text-lg focus:outline-none focus:border-red-400 transition hidden"
            placeholder="Mínimo $50" min="50" max="100000">
    </div>

    <form action="{{ route('donation.store') }}" method="POST" id="donation-form">
        @csrf
        <input type="hidden" name="campaign_id" value="{{ $campaign->id ?? '' }}">
        <input type="hidden" name="collaborator_id" value="{{ $collaborator->id ?? '' }}">
        <input type="hidden" name="amount" id="amount-input" value="0">

        {{-- Datos del donante --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-3">Tus datos</p>

            <div class="mb-3">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Nombre completo <span class="text-red-500">*</span>
                </label>
                <input type="text" name="donor_name" value="{{ old('donor_name') }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition @error('donor_name') border-red-400 @enderror"
                    placeholder="Tu nombre completo">
                @error('donor_name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Correo electrónico <span class="text-gray-400 normal-case font-normal">(opcional)</span>
                </label>
                <input type="email" name="donor_email" value="{{ old('donor_email') }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                    placeholder="tu@correo.com">
            </div>
        </div>

        {{-- Comprobante fiscal --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
            <div class="flex items-center gap-3 mb-4">
                <input type="checkbox" id="wants_invoice" name="wants_invoice" value="1"
                    {{ old('wants_invoice') ? 'checked' : '' }}
                    class="w-4 h-4 text-red-600 rounded border-gray-300 focus:ring-red-500 cursor-pointer"
                    onchange="toggleFiscal(this.checked)">
                <label for="wants_invoice" class="text-sm font-medium text-gray-700 cursor-pointer">
                    Requiero comprobante fiscal (CFDI)
                </label>
            </div>

            <div id="fiscal-fields" class="{{ old('wants_invoice') ? '' : 'hidden' }} space-y-3">

                {{-- Tipo de persona --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                        Tipo de persona <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-2">
                        <label class="flex items-center gap-2 border border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-red-300 transition">
                            <input type="radio" name="person_type" value="fisica"
                                {{ old('person_type') == 'fisica' ? 'checked' : '' }}
                                class="text-red-600">
                            <span class="text-sm text-gray-700">Física</span>
                        </label>
                        <label class="flex items-center gap-2 border border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-red-300 transition">
                            <input type="radio" name="person_type" value="moral"
                                {{ old('person_type') == 'moral' ? 'checked' : '' }}
                                class="text-red-600">
                            <span class="text-sm text-gray-700">Moral</span>
                        </label>
                    </div>
                </div>

                {{-- RFC --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                        RFC <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="donor_rfc" value="{{ old('donor_rfc') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition uppercase @error('donor_rfc') border-red-400 @enderror"
                        placeholder="XAXX010101000" maxlength="13">
                    @error('donor_rfc')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Razón social --}}
                <div id="razon-social-field" class="{{ old('person_type') == 'moral' ? '' : 'hidden' }}">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                        Razón social <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="razon_social" value="{{ old('razon_social') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                        placeholder="Nombre de la empresa">
                </div>

                {{-- Régimen fiscal --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                        Régimen fiscal <span class="text-red-500">*</span>
                    </label>
                    <select name="regimen_fiscal"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition bg-white">
                        <option value="">Selecciona tu régimen</option>
                        <option value="601" {{ old('regimen_fiscal') == '601' ? 'selected' : '' }}>601 - General de Ley Personas Morales</option>
                        <option value="603" {{ old('regimen_fiscal') == '603' ? 'selected' : '' }}>603 - Personas Morales con Fines no Lucrativos</option>
                        <option value="605" {{ old('regimen_fiscal') == '605' ? 'selected' : '' }}>605 - Sueldos y Salarios</option>
                        <option value="606" {{ old('regimen_fiscal') == '606' ? 'selected' : '' }}>606 - Arrendamiento</option>
                        <option value="608" {{ old('regimen_fiscal') == '608' ? 'selected' : '' }}>608 - Demás ingresos</option>
                        <option value="611" {{ old('regimen_fiscal') == '611' ? 'selected' : '' }}>611 - Ingresos por Dividendos</option>
                        <option value="612" {{ old('regimen_fiscal') == '612' ? 'selected' : '' }}>612 - Personas Físicas con Actividades Empresariales</option>
                        <option value="614" {{ old('regimen_fiscal') == '614' ? 'selected' : '' }}>614 - Ingresos por intereses</option>
                        <option value="616" {{ old('regimen_fiscal') == '616' ? 'selected' : '' }}>616 - Sin obligaciones fiscales</option>
                        <option value="621" {{ old('regimen_fiscal') == '621' ? 'selected' : '' }}>621 - Incorporación Fiscal</option>
                        <option value="625" {{ old('regimen_fiscal') == '625' ? 'selected' : '' }}>625 - Régimen de las Actividades Empresariales con ingresos a través de Plataformas Tecnológicas</option>
                        <option value="626" {{ old('regimen_fiscal') == '626' ? 'selected' : '' }}>626 - Régimen Simplificado de Confianza</option>
                    </select>
                </div>

                {{-- Uso de CFDI --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                        Uso de CFDI <span class="text-red-500">*</span>
                    </label>
                    <select name="uso_cfdi"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition bg-white">
                        <option value="">Selecciona el uso</option>
                        <option value="D01" {{ old('uso_cfdi') == 'D01' ? 'selected' : '' }}>D01 - Honorarios médicos y gastos hospitalarios</option>
                        <option value="D04" {{ old('uso_cfdi') == 'D04' ? 'selected' : '' }}>D04 - Donativos</option>
                        <option value="D05" {{ old('uso_cfdi') == 'D05' ? 'selected' : '' }}>D05 - Intereses reales por créditos hipotecarios</option>
                        <option value="G01" {{ old('uso_cfdi') == 'G01' ? 'selected' : '' }}>G01 - Adquisición de mercancias</option>
                        <option value="G03" {{ old('uso_cfdi') == 'G03' ? 'selected' : '' }}>G03 - Gastos en general</option>
                        <option value="P01" {{ old('uso_cfdi') == 'P01' ? 'selected' : '' }}>P01 - Por definir</option>
                        <option value="S01" {{ old('uso_cfdi') == 'S01' ? 'selected' : '' }}>S01 - Sin efectos fiscales</option>
                    </select>
                </div>

                {{-- Código postal --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                        Código postal <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="codigo_postal" value="{{ old('codigo_postal') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                        placeholder="29000" maxlength="5">
                </div>

                {{-- Email fiscal --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                        Correo para envío de CFDI <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="fiscal_email" value="{{ old('fiscal_email') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                        placeholder="facturacion@correo.com">
                </div>

                <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-3">
                    <p class="text-xs text-yellow-700">
                        ⚠️ La emisión del CFDI es realizada por Cruz Roja Mexicana. Tus datos serán enviados al área de facturación para su procesamiento posterior al donativo.
                    </p>
                </div>

            </div>
        </div>

        @if($errors->any())
        <div class="bg-red-50 border border-red-100 rounded-xl p-3 mb-4">
            @foreach($errors->all() as $error)
                <p class="text-sm text-red-600">{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <button type="submit" id="submit-btn"
            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl py-4 text-base transition-all shadow-sm">
            Donar ahora →
        </button>

        <p class="text-center text-xs text-gray-400 mt-3 flex items-center justify-center gap-1">
            🔒 Pago seguro procesado por Stripe
        </p>

    </form>

    {{-- Footer info --}}
    <div class="mt-6 text-center space-y-1">
        <p class="text-xs text-gray-400">
            Monto máximo por donativo: $100,000 MXN · Límite fiscal: $180,000 MXN en 6 meses
        </p>
        <div class="flex items-center justify-center gap-3 text-xs text-gray-400">
            <a href="#" class="hover:text-gray-600 transition">Aviso de privacidad</a>
            <span>·</span>
            <a href="#" class="hover:text-gray-600 transition">Términos y condiciones</a>
            <span>·</span>
            <a href="https://cruzrojamexicana.org.mx" target="_blank" class="hover:text-gray-600 transition">Cruz Roja Mexicana</a>
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
            btn.classList.add('border-gray-200', 'text-gray-600');
        });

        const amounts = [100, 500, 1000, 2500, 6000, 10000];
        const index = amounts.indexOf(val);
        if (index !== -1) {
            const chips = document.querySelectorAll('.amount-chip');
            chips[index].classList.add('bg-red-600', 'text-white', 'border-red-600');
            chips[index].classList.remove('border-gray-200', 'text-gray-600');
        }
    }

    function focusCustom() {
        document.querySelectorAll('.amount-chip').forEach(btn => {
            btn.classList.remove('bg-red-600', 'text-white', 'border-red-600');
            btn.classList.add('border-gray-200', 'text-gray-600');
        });
        document.getElementById('custom-amount').classList.remove('hidden');
        document.getElementById('custom-amount').focus();
    }

    document.getElementById('custom-amount').addEventListener('input', function() {
        const val = parseFloat(this.value) || 0;
        selectedAmount = val;
        document.getElementById('amount-display').textContent = '$' + val.toLocaleString('es-MX');
        document.getElementById('amount-input').value = val;
    });

    function toggleFiscal(show) {
        const fields = document.getElementById('fiscal-fields');
        fields.classList.toggle('hidden', !show);
    }

    document.querySelectorAll('input[name="person_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const razonField = document.getElementById('razon-social-field');
            razonField.classList.toggle('hidden', this.value !== 'moral');
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
        document.getElementById('submit-btn').textContent = 'Procesando...';
        document.getElementById('submit-btn').disabled = true;
    });
</script>
@endpush