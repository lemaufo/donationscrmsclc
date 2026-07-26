@extends('layouts.public')

@section('title', 'Campaña no disponible')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
        <p class="text-5xl mb-4">🔒</p>
        <h1 class="text-xl font-semibold text-gray-800 mb-2">Campaña no disponible</h1>
        <p class="text-gray-500 text-sm mb-2">
            @if($campaign->starts_at && now()->lt($campaign->starts_at))
                Esta campaña aún no ha iniciado. Regresa el {{ $campaign->starts_at->format('d/m/Y') }}.
            @elseif($campaign->ends_at && now()->gt($campaign->ends_at))
                Esta campaña finalizó el {{ $campaign->ends_at->format('d/m/Y') }}.
            @else
                Esta campaña no está activa en este momento.
            @endif
        </p>
        <a href="{{ route('home') }}"
            class="inline-block mt-4 bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-xl transition text-sm">
            Ir al inicio →
        </a>
    </div>
@endsection