@extends('layouts.presentation')

@section('title', 'Le Projet / À Propos - MaliActes')

@section('content')

<section class="py-16 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-4 max-w-5xl text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-8">
           e-Naissance Mali : Notre Engagement pour un Mali Numérique
        </h1>
        <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed mb-12">
             e-Naissance Mali est une initiative audacieuse visant à **digitaliser et simplifier** l'accès aux **actes de naissance** au Mali. Nous croyons en un avenir où chaque citoyen peut obtenir et gérer facilement et en toute sécurité ce document essentiel à ses droits fondamentaux, où qu'il se trouve, grâce à des outils numériques. Découvrez notre vision, nos valeurs et l'équipe derrière ce projet transformateur.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
            {{-- Lien vers Notre Vision --}}
            <a href="{{ route('presentation.a_propos.notre_vision') }}" class="block p-8 bg-blue-50 dark:bg-blue-900 rounded-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2 group">
                <div class="text-blue-600 dark:text-blue-400 text-6xl mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-lightbulb"></i> {{-- Icône ampoule --}}
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 group-hover:text-blue-700 dark:group-hover:text-blue-300">Notre Vision</h2>
                <p class="text-gray-700 dark:text-gray-300">Découvrez les principes et les objectifs qui guident notre action.</p>
            </a>
            {{-- Lien vers Sécurité & Confidentialité --}}
            <a href="{{ route('presentation.a_propos.securite_confidentialite') }}" class="block p-8 bg-green-50 dark:bg-green-900 rounded-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2 group">
                <div class="text-green-600 dark:text-green-400 text-6xl mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-lock"></i> {{-- Icône cadenas --}}
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 group-hover:text-green-700 dark:group-hover:text-green-300">Sécurité & Confidentialité</h2>
                <p class="text-gray-700 dark:text-gray-300">Apprenez comment nous protégeons vos données personnelles.</p>
            </a>
            {{-- Lien vers Partenaires --}}
            <a href="{{ route('presentation.a_propos.partenaires') }}" class="block p-8 bg-yellow-50 dark:bg-yellow-900 rounded-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2 group">
                <div class="text-yellow-600 dark:text-yellow-400 text-6xl mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-handshake"></i> {{-- Icône poignée de main --}}
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 group-hover:text-yellow-700 dark:group-hover:text-yellow-300">Nos Partenaires</h2>
                <p class="text-gray-700 dark:text-gray-300">Découvrez les acteurs qui nous accompagnent dans cette mission.</p>
            </a>
        </div>
    </div>
</section>

@endsection