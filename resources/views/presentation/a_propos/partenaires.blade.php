@extends('layouts.presentation')

{{-- Mise à jour du titre de la page --}}
@section('title', 'Nos Partenaires - e-Naissance Mali')

@section('content')

<section class="py-16 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-4 max-w-4xl text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-10">
            Nos Partenaires Stratégiques
        </h1>
        <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed mb-12">
            La réussite du projet **e-Naissance Mali** repose sur des collaborations solides et des partenariats stratégiques avec des institutions clés au Mali et des organisations qui partagent notre vision de la digitalisation et de la modernisation des **services d'enregistrement de naissances**.
        </p>

        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Institutions Gouvernementales</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            {{-- Ministère de l'Administration Territoriale et de la Décentralisation --}}
            <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-lg shadow-md border-t-4 border-blue-600 dark:border-blue-400">
                {{-- Correction du chemin de l'asset --}}
                <img src="{{ asset('images/logo_adt.jpg') }}" alt="Logo Ministère de l'Administration Territoriale et de la Décentralisation" class="mx-auto mb-4 h-16 object-contain">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Ministère de l'Administration Territoriale et de la Décentralisation</h3>
                {{-- Précision sur la nature des actes --}}
                <p class="text-gray-600 dark:text-gray-400 text-sm">Partenaire clé pour la validation et l'authentification des actes de naissance.</p>
            </div>
            {{-- Agence des Technologies de l'Information et de la Communication (AGETIC) --}}
            <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-lg shadow-md border-t-4 border-blue-600 dark:border-blue-400">
                {{-- Correction du chemin de l'asset --}}
                <img src="{{ asset('images/agtic.jpeg') }}" alt="Logo Agence des Technologies de l'Information et de la Communication (AGETIC)" class="mx-auto mb-4 h-16 object-contain">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Agence des Technologies de l'Information et de la Communication (AGETIC)</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Support technique et expertise en infrastructure numérique.</p>
            </div>
            {{-- Direction Nationale de l'État Civil (DNEC) --}}
            <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-lg shadow-md border-t-4 border-blue-600 dark:border-blue-400">
                {{-- Correction du chemin de l'asset --}}
                <img src="{{ asset('images/mali.jpg') }}" alt="Logo Direction Nationale de l'État Civil" class="mx-auto mb-4 h-16 object-contain">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Direction Nationale de l'État Civil</h3>
                {{-- Précision sur la nature des processus --}}
                <p class="text-gray-600 dark:text-gray-400 text-sm">Collaboration pour la conformité et la validité des processus liés aux actes de naissance.</p>
            </div>
        </div>

        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 mt-16">Partenaires Techniques et Financiers</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Exemple Partenaire Tech/Fin 1 --}}
            <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-lg shadow-md border-t-4 border-green-600 dark:border-green-400">
                {{-- Correction du chemin de l'asset --}}
                <img src="{{ asset('images/voodoo_gr.jpeg') }}" alt="Logo Partenaire Technique 1" class="mx-auto mb-4 h-16 object-contain">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Voodoo Group</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Expertise en développement logiciel et sécurité des plateformes.</p>
            </div>
            {{-- Exemple Partenaire Tech/Fin 2 --}}
            <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-lg shadow-md border-t-4 border-green-600 dark:border-green-400">
                {{-- Correction du chemin de l'asset --}}
                <img src="{{ asset('images/bdm.png') }}" alt="Logo Partenaire Financier 1" class="mx-auto mb-4 h-16 object-contain">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">BDM-SA</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Soutien financier pour le déploiement et l'expansion du projet.</p>
            </div>
            {{-- Exemple Partenaire Tech/Fin 3 --}}
            <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-lg shadow-md border-t-4 border-green-600 dark:border-green-400">
                {{-- Correction du chemin de l'asset --}}
                <img src="{{ asset('images/ONG.png') }}" alt="Logo Partenaire ONG 1" class="mx-auto mb-4 h-16 object-contain">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2"> ONG Terre des Hommes Suisse (TdH Suisse)</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Soutien à la sensibilisation et à l'adoption par les communautés.</p>
            </div>
        </div>

        <div class="text-center mt-16 p-8 bg-blue-100 dark:bg-blue-700 rounded-lg shadow">
            <p class="text-lg font-semibold text-blue-800 dark:text-blue-100">
                {{-- Mise à jour du nom du projet --}}
                Nous sommes fiers de collaborer avec ces acteurs clés pour faire de **e-Naissance Mali** une réalité au service des citoyens maliens.
            </p>
        </div>
    </div>
</section>

@endsection