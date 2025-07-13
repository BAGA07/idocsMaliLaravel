@extends('layouts.app') {{-- ou layouts.admin --}}

@section('content')
<div class="right_col" role="main">
    <div class="container">
        <h2 class="mb-4">Dashboard Administrateur</h2>

        <livewire:admin.dashboard /> {{-- Livewire v3 syntaxe --}}
    </div>
</div>
@endsection