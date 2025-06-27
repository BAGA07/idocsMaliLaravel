@extends ('layouts.presentation')

@section('title', 'Suivre ma Demande - MaliActes')

@section('content')
<section class="py-16 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-4 max-w-2xl">
        <h1 class="text-4xl md:text-5xl font-bold text-center text-gray-800 dark:text-white mb-12">Suivre l'État de
            votre Demande</h1>

        <p class="text-lg text-gray-700 dark:text-gray-300 text-center mb-10">
            Entrez votre numéro de suivi unique ci-dessous pour connaître l'état actuel de votre demande d'acte de
            naissance.
        </p>

        {{-- Le composant Livewire sera inséré ici --}}
        {{-- Pour que cela fonctionne, vous devez créer un composant Livewire TrackRequest --}}
        @livewire('track-request')

        <div class="text-center mt-10 p-6 bg-blue-50 dark:bg-blue-900 rounded-lg shadow-md">
            <p class="text-lg text-gray-700 dark:text-gray-200 mb-4">Besoin d'aide pour suivre votre demande ?</p>
            <a href="{{ route('presentation.contact') }}"
                class="inline-block bg-blue-600 text-white hover:bg-blue-700 px-6 py-3 rounded-lg text-lg font-semibold shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                Contactez le support
                <i class="fas fa-life-ring ml-2"></i>
            </a>
        </div>
    </div>
</section>
@endsection