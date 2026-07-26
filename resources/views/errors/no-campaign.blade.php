@extends('layouts.public')

@section('title', 'Próximamente — Impact Day')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
        <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h1 class="text-xl font-semibold text-gray-800 mb-2">No hay campaña activa</h1>
        <p class="text-gray-500 text-sm mb-6">
            En este momento no hay ninguna campaña de donativo activa. Vuelve pronto.
        </p>
        <a href="{{ route('home') }}"
            class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-xl transition text-sm">
            Ir al inicio →
        </a>
    </div>
@endsection