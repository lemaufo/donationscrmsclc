<footer class="border-t border-gray-100 bg-white mt-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Fila principal --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">

            {{-- Cruz Roja info --}}
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Cruz Roja Mexicana</p>
                <p class="text-xs text-gray-400 leading-relaxed">
                    Delegación San Cristóbal de Las Casas<br>
                    Prolongación Ignacio Allende No. 57<br>
                    Col. Altejar, C.P. 29278<br>
                    San Cristóbal de Las Casas, Chiapas
                </p>
            </div>

            {{-- Contacto --}}
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Contacto</p>
                <div class="space-y-1.5 text-xs text-gray-400">
                    <p class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        967 678 65 65
                    </p>
                    <p class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/>
                        </svg>
                        WhatsApp: 961 892 04 10
                    </p>
                    <p class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        crmsancristobal@gmail.com
                    </p>
                </div>
            </div>

            {{-- Links --}}
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Legal</p>
                <div class="space-y-2 text-xs">
                    <p><a href="{{ route('legal.privacy') }}" class="text-gray-400 hover:text-red-600 transition">Aviso de Privacidad</a></p>
                    <p><a href="{{ route('legal.terms') }}" class="text-gray-400 hover:text-red-600 transition">Términos y Condiciones</a></p>
                    <p><a href="https://cruzrojamexicana.org.mx" target="_blank" class="text-gray-400 hover:text-red-600 transition">Cruz Roja Mexicana Nacional</a></p>
                </div>
            </div>

        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-100 pt-4 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-2 text-xs text-gray-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Pagos seguros procesados por Stripe · SSL 256-bit · PCI DSS
            </div>
            <div class="flex items-center gap-2 text-xs text-gray-400">
                <span>© {{ date('Y') }} Cruz Roja Mexicana · Desarrollado por</span>
                <a href="https://teknologix.mx" target="_blank">
                    <img src="{{ asset('images/teknologix.png') }}" alt="Teknologix" class="h-3 object-contain hover:opacity-70 transition">
                </a>
            </div>
        </div>

    </div>
</footer>