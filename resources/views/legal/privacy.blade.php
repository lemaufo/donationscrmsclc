@extends('layouts.public')

@section('title', 'Aviso de Privacidad — Cruz Roja Mexicana')
@section('content_width', 'max-w-4xl mx-auto')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-4">

    {{-- Header --}}
    <div class="bg-[#1e3a8a] px-8 py-8">
        <p class="text-xs text-blue-300 uppercase tracking-widest mb-2">Documento legal</p>
        <h1 class="text-3xl font-black text-white mb-1">Aviso de Privacidad</h1>
        <p class="text-blue-200 text-sm">Cruz Roja Mexicana, I.A.P. · Delegación San Cristóbal de Las Casas</p>
        <p class="text-blue-300 text-xs mt-1">Última actualización: agosto de 2026</p>
    </div>

    <div class="p-8">

        <p class="text-sm text-gray-600 leading-relaxed mb-8">
            <strong class="text-gray-800">Cruz Roja Mexicana, I.A.P., Delegación San Cristóbal de Las Casas</strong>,
            con domicilio en Prolongación Ignacio Allende No. 57, Colonia Altejar, San Cristóbal de Las Casas, Chiapas, C.P. 29278,
            en cumplimiento de la <strong class="text-gray-800">Ley Federal de Protección de Datos Personales en Posesión de los Particulares (LFPDPPP)</strong>
            y su Reglamento, es responsable del uso y protección de los datos personales que se recaban a través de la plataforma de
            donativos <strong class="text-gray-800">donacionescruzrojasancristobal.org</strong> (la "Plataforma"), utilizada para la
            iniciativa "Día de Impacto" en colaboración con Novo Nordisk y, en general, para la recepción de donativos a favor de
            Cruz Roja Mexicana, Delegación San Cristóbal; que tendrá verificativo en agosto de 2026.
        </p>

        {{-- Sección 1 --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-red-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">1</span>
                </div>
                <h2 class="text-base font-bold text-[#1e3a8a]">Finalidades del tratamiento</h2>
            </div>
            <ul class="space-y-2 pl-11">
                @foreach([
                    'Procesar, confirmar y dar seguimiento a los donativos realizados a través de la Plataforma.',
                    'Emitir el Comprobante Fiscal Digital por Internet (CFDI) correspondiente, cuando el donante así lo solicite.',
                    'Contactar al donante para confirmaciones, agradecimientos o aclaraciones relacionadas con su donativo.',
                    'Generar estadísticas y reportes internos sobre los donativos recibidos.',
                    'Dar cumplimiento a obligaciones normativas y regulatorias aplicables, incluyendo las de carácter fiscal y de protección de datos personales.',
                ] as $item)
                <li class="flex items-start gap-2 text-sm text-gray-600">
                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mt-2 flex-shrink-0"></span>
                    {{ $item }}
                </li>
                @endforeach
            </ul>
        </div>

        {{-- Sección 2 --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-red-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">2</span>
                </div>
                <h2 class="text-base font-bold text-[#1e3a8a]">Datos personales recabados</h2>
            </div>
            <div class="pl-11 space-y-3 text-sm text-gray-600">
                <p>Para realizar un donativo a través de la Plataforma se recaban únicamente los siguientes datos: <strong class="text-gray-800">nombre completo</strong> y <strong class="text-gray-800">correo electrónico</strong> de contacto del donante.</p>
                <p>Si el donante activa la opción de solicitar comprobante fiscal (CFDI), adicionalmente se recaban: <strong class="text-gray-800">tipo de persona (física o moral), RFC, régimen fiscal, uso del CFDI, código postal fiscal y el correo electrónico al que se enviará la factura/CFDI</strong>.</p>
                <p>La Plataforma <strong class="text-gray-800">no solicita ni recaba</strong> número telefónico ni domicilio particular.</p>
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                    <p class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Los datos de la tarjeta o medio de pago son capturados y procesados directamente por <strong class="text-gray-800">Stripe</strong>. Cruz Roja Mexicana, Delegación San Cristóbal, <strong class="text-gray-800">no almacena ni tiene acceso</strong> a los datos completos de la tarjeta del donante.
                    </p>
                </div>
            </div>
        </div>

        {{-- Sección 3 --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-red-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">3</span>
                </div>
                <h2 class="text-base font-bold text-[#1e3a8a]">Transferencias de datos</h2>
            </div>
            <div class="pl-11 space-y-3 text-sm text-gray-600">
                <p>Los datos personales recabados se procesan únicamente entre Cruz Roja Mexicana, Delegación San Cristóbal, y el procesador de pagos <strong class="text-gray-800">Stripe</strong>, para efectos de procesar el donativo y, en su caso, emitir el CFDI correspondiente. No se realizan otras transferencias de datos personales a terceros.</p>
                <p>En caso de que Novo Nordisk, en su calidad de aliado de la iniciativa "Día de Impacto", solicite conocer los montos totales recaudados, dicha información se evaluará y compartirá, en su caso, de forma <strong class="text-gray-800">agregada y sin datos personales identificables</strong> de los donantes.</p>
            </div>
        </div>

        {{-- Sección 4 --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-red-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">4</span>
                </div>
                <h2 class="text-base font-bold text-[#1e3a8a]">Derechos ARCO y medios para ejercerlos</h2>
            </div>
            <div class="pl-11 space-y-3 text-sm text-gray-600">
                <p>Usted puede ejercer sus derechos de <strong class="text-gray-800">Acceso, Rectificación, Cancelación y Oposición (ARCO)</strong>, limitar el uso o divulgación de sus datos o revocar su consentimiento, enviando su solicitud al Responsable de Atención de Datos Personales:</p>
                <div class="bg-gray-50 rounded-xl p-5 border border-gray-200">
                    <p class="font-bold text-gray-800 mb-1">C.P. Antonio Ángel de la Cruz Jiménez</p>
                    <p class="text-xs text-gray-500 mb-3">Contador — Cruz Roja Mexicana, Delegación San Cristóbal de Las Casas</p>
                    <div class="space-y-1.5 text-xs text-gray-600">
                        <p class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:crmsancristobal@gmail.com" class="text-red-600 hover:underline">crmsancristobal@gmail.com</a>
                        </p>
                        <p class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            Teléfono: 967 678 65 65
                        </p>
                        <p class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/>
                            </svg>
                            WhatsApp: 961 892 04 10
                        </p>
                    </div>
                </div>
                <p>La solicitud deberá contener el nombre del titular, medios de contacto, documentación que acredite identidad o representación, y descripción clara de los datos respecto de los que se busca ejercer el derecho. Se dará respuesta en los plazos previstos por la LFPDPPP.</p>
            </div>
        </div>

        {{-- Sección 5 --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-red-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">5</span>
                </div>
                <h2 class="text-base font-bold text-[#1e3a8a]">Uso de cookies y tecnologías similares</h2>
            </div>
            <p class="pl-11 text-sm text-gray-600">En esta primera fase, la Plataforma <strong class="text-gray-800">no utiliza cookies</strong> ni tecnologías de rastreo similares. En caso de que en el futuro se incorporen, el presente Aviso será actualizado para informarlo oportunamente.</p>
        </div>

        {{-- Sección 6 --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-red-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">6</span>
                </div>
                <h2 class="text-base font-bold text-[#1e3a8a]">Medidas de seguridad</h2>
            </div>
            <p class="pl-11 text-sm text-gray-600">Se adoptan medidas administrativas, técnicas y físicas para proteger los datos personales contra daño, pérdida, alteración, destrucción o uso, acceso o tratamiento no autorizados.</p>
        </div>

        {{-- Sección 7 --}}
        <div>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-red-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">7</span>
                </div>
                <h2 class="text-base font-bold text-[#1e3a8a]">Cambios al Aviso</h2>
            </div>
            <p class="pl-11 text-sm text-gray-600">Cualquier modificación al presente Aviso se publicará en <strong class="text-gray-800">donacionescruzrojasancristobal.org</strong>.</p>
        </div>

    </div>
</div>

<div class="text-center">
    <a href="{{ route('home') }}" class="text-xs text-gray-400 hover:text-red-600 transition">← Volver al inicio</a>
</div>

@endsection