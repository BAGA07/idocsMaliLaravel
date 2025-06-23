@extends('layouts.presentation')

@section('title', 'Demande Acte Nouveau-né Déclaré - e-Naissance Mali')

@section('content')

<section class="relative py-16 bg-gray-100 dark:bg-gray-900 overflow-hidden"
    style="min-height: 800px;">
    {{-- L'image d'arrière-plan --}}
    <img src="{{ asset('./images/img2.png') }}" alt="Arrière-plan du formulaire MaliActes"
         class="absolute inset-0 w-full h-full object-cover opacity-70 dark:opacity-50">

    {{-- Le conteneur du formulaire (au-dessus de l'image) --}}
    <div class="relative z-10 container mx-auto px-4">
        <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-xl">
            {{-- Bouton de retour à la page de choix --}}
            <div class="mb-6">
                <a href="{{ route('demande.choix_type') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75 transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Retour aux choix des demandes
                </a>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-800 dark:text-white mb-8">
                Demande d'acte de naissance (pour nouveau-né déjà déclaré)
            </h1>

            {{-- Message de succès (SweetAlert) --}}
            @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Succès !',
                    text: '{{ session("success") }}',
                    confirmButtonColor: '#2563EB'
                });
            </script>
            @endif

            {{-- Message d'erreur général (si besoin) --}}
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Erreur !</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('demande.nouveau_ne.store') }}" enctype="multipart/form-data" class="space-y-6" id="nouveauNeForm">
                @csrf

                {{-- Étape 1: Informations du demandeur --}}
                <div id="step1" class="form-step">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Étape 1: Informations du demandeur</h2>
                    <div>
                        <label for="nom_demandeur" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Nom complet du demandeur:</label>
                        <input type="text" name="nom_demandeur" id="nom_demandeur"
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{ old('nom_demandeur') }}" required>
                        @error('nom_demandeur')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email_demandeur" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Email du demandeur:</label>
                        <input type="email" name="email_demandeur" id="email_demandeur"
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{ old('email_demandeur') }}" required>
                        @error('email_demandeur')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="telephone_demandeur" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Téléphone du demandeur:</label>
                        <input type="tel" name="telephone_demandeur" id="telephone_demandeur"
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{ old('telephone_demandeur') }}" required>
                        @error('telephone_demandeur')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="button" onclick="nextStep()" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition duration-300 ease-in-out transform hover:scale-105">
                            Suivant <svg class="w-4 h-4 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </div>

                {{-- Étape 2: Informations sur l'acte du nouveau-né --}}
                <div id="step2" class="form-step hidden">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Étape 2: Informations sur l'acte du nouveau-né</h2>

                    <div>
                        <label for="nom_enfant" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Nom de l'enfant:</label>
                        <input type="text" name="nom_enfant" id="nom_enfant"
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{ old('nom_enfant') }}"> {{-- Removed required here to allow JS validation --}}
                        @error('nom_enfant')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="prenom_enfant" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Prénom(s) de l'enfant:</label>
                        <input type="text" name="prenom_enfant" id="prenom_enfant"
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{ old('prenom_enfant') }}"> {{-- Removed required --}}
                        @error('prenom_enfant')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="date_naissance" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Date de naissance de l'enfant:</label>
                        <input type="date" name="date_naissance" id="date_naissance"
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{ old('date_naissance') }}"> {{-- Removed required --}}
                        @error('date_naissance')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="lieu_naissance" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Lieu de naissance de l'enfant:</label>
                        <input type="text" name="lieu_naissance" id="lieu_naissance"
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{ old('lieu_naissance') }}"> {{-- Removed required --}}
                        @error('lieu_naissance')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="hopital_declaration" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Hôpital de déclaration (si connu):</label>
                        <input type="text" name="hopital_declaration" id="hopital_declaration"
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{ old('hopital_declaration') }}">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="hopital_help">Nom de l'hôpital où la naissance a été déclarée initialement.</p>
                        @error('hopital_declaration')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="numero_volet_naissance" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Numéro de volet (si connu):</label>
                        <input type="text" name="numero_volet_naissance" id="numero_volet_naissance"
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{ old('numero_volet_naissance') }}">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="volet_help">Facultatif, mais aide à retrouver l'acte rapidement.</p>
                        @error('numero_volet_naissance')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="justificatif_demande" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Pièce justificative (Ex: Certificat de déclaration - PDF, JPG, PNG):</label>
                        <input type="file" name="justificatif_demande" id="justificatif_demande" accept=".pdf,.jpg,.jpeg,.png"
                               class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Facultatif, mais peut accélérer le traitement (ex: reçu de déclaration).</p>
                        @error('justificatif_demande')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="informations_complementaires_nouveau_ne" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Informations complémentaires:</label>
                        <textarea name="informations_complementaires_nouveau_ne" id="informations_complementaires_nouveau_ne" rows="4"
                                  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('informations_complementaires_nouveau_ne') }}</textarea>
                        @error('informations_complementaires_nouveau_ne')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between mt-6">
                        <button type="button" onclick="prevStep()" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75 transition duration-150 ease-in-out">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Précédent
                        </button>
                        <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 transition duration-300 ease-in-out transform hover:scale-105">
                            Soumettre la demande d'acte
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
        // Valider l'étape actuelle avant de passer à la suivante
        if (currentStep === 1) {
            const nomDemandeur = document.getElementById('nom_demandeur');
            const emailDemandeur = document.getElementById('email_demandeur');
            const telephoneDemandeur = document.getElementById('telephone_demandeur');

            if (!nomDemandeur.value || !emailDemandeur.value || !telephoneDemandeur.value) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Champs manquants !',
                    text: 'Veuillez remplir tous les champs obligatoires de l\'étape 1.',
                    confirmButtonColor: '#FBBF24'
                });
                return; // Empêche de passer à l'étape suivante
            }
        }
        showStep(currentStep + 1);
    }

    function prevStep() {
        showStep(currentStep - 1);
    }

    // Afficher la première étape au chargement de la page
    document.addEventListener('DOMContentLoaded', () => {
        showStep(1);

        // Si des erreurs de validation Laravel existent, revenir à l'étape correspondante
        @if($errors->any())
            const errorFieldsStep1 = ['nom_demandeur', 'email_demandeur', 'telephone_demandeur'];
            const errorFieldsStep2 = ['nom_enfant', 'prenom_enfant', 'date_naissance', 'lieu_naissance', 'hopital_declaration', 'numero_volet_naissance', 'justificatif_demande', 'informations_complementaires_nouveau_ne'];

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