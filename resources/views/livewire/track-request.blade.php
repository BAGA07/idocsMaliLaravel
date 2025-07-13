<div class="bg-white dark:bg-gray-800 p-6 md:p-8 rounded-lg shadow-md max-w-xl mx-auto transition-all">

    <!-- Champ de numéro de suivi -->
    <div class="mb-5">
        <label for="trackingNumber" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
            Numéro de suivi
        </label>
        <input wire:model.live="trackingNumber" type="text" id="trackingNumber" placeholder="Ex: MALIACTES123"
            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white dark:bg-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        @error('trackingNumber')
        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
        @enderror
    </div>

    <!-- Bouton de recherche -->
    <div class="text-center mb-6">
        <button wire:click="track" wire:loading.attr="disabled"
            class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transition-all duration-300 transform hover:scale-105 disabled:opacity-60 disabled:cursor-not-allowed">
            <span wire:loading.remove wire:target="track">Suivre ma demande</span>
            <span wire:loading wire:target="track">
                Recherche en cours...
            </span>
        </button>
    </div>

    <!-- Loader -->
    @if ($isLoading)
    <div class="text-center text-blue-600 dark:text-blue-400 mt-4 animate-pulse">
        <p class="text-sm">Chargement du statut...</p>
    </div>
    @endif

    <!-- Résultat -->
    @if (!$isLoading && $status)
    <div class="mt-6 p-5 rounded-lg border text-center
            @if ($status === 'En attente') bg-yellow-50 text-yellow-700 border-yellow-300
            @elseif ($status === 'En cours de traitement') bg-blue-50 text-blue-700 border-blue-300
            @elseif ($status === 'Prêt pour retrait' || $status === 'Terminée') bg-green-50 text-green-700 border-green-300
            @elseif ($status === 'Annulée' || $status === 'non_trouvee') bg-red-50 text-red-700 border-red-300
            @else bg-gray-100 text-gray-700 border-gray-300
            @endif
            dark:bg-gray-700 dark:text-white dark:border-gray-600">
        <h3 class="text-sm font-semibold mb-2">Statut actuel de la demande</h3>

        <!-- Badge de statut -->
        <div class="inline-block px-4 py-1 rounded-full text-sm font-medium
                @if ($status === 'En attente') bg-yellow-100 text-yellow-800
                @elseif ($status === 'En cours de traitement') bg-blue-100 text-blue-800
                @elseif ($status === 'Prêt pour retrait' || $status === 'Terminée') bg-green-100 text-green-800
                @elseif ($status === 'Annulée' || $status === 'non_trouvee') bg-red-100 text-red-800
                @else bg-gray-200 text-gray-800
                @endif">
            {{ $status }}
        </div>

        @if ($message)
        <p class="mt-3 text-sm">{{ $message }}</p>
        @endif
    </div>
    @endif

</div>