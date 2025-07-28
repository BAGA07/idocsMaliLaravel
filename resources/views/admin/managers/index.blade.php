@extends('layouts.admin')
@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Gestion des managers</h2>
        <livewire:admin.managers-table />
    </div>
</div>
@endsection