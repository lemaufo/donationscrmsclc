@extends('layouts.public')

@section('title', 'Error del servidor — Impact Days')

@section('content')
<div class="max-w-lg mx-auto text-center">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12">
        <p class="text-7xl font-black text-gray-100 mb-4">500</p>
        <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center mx-auto mb-5 -mt-8">
            <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-gray-800 mb-2">Error del servidor</h1>
        <p class="text-gray-500 text-sm mb-6">Algo salió mal. Por favor intenta de nuevo en unos momentos.</p>
        <div class="flex items-center justify-center gap-3">
            <a href="{{ route('home') }}"
                class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-xl transition text-sm">
                Ir al inicio →
            </a>
            <a href="https://wa.me/5219618920410?text=Hola,%20tuve%20un%20error%20en%20la%20plataforma%20Impact%20Days."
                target="_blank"
                class="inline-block border border-green-200 text-green-600 hover:bg-green-50 font-medium px-6 py-3 rounded-xl transition text-sm">
                Reportar error
            </a>
        </div>
    </div>
</div>
@endsection