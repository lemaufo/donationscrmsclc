@extends('layouts.public')

@section('title', 'Registro de colaborador — Impact Days · Cruz Roja Mexicana')

@section('content')

    {{-- Header de campaña --}}
    <div class="text-center mb-6">
        @if($campaign->welcome_message)
            <p class="text-xs text-gray-400 italic mb-3">"{{ $campaign->welcome_message }}"</p>
        @endif
        <h1 class="text-2xl font-bold text-[#1e3a8a]">Únete a Impact Day</h1>
        <p class="text-gray-500 text-sm mt-1">Obtén tu link personal de donaciones en segundos</p>
    </div>

    {{-- Errores --}}
    @if($errors->any())
    <div class="bg-red-50 border border-red-100 rounded-xl p-4 mb-4">
        @foreach($errors->all() as $error)
            <p class="text-sm text-red-600">{{ $error }}</p>
        @endforeach
    </div>
    @endif

    {{-- Formulario --}}
    <form action="{{ route('collaborator.register.store', $campaign->registration_token) }}" method="POST">
        @csrf

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Nombre completo <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition @error('name') border-red-400 @enderror"
                    placeholder="Tu nombre">
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">
                    Correo electrónico <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition @error('email') border-red-400 @enderror"
                    placeholder="tu.nombre@novonordisk.com">
                <p class="text-xs text-gray-400 mt-1">Solo se aceptan correos @novonordisk.com</p>
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">
                    Región <span class="text-red-500">*</span>
                </label>
                <select name="region" required
                    class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition bg-white @error('region') border-red-400 @enderror">
                    <option value="">Selecciona tu región</option>
                    <option value="Norte" {{ old('region') == 'Norte' ? 'selected' : '' }}>Norte</option>
                    <option value="Centro" {{ old('region') == 'Centro' ? 'selected' : '' }}>Centro</option>
                    <option value="Sur" {{ old('region') == 'Sur' ? 'selected' : '' }}>Sur</option>
                </select>
                @error('region')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Número de empleado
                    <span class="text-gray-400 normal-case font-normal">(opcional)</span>
                </label>
                <input type="text" name="employee_id" value="{{ old('employee_id') }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                    placeholder="EMP-00000">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Departamento
                    <span class="text-gray-400 normal-case font-normal">(opcional)</span>
                </label>
                <input type="text" name="department" value="{{ old('department') }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                    placeholder="Ej. Ventas, Marketing, TI">
            </div>

        </div>

        <button type="submit"
            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl py-4 text-base transition-all shadow-sm">
            Registrarme y obtener mi link →
        </button>

        <p class="text-center text-xs text-gray-400 mt-3">
            En segundos tendrás tu link único para recibir donativos de tus contactos
        </p>

    </form>

@endsection