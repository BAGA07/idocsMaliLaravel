<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Déclaration de Naissance</title>
    {{-- Assurez-vous que Vite est configuré pour charger Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900">

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-cover bg-center"
        style="background-image: url('/images/declaration3.png');">
        {{-- Utilisation de l'image de fond qui évoque l'enregistrement --}}

        @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-bold">Oups !</span> Il y a eu des erreurs lors de la soumission :
            <ul class="mt-1.5 list-disc list-inside">
                @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('naissances.update', $volet->id_volet) }}"
            class="max-w-4xl w-full space-y-8 p-8 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 bg-opacity-90 dark:bg-opacity-90">
            @csrf
            @method('PUT')

            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-blue-700 dark:text-blue-400 mb-2">REPUBLIQUE DU MALI</h1>
                <p class="text-md text-gray-700 dark:text-gray-300">Un Peuple - Un But - Une Foi</p>
                <p class="mt-6 text-xl font-semibold text-gray-800 dark:text-gray-200">Modifier Déclaration de Naissance
                </p>
            </div>

            {{-- ENFANT --}}
            <div class="space-y-6">
                <h2
                    class="text-2xl font-bold text-blue-600 dark:text-blue-400 border-b-2 border-blue-300 dark:border-blue-700 pb-3 mb-6">
                    Informations sur l'Enfant</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="date_naissance"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de
                            naissance</label>
                        <input type="date" name="date_naissance" id="date_naissance"
                            value="{{ old('date_naissance', $volet->date_naissance) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="heure_naissance"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Heure</label>
                        <input type="time" name="heure_naissance" id="heure_naissance"
                            value="{{ old('heure_naissance', $volet->heure_naissance) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="prenom_enfant"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénoms</label>
                        <input type="text" name="prenom_enfant" id="prenom_enfant"
                            value="{{ old('prenom_enfant', $volet->prenom_enfant) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="nom_enfant"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                        <input type="text" name="nom_enfant" id="nom_enfant"
                            value="{{ old('nom_enfant', $volet->nom_enfant) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="sexe"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexe</label>
                        <select name="sexe" id="sexe"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="M" {{ old('sexe', $volet->sexe) == 'M' ? 'selected' : '' }}>Masculin</option>
                            <option value="F" {{ old('sexe', $volet->sexe) == 'F' ? 'selected' : '' }}>Féminin</option>
                        </select>
                    </div>
                    <div>
                        <label for="nbreEnfantAccouchement"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre d’enfants issus
                            de cet accouchement</label>
                        <input type="number" name="nbreEnfantAccouchement" id="nbreEnfantAccouchement" min="1"
                            value="{{ old('nbreEnfantAccouchement', $volet->nbreEnfantAccouchement) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
            </div>

            {{-- PÈRE --}}
            <div class="space-y-6">
                <h2
                    class="text-2xl font-bold text-blue-600 dark:text-blue-400 border-b-2 border-blue-300 dark:border-blue-700 pb-3 mb-6">
                    Informations sur le Père</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="prenom_pere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                        <input type="text" name="prenom_pere" id="prenom_pere"
                            value="{{ old('prenom_pere', $volet->prenom_pere) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="nom_pere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                        <input type="text" name="nom_pere" id="nom_pere" value="{{ old('nom_pere', $volet->nom_pere) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="age_pere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Âge</label>
                        <input type="number" name="age_pere" id="age_pere"
                            value="{{ old('age_pere', $volet->age_pere) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="domicile_pere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Domicile</label>
                        <input type="text" name="domicile_pere" id="domicile_pere"
                            value="{{ old('domicile_pere', $volet->domicile_pere) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="ethnie_pere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ethnie</label>
                        <input type="text" name="ethnie_pere" id="ethnie_pere"
                            value="{{ old('ethnie_pere', $volet->ethnie_pere) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="situation_matrimonial_pere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Situation
                            matrimoniale</label>
                        <select name="situation_matrimonial_pere" id="situation_matrimonial_pere"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option value="">-- Choisir --</option>
                            <option value="Marié" {{ old('situation_matrimonial_pere', $volet->
                                situation_matrimonial_pere) == 'Marié' ? 'selected' : '' }}>Marié</option>
                            <option value="Célibataire" {{ old('situation_matrimonial_pere', $volet->
                                situation_matrimonial_pere) == 'Célibataire' ? 'selected' : '' }}>Célibataire</option>
                            <option value="Divorcé" {{ old('situation_matrimonial_pere', $volet->
                                situation_matrimonial_pere) == 'Divorcé' ? 'selected' : '' }}>Divorcé</option>
                        </select>
                    </div>
                    <div>
                        <label for="niveau_instruction_pere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Niveau scolaire</label>
                        <input type="text" name="niveau_instruction_pere" id="niveau_instruction_pere"
                            value="{{ old('niveau_instruction_pere', $volet->niveau_instruction_pere) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="profession_pere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profession</label>
                        <input type="text" name="profession_pere" id="profession_pere"
                            value="{{ old('profession_pere', $volet->profession_pere) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                </div>
            </div>

            {{-- MÈRE --}}
            <div class="space-y-6">
                <h2
                    class="text-2xl font-bold text-blue-600 dark:text-blue-400 border-b-2 border-blue-300 dark:border-blue-700 pb-3 mb-6">
                    Informations sur la Mère</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="prenom_mere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                        <input type="text" name="prenom_mere" id="prenom_mere"
                            value="{{ old('prenom_mere', $volet->prenom_mere) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="nom_mere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                        <input type="text" name="nom_mere" id="nom_mere" value="{{ old('nom_mere', $volet->nom_mere) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="age_mere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Âge</label>
                        <input type="number" name="age_mere" id="age_mere"
                            value="{{ old('age_mere', $volet->age_mere) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="domicile_mere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Domicile</label>
                        <input type="text" name="domicile_mere" id="domicile_mere"
                            value="{{ old('domicile_mere', $volet->domicile_mere) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="ethnie_mere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ethnie</label>
                        <input type="text" name="ethnie_mere" id="ethnie_mere"
                            value="{{ old('ethnie_mere', $volet->ethnie_mere) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="situation_matrimonial_mere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Situation
                            matrimoniale</label>
                        <select name="situation_matrimonial_mere" id="situation_matrimonial_mere"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option value="">-- Choisir --</option>
                            <option value="Marié" {{ old('situation_matrimonial_mere', $volet->
                                situation_matrimonial_mere) == 'Marié' ? 'selected' : '' }}>Marié</option>
                            <option value="Célibataire" {{ old('situation_matrimonial_mere', $volet->
                                situation_matrimonial_mere) == 'Célibataire' ? 'selected' : '' }}>Célibataire</option>
                            <option value="Divorcé" {{ old('situation_matrimonial_mere', $volet->
                                situation_matrimonial_mere) == 'Divorcé' ? 'selected' : '' }}>Divorcé</option>
                        </select>
                    </div>
                    <div>
                        <label for="niveau_instruction_mere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Niveau scolaire</label>
                        <input type="text" name="niveau_instruction_mere" id="niveau_instruction_mere"
                            value="{{ old('niveau_instruction_mere', $volet->niveau_instruction_mere) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="profession_mere"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profession</label>
                        <input type="text" name="profession_mere" id="profession_mere"
                            value="{{ old('profession_mere', $volet->profession_mere) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div class="md:col-span-2">
                        <label for="nbreEINouvNee"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre d'enfants nés
                            vivants (y compris celui-ci)</label>
                        <input type="number" name="nbreEINouvNee" id="nbreEINouvNee"
                            value="{{ old('nbreEINouvNee', $volet->nbreEINouvNee) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                </div>
            </div>

            {{-- DÉCLARANT --}}
            <div class="space-y-6">
                <h2
                    class="text-2xl font-bold text-blue-600 dark:text-blue-400 border-b-2 border-blue-300 dark:border-blue-700 pb-3 mb-6">
                    Informations sur le Déclarant</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="prenom_declarant"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                        <input type="text" name="prenom_declarant" id="prenom_declarant"
                            value="{{ old('prenom_declarant', $volet->declarant->prenom_declarant) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="nom_declarant"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                        <input type="text" name="nom_declarant" id="nom_declarant"
                            value="{{ old('nom_declarant', $volet->declarant->nom_declarant) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="age_declarant"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Âge</label>
                        <input type="number" name="age_declarant" id="age_declarant"
                            value="{{ old('age_declarant', $volet->declarant->age_declarant) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="domicile_declarant"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Domicile</label>
                        <input type="text" name="domicile_declarant" id="domicile_declarant"
                            value="{{ old('domicile_declarant', $volet->declarant->domicile_declarant) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="telephone"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone</label>
                        <input type="text" name="telephone" id="telephone"
                            value="{{ old('telephone', $volet->declarant->telephone) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $volet->declarant->email) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div class="md:col-span-2">
                        <label for="ethnie_declarant"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ethnie</label>
                        <input type="text" name="ethnie_declarant" id="ethnie_declarant"
                            value="{{ old('ethnie_declarant', $volet->declarant->ethnie_declarant) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center mt-8 space-y-4 sm:space-y-0 sm:space-x-4">
                <button type="submit"
                    class="w-full sm:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-8 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition duration-300 ease-in-out transform hover:scale-105">
                    ✅ Mettre à jour
                </button>
                <a href="{{ route('hopital.dashboard') }}"
                    class="w-full sm:w-auto py-3 px-8 text-lg font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition duration-300 ease-in-out transform hover:scale-105">
                    Annuler
                </a>
            </div>
        </form>
    </div>

</body>

</html>