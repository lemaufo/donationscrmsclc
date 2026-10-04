@extends('layouts.public')

@section('title', 'Próximamente — Impact Day')

@section('content')
<div class="max-w-lg mx-auto text-center">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12">
        <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-5">
            <svg class="w-8 h-8 text-[#1e3a8a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-gray-800 mb-2">¡Próximamente!</h1>
        <p class="text-gray-500 text-sm mb-4">
            La campaña de donativos aún no ha iniciado.
        </p>
        <div class="bg-[#1e3a8a] rounded-xl px-6 py-4 text-white mb-6">
            <p class="text-xs text-blue-300 uppercase tracking-widest mb-1">Inicia el</p>
            <p class="text-xl font-black">{{ $starts_at->format('d \d\e F \d\e Y') }}</p>
        </div>
        <p class="text-xs text-gray-400">
            Vuelve en esa fecha para realizar tu donativo a Cruz Roja Mexicana en Chiapas.
        </p>
        <a href="{{ route('home') }}"
            class="inline-block mt-6 bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-xl transition text-sm">
            Ir al inicio →
        </a>
    </div>
</div>
@endsection