@extends('layouts.presentation')

@section('title', 'Guide : Demande d\'Acte de Naissance pour un Nouveau-né')

@section('content')

<div class="container mx-auto px-4 py-12 max-w-4xl">
    <h1 class="text-4xl font-extrabold text-blue-800 mb-8 border-b-2 border-blue-400 pb-4">
        Demander l'Acte de Naissance d'un Nouveau-né : Le Guide Complet
    </h1>

    <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-6">
        Si la naissance de votre enfant a déjà été déclarée à la maternité ou au centre de santé par un agent d'état civil,
        **IdocsMali** vous permet de **demander facilement l'établissement ou la récupération de son acte de naissance officiel** en ligne.
        Cette étape cruciale finalise l'enregistrement de votre enfant auprès de l'état civil, lui conférant une identité juridique.
    </p>

    <h2 class="text-2xl font-bold text-blue-700 mb-4">Informations Cruciales pour votre Demande :</h2>
    <ul class="list-disc list-inside text-lg lg:text-xl text-gray-700 space-y-3 pl-4 mb-6">
        <li>
            <strong class="font-semibold text-blue-700">Numéro du volet (ou extrait provisoire) :</strong> Pour initier la démarche sur notre plateforme, vous aurez impérativement besoin du numéro du volet ou de l'extrait provisoire fourni par l'agent d'état civil au moment de la déclaration à la maternité ou au centre de santé. Une photo claire de ce volet sera également demandée lors de votre soumission en ligne.
        </li>
        <li>
            <strong class="font-semibold text-blue-700">Informations Complémentaires :</strong> Vous devrez également fournir quelques informations complémentaires sur le nouveau-né (date et lieu de naissance précis, sexe) et les parents (noms complets, dates et lieux de naissance, professions) pour faciliter la recherche et l'établissement de l'acte par les services d'état civil.
        </li>
        <li>
            <strong class="font-semibold text-blue-700">Rapidité et Simplicité :</strong> Cette démarche vous permet d'obtenir rapidement l'acte de naissance de votre enfant, sans avoir à vous déplacer physiquement aux bureaux de l'état civil.
        </li>
    </ul>

    <h2 class="text-2xl font-bold text-blue-700 mb-4">Étapes de la Demande en Ligne :</h2>
    <ol class="list-decimal list-inside text-lg lg:text-xl text-gray-700 space-y-3 pl-4 mb-8">
        <li>Accédez à la section "Demander un Acte de Naissance" sur notre plateforme.</li>
        <li>Sélectionnez l'option "Demande pour un nouveau-né (déclaration déjà faite)".</li>
        <li>Remplissez le formulaire en ligne avec les informations requises, y compris le numéro du volet et la photo.</li>
        <li>Procédez au paiement des frais de service de manière sécurisée.</li>
        <li>Suivez l'évolution de votre demande grâce au numéro de suivi que vous recevrez par email.</li>
        <li>Recevez votre acte de naissance certifié une fois qu'il est prêt pour le retrait ou l'envoi.</li>
    </ol>

    <p class="mt-8 text-center">
        <a href="{{ route('demande.nouveau_ne.create') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-xl font-bold rounded-md shadow-lg text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
            Commencer ma demande de nouveau-né <svg class="ml-3 -mr-1 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        </a>
    </p>
</div>

@endsection