@extends('layouts.public')

@section('title', 'Nueva campaña — Admin')
@section('content_width', 'max-w-2xl mx-auto')

@section('header_right')
    <a href="{{ route('admin.campaigns.index') }}" class="text-gray-400 hover:text-gray-600 transition text-xs">
        ← Volver a campañas
    </a>
@endsection

@section('content')

    <div class="mb-6">
        <h1 class="text-xl font-bold text-[#1e3a8a]">Nueva campaña</h1>
        <p class="text-xs text-gray-400 mt-0.5">Configura los datos de la nueva campaña de recaudación</p>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-100 rounded-xl p-4 mb-4">
        @foreach($errors->all() as $error)
            <p class="text-sm text-red-600">{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <form action="{{ route('admin.campaigns.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-4">Información general</p>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Nombre de la campaña <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                    placeholder="Ej. Impact Day 2026">
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Slug (URL) <span class="text-red-500">*</span>
                </label>
                <input type="text" name="slug" value="{{ old('slug') }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition font-mono"
                    placeholder="impact-day-2026">
                <p class="text-xs text-gray-400 mt-1">Solo letras minúsculas, números y guiones</p>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                        Inicio de campaña <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="starts_at" value="{{ old('starts_at', isset($campaign) ? $campaign->starts_at?->format('Y-m-d') : '') }}" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                        Fin de campaña <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="ends_at" value="{{ old('ends_at', isset($campaign) ? $campaign->ends_at?->format('Y-m-d') : '') }}" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                        Meta global (MXN)
                    </label>
                    <input type="number" name="goal_amount" value="{{ old('goal_amount') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                        placeholder="500000">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Mensaje de bienvenida
                </label>
                <textarea name="welcome_message" rows="2"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition resize-none"
                    placeholder="Bienvenido a Impact Day 2026...">{{ old('welcome_message') }}</textarea>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-4">Identidad visual</p>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Color principal
                </label>
                <div class="flex items-center gap-3">
                    <input type="color" name="theme_color" value="{{ old('theme_color', '#dc2626') }}"
                        class="w-12 h-12 rounded-xl border border-gray-200 cursor-pointer p-1">
                    <span class="text-xs text-gray-400">Color de botones y elementos destacados</span>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Logo principal
                </label>
                <input type="file" name="logo" accept="image/*"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition text-sm">
                <p class="text-xs text-gray-400 mt-1">PNG o SVG recomendado, fondo transparente</p>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Logo del patrocinador
                </label>
                <input type="file" name="banner" accept="image/*"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition text-sm">
                <p class="text-xs text-gray-400 mt-1">PNG o SVG recomendado, fondo transparente</p>
            </div>
        </div>

        <button type="submit"
            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl py-4 text-base transition-all shadow-sm">
            Crear campaña →
        </button>

    </form>

@endsection