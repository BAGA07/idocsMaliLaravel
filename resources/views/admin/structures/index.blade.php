@extends('layouts.admin')

@section('title', 'Gestion des Structures')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700 flex items-center gap-2">
            <i class="fas fa-hospital"></i> Gestion des Structures
        </h1>
        <nav class="text-sm text-gray-500">
            <ol class="list-reset flex">
                <li><a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">Dashboard</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-700">Structures</li>
            </ol>
        </nav>
    </div>

    <div class="bg-white rounded shadow p-4">
        @livewire('admin.structures-table')
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('structureCreated', () => {
            // Actions après création
        });

        Livewire.on('structureUpdated', () => {
            // Actions après mise à jour
        });

        Livewire.on('structureDeleted', () => {
            // Actions après suppression
        });
    });
</script>
@endpush
