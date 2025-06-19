@extends('layouts.presentation')

@section('title', 'Sécurité & Confidentialité - MaliActes')

@section('content')

<section class="py-16 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-4 max-w-4xl">
        <h1 class="text-4xl md:text-5xl font-bold text-center text-gray-900 dark:text-white mb-10">
            Votre Sécurité, Notre Priorité Absolue
        </h1>
        <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed mb-8">
            Chez MaliActes, nous comprenons l'importance capitale de la protection de vos données personnelles et de la confidentialité de vos informations. C'est pourquoi la sécurité est au cœur de notre conception et de nos opérations. Nous nous engageons à protéger vos données avec les plus hauts standards de l'industrie.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
                <div class="text-green-600 dark:text-green-400 text-5xl mb-6">
                    <i class="fas fa-user-shield"></i> {{-- Icône utilisateur + bouclier --}}
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Protection des Données Personnelles</h2>
                <p class="text-gray-700 dark:text-gray-300">
                    Toutes les informations que vous nous fournissez sont cryptées et stockées sur des serveurs sécurisés. Nous respectons scrupuleusement les réglementations en vigueur concernant la protection des données.
                </p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
                <div class="text-green-600 dark:text-green-400 text-5xl mb-6">
                    <i class="fas fa-file-invoice-dollar"></i> {{-- Icône document + dollar --}}
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Authenticité et Intégrité des Actes</h2>
                <p class="text-gray-700 dark:text-gray-300">
                    Les actes que vous recevez via MaliActes sont authentifiés et intègres. Nous travaillons en étroite collaboration avec les autorités compétentes pour garantir leur validité juridique.
                </p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
                <div class="text-green-600 dark:text-green-400 text-5xl mb-6">
                    <i class="fas fa-network-wired"></i> {{-- Icône réseau --}}
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Sécurité des Transactions</h2>
                <p class="text-gray-700 dark:text-gray-300">
                    Toutes les transactions et échanges d'informations sur notre plateforme sont sécurisés par des protocoles de cryptage SSL/TLS avancés.
                </p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
                <div class="text-green-600 dark:text-green-400 text-5xl mb-6">
                    <i class="fas fa-headset"></i> {{-- Icône support --}}
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Support et Assistance</h2>
                <p class="text-gray-700 dark:text-gray-300">
                    Notre équipe est formée aux meilleures pratiques de sécurité et est disponible pour répondre à vos questions concernant la protection de vos données.
                </p>
            </div>
        </div>

        <div class="text-center mt-12 p-8 bg-blue-100 dark:bg-blue-700 rounded-lg shadow">
            <p class="text-lg font-semibold text-blue-800 dark:text-blue-100">
                MaliActes s'engage à une transparence totale concernant l'utilisation et la protection de vos informations.
            </p>
        </div>
    </div>
</section>

@endsection