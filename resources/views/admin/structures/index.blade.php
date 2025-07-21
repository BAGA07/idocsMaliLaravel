@extends('layouts.admin')

@section('title', 'Gestion des Structures')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">
                    <i class="fas fa-hospital me-2"></i>
                    Gestion des Structures
                </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Structures</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @livewire('admin.structures-table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Écouter les événements Livewire pour fermer les modals
    document.addEventListener('livewire:init', () => {
        Livewire.on('structureCreated', () => {
            // Fermer automatiquement les modals si nécessaire
        });
        
        Livewire.on('structureUpdated', () => {
            // Fermer automatiquement les modals si nécessaire
        });
        
        Livewire.on('structureDeleted', () => {
            // Fermer automatiquement les modals si nécessaire
        });
    });
</script>
@endpush 