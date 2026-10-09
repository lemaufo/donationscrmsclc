@extends('layouts.public')

@section('title', 'Acceso denegado — Impact Days')

@section('content')
<div class="max-w-lg mx-auto text-center">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12">
        <p class="text-7xl font-black text-gray-100 mb-4">403</p>
        <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center mx-auto mb-5 -mt-8">
            <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-gray-800 mb-2">Acceso denegado</h1>
        <p class="text-gray-500 text-sm mb-6">No tienes permiso para acceder a esta sección.</p>
        <a href="{{ route('home') }}"
            class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-xl transition text-sm">
            Ir al inicio →
        </a>
    </div>
</div>
@endsection