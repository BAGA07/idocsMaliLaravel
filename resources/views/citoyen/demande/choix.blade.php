@extends('layouts.presentation')
@section('links')
<link rel="stylesheet" href="{{ asset('gentelella/assets/cssPresentation/form.css') }}">
@endsection
@section('content')

<style>

</style>

<div class="form-container">
    <h2 class="choix-title">Quel type de demande souhaitez-vous faire ?</h2>

    <a href="{{ route('demande.create') }}" class="choix-link choix-1">
        Nouveau-né (avec numéro ou photo du volet)
    </a>

    <a href="{{ route('demande.sans_info') }}" class="choix-link choix-2">
        Je n’ai aucune information
    </a>

    <a href="{{ route('demande.copie') }}" class="choix-link choix-3">
        Demander une copie
    </a>
</div>
@endsection