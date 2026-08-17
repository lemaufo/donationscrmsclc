@extends('layouts.public')

@section('title', 'Mi impacto — Impact Day')
@section('content_width', 'max-w-3xl mx-auto')

@section('header_right')
    <div class="flex items-center gap-2">
        <span class="text-sm text-gray-600 font-medium hidden sm:inline">{{ $collaborator->name }}</span>
        <span class="text-xs text-gray-400 bg-gray-100 rounded-lg px-2 py-0.5 font-mono">{{ $collaborator->ref_code }}</span>
    </div>
@endsection

@section('content')
    @livewire('collaborator-dashboard', ['collaborator' => $collaborator])
@endsection

@push('scripts')
<script>
    function copyLink() {
        navigator.clipboard.writeText('{{ url('/donar') }}?ref={{ $collaborator->ref_code }}').then(() => {
            alert('¡Link copiado!');
        });
    }
</script>
@endpush