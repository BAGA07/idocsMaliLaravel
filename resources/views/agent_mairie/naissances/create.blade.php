@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Création d'un Acte de Naissance</h2>

    <form action="{{ route('acte.store') }}" method="POST" class="space-y-6">
        @csrf

        <input type="hidden" name="demande_id" value="{{ $demande->id }}">

        {{-- Informations sur l’enfant --}}
        <div>
            <label class="block text-gray-700">Prénom de l'enfant</label>
            <input type="text" name="prenom_enfant" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->prenom_enfant ?? '' }}">
        </div>

        <div>
            <label class="block text-gray-700">Nom de l'enfant</label>
            <input type="text" name="nom_enfant" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->nom_enfant ?? '' }}">
        </div>

        <div>
            <label class="block text-gray-700">Date de naissance</label>
            <input type="date" name="date_naissance" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->date_naissance ?? '' }}">
        </div>

        <div>
            <label class="block text-gray-700">Lieu de naissance (Hôpital)</label>
            <input type="text" name="lieu_naissance" class="mt-1 w-full rounded border-gray-300 bg-gray-100" value="{{ $demande->volet->hopital->nom_hopital ?? '' }}" readonly>
        </div>

        <div>
            <label class="block text-gray-700">Heure de naissance</label>
            <input type="time" name="heure_naissance" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->heure_naissance ?? '' }}">
        </div>

        <div>
            <label class="block text-gray-700">Sexe</label>
            <input type="text" name="sexe_enfant" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->sexe ?? '' }}">
        </div>

        {{-- Informations du Père --}}
        <h3 class="text-lg font-medium text-gray-800 mt-6">Informations du Père</h3>

        <div>
            <label class="block text-gray-700">Prénom du père</label>
            <input type="text" name="prenom_pere" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->prenom_pere ?? '' }}">
        </div>

        <div>
            <label class="block text-gray-700">Nom du père</label>
            <input type="text" name="nom_pere" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->nom_pere ?? '' }}">
        </div>

        <div>
            <label class="block text-gray-700">Âge du père</label>
            <input type="number" name="age_pere" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->age_pere ?? '' }}">
        </div>

        <div>
            <label class="block text-gray-700">Domicile du père</label>
            <input type="text" name="domicile_pere" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->domicile_pere ?? '' }}">
        </div>

        <div>
            <label class="block text-gray-700">Profession du père</label>
            <input type="text" name="profession_pere" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->profession_pere ?? '' }}">
        </div>

        {{-- Informations de la Mère --}}
        <h3 class="text-lg font-medium text-gray-800 mt-6">Informations de la Mère</h3>

        <div>
            <label class="block text-gray-700">Prénom de la mère</label>
            <input type="text" name="prenom_mere" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->prenom_mere ?? '' }}">
        </div>

        <div>
            <label class="block text-gray-700">Nom de la mère</label>
            <input type="text" name="nom_mere" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->nom_mere ?? '' }}">
        </div>

        <div>
            <label class="block text-gray-700">Âge de la mère</label>
            <input type="number" name="age_mere" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->age_mere ?? '' }}">
        </div>

        <div>
            <label class="block text-gray-700">Domicile de la mère</label>
            <input type="text" name="domicile_mere" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->domicile_mere ?? '' }}">
        </div>

        <div>
            <label class="block text-gray-700">Profession de la mère</label>
            <input type="text" name="profession_mere" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->profession_mere ?? '' }}">
        </div>

        {{-- Officier et Commune --}}
        <div>
            <label class="block text-gray-700">Officier d'état civil</label>
            <select name="id_officier" class="mt-1 w-full rounded border-gray-300" required>
                @foreach($officiers as $officier)
                    <option value="{{ $officier->id }}">{{ $officier->nom }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700">Commune</label>
            <select name="id_commune" class="mt-1 w-full rounded border-gray-300" required>
                @foreach($communes as $commune)
                    <option value="{{ $commune->id }}">{{ $commune->nom_commune }}</option>
                @endforeach
            </select>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                Enregistrer l'acte
            </button>
        </div>
    </form>
</div>
@endsection
