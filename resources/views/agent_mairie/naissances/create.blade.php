@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-8 bg-white rounded-lg shadow">
    <h2 class="text-3xl font-semibold mb-8 text-gray-800">Création d'un Acte de Naissance</h2>

    <form action="{{ route('acte.store') }}" method="POST" class="space-y-6">
        @csrf

        <input type="hidden" name="demande_id" value="{{ $demande->id }}">

        {{-- Informations sur l’enfant --}}
        <h3 class="text-xl font-bold text-gray-700 mb-4">Informations sur l’enfant</h3>
        <div class="grid grid-cols-2 gap-6">
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
                <label class="block text-gray-700">Heure de naissance</label>
                <input type="time" name="heure_naissance" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->heure_naissance ?? '' }}">
            </div>

            <div>
                <label class="block text-gray-700">Lieu de naissance (Hôpital)</label>
                <input type="text" name="lieu_naissance" class="mt-1 w-full rounded border-gray-300 bg-gray-100" value="{{ $demande->volet->hopital->nom_hopital ?? '' }}" readonly>
            </div>

            <div>
                <label class="block text-gray-700">Sexe</label>
                <input type="text" name="sexe_enfant" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->sexe ?? '' }}">
            </div>
        </div>

        {{-- Informations du Père --}}
        <h3 class="text-xl font-bold text-gray-700 mt-10 mb-4">Informations du Père</h3>
        <div class="grid grid-cols-2 gap-6">
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

            <div class="col-span-2">
                <label class="block text-gray-700">Profession du père</label>
                <input type="text" name="profession_pere" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->profession_pere ?? '' }}">
            </div>
        </div>

        {{-- Informations de la Mère --}}
        <h3 class="text-xl font-bold text-gray-700 mt-10 mb-4">Informations de la Mère</h3>
        <div class="grid grid-cols-2 gap-6">
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

            <div class="col-span-2">
                <label class="block text-gray-700">Profession de la mère</label>
                <input type="text" name="profession_mere" class="mt-1 w-full rounded border-gray-300" value="{{ $demande->volet->profession_mere ?? '' }}">
            </div>
        </div>

        {{-- Officier et Commune --}}
        <div class="grid grid-cols-2 gap-6 mt-10">
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
        </div>

        <div class="pt-6">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg">
                Enregistrer l'acte
            </button>
        </div>
    </form>
</div>
@endsection
