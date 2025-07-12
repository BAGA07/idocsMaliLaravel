@extends('layouts.presentation')

@section('title', 'Guide : Procédure par Jugement Supplétif d\'Acte de Naissance au Mali')

@section('content')

<div class="container mx-auto px-4 py-12 max-w-4xl">
    <h1 class="text-4xl font-extrabold text-red-800 mb-8 border-b-2 border-red-400 pb-4">
        Obtenir un Acte de Naissance par Jugement Supplétif : Le Guide Complet
    </h1>

    <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-6">
        Le <strong class="font-semibold text-red-700">jugement supplétif d'acte de naissance</strong> est une procédure judiciaire fondamentale au Mali, cruciale pour l'établissement de l'identité juridique d'une personne. Cette démarche est requise dans des situations spécifiques où un acte de naissance n'a jamais été déclaré dans les délais légaux suivant la naissance (absence totale d'acte), ou lorsque l'acte original a été irrémédiablement perdu sans qu'aucune référence ne permette sa récupération par les voies administratives classiques.
    </p>
    <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-6">
        C'est la voie à suivre si vous n'avez **aucune information ni aucune trace d'un acte de naissance existant**. La décision du tribunal, une fois obtenue, tiendra lieu d'acte de naissance et permettra son enregistrement.
    </p>

    <h2 class="text-2xl font-bold text-red-700 mb-4">Comprendre la Démarche Judiciaire :</h2>
    <ul class="list-disc list-inside text-lg lg:text-xl text-gray-700 space-y-3 pl-4 mb-6">
        <li>
            <strong class="font-semibold text-red-700">Recours au Tribunal :</strong> Contrairement aux demandes de copie ou de premier établissement, le jugement supplétif est une procédure qui s'engage directement auprès du tribunal compétent (généralement le tribunal de première instance du lieu de naissance de la personne ou de son domicile). Il s'agit d'une démarche légale visant à prouver votre naissance et votre identité devant un juge.
        </li>
        <li>
            <strong class="font-semibold text-red-700">Preuves Requises :</strong> Le tribunal exigera des preuves pour établir la réalité de la naissance et l'identité de la personne. Cela inclut souvent :
            <ul class="list-circle list-inside ml-5 mt-2 space-y-1">
                <li>Des **témoignages** (souvent de deux témoins qui connaissent la personne depuis sa naissance et peuvent attester de son identité).</li>
                <li>Un **certificat de non-inscription** à l'état civil (délivré par la commune du lieu de naissance, attestant qu'aucun acte de naissance n'a été trouvé à votre nom).</li>
                <li>Tout autre document pouvant prouver l'existence de la personne et sa date de naissance (carnet de vaccination, certificat de baptême, anciens documents scolaires, etc.).</li>
            </ul>
        </li>
        <li>
            <strong class="font-semibold text-red-700">Procédure et Délais :</strong> Cette procédure peut être plus longue et plus complexe que les démarches administratives simples, car elle implique des audiences et des vérifications judiciaires. Les délais varient en fonction de la charge du tribunal et de la complexité du dossier.
        </li>
    </ul>

    <h2 class="text-2xl font-bold text-red-700 mb-4">Notre Accompagnement avec IdocsMali :</h2>
    <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-4">
        Bien que **IdocsMali** ne traite pas directement la demande judiciaire de jugement supplétif (étant une procédure qui nécessite une représentation ou une présence au tribunal), nous sommes là pour vous **guider et vous fournir un accompagnement précieux** dans la préparation de votre dossier.
    </p>
    <ul class="list-disc list-inside text-lg lg:text-xl text-gray-700 space-y-3 pl-4 mb-8">
        <li>
            <strong class="font-semibold text-red-700">Conseils Détaillés :</strong> Nous vous fournirons un guide détaillé sur les étapes à suivre, les documents à rassembler et les preuves à présenter au tribunal.
        </li>
        <li>
            <strong class="font-semibold text-red-700">Aide à la Préparation du Dossier :</strong> Nous pouvons vous aider à identifier et à organiser les documents nécessaires, et vous orienter sur la manière de solliciter les attestations requises (comme le certificat de non-inscription).
        </li>
        <li>
            <strong class="font-semibold text-red-700">Orientation Juridique :</strong> Si nécessaire, nous pouvons vous orienter vers des ressources ou des professionnels du droit qui pourront vous représenter ou vous assister directement devant le tribunal.
        </li>
    </ul>

    <p class="mt-8 text-center text-lg lg:text-xl text-gray-700 leading-relaxed">
        Cette procédure, bien que plus longue et exigeante, est cruciale pour rétablir votre identité juridique et vous permettre d'accéder à tous vos droits civiques. **IdocsMali** s'engage à vous accompagner dans cette démarche essentielle pour le Mali.
    </p>

    <p class="mt-8 text-center">
        {{-- Pas de bouton "Commencer ma demande" direct ici car c'est un guide pour une démarche judiciaire --}}
        <a href="{{ route('presentation.contact.submit') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-xl font-bold rounded-md shadow-lg text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-300 ease-in-out transform hover:scale-105">
            Contactez-nous pour un accompagnement <svg class="ml-3 -mr-1 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 9a1 1 0 100 2h4a1 1 0 100-2H8z" clip-rule="evenodd"></path></svg>
        </a>
    </p>
</div>

@endsection