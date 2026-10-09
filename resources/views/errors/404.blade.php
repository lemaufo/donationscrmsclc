@extends('layouts.public')

@section('title', 'Página no encontrada — Impact Days')

@section('content')
<div class="max-w-lg mx-auto text-center">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12">
        <p class="text-7xl font-black text-gray-100 mb-4">404</p>
        <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center mx-auto mb-5 -mt-8">
            <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-gray-800 mb-2">Página no encontrada</h1>
        <p class="text-gray-500 text-sm mb-6">El link que buscas no existe o fue movido.</p>
        <a href="{{ route('home') }}"
            class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-xl transition text-sm">
            Ir al inicio →
        </a>
    </div>
</div>
@endsection