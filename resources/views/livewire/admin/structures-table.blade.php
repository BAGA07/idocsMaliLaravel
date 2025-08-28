<div class="w-full">
    <!-- Messages Flash -->
    @if (session()->has('message'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('message') }}</span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" wire:click="$set('message', null)">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <title>Close</title>
                <path
                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </button>
    </div>
    @endif

    @if (session()->has('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" wire:click="$set('error', null)">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <title>Close</title>
                <path
                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </button>
    </div>
    @endif

    <!-- En-tête avec statistiques -->
    <div class="mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="text-center">
                    <h4 class="text-2xl font-bold text-blue-600">{{ $stats['total'] }}</h4>
                    <p class="text-gray-600">Total {{ $activeTab === 'hopitaux' ? 'Hôpitaux' : 'Mairies' }}</p>
                </div>
                <div class="text-center">
                    <h4 class="text-2xl font-bold text-green-600">{{ $stats['avec_coords'] }}</h4>
                    <p class="text-gray-600">Avec coordonnées</p>
                </div>
                <div class="text-center">
                    <h4 class="text-2xl font-bold text-yellow-600">{{ $stats['sans_coords'] }}</h4>
                    <p class="text-gray-600">Sans coordonnées</p>
                </div>
                <div class="text-center">
                    <button wire:click="openCreateModal('{{ $activeTab === 'hopitaux' ? 'hopital' : 'mairie' }}')"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-plus mr-2"></i> Ajouter {{ $activeTab === 'hopitaux' ? 'Hôpital' : 'Mairie' }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Onglets -->
    <div class="mb-6">
        <div class="bg-white rounded-lg shadow-md">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <button
                        class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'hopitaux' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                        wire:click="$set('activeTab', 'hopitaux')" type="button">
                        <i class="fas fa-hospital mr-2"></i> Hôpitaux
                    </button>
                    <button
                        class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'mairies' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                        wire:click="$set('activeTab', 'mairies')" type="button">
                        <i class="fas fa-building mr-2"></i> Mairies
                    </button>
                </nav>
            </div>
        </div>
    </div>

    <!-- Filtres et recherche -->
    <div class="mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Rechercher...">
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                    </div>
                    <input wire:model.live.debounce.300ms="filterCommune" type="text"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Filtrer par commune...">
                </div>
                <div class="flex justify-end">
                    <button wire:click="resetFilters"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-refresh mr-2"></i> Réinitialiser
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des structures -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nom
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Commune
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Coordonnées
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($structures as $structure)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $structure->nom }}</div>
                            @if($structure->email)
                            <div class="text-sm text-gray-500">{{ $structure->email }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $structure->commune->nom_commune ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($structure->latitude && $structure->longitude)
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i> Disponibles
                            </span>
                            @else
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times mr-1"></i> Manquantes
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button
                                    wire:click="openEditModal('{{ $activeTab === 'hopitaux' ? 'hopital' : 'mairie' }}', {{ $structure->id }})"
                                    class="text-blue-600 hover:text-blue-900" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button
                                    wire:click="openDeleteModal('{{ $activeTab === 'hopitaux' ? 'hopital' : 'mairie' }}', {{ $structure->id }})"
                                    class="text-red-600 hover:text-red-900" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Aucune {{ $activeTab === 'hopitaux' ? 'hôpital' : 'mairie' }} trouvée.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($structures->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $structures->links() }}
        </div>
        @endif
    </div>

    <!-- Modal de création/édition -->
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full {{ $showCreateModal || $showEditModal ? '' : 'hidden' }}"
        id="modal">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ $showCreateModal ? 'Ajouter une structure' : 'Modifier la structure' }}
                    </h3>
                    <button type="button" class="text-gray-400 hover:text-gray-600" wire:click="closeModals">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form wire:submit.prevent="{{ $showCreateModal ? 'createStructure' : 'updateStructure' }}">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" wire:model="form.nom"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            @error('form.nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" wire:model="form.email"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            @error('form.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <input type="text" wire:model="form.telephone"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            @error('form.telephone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Commune</label>
                            <select wire:model="form.commune_id"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Sélectionner une commune</option>
                                @foreach($communes as $commune)
                                <option value="{{ $commune->id }}">{{ $commune->nom_commune }}</option>
                                @endforeach
                            </select>
                            @error('form.commune_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Latitude</label>
                            <input type="number" step="any" wire:model="form.latitude"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            @error('form.latitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Longitude</label>
                            <input type="number" step="any" wire:model="form.longitude"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            @error('form.longitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200"
                            wire:click="closeModals">
                            Annuler
                        </button>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                            {{ $showCreateModal ? 'Créer' : 'Modifier' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de suppression -->
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full {{ $showDeleteModal ? '' : 'hidden' }}"
        id="deleteModal">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Confirmer la suppression</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-600" wire:click="closeModals">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <p class="text-gray-600 mb-6">Êtes-vous sûr de vouloir supprimer cette structure ? Cette action est
                    irréversible.</p>

                <div class="flex justify-end space-x-3">
                    <button type="button"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200"
                        wire:click="closeModals">
                        Annuler
                    </button>
                    <button type="button"
                        class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200"
                        wire:click="deleteStructure">
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>