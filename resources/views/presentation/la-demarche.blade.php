@extends('layouts.presentation')

{{-- Titre de la page clair et optimisé pour le SEO --}}
@section('title', 'La Démarche : Obtenir un Acte de Naissance au Mali avec e-Naissance Mali')

@section('content')

{{-- Bannière avec image de fond, dégradé et titre --}}
<div class="relative bg-cover bg-center h-[350px] flex items-center justify-center text-white text-shadow-lg text-center text-4xl md:text-6xl font-extrabold"
     style="background-image: url('{{ asset('images/img1.png') }}');"> {{-- Utilisation de demarche.jpg --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div> {{-- Dégradé plus prononcé --}}
    <h1 class="relative z-10 p-4 leading-tight">Obtenir votre Acte de Naissance au Mali : La Démarche Simplifiée</h1> {{-- Titre plus engageant --}}
</div>

<div class="container mx-auto px-4 py-12 max-w-4xl">

    {{-- Introduction Générale à la Digitalisation --}}
    <div class="bg-white p-8 rounded-lg shadow-xl mb-10">
        <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mb-6 border-b-2 border-blue-500 pb-3">
            L'Acte de Naissance au Mali à l'Ère Numérique
        </h2>
        <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-4">
            Au Mali, l'acte de naissance est le fondement de l'identité juridique. Conscients des défis liés aux démarches traditionnelles, **e-Naissance Mali** a pour objectif de simplifier et de digitaliser le processus d'obtention et de suivi de votre acte de naissance. Nous vous éclairons ici sur les différentes démarches possibles, désormais facilitées par notre plateforme en ligne.
        </p>
        <p class="text-lg lg:text-xl text-gray-700 leading-relaxed">
            Que vous soyez un jeune parent souhaitant récupérer l'acte de votre nouveau-né, un citoyen ayant besoin d'une copie de votre acte existant, ou en situation de non-déclaration, notre guide vous accompagnera pas à pas.
        </p>
    </div>

    {{-- Section 1: Demande d'Acte de Naissance pour un Nouveau-né (Déclaration déjà faite) --}}
    <div class="bg-blue-50 p-8 rounded-lg shadow-xl mb-10 border border-blue-200">
        <h2 class="text-3xl lg:text-4xl font-extrabold text-blue-800 mb-6 border-b-2 border-blue-400 pb-3">
            1. Demander l'Acte de Naissance d'un Nouveau-né (Déclaration Préalable Effectuée)
        </h2>
        <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-4">
            Si la naissance de votre enfant a déjà été déclarée à la maternité ou au centre de santé par un agent d'état civil, **e-Naissance Mali** vous permet de **demander facilement l'établissement ou la récupération de son acte de naissance officiel** en ligne. Cette étape cruciale finalise l'enregistrement de votre enfant auprès de l'état civil.
        </p>
        <ul class="list-disc list-inside text-lg lg:text-xl text-gray-700 space-y-3 pl-4">
            <li>
                <strong class="font-semibold text-blue-700">Information Cruciale pour votre Demande :</strong> Pour initier la démarche sur notre plateforme, vous aurez besoin du <strong class="font-semibold">numéro du volet (ou extrait provisoire) fourni par l'agent d'état civil à la maternité/centre de santé</strong>. Une photo de ce volet sera également demandée.
            </li>
            <li>
                Vous devrez également fournir quelques informations complémentaires sur le nouveau-né et les parents pour faciliter la recherche et l'établissement de l'acte.
            </li>
            <li>
                Cette démarche vous permet d'obtenir rapidement l'acte de naissance de votre enfant, sans avoir à vous déplacer.
            </li>
        </ul>
        <p class="mt-6 text-lg lg:text-xl text-gray-700 leading-relaxed">
            <a href="{{ route('demande.nouveau_ne.create') }}" class="inline-flex items-center text-blue-700 hover:text-blue-900 font-semibold transition duration-150 ease-in-out">
                Demander l'acte de naissance de mon nouveau-né <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path></svg>
            </a>
        </p>
    </div>

    {{-- Section 2: Demander une Copie Numérique d'un Acte de Naissance Existant --}}
    <div class="bg-green-50 p-8 rounded-lg shadow-xl mb-10 border border-green-200">
        <h2 class="text-3xl lg:text-4xl font-extrabold text-green-800 mb-6 border-b-2 border-green-400 pb-3">
            2. Demande de Copie d'un Acte de Naissance Existant
        </h2>
        <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-4">
            Si un acte de naissance a déjà été établi et enregistré, **e-Naissance Mali** simplifie la demande de sa copie intégrale ou d'un extrait. Cette démarche, souvent nécessaire pour des besoins administratifs (passeport, carte d'identité, scolarisation, etc.), est désormais plus accessible et rapide.
        </p>
        <ul class="list-disc list-inside text-lg lg:text-xl text-gray-700 space-y-3 pl-4">
            <li>
                <strong class="font-semibold text-green-700">Informations Indispensables :</strong> Pour obtenir une copie via notre service, vous devez impérativement disposer d'informations précises sur l'acte original : le <strong class="font-semibold">nom et prénom de la personne concernée, sa date et son lieu de naissance</strong>.
            </li>
            <li>
                <strong class="font-semibold text-green-700">Accélérer votre demande :</strong> Une photo ou un scan de l'acte original, ou la connaissance du **numéro de l'acte**, sont des atouts majeurs qui peuvent accélérer considérablement le traitement de votre demande.
            </li>
            <li>
                Si vous ne possédez aucune de ces informations, veuillez consulter la section suivante sur le jugement supplétif.
            </li>
        </ul>
        <p class="mt-6 text-lg lg://text-xl text-gray-700 leading-relaxed">
            <a href="{{ route('demande.copie_extrait.create') }}" class="inline-flex items-center text-green-700 hover:text-green-900 font-semibold transition duration-150 ease-in-out">
                Demander une copie d'extrait d'acte <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path></svg>
            </a>
        </p>
    </div>

    {{-- Section 3: Guider la Demande par Jugement Supplétif --}}
    <div class="bg-red-50 p-8 rounded-lg shadow-xl mb-10 border border-red-200">
        <h2 class="text-3xl lg:text-4xl font-extrabold text-red-800 mb-6 border-b-2 border-red-400 pb-3">
            3. Procédure par Jugement Supplétif (En cas d'Absence Totale d'Acte)
        </h2>
        <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-4">
            Le <strong class="font-semibold text-red-700">jugement supplétif d'acte de naissance</strong> est une procédure judiciaire fondamentale au Mali. Il est requis lorsque la naissance n'a jamais été déclarée dans les délais légaux (absence totale d'acte), ou lorsque l'acte original a été irrémédiablement perdu sans aucune référence permettant sa récupération.
        </p>
        <ul class="list-disc list-inside text-lg lg:text-xl text-gray-700 space-y-3 pl-4">
            <li>
                <strong class="font-semibold text-red-700">La Démarche :</strong> Cette procédure nécessite de s'adresser au tribunal compétent pour obtenir une décision de justice qui tiendra lieu d'acte de naissance.
            </li>
            <li>
                <strong class="font-semibold text-red-700">Notre Accompagnement :</strong> Bien que **e-Naissance Mali** ne traite pas directement cette demande judiciaire, nous vous fournissons un guide détaillé et des conseils pour comprendre les preuves nécessaires (témoignages, certificats de non-inscription, etc.) et préparer votre dossier pour cette procédure.
            </li>
            <li>
                C'est la voie à suivre si vous n'avez <strong class="font-semibold text-red-700">aucune information ni aucune trace d'un acte de naissance existant</strong>.
            </li>
        </ul>
        <p class="mt-6 text-lg lg://text-xl text-gray-700 leading-relaxed">
            Bien que plus longue, cette procédure est cruciale pour rétablir votre identité juridique. **e-Naissance Mali** est là pour vous guider à travers ce processus.
        </p>
    </div>

    {{-- Section Conclusion et Appel à l'Action --}}
    <div class="bg-gray-100 p-8 rounded-lg shadow-xl border border-gray-200">
        <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mb-6 border-b-2 border-gray-400 pb-3">
            **e-Naissance Mali** : Votre Partenaire pour des Démarches Simplifiées
        </h2>
        <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-4">
            Notre plateforme a été conçue pour vous accompagner et simplifier l'ensemble des démarches liées à l'acte de naissance au Mali. Nous vous guidons pas à pas dans la préparation de votre dossier en ligne, en vous indiquant précisément les informations et documents nécessaires pour chaque type de demande.
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