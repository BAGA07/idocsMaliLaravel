@extends('layouts.app') {{-- ou ton layout Gentelella --}}
@section('content')
<h2>Détails de la déclaration</h2>

<ul>
    <li>Nom de l'enfant : {{ $declaration->nom_enfant }}</li>
    <li>Date de naissance : {{ $declaration->date_naissance }}</li>
    <li>Lieu : {{ $declaration->lieu_naissance }}</li>
    <!-- etc -->
</ul>

<a href="{{ route('naissance.edit', $declaration->id) }}" class="btn btn-warning">Modifier</a>
@endsection