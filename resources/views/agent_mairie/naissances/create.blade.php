@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Création d'un Acte de Naissance</h2>

    <form action="{{ route('acte.store') }}" method="POST" class="space-y-4">
        @csrf

        <input type="hidden" name="demande_id" value="{{ $demande->id }}">

        <div>
            <label class="block font-medium">Prénom de l'enfant</label>
            <input type="text" name="prenom_enfant" value="{{ $demande->volet->prenom_enfant ?? '' }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block font-medium">Nom de l'enfant</label>
            <input type="text" name="nom_enfant" value="{{ $demande->volet->nom_enfant ?? '' }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block font-medium">Date de naissance</label>
            <input type="date" name="date_naissance" value="{{ $demande->volet->date_naissance ?? '' }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block font-medium">Lieu de naissance (Hôpital)</label>
            <input type="text" name="lieu_naissance" value="{{ $demande->volet->hopital->nom_hopital ?? '' }}" readonly
                class="w-full bg-gray-100 border border-gray-300 rounded px-3 py-2 text-gray-600">
        </div>
<!-- Heure de naissance -->
<div class="mb-3">
    <label>Heure de naissance</label>
    <input type="time" name="heure_naissance" class="form-control" value="{{ $demande->volet->heure_naissance ?? '' }}">
</div>
<div class="mb-3">
    <label>Sexe Enfant</label>
    <input type="texe" name="sexe_enfant" class="form-control" value="{{ $demande->volet->sexe ?? '' }}">
</div>

        <div>
            <label class="block font-medium">Heure de naissance</label>
            <input type="time" name="heure_naissance" value="{{ $demande->volet->heure_naissance ?? '' }}"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Sexe Enfant</label>
            <input type="text" name="sexe_enfant" value="{{ $demande->volet->sexe ?? '' }}"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <!-- Père -->
        <h3 class="text-lg font-semibold mt-6">Informations du Père</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Prénom du père</label>
                <input type="text" name="prenom_pere" value="{{ $demande->volet->prenom_pere ?? '' }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Nom du père</label>
                <input type="text" name="nom_pere" value="{{ $demande->volet->nom_pere ?? '' }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Âge du père</label>
                <input type="number" name="age_pere" value="{{ $demande->volet->age_pere ?? '' }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Domicile du père</label>
                <input type="text" name="domicile_pere" value="{{ $demande->volet->domicile_pere ?? '' }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div class="md:col-span-2">
                <label class="block font-medium">Profession du père</label>
                <input type="text" name="profession_pere" value="{{ $demande->volet->profession_pere ?? '' }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
        </div>

        <!-- Mère -->
        <h3 class="text-lg font-semibold mt-6">Informations de la Mère</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Prénom de la mère</label>
                <input type="text" name="prenom_mere" value="{{ $demande->volet->prenom_mere ?? '' }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Nom de la mère</label>
                <input type="text" name="nom_mere" value="{{ $demande->volet->nom_mere ?? '' }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Âge de la mère</label>
                <input type="number" name="age_mere" value="{{ $demande->volet->age_mere ?? '' }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Domicile de la mère</label>
                <input type="text" name="domicile_mere" value="{{ $demande->volet->domicile_mere ?? '' }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div class="md:col-span-2">
                <label class="block font-medium">Profession de la mère</label>
                <input type="text" name="profession_mere" value="{{ $demande->volet->profession_mere ?? '' }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
        </div>

        <!-- Relations -->
        <hr class="my-6">

        <div>
            <label class="block font-medium">Officier d'état civil</label>
            <select name="id_officier"
                class="w-full border border-gray-300 rounded px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($officiers as $officier)
                    <option value="{{ $officier->id }}">{{ $officier->nom }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium">Commune</label>
            <select name="id_commune"
                class="w-full border border-gray-300 rounded px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($communes as $commune)
                    <option value="{{ $commune->id }}">{{ $commune->nom_commune }}</option>
                @endforeach
            </select>
        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                Enregistrer l'acte
            </button>
        </div>
    </form>
</div>
@endsection
