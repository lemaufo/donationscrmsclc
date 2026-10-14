@extends('layouts.public')

@section('title', 'Colaboradores — Admin')
@section('content_width', 'max-w-6xl mx-auto')

@section('header_right')
    <div class="flex items-center gap-3 text-sm">
        <span class="text-gray-600 font-medium">{{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-xs text-gray-400 hover:text-gray-600 transition">
                Cerrar sesión
            </button>
        </form>
    </div>
@endsection

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-[#1e3a8a]">Colaboradores</h1>
            <p class="text-xs text-gray-400 mt-0.5">{{ $collaborators->total() }} registrados en {{ $campaign->name }}</p>
        </div>
        <a href="{{ route('admin.collaborators.export') }}"
            class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-xl transition flex items-center gap-1.5 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Exportar CSV
        </a>
    </div>

    <form method="GET" action="{{ route('admin.collaborators.index') }}" class="mb-4">
        <div class="flex gap-2">
            <input type="text" name="search" value="{{ $search }}"
                class="flex-1 border-2 border-gray-100 rounded-xl px-4 py-2.5 text-gray-700 focus:outline-none focus:border-red-400 transition text-sm"
                placeholder="Buscar por nombre, correo o ref. code...">
            <button type="submit"
                class="bg-[#1e3a8a] hover:bg-blue-900 text-white px-4 py-2.5 rounded-xl text-sm transition">
                Buscar
            </button>
            @if($search)
            <a href="{{ route('admin.collaborators.index') }}"
                class="border border-gray-200 text-gray-500 hover:border-red-300 hover:text-red-600 px-4 py-2.5 rounded-xl text-sm transition">
                Limpiar
            </a>
            @endif
        </div>
    </form>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left text-xs text-gray-400 uppercase tracking-wide px-4 py-3">Nombre</th>
                    <th class="text-left text-xs text-gray-400 uppercase tracking-wide px-4 py-3">Usuario</th>
                    <th class="text-left text-xs text-gray-400 uppercase tracking-wide px-4 py-3">Área</th>
                    <th class="text-left text-xs text-gray-400 uppercase tracking-wide px-4 py-3">Ref. Code</th>
                    <th class="text-left text-xs text-gray-400 uppercase tracking-wide px-4 py-3">Registro</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($collaborators as $collaborator)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $collaborator->name }}</td>
                    <td class="px-4 py-3">
                        <span class="font-mono text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-lg">
                            {{ strtoupper(explode('@', $collaborator->email)[0]) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-500">{{ $collaborator->department ?? '—' }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <span class="font-mono text-xs text-[#1e3a8a]">{{ $collaborator->ref_code }}</span>
                            <button
                                onclick="copyCollab('{{ url('/colaborador/' . $collaborator->ref_code) }}')"
                                title="Copiar link"
                                class="text-gray-300 hover:text-red-500 transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-gray-400 text-xs">{{ $collaborator->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-400 text-sm">
                        No se encontraron colaboradores
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($collaborators->hasPages())
    <div class="mt-4">
        {{ $collaborators->links() }}
    </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('admin.index') }}" class="text-xs text-gray-400 hover:text-gray-600">← Volver al dashboard</a>
    </div>

    @push('scripts')
    <script>
    function copyCollab(url) {
        navigator.clipboard.writeText(url).then(() => {
            alert('¡Link copiado: ' + url + '!');
        });
    }
    </script>
    @endpush

@endsection