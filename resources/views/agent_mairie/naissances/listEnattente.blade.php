@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded shadow-lg">

    <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Gestion des Demandes en Attente</h1>

    {{-- Section pour les demandes de copies d'extraits --}}
    <h2 class="text-2xl font-bold mb-4 text-gray-800 border-b-2 border-green-400 pb-2">
        Demandes de Copies d'Extraits en Attente
    </h2>
    <p class="mb-6 text-gray-700">
        Ces demandes concernent la délivrance de copies d'actes de naissance déjà enregistrés, ou de nouvelles demandes de copies d'extraits.
    </p>

    @if($demandesCopiesEnAttente->isEmpty())
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-12" role="alert">
            <p class="font-bold">Information Importante</p>
            <p>Aucune demande de copie d'extrait d'acte n'est en attente de traitement pour le moment.</p>
        </div>
    @else
        <div class="overflow-x-auto shadow-md rounded-lg mb-12">
            <table class="min-w-full table-auto border border-gray-300 text-sm">
                <thead class="bg-green-100">
                    <tr>
                        <th class="px-4 py-3 border border-gray-300 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Nom Demandeur</th>
                        <th class="px-4 py-3 border border-gray-300 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Nom Enfant</th>
                        <th class="px-4 py-3 border border-gray-300 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Numéro Acte Source</th>
                        <th class="px-4 py-3 border border-gray-300 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Nombre Copies</th>
                        <th class="px-4 py-3 border border-gray-300 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Statut</th>
                        <th class="px-4 py-3 border border-gray-300 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($demandesCopiesEnAttente as $demandeCopie)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                        <td class="px-4 py-3 border border-gray-300 whitespace-nowrap">{{ $demandeCopie->nom_complet }}</td>
                        <td class="px-4 py-3 border border-gray-300 whitespace-nowrap">
                            {{ $demandeCopie->prenom_enfant }} {{ $demandeCopie->nom_enfant }}
                        </td>
                        <td class="px-4 py-3 border border-gray-300 whitespace-nowrap">
                            {{ $demandeCopie->num_acte_source ?? 'N/A' }}
                        </td>
                        <td class="px-4 py-3 border border-gray-300 whitespace-nowrap">
                            {{ $demandeCopie->nombre_copie ?? 'N/A' }} {{-- Assurez-vous que 'nombre_copie' existe sur le modèle Demande ou Acte --}}
                        </td>
                        <td class="px-4 py-3 border border-gray-300 whitespace-nowrap">
                            @switch($demandeCopie->statut)
                                @case('Validé')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Validé</span>
                                    @break
                                @case('Rejeté')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejeté</span>
                                    @break
                                @default
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $demandeCopie->statut }}</span>
                            @endswitch
                        </td>
                        <td class="px-4 py-3 border border-gray-300 space-x-2 whitespace-nowrap">
                            <a href="{{ route('acteCopies.create', $demandeCopie->id) }}"
                                class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-150 ease-in-out text-sm font-medium">Traiter Copie</a>
                            <form action="{{ route('mairie.demandes.rejeter', $demandeCopie->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir rejeter cette demande de copie ? Cette action est irréversible.');">
                                @csrf
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-150 ease-in-out text-sm font-medium">Rejeter</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <hr class="my-12 border-gray-300">

    {{-- Section pour les demandes d'actes de naissance originaux --}}
    <h2 class="text-2xl font-bold mb-4 text-gray-800 border-b-2 border-blue-400 pb-2">
        Demandes d'Actes de Naissance Originaux en Attente
    </h2>
    <p class="mb-6 text-gray-700">
        Ces demandes proviennent des déclarations de naissance faites par les hôpitaux. Elles sont prêtes à être converties en actes de naissance officiels après vérification.
    </p>

    @if($demandesOriginalesEnAttente->isEmpty())
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded" role="alert">
            <p class="font-bold">Information Importante</p>
            <p>Aucune demande d'acte de naissance original n'est en attente de traitement pour le moment.</p>
        </div>
    @else
        <div class="overflow-x-auto shadow-md rounded-lg">
            <table class="min-w-full table-auto border border-gray-300 text-sm">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-4 py-3 border border-gray-300 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Nom Demandeur</th>
                        <th class="px-4 py-3 border border-gray-300 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Nom Enfant</th>
                        <th class="px-4 py-3 border border-gray-300 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Numéro Volet</th>
                        <th class="px-4 py-3 border border-gray-300 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Statut</th>
                        <th class="px-4 py-3 border border-gray-300 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($demandesOriginalesEnAttente as $demande)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                        <td class="px-4 py-3 border border-gray-300 whitespace-nowrap">{{ $demande->nom_complet }}</td>
                        <td class="px-4 py-3 border border-gray-300 whitespace-nowrap">
                            {{ optional($demande->volet)->prenom_enfant . ' ' . optional($demande->volet)->nom_enfant }}
                        </td>
                        <td class="px-4 py-3 border border-gray-300 whitespace-nowrap">
                            {{ optional($demande->volet)->num_volet ?? 'N/A' }}
                        </td>
                        <td class="px-4 py-3 border border-gray-300 whitespace-nowrap">
                            @switch($demande->statut)
                                @case('Validé')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Validé</span>
                                    @break
                                @case('Rejeté')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejeté</span>
                                    @break
                                @default
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $demande->statut }}</span>
                            @endswitch
                        </td>
                        <td class="px-4 py-3 border border-gray-300 space-x-2 whitespace-nowrap">
                            <a href="{{ route('acte.create', $demande->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-150 ease-in-out text-sm font-medium">Traiter</a>
                            <form action="{{ route('mairie.demandes.rejeter', $demande->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir rejeter cette demande d\'acte original ? Cette action est irréversible.');">
                                @csrf
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-150 ease-in-out text-sm font-medium">Rejeter</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection