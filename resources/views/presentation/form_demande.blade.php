@extends('layouts.presentation')

@section('title', 'Demander un Acte - IdocsMali')

@section('content')

{{-- Section avec l'image en arrière-plan --}}
<section class="relative py-16 bg-gray-100 dark:bg-gray-900 overflow-hidden"
    style="min-height: 800px;"> {{-- Augmentez min-height si l'image est très grande ou si vous avez beaucoup de contenu --}}

    {{-- L'image d'arrière-plan --}}
    <img src="{{ asset('./images/img2.png') }}" {{-- REMPLACER PAR LE CHEMIN DE VOTRE IMAGE D'ARRIÈRE-PLAN --}}
         alt="Arrière-plan du formulaire MaliActes"
         class="absolute inset-0 w-full h-full object-cover opacity-70 dark:opacity-50"> {{-- Ajustez l'opacité selon vos préférences --}}

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

                <div>
                    <label for="nom" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Nom complet:</label>
                    <input type="text" name="nom" id="nom"
                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           value="{{ old('nom') }}" required>
                    @error('nom')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Email:</label>
                    <input type="email" name="email" id="email"
                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="telephone" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Téléphone:</label>
                    <input type="tel" name="telephone" id="telephone"
                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           value="{{ old('telephone') }}" required>
                    @error('telephone')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type_document" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Type de document:</label>
                    <select name="type_document" id="type_document" required onchange="toggleJustificatif()"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">-- Choisir un type --</option>
                        <option value="Acte de naissance" {{ old('type_document') == 'Acte de naissance' ? 'selected' : '' }}>Acte de naissance</option>
                        <option value="Actes de mariage" {{ old('type_document') == 'Actes de mariage' ? 'selected' : '' }}>Actes de mariage</option>
                        <option value="Carte d'identité" {{ old('type_document') == 'Carte d\'identité' ? 'selected' : '' }}>Carte d'identité</option>
                    </select>
                    @error('type_document')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div id="justificatifDiv" class="justificatif-div {{ old('type_document') == 'Acte de naissance' ? '' : 'hidden' }}">
                    <label for="justificatif" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Justificatif (PDF, JPG, PNG):</label>
                    <input type="file" name="justificatif" id="justificatif" accept=".pdf,.jpg,.jpeg,.png"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none
                                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0 file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @error('justificatif')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="informations_complementaires" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Informations complémentaires:</label>
                    <textarea name="informations_complementaires" id="informations_complementaires" rows="4"
                              class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                     dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('informations_complementaires') }}</textarea>
                    @error('informations_complementaires')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center
                               dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition duration-300 ease-in-out transform hover:scale-105">
                    Soumettre la demande
                </button>
            </form>
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