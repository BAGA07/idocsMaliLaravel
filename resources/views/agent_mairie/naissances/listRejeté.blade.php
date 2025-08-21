@extends('layouts.app')

@section('titre')
    Liste de toutes les demandes
@endsection

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded shadow-lg">

    <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Liste des Demandes Rejetées</h1>

    {{-- Demandes de copies traitées --}}
    <h2 class="text-2xl font-bold mb-4 text-gray-800 border-b-2 border-green-400 pb-2">
        Demandes de Copies d'Extraits Rejetées
    </h2>

    @if($demandesCopies->isEmpty())
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-12" role="alert">
            <p class="font-bold">Information</p>
            <p>Aucune demande de copie Rejetée n'est disponible.</p>
        </div>
    @else
        <div class="overflow-x-auto shadow-md rounded-lg mb-12">
            <table class="min-w-full table-auto border border-gray-300 text-sm">
                <thead class="bg-green-100">
                    <tr>
                        <th class="px-4 py-3 border text-left font-semibold text-gray-700 uppercase">Nom Demandeur</th>
                        <th class="px-4 py-3 border text-left font-semibold text-gray-700 uppercase">Telephone Demandeur</th>
                        <th class="px-4 py-3 border text-left font-semibold text-gray-700 uppercase">Email Demandeur</th>
                        <th class="px-4 py-3 border text-left font-semibold text-gray-700 uppercase">Nombre Copies</th>
                        <th class="px-4 py-3 border text-left font-semibold text-gray-700 uppercase">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($demandesCopies as $demande)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                        <td class="px-4 py-3 border">{{ $demande->nom_complet }}</td>
                        <td class="px-4 py-3 border">{{ $demande->telephone }}</td>
                        <td class="px-4 py-3 border">{{ $demande->email ?? 'N/A' }}</td>
                        <td class="px-4 py-3 border">{{ $demande->nombre_copie ?? 'N/A' }}</td>
                        <td class="px-4 py-3 border">
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Séparateur --}}
    <hr class="my-12 border-gray-300">

    {{-- Demandes d’actes originaux validés --}}
    <h2 class="text-2xl font-bold mb-4 text-gray-800 border-b-2 border-blue-400 pb-2">
        Demandes d’Actes de Naissance Originaux Rejetées
    </h2>

    @if($demandes->isEmpty())
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded" role="alert">
            <p class="font-bold">Information</p>
            <p>Aucune demande d'acte original Rejetée n’est disponible pour le moment.</p>
        </div>
    @else
        <div class="overflow-x-auto shadow-md rounded-lg">
            <table class="min-w-full table-auto border border-gray-300 text-sm">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-4 py-3 border text-left font-semibold text-gray-700 uppercase">Nom Demandeur</th>
                        <th class="px-4 py-3 border text-left font-semibold text-gray-700 uppercase">Nom Enfant</th>
                        <th class="px-4 py-3 border text-left font-semibold text-gray-700 uppercase">Numéro Volet</th>
                        <th class="px-4 py-3 border text-left font-semibold text-gray-700 uppercase">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($demandes as $demande)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                        <td class="px-4 py-3 border">{{ $demande->nom_complet }}</td>
                        <td class="px-4 py-3 border">
                            {{ optional($demande->volet)->prenom_enfant }} {{ optional($demande->volet)->nom_enfant }}
                        </td>
                        <td class="px-4 py-3 border">{{ optional($demande->volet)->num_volet ?? 'N/A' }}</td>
                        <td class="px-4 py-3 border">
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
