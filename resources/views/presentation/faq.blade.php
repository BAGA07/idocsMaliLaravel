@extends ('layouts.presentation')

@section('title', 'Questions Fréquentes - IdocsMali')

@section('content')
<section class="py-16 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-4 max-w-4xl">
        <h1 class="text-4xl md:text-5xl font-bold text-center text-gray-800 dark:text-white mb-12">Questions Fréquentes (FAQ)</h1>

        {{-- Barre de Recherche (Optionnel) --}}
        <div class="mb-12">
            <input type="text" id="faq-search" class="w-full p-4 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" placeholder="Rechercher une question...">
        </div>

        {{-- Catégories (Optionnel, si vous avez beaucoup de questions) --}}
        {{-- <div class="mb-12 flex flex-wrap justify-center gap-4">
            <button class="px-5 py-2 rounded-full bg-blue-100 text-blue-800 hover:bg-blue-200 dark:bg-blue-700 dark:text-blue-100">Général</button>
            <button class="px-5 py-2 rounded-full bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-100">Demande en ligne</button>
            <button class="px-5 py-2 rounded-full bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-100">Paiement</button>
            <button class="px-5 py-2 rounded-full bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-100">Sécurité</button>
        </div> --}}

        {{-- Liste de Q/R (Accordeon Flowbite) --}}
        <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
            @forelse($faqs as $key => $faq)
                <h2 id="accordion-flush-heading-{{ $key + 1 }}">
                    <button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-900 bg-white border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white" data-accordion-target="#accordion-flush-body-{{ $key + 1 }}" aria-expanded="{{ $key === 0 ? 'true' : 'false' }}" aria-controls="accordion-flush-body-{{ $key + 1 }}">
                        <span>{{ $faq['question'] }}</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-{{ $key === 0 ? '180' : '0' }} shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-flush-body-{{ $key + 1 }}" class="{{ $key === 0 ? '' : 'hidden' }}" aria-labelledby="accordion-flush-heading-{{ $key + 1 }}">
                    <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                        <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $faq['answer'] }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-600 dark:text-gray-400">Aucune question fréquente disponible pour le moment.</p>
            @endforelse
        </div>

        {{-- Liens vers Contact si la réponse n'est pas trouvée --}}
        <div class="text-center mt-10 p-6 bg-blue-50 dark:bg-blue-900 rounded-lg shadow-md">
            <p class="text-lg text-gray-700 dark:text-gray-200 mb-4">Vous n'avez pas trouvé la réponse à votre question ?</p>
            <a href="{{ route('presentation.contact') }}" class="inline-block bg-blue-600 text-white hover:bg-blue-700 px-6 py-3 rounded-lg text-lg font-semibold shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                Contactez-nous directement
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
@endsection