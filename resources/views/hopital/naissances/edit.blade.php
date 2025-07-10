@extends('layouts.app')
@section('titre')Modification @endsection
@section('content')
<div class="right_col" role="main">
    <form method="POST" action="{{ route('naissances.update', $volet->id_volet) }}"
        class="max-w-3xl mx-auto my-10 bg-white border border-black px-6 py-8 font-[Times] text-[14px]">
        @csrf
        @method('PUT')

        @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="text-center font-bold uppercase mb-4">
            REPUBLIQUE DU MALI<br>
            Un Peuple - Un But - Une Foi
        </div>

        <div class="text-center font-bold uppercase mb-4">Enfant</div>
        <div class="flex flex-wrap gap-4 mb-4">
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Date de naissance</label>
                <input type="date" name="date_naissance" value="{{ old('date_naissance', $volet->date_naissance) }}"
                    required class="w-full border px-3 py-1 rounded">
            </div>
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Heure</label>
                <input type="time" name="heure_naissance" value="{{ old('heure_naissance', $volet->heure_naissance) }}"
                    required class="w-full border px-3 py-1 rounded">
            </div>
        </div>

        <div class="flex flex-wrap gap-4 mb-4">
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Prénoms</label>
                <input type="text" name="prenom_enfant" value="{{ old('prenom_enfant', $volet->prenom_enfant) }}"
                    class="w-full border px-3 py-1 rounded">
            </div>
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Nom</label>
                <input type="text" name="nom_enfant" value="{{ old('nom_enfant', $volet->nom_enfant) }}"
                    class="w-full border px-3 py-1 rounded">
            </div>
        </div>

        <div class="flex flex-wrap gap-4 mb-4">
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Sexe</label>
                <select name="sexe" class="w-full border px-3 py-1 rounded">
                    <option value="M" {{ old('sexe', $volet->sexe) == 'M' ? 'selected' : '' }}>Masculin</option>
                    <option value="F" {{ old('sexe', $volet->sexe) == 'F' ? 'selected' : '' }}>Féminin</option>
                </select>
            </div>
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Nombre d’enfants</label>
                <input type="number" name="nbreEnfantAccouchement"
                    value="{{ old('nbreEnfantAccouchement', $volet->nbreEnfantAccouchement) }}"
                    class="w-full border px-3 py-1 rounded">
            </div>
        </div>

        @php $parents = ['pere' => 'Père', 'mere' => 'Mère']; @endphp
        @foreach ($parents as $prefix => $label)
        <div class="text-center font-bold uppercase mb-4">{{ $label }}</div>
        <div class="flex flex-wrap gap-4 mb-4">
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Prénom</label>
                <input type="text" name="prenom_{{ $prefix }}"
                    value="{{ old('prenom_'.$prefix, $volet->{'prenom_'.$prefix}) }}"
                    class="w-full border px-3 py-1 rounded">
            </div>
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Nom</label>
                <input type="text" name="nom_{{ $prefix }}" value="{{ old('nom_'.$prefix, $volet->{'nom_'.$prefix}) }}"
                    class="w-full border px-3 py-1 rounded">
            </div>
        </div>
        <div class="flex flex-wrap gap-4 mb-4">
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Age</label>
                <input type="number" name="age_{{ $prefix }}"
                    value="{{ old('age_'.$prefix, $volet->{'age_'.$prefix}) }}" class="w-full border px-3 py-1 rounded">
            </div>
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Domicile</label>
                <input type="text" name="domicile_{{ $prefix }}"
                    value="{{ old('domicile_'.$prefix, $volet->{'domicile_'.$prefix}) }}"
                    class="w-full border px-3 py-1 rounded">
            </div>
        </div>
        <div class="flex flex-wrap gap-4 mb-4">
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Ethnie</label>
                <input type="text" name="ethnie_{{ $prefix }}"
                    value="{{ old('ethnie_'.$prefix, $volet->{'ethnie_'.$prefix}) }}"
                    class="w-full border px-3 py-1 rounded">
            </div>
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Situation matrimoniale</label>
                <select name="situation_matrimonial_{{ $prefix }}" class="w-full border px-3 py-1 rounded">
                    @foreach(['Marié', 'Célibataire', 'Divorcé'] as $status)
                    <option value="{{ $status }}" {{ old('situation_matrimonial_'.$prefix, $volet->
                        {'situation_matrimonial_'.$prefix}) == $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex flex-wrap gap-4 mb-6">
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Niveau scolaire</label>
                <input type="text" name="niveau_instruction_{{ $prefix }}"
                    value="{{ old('niveau_instruction_'.$prefix, $volet->{'niveau_instruction_'.$prefix}) }}"
                    class="w-full border px-3 py-1 rounded">
            </div>
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Profession</label>
                <input type="text" name="profession_{{ $prefix }}"
                    value="{{ old('profession_'.$prefix, $volet->{'profession_'.$prefix}) }}"
                    class="w-full border px-3 py-1 rounded">
            </div>
        </div>
        @endforeach

        <div class="text-center font-bold uppercase mb-4">Déclarant</div>
        <div class="flex flex-wrap gap-4 mb-4">
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Prénom</label>
                <input type="text" name="prenom_declarant"
                    value="{{ old('prenom_declarant', $volet->declarant->prenom_declarant) }}"
                    class="w-full border px-3 py-1 rounded">
            </div>
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Nom</label>
                <input type="text" name="nom_declarant"
                    value="{{ old('nom_declarant', $volet->declarant->nom_declarant) }}"
                    class="w-full border px-3 py-1 rounded">
            </div>
        </div>
        <div class="flex flex-wrap gap-4 mb-4">
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Age</label>
                <input type="number" name="age_declarant"
                    value="{{ old('age_declarant', $volet->declarant->age_declarant) }}"
                    class="w-full border px-3 py-1 rounded">
            </div>
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Domicile</label>
                <input type="text" name="domicile_declarant"
                    value="{{ old('domicile_declarant', $volet->declarant->domicile_declarant) }}"
                    class="w-full border px-3 py-1 rounded">
            </div>
        </div>
        <div class="flex flex-wrap gap-4 mb-4">
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $volet->declarant->email) }}"
                    class="w-full border px-3 py-1 rounded">
            </div>
            <div class="w-full md:flex-1">
                <label class="font-semibold block mb-1">Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone', $volet->declarant->telephone) }}"
                    class="w-full border px-3 py-1 rounded">
            </div>
        </div>
        <div class="mb-6">
            <label class="font-semibold block mb-1">Ethnie</label>
            <input type="text" name="ethnie_declarant"
                value="{{ old('ethnie_declarant', $volet->declarant->ethnie_declarant) }}"
                class="w-full border px-3 py-1 rounded">
        </div>

        <div class="flex justify-center gap-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded">✅
                Mettre à jour</button>
            <a href="{{ route('hopital.dashboard') }}"
                class="bg-gray-400 hover:bg-gray-500 text-white font-semibold px-6 py-2 rounded">Annuler</a>
        </div>
    </form>
</div>
@endsection