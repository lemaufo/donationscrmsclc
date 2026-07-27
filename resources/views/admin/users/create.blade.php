@extends('layouts.public')

@section('title', 'Nuevo usuario — Admin')
@section('content_width', 'max-w-lg mx-auto')

@section('header_right')
    <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-gray-600 text-xs">
        ← Volver a usuarios
    </a>
@endsection

@section('content')

    <div class="mb-6">
        <h1 class="text-xl font-bold text-[#1e3a8a]">Nuevo usuario</h1>
        <p class="text-xs text-gray-400 mt-0.5">Crea acceso al panel de administración</p>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-100 rounded-xl p-4 mb-4">
        @foreach($errors->all() as $error)
            <p class="text-sm text-red-600">{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Nombre completo <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                    placeholder="Nombre completo">
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Correo electrónico <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                    placeholder="correo@ejemplo.com">
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Contraseña <span class="text-red-500">*</span>
                </label>
                <input type="password" name="password" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                    placeholder="Mínimo 8 caracteres">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                    Rol <span class="text-red-500">*</span>
                </label>
                <select name="role"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition bg-white">
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin Cruz Roja</option>
                    <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                </select>
            </div>

        </div>

        <button type="submit"
            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl py-4 text-base transition-all shadow-sm">
            Crear usuario →
        </button>

    </form>

@endsection