@extends('layouts.presentation')

@section('title', 'Récupérer l\'Acte de Naissance d\'un Nouveau-né')

@section('content')

<div class="container mx-auto px-4 py-12 max-w-4xl">
    <h1 class="text-4xl font-extrabold text-blue-800 mb-8 border-b-2 border-blue-400 pb-4">
        Récupérer l'Acte de Naissance d'un Nouveau-né
    </h1>

    <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-6">
        Au Mali, la déclaration de naissance se fait directement à la maternité ou au centre de santé. Une fois cette étape complétée, le dossier est transmis à l'agent d'état civil de la mairie pour que l'acte soit établi.
    </p>

    <h2 class="text-2xl font-bold text-blue-700 mb-4">Informations sur la procédure :</h2>
    <ul class="list-disc list-inside text-lg lg:text-xl text-gray-700 space-y-3 pl-4 mb-6">
        <li>
            Dès que la déclaration est reçue par la mairie, le déclarant est **notifié de la prise en charge de son dossier**.
        </li>
        <li>
            Une fois l'acte de naissance créé et prêt à être remis, le déclarant est **notifié pour la récupération du document**.
        </li>
    </ul>

    <p class="mt-8 text-center">
        <a href="{{ route('demande.nouveau_ne.create') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-xl font-bold rounded-md shadow-lg text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
            Commencer la procédure <svg class="ml-3 -mr-1 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        </a>
    </p>
</div>

@endsection