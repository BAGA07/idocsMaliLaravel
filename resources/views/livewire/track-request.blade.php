<div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-lg shadow-md">
    <div class="mb-6">
        <label for="trackingNumber" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Votre numéro de suivi:</label>
        <input wire:model.live="trackingNumber" type="text" id="trackingNumber" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 dark:bg-gray-600 dark:text-white leading-tight focus:outline-none focus:shadow-outline focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: MALIACTES123">
        @error('trackingNumber')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-center mb-6">
        <button wire:click="track" wire:loading.attr="disabled" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:scale-105 {{ $isLoading ? 'opacity-75 cursor-not-allowed' : '' }}">
            <span wire:loading.remove wire:target="track">Suivre ma Demande</span>
            <span wire:loading wire:target="track">
                <i class="fas fa-spinner fa-spin mr-2"></i> Recherche en cours...
            </span>
        </button>
    </div>

    @if ($isLoading)
        <div class="text-center text-blue-600 dark:text-blue-400 mt-4">
            <i class="fas fa-circle-notch fa-spin text-xl"></i>
            <p class="mt-2">Chargement du statut...</p>
        </div>
    @else
        @if ($status)
            <div class="mt-6 p-4 rounded-lg
                @if ($status === 'En attente') bg-yellow-100 text-yellow-800 border border-yellow-300
                @elseif ($status === 'En cours de traitement') bg-blue-100 text-blue-800 border border-blue-300
                @elseif ($status === 'Prêt pour retrait') bg-green-100 text-green-800 border border-green-300
                @elseif ($status === 'Terminée') bg-green-100 text-green-800 border border-green-300
                @elseif ($status === 'Annulée' || $status === 'non_trouvee') bg-red-100 text-red-800 border border-red-300
                @endif
                dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600" role="alert">
                <p class="font-bold mb-2">Statut de la demande:</p>
                <p class="text-xl">{{ $status }}</p>
                @if ($message)
                    <p class="mt-2 text-sm">{{ $message }}</p>
                @endif
            </div>
        @endif
    @endif
</div>