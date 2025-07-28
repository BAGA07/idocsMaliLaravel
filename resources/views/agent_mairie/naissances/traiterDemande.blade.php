@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Traitement de la demande</h2>
    <form action="{{ route('mairie.demandes.valider', $demande->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold">Nom demandeur :</label>
            <input type="text" class="w-full border rounded px-3 py-2" value="{{ $demande->nom_complet }}" readonly>
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Nom enfant :</label>
            <input type="text" class="w-full border rounded px-3 py-2" value="{{ $demande->volet->prenom_enfant ?? '' }} {{ $demande->volet->nom_enfant ?? '' }}" readonly>
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Numéro volet :</label>
            <input type="text" class="w-full border rounded px-3 py-2" value="{{ $demande->volet->num_volet ?? '' }}" readonly>
        </div>
        <!-- Ajoute ici d'autres champs à modifier si besoin -->
        <div class="flex gap-4 mt-6">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Enregistrer</button>
            <a href="{{ route('mairie.demandes.en_attente') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
        </div>
    </form>
</div>
@endsection 