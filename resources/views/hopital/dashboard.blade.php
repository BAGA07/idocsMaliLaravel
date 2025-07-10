@php
use Illuminate\Pagination\Paginator;
@endphp

@extends('layouts.app')
@section('titre')Tableau de bord @endsection
@section('content')
<div class="space-y-8">

    <!-- Statistiques -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Naissances -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-4 border-l-4 border-blue-600">
            <div class="text-blue-600 text-4xl">
                <i class="fa fa-file-text-o"></i>
            </div>
            <div>
                <h3 class="text-gray-600 font-semibold">Total des naissances</h3>
                <p class="text-xl font-bold">{{ $totalNaissances ?? 0 }}</p>
                <span class="text-sm text-gray-500">Depuis votre inscription</span>
            </div>
        </div>

        <!-- Total Garçons -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-4 border-l-4 border-blue-600">
            <div class="text-blue-600 text-4xl">
                <i class="fa fa-mars"></i>
            </div>
            <div>
                <h3 class="text-gray-600 font-semibold">Total Garçons</h3>
                <p class="text-xl font-bold">{{ $totalGarçons ?? 0 }}</p>
                <span class="text-sm text-gray-500">Nés ce Mois</span>
            </div>
        </div>

        <!-- Total Filles -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-4 border-l-4 border-blue-600">
            <div class="text-blue-600 text-4xl">
                <i class="fa fa-venus"></i>
            </div>
            <div>
                <h3 class="text-gray-600 font-semibold">Total Filles</h3>
                <p class="text-xl font-bold">{{ $totalFilles ?? 0 }}</p>
                <span class="text-sm text-gray-500">Nées ce Mois</span>
            </div>
        </div>
    </div>

    <!-- Liste des déclarations -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Déclarations récentes</h2>
            <a href="{{ route('naissances.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center gap-2 text-sm">
                <i class="fa fa-plus"></i> Nouvelle déclaration
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-gray-600">Date</th>
                        <th class="px-4 py-3 text-left text-gray-600">Nom du père</th>
                        <th class="px-4 py-3 text-left text-gray-600">Nom de la mère</th>
                        <th class="px-4 py-3 text-left text-gray-600">Téléphone</th>
                        <th class="px-4 py-3 text-left text-gray-600">Sexe</th>
                        <th class="px-4 py-3 text-center text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($declarations as $declaration)
                    <tr>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($declaration->heure_naissance)->format('d/m/Y
                            H:i') }}</td>
                        <td class="px-4 py-2">{{ $declaration->prenom_pere }} {{ $declaration->nom_pere }}</td>
                        <td class="px-4 py-2">{{ $declaration->prenom_mere }} {{ $declaration->nom_mere }}</td>
                        <td class="px-4 py-2">+223 {{ $declaration->declarant->telephone }}</td>
                        <td class="px-4 py-2">
                            @if ($declaration->sexe === 'M')
                            <span class="bg-blue-500 text-white px-2 py-1 text-xs rounded">Masculin</span>
                            @elseif ($declaration->sexe === 'F')
                            <span class="bg-pink-500 text-white px-2 py-1 text-xs rounded">Féminin</span>
                            @else
                            <span class="bg-gray-400 text-white px-2 py-1 text-xs rounded">Non défini</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('naissances.show', $declaration->id_volet) }}"
                                class="text-blue-600 hover:text-blue-800 mx-1" title="Voir">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('naissances.edit', $declaration->id_volet) }}"
                                class="text-yellow-500 hover:text-yellow-700 mx-1" title="Modifier">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form id="delete-form-{{ $declaration->id_volet }}"
                                action="{{ route('naissances.destroy', $declaration->id_volet) }}" method="POST"
                                class="hidden">
                                @csrf @method('DELETE')
                            </form>
                            <button onclick="confirmDelete({{ $declaration->id_volet }})"
                                class="text-red-600 hover:text-red-800 mx-1" title="Supprimer">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-4">Aucune déclaration enregistrée.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $declarations->links() }}
        </div>
    </div>

    <!-- Optionnel : activité récente, stats globales, résumé rapide -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded shadow">Graphique ici (optionnel)</div>
        <div class="bg-white p-6 rounded shadow">Activité récente ici (optionnel)</div>
    </div>
</div>
@endsection