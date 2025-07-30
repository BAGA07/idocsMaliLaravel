@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Gestion des Structures</h1>
                <p class="text-gray-600 mt-2">Gérez les hôpitaux</p>
            </div>
            <a href="{{ route('manager.structures.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-200">
                <i class="fa fa-plus mr-2"></i> Ajouter une structure
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        <!-- Onglets -->
        <div class="mb-6">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <button onclick="showTab('hopitaux')" id="tab-hopitaux"
                        class="tab-button py-2 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600">
                        <i class="fa fa-hospital-o mr-2"></i> Hôpitaux ({{ $hopitaux->total() }})
                    </button>
                    {{-- <button onclick="showTab('mairies')" id="tab-mairies"
                        class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700">
                        <i class="fa fa-building mr-2"></i> Mairies ({{ $mairies->total() }})
                    </button> --}}
                </nav>
            </div>
        </div>

        <!-- Contenu des onglets -->
        <div id="content-hopitaux" class="tab-content">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Hôpital
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Commune
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contact
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Localisation
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($hopitaux as $hopital)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div
                                                class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                <i class="fa fa-hospital-o text-green-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $hopital->nom_hopital }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $hopital->commune->nom_commune ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div>{{ $hopital->telephone ?? 'N/A' }}</div>
                                    <div class="text-gray-500">{{ $hopital->email ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($hopital->latitude && $hopital->longitude)
                                    <span class="text-green-600">
                                        <i class="fa fa-map-marker mr-1"></i> Coordonnées disponibles
                                    </span>
                                    @else
                                    <span class="text-gray-400">Non définies</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('manager.structures.show', $hopital->id) }}"
                                            class="text-blue-600 hover:text-blue-900" title="Voir">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('manager.structures.edit', $hopital->id) }}"
                                            class="text-green-600 hover:text-green-900" title="Modifier">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('manager.structures.destroy', $hopital->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet hôpital ?')"
                                                title="Supprimer">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    Aucun hôpital trouvé
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- <div id="content-mairies" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mairie
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Commune
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contact
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Localisation
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($mairies as $mairie)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div
                                                class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                                <i class="fa fa-building text-purple-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $mairie->nom_mairie }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $mairie->commune->nom_commune ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div>{{ $mairie->telephone ?? 'N/A' }}</div>
                                    <div class="text-gray-500">{{ $mairie->email ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($mairie->latitude && $mairie->longitude)
                                    <span class="text-green-600">
                                        <i class="fa fa-map-marker mr-1"></i> Coordonnées disponibles
                                    </span>
                                    @else
                                    <span class="text-gray-400">Non définies</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('manager.structures.show', $mairie->id) }}"
                                            class="text-blue-600 hover:text-blue-900" title="Voir">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('manager.structures.edit', $mairie->id) }}"
                                            class="text-green-600 hover:text-green-900" title="Modifier">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('manager.structures.destroy', $mairie->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette mairie ?')"
                                                title="Supprimer">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    Aucune mairie trouvée
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        <!-- Pagination pour les hôpitaux -->
        <div id="pagination-hopitaux" class="mt-6">
            {{ $hopitaux->links() }}
        </div>

        {{--
        <!-- Pagination pour les mairies -->
        <div id="pagination-mairies" class="mt-6 hidden">
            {{ $mairies->links() }}
        </div> --}}
    </div>
</div>

<script>
    function showTab(tabName) {
    // Masquer tous les contenus d'onglets
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => {
        content.classList.add('hidden');
    });

    // Masquer toutes les paginations
    const paginations = document.querySelectorAll('[id^="pagination-"]');
    paginations.forEach(pagination => {
        pagination.classList.add('hidden');
    });

    // Désactiver tous les boutons d'onglets
    const tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach(button => {
        button.classList.remove('border-blue-500', 'text-blue-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });

    // Afficher le contenu de l'onglet sélectionné
    document.getElementById('content-' + tabName).classList.remove('hidden');

    // Afficher la pagination correspondante
    document.getElementById('pagination-' + tabName).classList.remove('hidden');

    // Activer le bouton de l'onglet sélectionné
    document.getElementById('tab-' + tabName).classList.remove('border-transparent', 'text-gray-500');
    document.getElementById('tab-' + tabName).classList.add('border-blue-500', 'text-blue-600');
}
</script>
@endsection