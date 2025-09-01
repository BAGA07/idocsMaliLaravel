@extends('layouts.presentation')

@section('title', 'Demander un Extrait d\'Acte - IdocsMali')

@section('content')

{{-- Section avec l'image en arrière-plan --}}
<section class="relative py-16 bg-gray-100 dark:bg-gray-900 overflow-hidden" style="min-height: 800px;"> {{-- Augmentez
    min-height si l'image est très grande ou si vous avez beaucoup de contenu --}}

    {{-- L'image d'arrière-plan --}}
    <img src="{{ asset('./images/img2.png') }}" {{-- REMPLACER PAR LE CHEMIN DE VOTRE IMAGE D'ARRIÈRE-PLAN --}}
        alt="Arrière-plan du formulaire MaliActes"
        class="absolute inset-0 w-full h-full object-cover opacity-70 dark:opacity-50"> {{-- Ajustez l'opacité selon vos
    préférences --}}

    {{-- Le conteneur du formulaire (au-dessus de l'image) --}}
    <div class="relative z-10 container mx-auto px-4"> {{-- z-10 pour placer le contenu au-dessus de l'image --}}
        <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-xl">
            <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-800 dark:text-white mb-8">
                Faire une demande de document
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

            <form method="POST" action="{{ route('demande.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Infos du demandeur --}}
                <div>
                    <label>Nom complet:</label>
                    <input type="text" name="nom_complet" value="{{ old('nom_complet') }}" required class="input-style">
                </div>

                <div>
                    <label>Email:</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="input-style">
                </div>

                <div>
                    <label>Téléphone:</label>
                    <input type="tel" name="telephone" value="{{ old('telephone') }}" required class="input-style">
                </div>

                {{-- Type de document demandé --}}
                <div>
                    <label>Type de document:</label>
                    <select name="type_document" required class="input-style">
                        <option value="Copie intégrale" {{ old('type_document')=='Copie intégrale' ? 'selected' : '' }}>
                            Copie intégrale</option>
                        <option value="Extrait de naissance" {{ old('type_document')=='Extrait de naissance'
                            ? 'selected' : '' }}>Extrait de naissance</option>
                        <option value="Acte de mariage" {{ old('type_document')=='Acte de mariage' ? 'selected' : '' }}>
                            Acte de mariage</option>
                    </select>
                </div>

                {{-- Infos de la personne concernée --}}
                <div>
                    <label>Nom de l'enfant:</label>
                    <input type="text" name="nom_enfant" value="{{ old('nom_enfant') }}" class="input-style">
                </div>

                <div>
                    <label>Prénom(s) de l'enfant:</label>
                    <input type="text" name="prenom_enfant" value="{{ old('prenom_enfant') }}" class="input-style">
                </div>

                <div>
                    <label>Date de l'évènement:</label>
                    <input type="date" name="date_evenement" value="{{ old('date_evenement') }}" class="input-style">
                </div>

                <div>
                    <label>Lieu de l'évènement:</label>
                    <input type="text" name="lieu_evenement" value="{{ old('lieu_evenement') }}" class="input-style">
                </div>

                {{-- Volet de naissance --}}
                <div>
                    <label>Numéro du volet de naissance:</label>
                    <input type="text" name="numero_volet_naissance" value="{{ old('numero_volet_naissance') }}"
                        class="input-style">
                </div>

                <div>
                    <label>Volet de déclaration:</label>
                    <select name="id_volet" class="input-style">
                        <option value="">-- Sélectionner --</option>
                        @foreach($volets as $volet)
                        <option value="{{ $volet->id_volet }}" {{ old('id_volet')==$volet->id_volet ? 'selected' : ''
                            }}>
                            {{ $volet->numero_volet }} - {{ $volet->date_declaration }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Informations complémentaires --}}
                <div>
                    <label>Informations complémentaires:</label>
                    <textarea name="informations_complementaires" rows="3"
                        class="input-style">{{ old('informations_complementaires') }}</textarea>
                </div>

                {{-- Justificatif --}}
                <div>
                    <label>Justificatif (PDF, JPG, PNG):</label>
                    <input type="file" name="justificatif" accept=".pdf,.jpg,.jpeg,.png" class="input-style">
                </div>

                <button type="submit" class="btn-style">Soumettre la demande</button>
            </form>

            {{-- Exemple de styles Tailwind --}}
            <style>
                .input-style {
                    @apply shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5;
                }

                .btn-style {
                    @apply w-full text-white bg-blue-600 hover: bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5;
                }
            </style>

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        toggleJustificatif();
    });

    function toggleJustificatif() {
        const typeDoc = document.getElementById('type_document').value;
        const justificatifDiv = document.getElementById('justificatifDiv');
        const justificatifInput = document.getElementById('justificatif');

        if (typeDoc === 'Acte de naissance') {
            justificatifDiv.classList.remove('hidden');
            justificatifInput.setAttribute('required', 'required');
        } else {
            justificatifDiv.classList.add('hidden');
            justificatifInput.removeAttribute('required');
            justificatifInput.value = '';
        }
    }
</script>

@endsection