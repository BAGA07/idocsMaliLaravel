@extends('layouts.presentation')

@section('title', 'Guide : Demande de Copie d\'un Acte de Naissance Existant au Mali')

@section('content')

<div class="container mx-auto px-4 py-12 max-w-4xl">
    <h1 class="text-4xl font-extrabold text-green-800 mb-8 border-b-2 border-green-400 pb-4">
        Demander une Copie d'un Acte de Naissance Existant : Le Guide Complet
    </h1>

    <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-6">
        Si un **acte de naissance a déjà été établi et enregistré** pour vous ou pour une personne que vous représentez,
        **IdocsMali** simplifie grandement la demande d'une copie intégrale ou d'un extrait de cet acte.
        Cette démarche est fréquemment nécessaire pour diverses procédures administratives essentielles, comme l'obtention d'un passeport,
        d'une carte d'identité, l'inscription scolaire, ou toute autre formalité nécessitant une preuve de votre identité légale.
        Notre plateforme rend ce processus plus **accessible et rapide**, vous épargnant les déplacements.
    </p>

    <h2 class="text-2xl font-bold text-green-700 mb-4">Informations Indispensables pour votre Demande :</h2>
    <ul class="list-disc list-inside text-lg lg:text-xl text-gray-700 space-y-3 pl-4 mb-6">
        <li>
            <strong class="font-semibold text-green-700">Identité Complète :</strong> Pour que votre demande aboutisse, il est impératif de disposer des informations précises sur la personne concernée par l'acte :
            <ul>
                <li>Le **nom de famille et tous les prénoms** exactement comme ils apparaissent sur l'acte.</li>
                <li>La **date de naissance complète** (jour, mois, année).</li>
                <li>Le **lieu de naissance exact** (commune, cercle, région au Mali).</li>
            </ul>
        </li>
        <li>
            <strong class="font-semibold text-green-700">Accélérer votre demande :</strong> Si vous possédez une **photo ou un scan de l'acte original** (même une ancienne copie) ou si vous connaissez le **numéro de l'acte** et l'année de son enregistrement, cela peut considérablement accélérer le traitement de votre demande. Ces éléments aident nos agents à localiser l'acte plus rapidement dans les registres d'état civil.
        </li>
        <li>
            <strong class="font-semibold text-green-700">Cas particulier : Jugement supplétif :</strong> Si vous ne possédez aucune des informations mentionnées ci-dessus, ou si l'acte n'a jamais été établi ou a été irrémédiablement perdu sans aucune trace, la procédure de demande de copie n'est pas applicable. Dans ce cas, vous devrez vous orienter vers la procédure de **jugement supplétif d'acte de naissance**. Veuillez consulter la section dédiée à cette démarche pour plus d'informations.
        </li>
    </ul>

    <h2 class="text-2xl font-bold text-green-700 mb-4">Étapes de la Demande en Ligne :</h2>
    <ol class="list-decimal list-inside text-lg lg:text-xl text-gray-700 space-y-3 pl-4 mb-8">
                        <li>Accédez à la section "Demander un Extrait d'Acte de Naissance" sur notre plateforme.</li>
        <li>Remplissez le formulaire en ligne avec les informations précises de l'acte et, si possible, téléchargez la photo ou le scan de l'acte original.</li>
        <li>Votre demande sera examinée et soumise aux autorités compétentes. Vous recevrez un numéro de suivi par email pour rester informé de son statut.</li>
        <li>Une fois la copie prête, nous vous notifierons pour son retrait ou les modalités d'envoi.</li>
    </ol>

    <p class="mt-8 text-center">
        <a href="{{ route('demande.copie_extrait.create') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-xl font-bold rounded-md shadow-lg text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300 ease-in-out transform hover:scale-105">
            Commencer ma demande de copie d'extrait <svg class="ml-3 -mr-1 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        </a>
    </p>
</div>

@endsection