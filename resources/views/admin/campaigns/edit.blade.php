@extends('layouts.public')

@section('title', 'Editar campaña — Admin')
@section('content_width', 'max-w-2xl mx-auto')

@section('header_right')
    <a href="{{ route('admin.campaigns.index') }}" class="text-gray-400 hover:text-gray-600 transition text-xs">
        ← Volver a campañas
    </a>
@endsection

@section('content')

    <div class="mb-6">
        <h1 class="text-xl font-bold text-[#1e3a8a]">Editar campaña</h1>
        <p class="text-xs text-gray-400 mt-0.5">{{ $campaign->name }}</p>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 rounded-xl p-3 mb-4 text-sm text-green-700">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-50 border border-red-100 rounded-xl p-4 mb-4">
        @foreach($errors->all() as $error)
            <p class="text-sm text-red-600">{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <form action="{{ route('admin.campaigns.update', $campaign) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-4">Información general</p>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Nombre de la campaña <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $campaign->name) }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition">
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
                    <input type="number" name="goal_amount" value="{{ old('goal_amount', $campaign->goal_amount) }}"
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
                    placeholder="Bienvenido a Impact Day 2026...">{{ old('welcome_message', $campaign->welcome_message) }}</textarea>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-4">Identidad visual</p>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Color principal
                </label>
                <div class="flex items-center gap-3">
                    <input type="color" name="theme_color" value="{{ old('theme_color', $campaign->theme_color ?? '#dc2626') }}"
                        class="w-12 h-12 rounded-xl border border-gray-200 cursor-pointer p-1">
                    <span class="text-xs text-gray-400">Color de botones y elementos destacados</span>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Logo principal (Cruz Roja / organizador)
                </label>
                @if($campaign->logo_url)
                    <div class="mb-2 flex items-center gap-3">
                        <img src="{{ Storage::url($campaign->logo_url) }}" alt="Logo actual" class="h-10 object-contain">
                        <span class="text-xs text-gray-400">Logo actual</span>
                    </div>
                @endif
                <input type="file" name="logo" accept="image/*"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition text-sm">
                <p class="text-xs text-gray-400 mt-1">Deja vacío para mantener el logo actual</p>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Logo del patrocinador (Novo Nordisk)
                </label>
                @if($campaign->banner_url)
                    <div class="mb-2 flex items-center gap-3">
                        <img src="{{ Storage::url($campaign->banner_url) }}" alt="Logo patrocinador actual" class="h-10 object-contain">
                        <span class="text-xs text-gray-400">Logo actual</span>
                    </div>
                @endif
                <input type="file" name="banner" accept="image/*"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition text-sm">
                <p class="text-xs text-gray-400 mt-1">Deja vacío para mantener el logo actual</p>
            </div>
        </div>

        {{-- Link de invitación --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
            <p class="text-xs text-gray-400 uppercase tracking-wide mb-3">Link de invitación para colaboradores</p>
            <div class="bg-gray-50 rounded-xl px-3 py-2.5 flex items-center gap-2 border border-gray-200">
                <code class="text-xs text-gray-600 flex-1 truncate">
                    {{ url('/unirse/' . $campaign->registration_token) }}
                </code>
                <button type="button"
                    onclick="navigator.clipboard.writeText('{{ url('/unirse/' . $campaign->registration_token) }}').then(() => alert('¡Copiado!'))"
                    class="text-xs text-red-600 hover:text-red-700 font-medium flex-shrink-0">
                    Copiar
                </button>
            </div>
        </div>

        <button type="submit"
            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl py-4 text-base transition-all shadow-sm">
            Guardar cambios →
        </button>

    </form>

@endsection