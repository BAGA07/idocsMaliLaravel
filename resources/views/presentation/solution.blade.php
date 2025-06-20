<<<<<<< HEAD
@extends('layouts.presentation')
@section('links')
<link rel="stylesheet" href="{{ asset('gentelella/assets/cssPresentation/solution.css') }}">
@endsection
@section('content')
<header>
    <div class="container">
        <div class="header_wrapper">
            <div class="header_nav">
                <a href="#" class="nav_logo">
                    <!--<img src="{{ asset('gentelella/assets/cssPresentation/Idocs Mali.png') }}" alt="Logo IDOCS MALI"
                            class="logo" width="100" height="100"> -->
                </a>
                <div class="nav_items">
                    <a href="{{ route('presentation.index') }}" class="nav_btn">Accueil</a>
                    <a href="{{ route('presentation.solution') }}" class="nav_btn">Nos Solutions</a>
                    <a href="{{ route('login') }}" class="nav_btn">Se connecter</a>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="solutions_section">
    <div class="container">
        <h2 class="section_title">Nos Solutions Numériques</h2>
        <p class="section_description">
            Découvrez nos solutions innovantes pour faciliter la gestion des documents administratifs dans les
            mairies du Mali.
            Nous vous proposons des outils pour digitaliser, sécuriser et optimiser les démarches administratives.
        </p>
        <div class="solutions_list">
            <div class="solution_item">
                <h3>Gestion des Actes Civils</h3>
                <p>Numérisation des actes de naissance, mariage, décès et certificats pour une gestion plus rapide
                    et sécurisée.</p>
            </div>
            <div class="solution_item">
                <h3>Plateforme de Demandes en Ligne</h3>
                <p>Permet aux citoyens de faire leurs demandes d’actes en ligne, de suivre leur statut et d’obtenir
                    leurs documents sans se déplacer.</p>
            </div>
            <div class="solution_item">
                <h3>Système de Paiement Intégré</h3>
                <p>Intégration d’un système de paiement mobile pour simplifier les démarches de paiement des actes
                    administratifs.</p>
            </div>
            <div class="solution_item">
                <h3>Archivage Sécurisé</h3>
                <p>Une solution d’archivage électronique pour une conservation longue durée des documents
                    administratifs, accessible en tout temps.</p>
            </div>
        </div>
    </div>
</section>
@endsection
=======
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test Flowbite</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- ✅ Vite CSS et JS -->
</head>
<body class="p-10 bg-gray-100">

<button class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
  Bouton Tailwind
</button>

<button data-modal-target="demoModal" data-modal-toggle="demoModal" class="bg-green-600 text-white px-4 py-2 rounded">
  Ouvrir Modale
</button>

<div id="demoModal" tabindex="-1" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Modale Flowbite</h2>
        <p>Ceci est une modale !</p>
        <button data-modal-hide="demoModal" class="mt-4 bg-red-600 text-white px-4 py-2 rounded">
            Fermer
        </button>
    </div>
</div>



    <!-- ✅ Script JS de Flowbite (important pour le modal) -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@latest/dist/flowbite.min.js"></script>
</body>
</html>
>>>>>>> 98ce78432dfb49134b611cada640fcb8e87255c9
