@extends('layouts.app')
@section('titre')Modification du profile @endsection
@section('content')
<div class="right_col" role="main">
    <h2 class="text-2xl font-semibold mb-6">Tableau de bord - Agent de Mairie</h2>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-600 text-white rounded shadow p-4">
            <h5 class="text-sm font-semibold">Total Volets</h5>
            <p class="text-xl">{{ $total }}</p>
        </div>
        <div class="bg-green-600 text-white rounded shadow p-4">
            <h5 class="text-sm font-semibold">Aujourd'hui</h5>
            <p class="text-xl">{{ $todayCount }}</p>
        </div>
        <div class="bg-yellow-500 text-white rounded shadow p-4">
            <h5 class="text-sm font-semibold">Cette semaine</h5>
            <p class="text-xl">{{ $weekCount }}</p>
        </div>
        <div class="bg-cyan-600 text-white rounded shadow p-4">
            <h5 class="text-sm font-semibold">Ce mois</h5>
            <p class="text-xl">{{ $monthCount }}</p>
        </div>
    </div>

    Tableau des déclarations
    <div class="bg-white shadow rounded mb-6">
        <div class="border-b px-6 py-3 font-semibold">Volets de déclaration</div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Numéro Volet</th>
                        <th class="px-4 py-2 border">Nom Enfant</th>
                        <th class="px-4 py-2 border">Date Naissance</th>
                        <th class="px-4 py-2 border">Hopital</th>
                        <th class="px-4 py-2 border">Déclarant</th>
                        <th class="px-4 py-2 border">Date Déclaration</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($declarations as $volet)
                    <tr>
                        <td class="px-4 py-2 border">{{ $volet->num_volet }}</td>
                        <td class="px-4 py-2 border">{{ $volet->prenom_enfant }} {{ $volet->nom_enfant }}</td>
                        <td class="px-4 py-2 border">{{ $volet->date_naissance }}</td>
                        <td class="px-4 py-2 border">{{ $volet->hopital->nom_hopital ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">{{ $volet->declarant->prenom_declarant }} {{
                            $volet->declarant->nom_declarant }}</td>
                        <td class="px-4 py-2 border">{{ $volet->date_declaration }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tableau des demandes en attente -->
    <div class="bg-white shadow rounded mb-6">
        <div class="border-b px-6 py-3 font-semibold">Demandes en attente</div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Nom Demandeur</th>
                        <th class="px-4 py-2 border">Nom Enfant</th>
                        <th class="px-4 py-2 border">Numéro Volet</th>
                        <th class="px-4 py-2 border">Statut</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($demandes as $demande)
                    <tr>
                        <td class="px-4 py-2 border">{{ $demande->nom_complet }}</td>
                        <td class="px-4 py-2 border">
                            {{ $demande->volet ? $demande->volet->prenom_enfant . ' ' . $demande->volet->nom_enfant :
                            'N/A' }}
                        </td>
                        <td class="px-4 py-2 border">{{ $demande->numero_volet_naissance }}</td>
                        <td class="px-4 py-2 border">
                            @switch($demande->statut)
                            @case('Validé')
                            <span class="bg-green-200 text-green-800 px-2 py-1 rounded">Validé</span>
                            @break
                            @case('Rejeté')
                            <span class="bg-red-200 text-red-800 px-2 py-1 rounded">Rejeté</span>
                            @break
                            @default
                            <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded">{{ $demande->statut }}</span>
                            @endswitch
                        </td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('acte.create', $demande->id) }}"
                                class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded hover:bg-blue-700">Traiter</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Liste des actes -->
    <div class="bg-white shadow rounded mb-6">
        <div class="border-b px-6 py-3 font-semibold">Liste des actes de naissance</div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Numéro acte</th>
                        <th class="px-4 py-2 border">Nom enfant</th>
                        <th class="px-4 py-2 border">Prénom enfant</th>
                        <th class="px-4 py-2 border">Date naissance</th>
                        <th class="px-4 py-2 border">Déclarant</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actesNaissance as $acte)
                    <tr>
                        <td class="px-4 py-2 border">{{ $acte->num_acte }}</td>
                        <td class="px-4 py-2 border">{{ $acte->nom }}</td>
                        <td class="px-4 py-2 border">{{ $acte->prenom }}</td>
                        <td class="px-4 py-2 border">{{ $acte->date_naissance_enfant }}</td>
                        <td class="px-4 py-2 border">{{ $acte->declarant->prenom_declarant ?? 'N/A' }} {{
                            $acte->declarant->nom_declarant ?? '' }}</td>
                        <td class="px-4 py-2 border space-x-2">
                            <a href="{{ route('acte.show', $acte->id) }}"
                                class="inline-block bg-cyan-600 text-white text-xs px-3 py-1 rounded hover:bg-cyan-700">Voir</a>
                            <a href="{{ route('acte.edit', $acte->id) }}"
                                class="inline-block bg-yellow-500 text-white text-xs px-3 py-1 rounded hover:bg-yellow-600">Modifier</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection