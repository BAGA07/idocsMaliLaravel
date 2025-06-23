@extends('layouts.presentation')

@section('title', 'Choix du Type de Demande - e-Naissance Mali') {{-- Titre plus descriptif --}}

@section('content')

<section class="relative py-16 bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center">
    {{-- L'image d'arrière-plan --}}
    <img src="{{ asset('./images/img2.png') }}" alt="Arrière-plan MaliActes"
         class="absolute inset-0 w-full h-full object-cover opacity-70 dark:opacity-50">

    {{-- Le conteneur des options (au-dessus de l'image) --}}
    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 flex justify-center items-center h-full"> {{-- Ajout de flex et h-full pour centrer verticalement --}}
        <div class="max-w-3xl w-full bg-white dark:bg-gray-800 p-8 rounded-lg shadow-xl text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-10"> {{-- Augmentation du mb --}}
                Quel type de demande souhaitez-vous effectuer ? {{-- Reformulation pour plus de clarté --}}
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 lg:gap-10"> {{-- Ajustement des gaps pour un meilleur espacement --}}
                {{-- Option 1: Demande pour un nouveau-né --}}
                <a href="{{ route('demande.nouveau_ne.create') }}"
                   class="flex flex-col items-center justify-center p-6 sm:p-8 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105 min-h-[180px]"> {{-- Ajout de min-h pour uniformiser la hauteur des cartes --}}
                    {{-- Icône Flowbite : User Plus (pour un nouveau-né) --}}
                    <svg class="w-12 h-12 mb-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H4m12 0-4 4m4-4-4-4m3 8v5H7a3 3 0 0 1-3-3v-2m14-4V7a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2"/>
                    </svg>
                    <span class="text-xl font-semibold mt-2">Pour un nouveau-né</span>
                    <p class="text-sm mt-2 opacity-90">Obtenir l'acte de naissance d'un enfant déjà déclaré.</p> {{-- Correction de "declarer" en "déclaré" --}}
                </a>

                {{-- Option 2: Demande de copie d'extrait d'acte --}}
                <a href="{{ route('demande.copie_extrait.create') }}"
                   class="flex flex-col items-center justify-center p-6 sm:p-8 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105 min-h-[180px]"> {{-- Ajout de min-h --}}
                    {{-- Icône Flowbite : Document Text (pour une copie) --}}
                    <svg class="w-12 h-12 mb-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 3v4a1 1 0 0 1-1 1H5m4 8h6m-6 4h6m2-14v10a.97.97 0 0 1-.933 1H5.933A.97.97 0 0 1 5 18V7.083A.97.97 0 0 1 5.933 6H9.154a.928.928 0 0 0 .686-.293L12.914 3.2A.928.928 0 0 1 13.6 3h4.4A1.97 1.97 0 0 1 20 5v14a1.97 1.97 0 0 1-2 2H6a1.97 1.97 0 0 1-2-2V7.083A.97.97 0 0 1 4.933 6h4.167A.928.928 0 0 0 10 5.083Z"/>
                    </svg>
                    <span class="text-xl font-semibold mt-2">Copie d'extrait d'acte</span> {{-- Plus explicite --}}
                    <p class="text-sm mt-2 opacity-90">Obtenir une copie d'un acte de naissance existant (ou autre).</p> {{-- Correction et clarification --}}
                </a>

                {{-- Option 3: Informations sur la démarche --}}
                <a href="{{ route('presentation.la_demarche') }}"
                   class="flex flex-col items-center justify-center p-6 sm:p-8 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105 min-h-[180px]"> {{-- Ajout de min-h --}}
                    {{-- Icône Flowbite : Question Mark Circle (pour les informations) --}}
                    <svg class="w-12 h-12 mb-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.875 16.875h.008v.008h-.008v-.008ZM12 11.25V9a2.25 2.25 0 0 0-4.5 0v.625M17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0ZM12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z"/>
                    </svg>
                    <span class="text-xl font-semibold mt-2">Je n'ai pas d'informations</span> {{-- Légère reformulation --}}
                    <p class="text-sm mt-2 opacity-90">Découvrir la démarche à suivre pour vos requêtes.</p> {{-- Reformulation pour plus de généralité --}}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection