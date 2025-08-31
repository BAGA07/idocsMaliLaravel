@extends ('layouts.presentation') {{-- Assurez-vous que c'est le bon chemin vers votre layout --}}

@section('title', 'Accueil - idocsMali') {{-- Titre spécifique pour la page d'accueil --}}

@section('content')

{{-- 1. Bannière Principale (Hero Section) --}}
<section
    class="relative bg-gradient-to-r from-blue-700 to-blue-900 text-white min-h-[600px] flex items-center justify-center p-8 overflow-hidden"
    style="background-image: url('{{ asset('./images/mali1.png') }}'); background-size: cover; background-position: center;">
    {{-- Optionnel: Image de fond ou motif --}}
    {{-- <img src="[Chemin vers une image d" alt="MaliActes Background"
        class="absolute inset-0 w-full h-full object-cover opacity-20"> --}}

    <div class="relative z-10 text-center max-w-4xl mx-auto">
        <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-4 animate-fade-in-down">
            Simplifiez vos Démarches d'Actes de Naissance au Mali
        </h1>
        <p class="text-xl md:text-2xl mb-8 font-light animate-fade-in-up">
            Demandez et suivez vos actes en ligne, rapidement et en toute sécurité, depuis chez vous.
        </p>
        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6 animate-scale-in">
            {{-- CORRECTION ICI : Ajout de l'attribut href manquant pour le premier bouton --}}
            <a href="{{ route('demande.choix_type') }}" class="inline-block bg-white text-blue-600 hover:bg-blue-100 px-8 py-4 rounded-lg text-lg font-semibold shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                Demander un Extrait d'acte de naissance
            </a>
            {{-- Le deuxième bouton est déjà correct --}}
            <a href="{{ route('presentation.suivre_demande') }}"
                class="inline-block border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                Suivre ma Demande
            </a>
        </div>
    </div>
</section>

{{-- 2. Avantages Clés --}}
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-gray-800 mb-12">Pourquoi choisir IdocsMali ?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            {{-- Avantage 1 --}}
            <div
                class="bg-white p-8 rounded-lg shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                <div class="text-blue-400 text-5xl mb-6">
                    <i class="fas fa-clock"></i> {{-- Icône de temps, nécessite Font Awesome --}}
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Gain de Temps Précieux</h3>
                <p class="text-gray-600">Évitez les files d'attente et les déplacements. Votre demande est traitée en
                    ligne, quand vous le souhaitez.</p>
            </div>
            {{-- Avantage 2 --}}
            <div
                class="bg-white p-8 rounded-lg shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                <div class="text-blue-400 text-5xl mb-6">
                    <i class="fas fa-shield-alt"></i> {{-- Icône de sécurité --}}
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Sécurité et Fiabilité</h3>
                <p class="text-gray-600">Vos données sont protégées. Les actes sont authentifiés et livrés de manière
                    sécurisée.</p>
            </div>
            {{-- Avantage 3 --}}
            <div
                class="bg-white p-8 rounded-lg shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                <div class="text-blue-400 text-5xl mb-6">
                    <i class="fas fa-globe"></i> {{-- Icône d'accessibilité --}}
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Accès Facile Partout</h3>
                <p class="text-gray-600">Que vous soyez au Mali ou à l'étranger, accédez au service 24h/24, 7j/7 depuis
                    n'importe quel appareil.</p>
            </div>
        </div>
    </div>
</section>

{{-- 3. Comment ça Marche ? --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 text-center max-w-5xl">
        <h2 class="text-4xl font-bold text-gray-800 mb-12">Comment ça Marche ?</h2>
        <p class="text-lg text-gray-700 mb-10 max-w-3xl mx-auto">
            Demander votre extrait d'acte de naissance en ligne est un processus simple et intuitif. Suivez ces étapes pour
            obtenir votre document.
        </p>

        {{-- Section Vidéo (Optionnel mais fortement recommandé) --}}
        <div class="mb-12">
            <div class="relative w-full aspect-video rounded-lg shadow-xl overflow-hidden mx-auto">
                {{-- Remplacez l'URL ci-dessous par l'URL d'intégration de votre vidéo YouTube/Vimeo --}}
                {{-- ATTENTION: "https://www.youtube.com/embed/dQw4w9WgXcQ" n'est PAS une URL YouTube valide.
                     Utilisez une URL d'intégration YouTube standard comme "https://www.youtube.com/embed/YOUR_VIDEO_ID" --}}
                <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" {{-- Exemple d'URL YouTube valide pour un tutoriel factice --}} frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen class="absolute top-0 left-0 w-full h-full"></iframe>
            </div>
            <p class="text-sm text-gray-500 mt-4">Regardez notre guide vidéo rapide pour une démonstration pas à pas.
            </p>
        </div>

        {{-- Étapes simplifiées (alternative ou complément à la vidéo) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            <div class="flex items-start">
                <div
                    class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-blue-400 text-white rounded-full text-xl font-bold mr-4">
                    1</div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Remplissez le Formulaire</h3>
                    <p class="text-gray-600">Saisissez les informations requises sur notre formulaire en ligne sécurisé.
                    </p>
                </div>
            </div>
            <div class="flex items-start">
                <div
                    class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-blue-400 text-white rounded-full text-xl font-bold mr-4">
                    2</div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Validez et Suivez</h3>
                    <p class="text-gray-600">Confirmez votre demande et recevez un numéro de suivi unique par email.</p>
                </div>
            </div>
            <div class="flex items-start">
                <div
                    class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-blue-400 text-white rounded-full text-xl font-bold mr-4">
                    3</div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Recevez votre Acte</h3>
                    <p class="text-gray-600">Votre acte est traité et vous êtes notifié dès qu'il est prêt à être
                        téléchargé.</p>
                </div>
            </div>
        </div>
        <a href="{{ route('presentation.la_demarche') }}" class="inline-block text-blue-400 hover:text-blue-800 font-semibold mt-10 text-lg">
            Voir la démarche complète <i class="fas fa-arrow-right ml-2"></i> {{-- Icône de flèche --}}
        </a>
    </div>
</section>

{{-- 4. Confiance & Chiffres --}}
<section class="py-16 bg-gray-100">
<div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-gray-800 mb-12">Notre Engagement : Confiance et Efficacité</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-5xl font-bold text-blue-400 mb-2">99%</p>
                <p class="text-gray-600">Demandes traitées avec succès</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-5xl font-bold text-blue-400 mb-2">24/7</p>
                <p class="text-gray-600">Accès au service en ligne</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-5xl font-bold text-blue-400 mb-2">5 min</p>
                <p class="text-gray-600">Durée moyenne d'une demande</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-5xl font-bold text-blue-400 mb-2">100%</p>
                <p class="text-gray-600">Données sécurisées</p>
            </div>
        </div>

                <h3 class="text-2xl font-bold text-gray-800 mb-8">Ils nous font confiance :</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center justify-center mb-12">
            {{-- Remplacez par les chemins de vos logos partenaires --}}
            <img src="{{ asset('./images/mali.jpg') }}" alt="Nom du Partenaire 1" class="mx-auto max-h-20 opacity-75 hover:opacity-100 transition duration-300">
            <img src="{{ asset('./images/bdm.png') }}" alt="Nom du Partenaire 2" class="mx-auto max-h-20 opacity-75 hover:opacity-100 transition duration-300">
            <img src="{{ asset('./images/ONG.png') }}" alt="Nom du Partenaire 3" class="mx-auto max-h-20 opacity-75 hover:opacity-100 transition duration-300">
            <img src="{{ asset('./images/agtic.jpeg') }}" alt="Nom du Partenaire 4" class="mx-auto max-h-20 opacity-75 hover:opacity-100 transition duration-300">
        </div>

        <p class="text-gray-700 text-lg max-w-2xl mx-auto">
            IdocsMali Mali s'engage à garantir la confidentialité et la sécurité de toutes vos informations. Votre confiance est notre priorité.
        </p>
    </div>
</section>

{{-- 5. Extraits FAQ (avec Flowbite Accordion) --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Questions Fréquentes</h2>

        <div id="accordion-flush" data-accordion="collapse"
            data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
            data-inactive-classes="text-gray-500 dark:text-gray-400">
            {{-- Question 1 --}}
            <h2 id="accordion-flush-heading-1">
                <button type="button"
                    class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-900 bg-white border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white"
                    data-accordion-target="#accordion-flush-body-1" aria-expanded="true"
                    aria-controls="accordion-flush-body-1">
                    <span>Quel est le délai pour obtenir un acte de naissance ?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                    <p class="mb-2 text-gray-500 dark:text-gray-400">Le délai de traitement est généralement de **X jours ouvrables** après la validation de votre demande. Vous serez notifié par email.</p>
                </div>
            </div>

            {{-- Question 2 --}}
            <h2 id="accordion-flush-heading-2">
                <button type="button"
                    class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                    data-accordion-target="#accordion-flush-body-2" aria-expanded="false"
                    aria-controls="accordion-flush-body-2">
                    <span>Comment puis-je suivre l'état de ma demande ?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                    <p class="mb-2 text-gray-500 dark:text-gray-400">Utilisez le **numéro de suivi** que vous avez reçu par
                        email sur notre page "<a href="{{ route('presentation.suivre_demande') }}" class="text-blue-600 hover:underline">Suivre ma Demande</a>".</p>
                </div>
            </div>

            {{-- Question 3 --}}
            <h2 id="accordion-flush-heading-3">
                <button type="button"
                    class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                    data-accordion-target="#accordion-flush-body-3" aria-expanded="false"
                    aria-controls="accordion-flush-body-3">
                    <span>Mes données personnelles sont-elles sécurisées ?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
                <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                    <p class="mb-2 text-gray-500 dark:text-gray-400">Oui, nous utilisons des technologies de cryptage
                        avancées pour protéger toutes vos informations. Pour plus de détails, consultez notre page sur
                        la <a href="{{ route('presentation.a_propos.securite_confidentialite') }}" class="text-blue-600 hover:underline">sécurité et la confidentialité</a>.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('presentation.faq') }}"
                class="inline-block text-blue-400 hover:text-blue-800 font-semibold text-lg">
                Voir toutes les questions <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

{{-- 6. Appel à l'Action Final --}}
<section class="bg-blue-400 text-white py-20 text-center">
    <div class="container mx-auto px-4">
        {{-- Le titre est rendu plus spécifique à l'acte de naissance et à la digitalisation --}}
        <h2 class="text-4xl md:text-5xl font-bold mb-8">Prêt à digitaliser vos démarches d'Extrait d'Acte de Naissance ?</h2>
        <a href="{{ route('demande.choix_type') }}" class="inline-block bg-white text-blue-700 hover:bg-blue-100 px-10 py-5 rounded-lg text-xl font-semibold shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
            Commencer ma Demande en Ligne
        </a>
    </div>
</section>

@endsection