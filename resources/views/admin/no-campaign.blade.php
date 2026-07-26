@extends('layouts.public')

@section('title', 'Sin campaña activa — Admin')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
        <p class="text-4xl mb-4">📋</p>
        <h1 class="text-xl font-semibold text-gray-800 mb-2">Sin campaña activa</h1>
        <p class="text-gray-500 text-sm mb-6">
            No hay ninguna campaña activa. Crea una nueva o activa una existente.
        </p>
        <a href="{{ route('admin.campaigns.index') }}"
            class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-xl transition text-sm">
            Ir a campañas →
        </a>
    </div>
@endsection