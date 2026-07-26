@extends('layouts.public')

@section('title', 'Mi impacto — Impact Day')

@section('header_right')
    <div class="flex items-center gap-2 text-sm text-gray-600">
        <span class="font-medium">{{ $collaborator->name }}</span>
        <span class="text-xs text-gray-400 bg-gray-100 rounded-lg px-2 py-0.5 font-mono">{{ $collaborator->ref_code }}</span>
    </div>
@endsection

@section('content')
    @livewire('collaborator-dashboard', ['collaborator' => $collaborator])
@endsection

@push('scripts')
<script>
    function copyLink() {
        const url = '{{ url('/donar') }}?ref={{ $collaborator->ref_code }}';
        navigator.clipboard.writeText(url).then(() => {
            alert('¡Link copiado!');
        });
    }
</script>
@endpush