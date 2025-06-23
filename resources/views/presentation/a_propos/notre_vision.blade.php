@extends('layouts.presentation')

@section('title', 'Notre Vision - e-Naissance Mali')

@section('content')

<section class="py-16 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-4 max-w-4xl">
        <h1 class="text-4xl md:text-5xl font-bold text-center text-gray-900 dark:text-white mb-10">
            Notre Vision pour un Mali Connecté
        </h1>

        {{-- L'image avec le texte "Notre Vision pour un Mali Connecté" --}}
        <div class="mb-8">
           {{-- Correction du chemin de l'asset --}}
           <img src="{{ asset('images/notre_vision2.png') }}"
             alt="Notre Vision pour un Mali Connecté"
             class="mx-auto w-full md:w-3/4 lg:w-2/3 rounded-lg shadow-lg" />
         </div>

        <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
            Chez e-Naissance Mali, nous rêvons d'un Mali où l'accès aux **documents fondamentaux d'identité** est simplifié, transparent et équitable pour tous les citoyens, où qu'ils se trouvent. Notre vision est de bâtir un pont numérique entre l'administration et le citoyen, en tirant parti des technologies modernes pour offrir une expérience sans friction.
        </p>
        <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
            Nous aspirons à un système où l'obtention d'un **acte de naissance** n'est plus une source de stress ou de perte de temps, mais une démarche simple et rapide, accessible depuis un téléphone ou un ordinateur. Cela permettra non seulement de faciliter la vie des Maliens, mais aussi de renforcer la fiabilité et la sécurité des **registres de naissances** du pays.
        </p>
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 mt-12">Nos Objectifs Clés :</h2>
        <ul class="list-disc list-inside text-lg text-gray-700 dark:text-gray-300 space-y-3">
            <li><span class="font-semibold text-blue-600 dark:text-blue-400">Accessibilité Universelle :</span> Permettre à chaque Malien, y compris ceux de la diaspora, d'accéder à leurs **actes de naissance**.</li>
            <li><span class="font-semibold text-blue-600 dark:text-blue-400">Simplification Administrative :</span> Réduire la bureaucratie et les délais grâce à des processus optimisés.</li>
            <li><span class="font-semibold text-blue-600 dark:text-blue-400">Sécurité des Données :</span> Assurer la protection et la confidentialité des informations personnelles des citoyens.</li>
            <li><span class="font-semibold text-blue-600 dark:text-blue-400">Fiabilité des Registres :</span> Contribuer à la numérisation et à la sécurisation des **registres de naissances** nationaux.</li>
            <li><span class="font-semibold text-blue-600 dark:text-blue-400">Transparence :</span> Offrir un suivi clair et traçable de chaque demande.</li>
        </ul>

        <div class="text-center mt-12">
            <p class="text-xl font-semibold text-gray-800 dark:text-gray-200">Ensemble, construisons l'avenir numérique des **services liés à l'identité** au Mali.</p>
        </div>
    </div>
</section>

@endsection