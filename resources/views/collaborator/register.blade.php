@extends('layouts.public')

@section('title', 'Registro de colaborador — Impact Days · Cruz Roja Mexicana')

@section('content')

    {{-- Header de campaña --}}
    <div class="text-center mb-6">
        @if($campaign->welcome_message)
            <p class="text-xs text-gray-400 italic mb-3">"{{ $campaign->welcome_message }}"</p>
        @endif
        <h1 class="text-2xl font-bold text-[#1e3a8a]">Únete a Impact Days</h1>
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

            {{-- Área --}}
            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">
                    Área <span class="text-red-500">*</span>
                </label>
                <select name="department" required id="area-select"
                    onchange="toggleOtro(this.value)"
                    class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition bg-white @error('department') border-red-400 @enderror">
                    <option value="">Selecciona tu área</option>
                    <option value="Cardiometabolic marketing" {{ old('department') == 'Cardiometabolic marketing' ? 'selected' : '' }}>Cardiometabolic marketing</option>
                    <option value="MR-PV" {{ old('department') == 'MR-PV' ? 'selected' : '' }}>MR-PV</option>
                    <option value="Cardiometabolic sales" {{ old('department') == 'Cardiometabolic sales' ? 'selected' : '' }}>Cardiometabolic sales</option>
                    <option value="Rare Disease" {{ old('department') == 'Rare Disease' ? 'selected' : '' }}>Rare Disease</option>
                    <option value="CAS-E" {{ old('department') == 'CAS-E' ? 'selected' : '' }}>CAS-E</option>
                    <option value="MACO" {{ old('department') == 'MACO' ? 'selected' : '' }}>MACO</option>
                    <option value="F&O" {{ old('department') == 'F&O' ? 'selected' : '' }}>F&O</option>
                    <option value="Commercial Excellence and Business Transformation" {{ old('department') == 'Commercial Excellence and Business Transformation' ? 'selected' : '' }}>Commercial Excellence and Business Transformation</option>
                    <option value="P&O" {{ old('department') == 'P&O' ? 'selected' : '' }}>P&O</option>
                    <option value="LEC-Q" {{ old('department') == 'LEC-Q' ? 'selected' : '' }}>LEC-Q</option>
                    <option value="IT Operations" {{ old('department') == 'IT Operations' ? 'selected' : '' }}>IT Operations</option>
                    <option value="Clinical" {{ old('department') == 'Clinical' ? 'selected' : '' }}>Clinical</option>
                    <option value="Operations" {{ old('department') == 'Operations' ? 'selected' : '' }}>Operations</option>
                    <option value="Facilities" {{ old('department') == 'Facilities' ? 'selected' : '' }}>Facilities</option>
                    <option value="Otro" {{ old('department') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('department')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Otro área --}}
            <div id="otro-area" class="{{ old('department') == 'Otro' ? '' : 'hidden' }} mb-4">
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">
                    Especifica tu área <span class="text-red-500">*</span>
                </label>
                <input type="text" name="department_otro" value="{{ old('department_otro') }}"
                    class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                    placeholder="Escribe tu área">
            </div>

            <script>
            function toggleOtro(value) {
                const otroDiv = document.getElementById('otro-area');
                otroDiv.classList.toggle('hidden', value !== 'Otro');
            }
            </script>

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