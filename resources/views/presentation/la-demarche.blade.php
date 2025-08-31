@extends('layouts.presentation')

{{-- Titre de la page clair et optimisé pour le SEO --}}
@section('title', 'La Démarche : Obtenir un Extrait d\'Acte de Naissance au Mali avec e-Naissance Mali')

@section('content')

{{-- Bannière avec image de fond, dégradé et titre --}}
<div class="relative bg-cover bg-center h-[350px] flex items-center justify-center text-white text-shadow-lg text-center text-4xl md:text-6xl font-extrabold"
     style="background-image: url('{{ asset('images/img1.png') }}');"> {{-- Utilisation de demarche.jpg --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div> {{-- Dégradé plus prononcé --}}
    <h1 class="relative z-10 p-4 leading-tight">Obtenir votre Extrait d'Acte de Naissance au Mali : La Démarche Simplifiée</h1> {{-- Titre plus engageant --}}
</div>

<div class="container mx-auto px-4 py-12 max-w-4xl">

    {{-- Introduction Générale à la Digitalisation --}}
    <div class="bg-white p-8 rounded-lg shadow-xl mb-10">
        <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mb-6 border-b-2 border-blue-500 pb-3">
            L'Extrait d'Acte de Naissance au Mali à l'Ère Numérique
        </h2>
        <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-4">
            Au Mali, l'extrait d'acte de naissance est le fondement de l'identité juridique. Conscients des défis liés aux démarches traditionnelles, **IdocsMali** a pour objectif de simplifier et de numériser le processus d'obtention et de suivi de votre extrait d'acte de naissance. Nous vous éclairons ici sur les différentes démarches possibles, désormais facilitées par notre plateforme en ligne.
        </p>
        <p class="text-lg lg:text-xl text-gray-700 leading-relaxed">
            Que vous soyez un jeune parent souhaitant récupérer l'extrait d'acte de votre nouveau-né, un citoyen ayant besoin d'une copie de votre extrait d'acte existant, ou en situation de non-déclaration, notre guide vous accompagnera pas à pas.
        </p>
    </div>

                {{-- Section 1: Demande d'Extrait d'Acte de Naissance pour un Nouveau-né (Déclaration déjà faite) --}}
    <div class="bg-blue-50 p-8 rounded-lg shadow-xl mb-10 border border-blue-200 flex flex-col md:flex-row items-center">
        <div class="md:w-2/3 md:pr-8">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-blue-800 mb-6 border-b-2 border-blue-400 pb-3">
                1. Demander l'Extrait d'Acte de Naissance d'un Nouveau-né
            </h2>
            <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-4">
                Si la naissance de votre enfant a déjà été déclarée, **IdocsMali** vous permet de **demander facilement l'établissement ou la récupération de son extrait d'acte de naissance officiel** en ligne. Cette étape cruciale finalise l'enregistrement de votre enfant auprès de l'état civil.
            </p>
            <ul class="list-disc list-inside text-lg lg:text-xl text-gray-700 space-y-3 pl-4 mb-4">
                <li>
                    <strong class="font-semibold text-blue-700">Information Cruciale :</strong> Vous aurez besoin du <strong class="font-semibold">numéro du volet (ou extrait provisoire) fourni par l'agent d'état civil à la maternité/centre de santé</strong>. Une photo de ce volet sera également demandée.
                </li>
            </ul>
            <a href="{{ route('demande.nouveau_ne.guide') }}" class="inline-flex items-center text-blue-700 hover:text-blue-900 font-semibold transition duration-150 ease-in-out">
                Voir plus et Commencer ma demande <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path></svg>
            </a>
        </div>
        <div class="md:w-1/3 mt-6 md:mt-0 flex justify-center items-center">
            {{-- Remplacez 'acte_naissance_nouveau_ne.jpg' par le nom de votre image --}}
            <img src="{{ asset('images/nouveau.png') }}" alt="Extrait d'acte de naissance nouveau-né" class="rounded-lg shadow-md object-cover max-h-64">
        </div>
    </div>

                {{-- Section 2: Demander une Copie Numérique d'un Extrait d'Acte de Naissance Existant --}}
    <div class="bg-green-50 p-8 rounded-lg shadow-xl mb-10 border border-green-200 flex flex-col md:flex-row items-center">
        <div class="md:w-2/3 md:pr-8">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-green-800 mb-6 border-b-2 border-green-400 pb-3">
                2. Demande de Copie d'un Extrait d'Acte de Naissance Existant
            </h2>
            <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-4">
                Si un extrait d'acte de naissance a déjà été établi et enregistré, **IdocsMali** simplifie la demande de sa copie intégrale ou d'un extrait. Cette démarche est souvent nécessaire pour des besoins administratifs (passeport, carte d'identité, scolarisation, etc.).
            </p>
            <ul class="list-disc list-inside text-lg lg:text-xl text-gray-700 space-y-3 pl-4 mb-4">
                <li>
                    <strong class="font-semibold text-green-700">Informations Indispensables :</strong> Vous devez disposer d'informations précises sur l'acte original : <strong class="font-semibold">nom et prénom de la personne concernée, sa date et son lieu de naissance</strong>.
                </li>
            </ul>
            <a href="{{ route('demande.copie_extrait.guide') }}" class="inline-flex items-center text-green-700 hover:text-green-900 font-semibold transition duration-150 ease-in-out">
                Voir plus et Demander une copie d'extrait d'acte <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path></svg>
            </a>
        </div>
        <div class="md:w-1/3 mt-6 md:mt-0 flex justify-center items-center">
            {{-- Remplacez 'copie_acte_naissance.jpg' par le nom de votre image --}}
            <img src="{{ asset('images/copie.png') }}" alt="Copie d'un extrait d'acte de naissance" class="rounded-lg shadow-md object-cover max-h-64">
        </div>
    </div>

    {{-- Section 3: Guider la Demande par Jugement Supplétif --}}
    <div class="bg-red-50 p-8 rounded-lg shadow-xl mb-10 border border-red-200 flex flex-col md:flex-row items-center">
        <div class="md:w-2/3 md:pr-8">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-red-800 mb-6 border-b-2 border-red-400 pb-3">
                3. Procédure par Jugement Supplétif
            </h2>
            <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-4">
                Le <strong class="font-semibold text-red-700">jugement supplétif d'acte de naissance</strong> est une procédure judiciaire fondamentale au Mali. Il est requis lorsque la naissance n'a jamais été déclarée (absence totale d'acte), ou lorsque l'acte original a été irrémédiablement perdu sans aucune référence.
            </p>
            <ul class="list-disc list-inside text-lg lg:text-xl text-gray-700 space-y-3 pl-4 mb-4">
                <li>
                    <strong class="font-semibold text-red-700">La Démarche :</strong> Cette procédure nécessite de s'adresser au tribunal compétent pour obtenir une décision de justice.
                </li>
            </ul>
            <a href="{{ route('demande.jugement_suppletif.guide') }}" class="inline-flex items-center text-red-700 hover:text-red-900 font-semibold transition duration-150 ease-in-out">
                Voir plus sur le jugement supplétif <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path></svg>
            </a>
        </div>
        <div class="md:w-1/3 mt-6 md:mt-0 flex justify-center items-center">
            {{-- Remplacez 'jugement_suppletif.jpg' par le nom de votre image --}}
            <img src="{{ asset('images/jugement.png') }}" alt="Jugement supplétif d'extrait d'acte de naissance" class="rounded-lg shadow-md object-cover max-h-64">
        </div>
    </div>

    {{-- Section Conclusion et Appel à l'Action --}}
    <div class="bg-gray-100 p-8 rounded-lg shadow-xl border border-gray-200">
        <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mb-6 border-b-2 border-gray-400 pb-3">
            **IdocsMali** : Votre Partenaire pour des Démarches Simplifiées
        </h2>
        <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-4">
            Notre plateforme a été conçue pour vous accompagner et simplifier l'ensemble des démarches liées à l'extrait d'acte de naissance au Mali. Nous vous guidons pas à pas dans la préparation de votre dossier en ligne, en vous indiquant précisément les informations et documents nécessaires pour chaque type de demande.
        </p>
        <p class="text-lg lg:text-xl text-gray-700 leading-relaxed">
            Notre objectif est de faciliter votre interaction avec les services d'état civil maliens et de rendre l'accès à votre identité juridique plus rapide, plus transparente et plus accessible.
        </p>
        <p class="text-center mt-8">
            <a href="{{ route('demande.choix_type') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-xl font-bold rounded-md shadow-lg text-white bg-indigo-700 hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:scale-105">
                Commencer ma demande maintenant
                <svg class="ml-3 -mr-1 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            </a>
        </p>
    </div>
</div>

@endsection