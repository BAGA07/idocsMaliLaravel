@php
use Illuminate\Pagination\Paginator;
@endphp

@extends('layouts.app') {{-- Ne change pas --}}

@section('content')
{{-- Suppression du div parent avec p-4 sm:ml-64, car layouts.app s'en charge. --}}
{{-- Seul le conteneur de largeur maximale et centré est conservé. --}}
<div class="mx-auto max-w-screen-2xl"> {{-- Utilisez 'max-w-screen-xl' ou 'max-w-screen-3xl' si vous préférez une largeur différente --}}

    {{-- Section : Cartes de Statistiques --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        {{-- Statistique - Total des naissances --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex items-center justify-between transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-700 text-blue-600 dark:text-blue-200 p-3 rounded-full">
                    <i class="fa fa-file-text-o text-2xl"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">
                        @if(isset($totalNaissances))
                            {{ $totalNaissances }}
                        @else
                            00
                        @endif
                    </div>
                    <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">Total des Naissances</h3>
                </div>
            </div>
            <p class="text-sm text-gray-400 dark:text-gray-500 text-right">Depuis votre inscription</p>
        </div>

        {{-- Statistique - Total Garçons --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex items-center justify-between transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0 bg-green-100 dark:bg-green-700 text-green-600 dark:text-green-200 p-3 rounded-full">
                    <i class="fa fa-male text-2xl"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">
                        @if(isset($totalGarçons))
                            {{ $totalGarçons }}
                        @else
                            00
                        @endif
                    </div>
                    <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">Total Garçons</h3>
                </div>
            </div>
            <p class="text-sm text-gray-400 dark:text-gray-500 text-right">Nés cette année</p>
        </div>

        {{-- Statistique - Total Filles --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex items-center justify-between transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0 bg-pink-100 dark:bg-pink-700 text-pink-600 dark:text-pink-200 p-3 rounded-full">
                    <i class="fa fa-female text-2xl"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">
                        @if(isset($totalFilles))
                            {{ $totalFilles }}
                        @else
                            00
                        @endif
                    </div>
                    <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">Total Filles</h3>
                </div>
            </div>
            <p class="text-sm text-gray-400 dark:text-gray-500 text-right">Nées cette année</p>
        </div>
    </div>

    ---

    {{-- Section : Tableau des Naissances --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 sm:mb-0">Liste des naissances enregistrées</h2>
            <a href="{{ route('naissances.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
                <i class="fa fa-plus mr-2"></i> Nouvelle naissance
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Nom du père
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Nom de la mère
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Contact Déclarant
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Sexe de l’enfant
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($declarations as $declaration)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            {{ \Carbon\Carbon::parse($declaration->heure_naissance)->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            {{ $declaration->prenom_pere }} {{ $declaration->nom_pere }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            {{ $declaration->prenom_mere }} {{ $declaration->nom_mere }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            +223 {{ $declaration->declarant->telephone }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if ($declaration->sexe === 'M')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                Masculin
                            </span>
                            @elseif ($declaration->sexe === 'F')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pink-100 text-pink-800 dark:bg-pink-800 dark:text-pink-100">
                                Féminin
                            </span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                Non défini
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            {{-- Voir --}}
                            <a href="{{ route('naissances.show', $declaration->id_volet) }}"
                               class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-600 mx-1 p-2 rounded-md hover:bg-blue-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out" title="Voir les détails">
                                <i class="fa fa-eye"></i>
                            </a>

                            {{-- Modifier --}}
                            <a href="{{ route('naissances.edit', $declaration->id_volet) }}"
                               class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-600 mx-1 p-2 rounded-md hover:bg-yellow-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out" title="Modifier">
                                <i class="fa fa-edit"></i>
                            </a>

                            {{-- Formulaire de suppression masqué --}}
                            <form id="delete-form-{{ $declaration->id_volet }}"
                                  action="{{ route('naissances.destroy', $declaration->id_volet) }}"
                                  method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600 mx-1 p-2 rounded-md hover:bg-red-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out" title="Supprimer"
                                        onclick="confirmDelete({{ $declaration->id_volet }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 dark:text-gray-400">
                            Aucune déclaration enregistrée.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4 flex justify-center">
            {{ $declarations->links() }}
        </div>
    </div>
</div> {{-- Fin du div avec mx-auto et max-w --}}

{{-- SweetAlert2 pour la confirmation de suppression --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Êtes-vous sûr(e)?',
            text: "Vous ne pourrez pas revenir en arrière!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer!',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection