@extends('layouts.presentation')

@section('title', 'Demande Copie Extrait Acte - IdocsMali')

@section('content')

<section class="relative py-16 bg-gray-100 dark:bg-gray-900 overflow-hidden" style="min-height: 800px;">
    {{-- L'image d'arrière-plan --}}
    <img src="{{ asset('./images/img2.png') }}" alt="Arrière-plan du formulaire MaliActes"
        class="absolute inset-0 w-full h-full object-cover opacity-70 dark:opacity-50">

    {{-- Le conteneur du formulaire (au-dessus de l'image) --}}
    <div class="relative z-10 container mx-auto px-4">
        <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-xl">
            {{-- Bouton de retour à la page de choix --}}
            <div class="mb-6">
                <a href="{{ route('demande.choix_type') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75 transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour aux choix des demandes
                </a>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-800 dark:text-white mb-8">
                Demande de copie d'extrait d'acte
            </h1>

            {{-- NOUVEAU BLOC SweetAlert pour le succès simple --}}
            @if(session('numero_suivi_succes'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Demande soumise avec succès !',
                        html: `
                            <p class="mt-2 text-lg">Votre numéro de suivi est : <strong class="text-blue-600">{{ session('numero_suivi_succes') }}</strong></p>
                            <p class="mt-3 text-sm">Nous vous contacterons par e-mail concernant l'avancement de votre demande.</p>
                            <p class="mt-4">
                                <a href="{{ route('presentation.suivre_demande') }}" class="text-blue-500 hover:underline">
                                    Cliquez ici pour suivre votre demande
                                </a>
                            </p>
                        `,
                        confirmButtonColor: '#2563EB'
                    });
                </script>
            @endif
            {{-- Message d'erreur général --}}
            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Erreur !</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            {{-- Message de succès simple (fallback si SweetAlert ne fonctionne pas) --}}
            @if(session('numero_suivi_succes'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Succès !</strong>
                <span class="block sm:inline">Votre demande a été soumise avec succès. Numéro de suivi : <strong>{{ session('numero_suivi_succes') }}</strong></span>
            </div>
            @endif

            {{-- Votre formulaire --}}
            <form method="POST" action="{{ route('demande.copie_extrait.store') }}" enctype="multipart/form-data"
                class="space-y-6" id="copieExtraitForm" novalidate>
                @csrf



                {{-- Étape 1: Informations du demandeur --}}
                <div id="step1" class="form-step">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Étape 1: Informations du demandeur
                    </h2>
                    <div>
                        <label for="nom_demandeur"
                            class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Nom:</label>
                        <input type="text" name="nom_demandeur" id="nom_demandeur"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('nom_demandeur') }}">
                        @error('nom_demandeur')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="prenom_demandeur"
                            class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Prénom(s):</label>
                        <input type="text" name="prenom_demandeur" id="prenom_demandeur"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('prenom_demandeur') }}">
                        @error('prenom_demandeur')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email_demandeur"
                            class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Email:</label>
                        <input type="email" name="email_demandeur" id="email_demandeur"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('email_demandeur') }}">
                        @error('email_demandeur')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="telephone_demandeur"
                            class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Téléphone:</label>
                        <input type="tel" name="telephone_demandeur" id="telephone_demandeur"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('telephone_demandeur') }}">
                        @error('telephone_demandeur')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="commune_demandeur"
                            class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Commune:</label>
                        <select name="commune_demandeur" id="commune_demandeur"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Sélectionnez votre commune</option>
                            @foreach($communes as $commune)
                                <option value="{{ $commune->id }}" {{ old('commune_demandeur') == $commune->id ? 'selected' : '' }}>
                                    {{ $commune->nom_commune }} - {{ $commune->cercle }} ({{ $commune->region }})
                                </option>
                            @endforeach
                        </select>
                        @error('commune_demandeur')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="button" onclick="nextStep()"
                            class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition duration-300 ease-in-out transform hover:scale-105">
                            Suivant <svg class="w-4 h-4 ml-2 inline-block" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Étape 2: Informations de l'acte demandé --}}
                <div id="step2" class="form-step hidden">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mt-8 mb-4">Étape 2: Détails de la demande
                    </h2>

                    {{-- Champ: Nombre de copies --}}
                    <div>
                        <label for="nombre_copie"
                            class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Nombre de
                            copies:</label>
                        <input type="number" name="nombre_copie" id="nombre_copie" min="1"
                            value="{{ old('nombre_copie', 1) }}"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('nombre_copie')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="justificatif"
                            class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Pièce justificative
                            (Photo de l'extrait d'acte existant - JPG, PNG, PDF):</label>
                        <input type="file" name="justificatif" id="justificatif"
                            accept=".pdf,.jpg,.jpeg,.png"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Veuillez
                            télécharger une photo claire de l'extrait de naissance existant.</p>
                        @error('justificatif')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="informations_complementaires_copie"
                            class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Informations
                            complémentaires:</label>
                        <textarea name="informations_complementaires_copie" id="informations_complementaires_copie"
                            rows="4"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('informations_complementaires_copie') }}</textarea>
                        @error('informations_complementaires_copie')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between mt-6">
                        <button type="button" onclick="prevStep()"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75 transition duration-150 ease-in-out">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Précédent
                        </button>
                        {{-- CE BOUTON EST DE TYPE SUBMIT, IL ENVERRA LE FORMULAIRE --}}
                        <button type="submit" id="submitBtn"
                            class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 transition duration-300 ease-in-out transform hover:scale-105">
                            Soumettre la demande
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    let currentStep = 1;

    function showStep(stepNum) {
        document.querySelectorAll('.form-step').forEach(step => {
            step.classList.add('hidden');
        });
        document.getElementById(`step${stepNum}`).classList.remove('hidden');
        currentStep = stepNum;
    }

    function nextStep() {
        // Valider l'étape 1 avant de passer à l'étape 2
        if (currentStep === 1) {
            const nomDemandeur = document.getElementById('nom_demandeur');
            const prenomDemandeur = document.getElementById('prenom_demandeur');
            const emailDemandeur = document.getElementById('email_demandeur');
            const telephoneDemandeur = document.getElementById('telephone_demandeur');
            const communeDemandeur = document.getElementById('commune_demandeur');

            // Simple validation client-side pour s'assurer que les champs requis de l'étape 1 sont remplis
            if (!nomDemandeur.value || !prenomDemandeur.value || !emailDemandeur.value || !telephoneDemandeur.value || !communeDemandeur.value) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Champs manquants !',
                    text: 'Veuillez remplir tous les champs obligatoires de l\'étape 1.',
                    confirmButtonColor: '#FBBF24'
                });
                return; // Empêche de passer à l'étape suivante
            }
        }
        // Passe simplement à l'étape suivante, le bouton "Soumettre" s'occupe de la soumission finale
        showStep(currentStep + 1);
    }

    function prevStep() {
        showStep(currentStep - 1);
    }

    // Afficher la première étape au chargement de la page
    document.addEventListener('DOMContentLoaded', () => {
        showStep(1);

        // Gestion simple de la soumission du formulaire
        const form = document.getElementById('copieExtraitForm');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', function(e) {
            // Désactiver le bouton pour éviter les doubles soumissions
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Soumission en cours...';

            // Laisser le formulaire se soumettre normalement
            return true;
        });

        // Si des erreurs de validation Laravel existent, revenir à l'étape correspondante
        @if($errors->any())
            const errorFieldsStep1 = ['nom_demandeur', 'prenom_demandeur', 'email_demandeur', 'telephone_demandeur', 'commune_demandeur'];
            const errorFieldsStep2 = ['nombre_copie', 'justificatif', 'informations_complementaires_copie'];

            let hasErrorInStep1 = false;
            let hasErrorInStep2 = false;

            @foreach($errors->keys() as $errorField)
                if (errorFieldsStep1.includes('{{ $errorField }}')) {
                    hasErrorInStep1 = true;
                } else if (errorFieldsStep2.includes('{{ $errorField }}')) {
                    hasErrorInStep2 = true;
                }
            @endforeach

            if (hasErrorInStep2) {
                showStep(2); // Si l'erreur est à l'étape 2, afficher l'étape 2
            } else {
                showStep(1); // Par défaut, afficher l'étape 1 (ou si l'erreur est à l'étape 1)
            }

            Swal.fire({
                icon: 'error',
                title: 'Erreur de validation !',
                text: 'Veuillez corriger les erreurs dans le formulaire.',
                confirmButtonColor: '#EF4444'
            });
        @endif
    });
</script>

@endsection
