@extends('layouts.public')

@section('title', 'Términos y Condiciones — Cruz Roja Mexicana')
@section('content_width', 'max-w-4xl mx-auto')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-4">

    {{-- Header --}}
    <div class="bg-[#1e3a8a] px-8 py-8">
        <p class="text-xs text-blue-300 uppercase tracking-widest mb-2">Documento legal</p>
        <h1 class="text-3xl font-black text-white mb-1">Términos y Condiciones de Uso</h1>
        <p class="text-blue-200 text-sm">Cruz Roja Mexicana, I.A.P. · Delegación San Cristóbal de Las Casas</p>
        <p class="text-blue-300 text-xs mt-1">Vigentes a partir de agosto de 2026</p>
    </div>

    <div class="p-8">

        <p class="text-sm text-gray-600 leading-relaxed mb-8">
            El presente documento regula el acceso y uso de la plataforma de donativos
            <strong class="text-gray-800">donacionescruzrojasancristobal.org</strong> (la "Plataforma"), operada por
            <strong class="text-gray-800">Cruz Roja Mexicana, I.A.P., Delegación San Cristóbal de Las Casas</strong>,
            utilizada para la iniciativa "Día de Impacto" en colaboración con Novo Nordisk,
            que tendrá verificativo en agosto de 2026. Al acceder o utilizar la Plataforma,
            el usuario acepta los presentes Términos y Condiciones.
        </p>

        @foreach([
            [
                'num' => '1',
                'title' => 'Uso permitido',
                'content' => 'El usuario se obliga a utilizar la Plataforma de forma lícita, exclusivamente para realizar donativos y consultar información relacionada con ellos, absteniéndose de realizar actos que vulneren la seguridad, disponibilidad o integridad de la Plataforma o de terceros.',
                'extra' => null,
            ],
            [
                'num' => '2',
                'title' => 'Propiedad intelectual',
                'content' => 'El contenido de la Plataforma (marcas, logotipos, nombres comerciales, textos, imágenes, gráficos, software y bases de datos) pertenece a Cruz Roja Mexicana, I.A.P. o a sus respectivos titulares y está protegido por la legislación aplicable. Su uso no implica transmisión o licencia alguna, salvo autorización expresa y por escrito.',
                'extra' => null,
            ],
            [
                'num' => '5',
                'title' => 'Disponibilidad de la Plataforma',
                'content' => 'No se garantiza la disponibilidad, continuidad o ausencia de errores de la Plataforma. Cruz Roja Mexicana, I.A.P. no será responsable por daños derivados de fallas técnicas, interrupciones o inexactitudes, en la medida permitida por la ley.',
                'extra' => null,
            ],
            [
                'num' => '8',
                'title' => 'Modificaciones',
                'content' => 'Cruz Roja Mexicana, I.A.P. podrá modificar estos Términos en cualquier momento. Las modificaciones surtirán efectos a partir de su publicación en la Plataforma.',
                'extra' => null,
            ],
            [
                'num' => '9',
                'title' => 'Legislación y jurisdicción',
                'content' => 'Estos Términos se interpretarán conforme a las leyes mexicanas. Para la resolución de controversias, las partes se someten a los tribunales competentes de la Ciudad de México.',
                'extra' => null,
            ],
        ] as $section)
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-red-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">{{ $section['num'] }}</span>
                </div>
                <h2 class="text-base font-bold text-[#1e3a8a]">{{ $section['title'] }}</h2>
            </div>
            <p class="pl-11 text-sm text-gray-600 leading-relaxed">{{ $section['content'] }}</p>
        </div>
        @endforeach

        {{-- Sección 3 - Donativos --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-red-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">3</span>
                </div>
                <h2 class="text-base font-bold text-[#1e3a8a]">Donativos</h2>
            </div>
            <div class="pl-11 space-y-3 text-sm text-gray-600">
                <p>Los donativos realizados a través de la Plataforma son <strong class="text-gray-800">voluntarios</strong>. El pago se procesa mediante <strong class="text-gray-800">Stripe</strong> como pasarela de pago; Cruz Roja Mexicana, Delegación San Cristóbal, no almacena los datos completos de la tarjeta del donante.</p>
                <p>La emisión del CFDI, en caso de solicitarse, se realiza con base en los datos fiscales proporcionados por el donante al momento del donativo.</p>
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                    <p class="text-xs text-gray-500">Los límites aplicables conforme a la normativa de Prevención de Lavado de Dinero (PLD) son: <strong class="text-gray-700">$100,000 MXN por transacción</strong> y <strong class="text-gray-700">$180,000 MXN acumulados en 6 meses por RFC</strong>.</p>
                </div>
            </div>
        </div>

        {{-- Sección 4 - Contenido de terceros --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-red-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">4</span>
                </div>
                <h2 class="text-base font-bold text-[#1e3a8a]">Contenido de terceros y procesamiento de pagos</h2>
            </div>
            <div class="pl-11 space-y-3 text-sm text-gray-600">
                <p>La Plataforma puede contener enlaces a sitios de terceros, incluyendo el sitio institucional de Cruz Roja Mexicana o de Novo Nordisk. Cruz Roja Mexicana, I.A.P. no controla ni asume responsabilidad por su contenido, políticas o prácticas.</p>
                <div class="bg-amber-50 border border-amber-100 rounded-xl p-4">
                    <p class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>El donativo se procesa bajo los términos y condiciones de Stripe. El rechazo de pagos puede ocurrir cuando la entidad financiera o la pasarela declina una transacción; la resolución se gestionará conforme a los términos de Stripe. La plataforma no asume responsabilidad por declinaciones bancarias derivadas de fondos insuficientes, errores en los datos ingresados, bloqueos de seguridad o fallas técnicas del banco emisor.</span>
                    </p>
                </div>
            </div>
        </div>

        {{-- Sección 6 - Protección de datos --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-red-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">6</span>
                </div>
                <h2 class="text-base font-bold text-[#1e3a8a]">Protección de datos personales</h2>
            </div>
            <div class="pl-11 space-y-3 text-sm text-gray-600">
                <p>El tratamiento de datos personales se rige por el <a href="{{ route('legal.privacy') }}" class="text-red-600 hover:underline font-medium">Aviso de Privacidad</a> publicado en esta misma Plataforma.</p>
                <div class="bg-gray-50 rounded-xl p-5 border border-gray-200">
                    <p class="font-bold text-gray-800 mb-1">C.P. Antonio Ángel de la Cruz Jiménez</p>
                    <p class="text-xs text-gray-500 mb-2">Responsable de Atención de Datos Personales</p>
                    <p class="text-xs text-gray-600 flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:crmsancristobal@gmail.com" class="text-red-600 hover:underline">crmsancristobal@gmail.com</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Sección 7 - Contacto --}}
        <div>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-red-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">7</span>
                </div>
                <h2 class="text-base font-bold text-[#1e3a8a]">Notificaciones y contacto</h2>
            </div>
            <p class="pl-11 text-sm text-gray-600">Para cualquier comunicación relacionada con estos Términos (incluidas notificaciones legales), utilice el correo <a href="mailto:crmsancristobal@gmail.com" class="text-red-600 hover:underline font-medium">crmsancristobal@gmail.com</a>, dirigido a Cruz Roja Mexicana, Delegación San Cristóbal.</p>
        </div>

    </div>
</div>

<div class="text-center">
    <a href="{{ route('home') }}" class="text-xs text-gray-400 hover:text-red-600 transition">← Volver al inicio</a>
</div>

@endsection