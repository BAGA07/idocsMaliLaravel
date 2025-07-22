@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Création d'un Acte de Naissance (Copie)</h2>

    <form action="{{ route('acteCopies.store') }}" method="POST" class="space-y-4">
        @csrf

        <input type="hidden" name="demande_id" value="{{ $demandeCopies->id }}">

        {{-- Enfant --}}
        <div>
            <label class="block font-medium">Prénom de l'enfant</label>
            <input type="text" name="prenom_enfant"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Nom de l'enfant</label>
            <input type="text" name="nom_enfant"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Date de naissance</label>
            <input type="date" name="date_naissance"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Lieu de naissance (Hôpital)</label>
            <input type="text" name="lieu_naissance"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Heure de naissance</label>
            <input type="time" name="heure_naissance"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Sexe Enfant</label>
            <input type="text" name="sexe_enfant"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        {{-- Père --}}
        <h3 class="text-lg font-semibold mt-6">Informations du Père</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Prénom du père</label>
                <input type="text" name="prenom_pere"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Nom du père</label>
                <input type="text" name="nom_pere"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div class="md:col-span-2">
                <label class="block font-medium">Domicile du père</label>
                <input type="text" name="domicile_pere"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div class="md:col-span-2">
                <label class="block font-medium">Profession du père</label>
                <input type="text" name="profession_pere"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
        </div>

        {{-- Mère --}}
        <h3 class="text-lg font-semibold mt-6">Informations de la Mère</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Prénom de la mère</label>
                <input type="text" name="prenom_mere"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Nom de la mère</label>
                <input type="text" name="nom_mere"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div class="md:col-span-2">
                <label class="block font-medium">Domicile de la mère</label>
                <input type="text" name="domicile_mere"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div class="md:col-span-2">
                <label class="block font-medium">Profession de la mère</label>
                <input type="text" name="profession_mere"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
        </div>

        {{-- Déclarant --}}
        <h3 class="text-lg font-semibold mt-6">Informations du Déclarant</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Prénom du déclarant</label>
                <input type="text" name="prenom_declarant" required
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Nom du déclarant</label>
                <input type="text" name="nom_declarant" required
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Âge du déclarant</label>
                <input type="text" name="age_declarant" required
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Profession du déclarant</label>
                <input type="text" name="profession_declarant" required
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Adresse du déclarant</label>
                <input type="text" name="domicile_declarant"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Ethnie</label>
                <input type="text" name="ethnie_declarant"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Téléphone</label>
                <input type="number" name="telephone"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Email</label>
                <input type="text" name="email"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
        </div>

        {{-- Affichage des erreurs --}}
        @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded">
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Relations officielles --}}
        <div>
            <label class="block font-medium mt-4">Officier d'état civil</label>
            <select name="id_officier"
                class="w-full border border-gray-300 rounded px-3 py-2 bg-white">
                @foreach($officiers as $officier)
                <option value="{{ $officier->id }}">{{ $officier->nom }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium">Commune</label>
            <select name="id_commune"
                class="w-full border border-gray-300 rounded px-3 py-2 bg-white">
                @foreach($communes as $commune)
                <option value="{{ $commune->id }}">{{ $commune->nom_commune }}</option>
                @endforeach
            </select>
        </div>

        <div class="pt-6">
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                Enregistrer l'acte
            </button>
        </div>
    </form>
</div>
@endsection
