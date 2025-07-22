@extends('layouts.app')
@section('content')

<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg">
        <div class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center rounded-t-lg">
            <h2 class="text-lg font-semibold">Modifier l'acte #{{ $acte->num_acte }}</h2>
            <a href="{{ route('agent.dashboard') }}" class="text-sm bg-white text-blue-600 px-3 py-1 rounded hover:bg-gray-100">
                ← Retour au dashboard
            </a>
        </div>

        <div class="p-6">
            {{-- Affichage des erreurs --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('acte.update', $acte->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Informations de l'enfant --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium">Nom de l'enfant</label>
                        <input type="text" name="nom" class="w-full border rounded px-3 py-2" value="{{ old('nom', $acte->nom) }}">
                    </div>
                    <div>
                        <label class="block font-medium">Prénom de l'enfant</label>
                        <input type="text" name="prenom" class="w-full border rounded px-3 py-2" value="{{ old('prenom', $acte->prenom) }}">
                    </div>

                    <div>
                        <label class="block font-medium">Date de naissance</label>
                        <input type="date" name="date_naissance_enfant" class="w-full border rounded px-3 py-2" value="{{ old('date_naissance_enfant', $acte->date_naissance_enfant) }}">
                    </div>
                    <div>
                        <label class="block font-medium">Heure de naissance</label>
                        <input type="time" name="heure_naissance" class="w-full border rounded px-3 py-2" value="{{ old('heure_naissance', $acte->heure_naissance) }}">
                    </div>

                    <div>
                        <label class="block font-medium">Lieu de naissance</label>
                        <input type="text" name="lieu_naissance_enfant" class="w-full border rounded px-3 py-2" value="{{ old('lieu_naissance_enfant', $acte->lieu_naissance_enfant) }}">
                    </div>
                    <div>
                        <label class="block font-medium">Sexe</label>
                        <select name="sexe_enfant" class="w-full border rounded px-3 py-2">
                            <option value="masculin" {{ $acte->sexe_enfant == 'masculin' ? 'selected' : '' }}>Masculin</option>
                            <option value="féminin" {{ $acte->sexe_enfant == 'féminin' ? 'selected' : '' }}>Féminin</option>
                        </select>
                    </div>
                </div>

                {{-- Informations du père --}}
                <h4 class="mt-6 font-semibold text-gray-700">Informations du père</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                    <div>
                        <label class="block font-medium">Prénom du père</label>
                        <input type="text" name="prenom_pere" class="w-full border rounded px-3 py-2" value="{{ old('prenom_pere', $acte->prenom_pere) }}">
                    </div>
                    <div>
                        <label class="block font-medium">Nom du père</label>
                        <input type="text" name="nom_pere" class="w-full border rounded px-3 py-2" value="{{ old('nom_pere', $acte->nom_pere) }}">
                    </div>
                    <div>
                        <label class="block font-medium">Profession du père</label>
                        <input type="text" name="profession_pere" class="w-full border rounded px-3 py-2" value="{{ old('profession_pere', $acte->profession_pere) }}">
                    </div>
                    <div>
                        <label class="block font-medium">Domicile du père</label>
                        <input type="text" name="domicile_pere" class="w-full border rounded px-3 py-2" value="{{ old('domicile_pere', $acte->domicile_pere) }}">
                    </div>
                </div>

                {{-- Informations de la mère --}}
                <h4 class="mt-6 font-semibold text-gray-700">Informations de la mère</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                    <div>
                        <label class="block font-medium">Prénom de la mère</label>
                        <input type="text" name="prenom_mere" class="w-full border rounded px-3 py-2" value="{{ old('prenom_mere', $acte->prenom_mere) }}">
                    </div>
                    <div>
                        <label class="block font-medium">Nom de la mère</label>
                        <input type="text" name="nom_mere" class="w-full border rounded px-3 py-2" value="{{ old('nom_mere', $acte->nom_mere) }}">
                    </div>
                    <div>
                        <label class="block font-medium">Profession de la mère</label>
                        <input type="text" name="profession_mere" class="w-full border rounded px-3 py-2" value="{{ old('profession_mere', $acte->profession_mere) }}">
                    </div>
                    <div>
                        <label class="block font-medium">Domicile de la mère</label>
                        <input type="text" name="domicile_mere" class="w-full border rounded px-3 py-2" value="{{ old('domicile_mere', $acte->domicile_mere) }}">
                    </div>
                </div>

                {{-- Officier et Commune --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div>
                        <label class="block font-medium">Officier d'état civil</label>
                        <select name="id_officier" class="w-full border rounded px-3 py-2">
                            @foreach ($officiers as $officier)
                                <option value="{{ $officier->id }}" {{ $acte->id_officier == $officier->id ? 'selected' : '' }}>
                                    {{ $officier->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium">Commune</label>
                        <select name="id_commune" class="w-full border rounded px-3 py-2">
                            @foreach ($communes as $commune)
                                <option value="{{ $commune->id }}" {{ $acte->id_commune == $commune->id ? 'selected' : '' }}>
                                    {{ $commune->nom_commune }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Boutons --}}
                <div class="mt-6 flex justify-between">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold">
                        Modifier
                    </button>
                    <a href="{{ route('agent.dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                        Annuler
                    </a>
                </div>

            </form>
            <!-- <div class="d-flex justify-content-end">
              <form action="{{ route('acte.destroy', $acte->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet acte ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            🗑 Supprimer
                        </button>
                    </form>
            </div> -->
        </div>
    </div>
</div>
@endsection
