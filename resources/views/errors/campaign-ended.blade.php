@extends('layouts.public')

@section('title', 'Campaña finalizada — Impact Day')

@section('content')
<div class="max-w-lg mx-auto text-center">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12">
        <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center mx-auto mb-5">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-gray-800 mb-2">Campaña finalizada</h1>
        <p class="text-gray-500 text-sm mb-4">
            La campaña Impact Day 2026 concluyó el
            <strong class="text-gray-700">{{ $ends_at->format('d \d\e F \d\e Y') }}</strong>.
        </p>
        <p class="text-gray-400 text-sm mb-6">
            Gracias a todos los donantes y colaboradores que participaron. Su apoyo hace la diferencia en las comunidades de Chiapas.
        </p>
        <div class="flex items-center justify-center gap-2 text-xs text-gray-400">
            <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            Cruz Roja Mexicana · Delegación San Cristóbal de Las Casas
        </div>
        <a href="{{ route('home') }}"
            class="inline-block mt-6 bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-xl transition text-sm">
            Ir al inicio →
        </a>
    </div>
</div>
@endsection