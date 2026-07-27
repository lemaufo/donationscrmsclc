@extends('layouts.public')

@section('title', 'Usuarios — Admin')
@section('content_width', 'max-w-3xl mx-auto')

@section('header_right')
    <div class="flex items-center gap-3 text-sm">
        <span class="text-gray-600">{{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-gray-400 hover:text-gray-600 text-xs">
                Cerrar sesión
            </button>
        </form>
    </div>
@endsection

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-[#1e3a8a]">Usuarios</h1>
            <p class="text-xs text-gray-400 mt-0.5">Gestiona los accesos al panel de administración</p>
        </div>
        @if(auth()->user()->isSuperAdmin())
        <a href="{{ route('admin.users.create') }}"
            class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-xl transition flex items-center gap-1.5">
            + Nuevo usuario
        </a>
        @endif
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 rounded-xl p-3 mb-4 text-sm text-green-700">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left text-xs text-gray-400 uppercase tracking-wide px-5 py-3">Nombre</th>
                    <th class="text-left text-xs text-gray-400 uppercase tracking-wide px-5 py-3">Email</th>
                    <th class="text-left text-xs text-gray-400 uppercase tracking-wide px-5 py-3">Rol</th>
                    @if(auth()->user()->isSuperAdmin())
                    <th class="px-5 py-3"></th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($users as $user)
                <tr>
                    <td class="px-5 py-3 text-sm font-medium text-gray-800">{{ $user->name }}</td>
                    <td class="px-5 py-3 text-sm text-gray-500">{{ $user->email }}</td>
                    <td class="px-5 py-3">
                        <span class="text-xs px-2 py-1 rounded-full font-medium
                            {{ $user->role === 'superadmin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ $user->role === 'superadmin' ? 'Superadmin' : 'Admin Cruz Roja' }}
                        </span>
                    </td>
                    @if(auth()->user()->isSuperAdmin())
                    <td class="px-5 py-3 text-right">
                        @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                            onsubmit="return confirm('¿Eliminar este usuario?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:text-red-700">
                                Eliminar
                            </button>
                        </form>
                        @endif
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.index') }}" class="text-xs text-gray-400 hover:text-gray-600">
            ← Volver al dashboard
        </a>
    </div>

@endsection