@php
use Illuminate\Pagination\Paginator;
@endphp

@extends('layouts.app')
@section('titre')Tableau de bord @endsection
@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Statistiques -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Total Naissances -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-4 border-l-4 border-blue-600">
                <div class="text-blue-600 text-4xl">
                    <i class="fa fa-file-text-o"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-gray-600 font-semibold">Total des naissances</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalNaissances ?? 0 }}</p>
                    <span class="text-sm text-gray-500">Depuis votre inscription</span>
                </div>
            </div>

            <!-- Total Garçons -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-4 border-l-4 border-blue-600">
                <div class="text-blue-600 text-4xl">
                    <i class="fa fa-mars"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-gray-600 font-semibold">Total Garçons</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalGarçons ?? 0 }}</p>
                    <span class="text-sm text-gray-500">Nés cette année</span>
                </div>
            </div>

            <!-- Total Filles -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-4 border-l-4 border-blue-600">
                <div class="text-blue-600 text-4xl">
                    <i class="fa fa-venus"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-gray-600 font-semibold">Total Filles</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalFilles ?? 0 }}</p>
                    <span class="text-sm text-gray-500">Nées cette année</span>
                </div>
            </div>
        </div>

        <!-- Liste des déclarations -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">Déclarations récentes</h2>
                    <a href="{{ route('naissances.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm font-medium transition duration-200">
                        <i class="fa fa-plus"></i> Nouvelle déclaration
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom du père</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom de la mère</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Téléphone</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sexe</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($declarations as $declaration)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($declaration->date_naissance)->format('d/m/Y') }} à {{
                                $declaration->heure_naissance }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $declaration->prenom_pere }} {{ $declaration->nom_pere }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $declaration->prenom_mere }} {{ $declaration->nom_mere }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                +223 {{ $declaration->declarant->telephone }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($declaration->sexe === 'M')
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Masculin
                                </span>
                                @elseif ($declaration->sexe === 'F')
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                    Féminin
                                </span>
                                @else
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Non défini
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('naissances.show', $declaration->id_volet) }}"
                                        class="text-blue-600 hover:text-blue-900" title="Voir">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('naissances.edit', $declaration->id_volet) }}"
                                        class="text-yellow-600 hover:text-yellow-900" title="Modifier">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button onclick="confirmDelete({{ $declaration->id_volet }})"
                                        class="text-red-600 hover:text-red-900" title="Supprimer">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <!-- Bouton d'envoi de notification -->
                                    <button onclick="sendNotification({{ $declaration->id_volet }})"
                                        class="text-green-600 hover:text-green-900" title="Envoyer notification">
                                        <i class="fa fa-paper-plane"></i>
                                    </button>
                                </div>

                                <!-- Formulaire de suppression caché -->
                                <form id="delete-form-{{ $declaration->id_volet }}"
                                    action="{{ route('naissances.destroy', $declaration->id_volet) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <!-- Formulaire d'envoi de notification caché -->
                                <form id="notification-form-{{ $declaration->id_volet }}"
                                    action="{{ route('declaration.sendNotification', $declaration->id_volet) }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Aucune déclaration trouvée.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($declarations->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $declarations->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette déclaration ?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}

function sendNotification(id) {
    if (confirm('Voulez-vous envoyer une notification au déclarant ?')) {
        document.getElementById('notification-form-' + id).submit();
    }
}
</script>
@endsection