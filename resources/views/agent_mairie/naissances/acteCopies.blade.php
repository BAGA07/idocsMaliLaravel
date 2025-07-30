@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4 px-4 max-w-7xl">
    <h1 class="mb-6 text-center text-2xl font-bold text-gray-800">
        @if($isVoletCopy)
            Créer une Copie d'Acte de Naissance (Depuis Volet)
        @else
            Créer une Copie d'Acte de Naissance (Depuis Justificatif)
        @endif
    </h1>

    {{-- Affichage des erreurs de validation --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        {{-- Colonne de gauche : Informations/Justificatif --}}
        <div class="space-y-6">
            @if($isVoletCopy)
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-blue-600">📋 Informations du Volet de Déclaration</h3>
                    <div class="space-y-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h5 class="font-semibold text-gray-700 mb-2">👶 Enfant:</h5>
                            <div class="grid grid-cols-2 gap-2 text-sm">
                                <p><span class="font-medium">Nom:</span> {{ $volet->nom_enfant }}</p>
                                <p><span class="font-medium">Prénom:</span> {{ $volet->prenom_enfant }}</p>
                                <p><span class="font-medium">Date de naissance:</span> {{ $volet->date_naissance }}</p>
                                <p><span class="font-medium">Sexe:</span> {{ $volet->sexe }}</p>
                            </div>
                        </div>
                        
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h5 class="font-semibold text-gray-700 mb-2">👨 Père:</h5>
                            <div class="grid grid-cols-2 gap-2 text-sm">
                                <p><span class="font-medium">Nom:</span> {{ $volet->nom_pere }}</p>
                                <p><span class="font-medium">Prénom:</span> {{ $volet->prenom_pere }}</p>
                                <p><span class="font-medium">Profession:</span> {{ $volet->profession_pere }}</p>
                            </div>
                        </div>
                        
                        <div class="bg-pink-50 p-4 rounded-lg">
                            <h5 class="font-semibold text-gray-700 mb-2">👩 Mère:</h5>
                            <div class="grid grid-cols-2 gap-2 text-sm">
                                <p><span class="font-medium">Nom:</span> {{ $volet->nom_mere }}</p>
                                <p><span class="font-medium">Prénom:</span> {{ $volet->prenom_mere }}</p>
                                <p><span class="font-medium">Profession:</span> {{ $volet->profession_mere }}</p>
                            </div>
                        </div>
                        
                        <div class="bg-yellow-50 p-3 rounded-lg">
                            <p class="text-blue-600 text-sm italic">✅ Les informations du formulaire sont pré-remplies avec les données du volet.</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-blue-600">📄 Justificatif fourni par l'utilisateur</h3>
                    

                    
                    @if($urlJustificatif)
                        <p class="mb-4 text-gray-600">Veuillez remplir le formulaire ci-contre en vous basant sur cette image.</p>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                            <img src="{{ $urlJustificatif }}" alt="Photo du justificatif (extrait de naissance)" 
                                 class="w-full h-auto rounded-lg shadow-lg max-h-[700px] object-contain mx-auto"
                                 onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='block';"
                                 onload="this.nextElementSibling.style.display='none';">
                            <div class="hidden text-center p-4 bg-red-50 border border-red-200 rounded">
                                <p class="text-red-600 font-semibold">⚠️ Erreur de chargement de l'image</p>
                                <p class="text-sm text-gray-600">URL: {{ $urlJustificatif }}</p>
                                <a href="{{ $urlJustificatif }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                                    Ouvrir l'image dans un nouvel onglet
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 p-4 rounded-lg">
                            <p class="flex items-center">
                                <span class="mr-2">⚠️</span>
                                Aucun justificatif disponible pour cette demande.
                            </p>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        {{-- Colonne de droite : Formulaire --}}
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-6 text-gray-800">📝 Informations de la Copie à Créer</h3>
            <form action="{{ route('acteCopies.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="demande_id" value="{{ $demande->id }}">

                @php
                    $annee = date('Y');
                    $numeroActe = '1729/MCVI/REG/' . $annee . '/' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
                @endphp

                {{-- Informations Administratives --}}
                <div class="border-l-4 border-blue-500 pl-4">
                    <h4 class="text-md font-semibold mb-4 text-blue-600">🏛️ Informations Administratives</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="num_acte" class="block text-sm font-medium text-gray-700 mb-1">
                                @if($isVoletCopy)
                                    Numéro d'acte:
                                @else
                                    Numéro d'acte (lu sur le justificatif):
                                @endif
                            </label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $isVoletCopy ? 'bg-gray-100' : '' }}" 
                                   id="num_acte" name="num_acte" 
                                   value="{{ old('num_acte', $isVoletCopy ? $numeroActe : '') }}" 
                                   {{ $isVoletCopy ? 'readonly' : 'required' }}>
                            @if(!$isVoletCopy)
                                <p class="text-sm text-gray-500 mt-1">Entrez le numéro d'acte tel qu'il apparaît sur le justificatif</p>
                            @endif
                        </div>
                        
                        <div>
                            <label for="nina" class="block text-sm font-medium text-gray-700 mb-1">NINA:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   id="nina" name="nina" placeholder="Numéro d'Identification Nationale" value="{{ old('nina') }}">
                        </div>
                        
                        <div>
                            <label for="region" class="block text-sm font-medium text-gray-700 mb-1">Région:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" 
                                   id="region" name="region" value="{{ old('region', 'DISTRICT DE BAMAKO') }}" readonly>
                </div>
                        
                        <div>
                            <label for="cercle" class="block text-sm font-medium text-gray-700 mb-1">Cercle:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" 
                                   id="cercle" name="cercle" value="{{ old('cercle', 'BAMAKO') }}" readonly>
                </div>
                        
                        <div>
                            <label for="arrondissement" class="block text-sm font-medium text-gray-700 mb-1">Arrondissement:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" 
                                   id="arrondissement" name="arrondissement" value="{{ old('arrondissement', 'VI DE BAMAKO') }}" readonly>
                </div>
                        
                        <div>
                            <label for="centre" class="block text-sm font-medium text-gray-700 mb-1">Centre:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" 
                                   id="centre" name="centre" value="{{ old('centre', 'SECONDAIRE NIAMAKORO') }}" readonly>
                </div>
                </div>
                </div>

                {{-- Informations de l'Enfant --}}
                <div class="border-l-4 border-green-500 pl-4">
                    <h4 class="text-md font-semibold mb-4 text-green-600">👶 Informations de l'Enfant</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="prenom_enfant" class="block text-sm font-medium text-gray-700 mb-1">Prénom(s) de l'enfant:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                                   id="prenom_enfant" name="prenom_enfant" 
                                   value="{{ old('prenom_enfant', $isVoletCopy ? $volet->prenom_enfant : '') }}" required>
                </div>
                        
                        <div>
                            <label for="nom_enfant" class="block text-sm font-medium text-gray-700 mb-1">Nom de l'enfant:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                                   id="nom_enfant" name="nom_enfant" 
                                   value="{{ old('nom_enfant', $isVoletCopy ? $volet->nom_enfant : '') }}" required>
                </div>
                        
                        <div>
                            <label for="date_naissance_enfant" class="block text-sm font-medium text-gray-700 mb-1">Date de naissance:</label>
                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                                   id="date_naissance_enfant" name="date_naissance_enfant" 
                                   value="{{ old('date_naissance_enfant', $isVoletCopy ? $volet->date_naissance : '') }}" required>
                </div>
                        
                        <div>
                            <label for="heure_naissance" class="block text-sm font-medium text-gray-700 mb-1">Heure de naissance:</label>
                            <input type="time" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                                   id="heure_naissance" name="heure_naissance" 
                                   value="{{ old('heure_naissance', $isVoletCopy ? $volet->heure_naissance : '') }}">
                </div>
                        
                        <div>
                            <label for="lieu_naissance_enfant" class="block text-sm font-medium text-gray-700 mb-1">Localité de naissance:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                                   id="lieu_naissance_enfant" name="lieu_naissance_enfant" 
                                   value="{{ old('lieu_naissance_enfant', $isVoletCopy ? ($volet->hopital->nom_hopital ?? '') : '') }}" required>
                </div>
                        
                        <div>
                            <label for="sexe_enfant" class="block text-sm font-medium text-gray-700 mb-1">Sexe:</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                                    id="sexe_enfant" name="sexe_enfant" required>
                        <option value="">Sélectionner</option>
                                <option value="M" {{ old('sexe_enfant', $isVoletCopy ? $volet->sexe : '') == 'M' ? 'selected' : '' }}>Masculin</option>
                                <option value="F" {{ old('sexe_enfant', $isVoletCopy ? $volet->sexe : '') == 'F' ? 'selected' : '' }}>Féminin</option>
                    </select>
                        </div>
                    </div>
                </div>

                {{-- Informations du Père --}}
                <div class="border-l-4 border-blue-500 pl-4">
                    <h4 class="text-md font-semibold mb-4 text-blue-600">👨 Informations du Père</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="prenom_pere" class="block text-sm font-medium text-gray-700 mb-1">Prénom(s) du père:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   id="prenom_pere" name="prenom_pere" 
                                   value="{{ old('prenom_pere', $isVoletCopy ? $volet->prenom_pere : '') }}" required>
                        </div>
                        
                        <div>
                            <label for="nom_pere" class="block text-sm font-medium text-gray-700 mb-1">Nom du père:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   id="nom_pere" name="nom_pere" 
                                   value="{{ old('nom_pere', $isVoletCopy ? $volet->nom_pere : '') }}" required>
                        </div>
                        
                        <div>
                            <label for="profession_pere" class="block text-sm font-medium text-gray-700 mb-1">Profession du père:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   id="profession_pere" name="profession_pere" 
                                   value="{{ old('profession_pere', $isVoletCopy ? $volet->profession_pere : '') }}">
                        </div>
                        
                        <div>
                            <label for="domicile_pere" class="block text-sm font-medium text-gray-700 mb-1">Domicile du père:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   id="domicile_pere" name="domicile_pere" 
                                   value="{{ old('domicile_pere', $isVoletCopy ? $volet->domicile_pere : '') }}">
                        </div>
                </div>
                </div>

                {{-- Informations de la Mère --}}
                <div class="border-l-4 border-pink-500 pl-4">
                    <h4 class="text-md font-semibold mb-4 text-pink-600">👩 Informations de la Mère</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="prenom_mere" class="block text-sm font-medium text-gray-700 mb-1">Prénom(s) de la mère:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" 
                                   id="prenom_mere" name="prenom_mere" 
                                   value="{{ old('prenom_mere', $isVoletCopy ? $volet->prenom_mere : '') }}" required>
                </div>
                        
                        <div>
                            <label for="nom_mere" class="block text-sm font-medium text-gray-700 mb-1">Nom de la mère:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" 
                                   id="nom_mere" name="nom_mere" 
                                   value="{{ old('nom_mere', $isVoletCopy ? $volet->nom_mere : '') }}" required>
                </div>

                        <div>
                            <label for="profession_mere" class="block text-sm font-medium text-gray-700 mb-1">Profession de la mère:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" 
                                   id="profession_mere" name="profession_mere" 
                                   value="{{ old('profession_mere', $isVoletCopy ? $volet->profession_mere : '') }}">
                </div>
                        
                        <div>
                            <label for="domicile_mere" class="block text-sm font-medium text-gray-700 mb-1">Domicile de la mère:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" 
                                   id="domicile_mere" name="domicile_mere" 
                                   value="{{ old('domicile_mere', $isVoletCopy ? $volet->domicile_mere : '') }}">
                </div>
                </div>
                </div>

                {{-- Officier d'État Civil --}}
                <div class="border-l-4 border-purple-500 pl-4">
                    <h4 class="text-md font-semibold mb-4 text-purple-600">⚖️ Officier d'État Civil</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="id_officier" class="block text-sm font-medium text-gray-700 mb-1">Officier d'état civil:</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" 
                                    name="id_officier" id="id_officier" required>
                        <option value="">Sélectionnez un officier</option>
                        @foreach($officiers as $officier)
                            <option value="{{ $officier->id }}" {{ old('id_officier') == $officier->id ? 'selected' : '' }}>
                                {{ $officier->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                        
                        <div>
                            <label for="qualite_officier" class="block text-sm font-medium text-gray-700 mb-1">Qualité de l'officier:</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" 
                                   id="qualite_officier" name="qualite_officier" value="{{ old('qualite_officier', 'OFFICIER D\'ETAT CIVIL') }}" readonly>
                        </div>
                        
                        <div>
                            <label for="date_etablissement" class="block text-sm font-medium text-gray-700 mb-1">Date d'établissement:</label>
                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" 
                                   id="date_etablissement" name="date_etablissement" value="{{ old('date_etablissement', date('Y-m-d')) }}" readonly>
                        </div>
                        
                        <div>
                            <label for="date_delivrance" class="block text-sm font-medium text-gray-700 mb-1">Date de délivrance:</label>
                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" 
                                   id="date_delivrance" name="date_delivrance" value="{{ old('date_delivrance', date('Y-m-d')) }}" readonly>
                </div>
                </div>
                </div>

                {{-- Commune --}}
                <div class="border-l-4 border-orange-500 pl-4">
                    <h4 class="text-md font-semibold mb-4 text-orange-600">🏘️ Commune</h4>
                    <div>
                        <label for="id_commune" class="block text-sm font-medium text-gray-700 mb-1">Commune:</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" 
                                name="id_commune" id="id_commune" required>
                        <option value="">Sélectionnez une commune</option>
                        @foreach($communes as $commune)
                            <option value="{{ $commune->id }}" {{ old('id_commune') == $commune->id ? 'selected' : '' }}>
                                {{ $commune->nom_commune }}
                            </option>
                        @endforeach
                    </select>
                    </div>
                </div>

                {{-- Bouton de soumission --}}
                <div class="pt-6 border-t border-gray-200">
                    <button type="submit" class="w-full bg-green-600 text-white py-4 px-6 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 font-semibold text-lg transition duration-200 shadow-lg">
                        @if($isVoletCopy)
                            ✅ Créer la Copie depuis le Volet
                        @else
                            ✅ Créer la Copie depuis le Justificatif
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection