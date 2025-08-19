@extends('layouts.app')

@section('titre')
    Tableau de bord - Agent Mairie
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    {{-- Notifications --}}
    @foreach (['success' => 'green', 'info' => 'blue', 'error' => 'red'] as $type => $color)
        @if(session($type))
        <div class="flex items-start bg-{{ $color }}-100 border-l-4 border-{{ $color }}-500 text-{{ $color }}-700 px-4 py-3 rounded mb-4">
            <svg class="h-5 w-5 mr-3 mt-1 text-{{ $color }}-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11H9v4h2V7zm0 6H9v2h2v-2z"
                      clip-rule="evenodd" />
            </svg>
            <div>
                <p class="font-semibold capitalize">{{ $type }}</p>
                <p>{{ session($type) }}</p>
            </div>
        </div>
        @endif
    @endforeach

    {{-- Statistiques --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        @php
            $cards = [
                ['label' => 'Total Demandes', 'value' => $total, 'color' => 'bg-blue-600'],
                ['label' => "Aujourd'hui", 'value' => $todayCount, 'color' => 'bg-green-600'],
                ['label' => 'Cette semaine', 'value' => $weekCount, 'color' => 'bg-yellow-500'],
                ['label' => 'Ce mois', 'value' => $monthCount, 'color' => 'bg-cyan-600']
            ];
        @endphp

        @foreach($cards as $card)
        <div class="{{ $card['color'] }} text-white rounded-lg shadow-md p-5 transition hover:scale-105 duration-300">
            <p class="text-sm font-medium">{{ $card['label'] }}</p>
            <p class="text-3xl font-bold mt-2">{{ $card['value'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Section: Demandes actes en attente --}}
    <div class="bg-white rounded-lg shadow-md mb-10">
        <div class="px-6 py-4 bg-gray-100 rounded-t-md border-b">
            <h2 class="text-xl font-bold text-gray-800">Demandes d'actes de naissance en attente</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full table-auto text-sm text-gray-700">
                <thead class="bg-gray-200 text-left uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-3">Nom Demandeur</th>
                        <th class="px-6 py-3">Nom Enfant</th>
                        <th class="px-6 py-3">N° Volet</th>
                        <th class="px-6 py-3">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($demandes as $demande)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">{{ $demande->nom_complet }}</td>
                        <td class="px-6 py-4">
                            {{ $demande->volet?->prenom_enfant }} {{ $demande->volet?->nom_enfant }}
                        </td>
                        <td class="px-6 py-4">{{ $demande->volet?->num_volet ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            @switch($demande->statut)
                                @case('Validé')
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Validé</span>
                                    @break
                                @case('Rejeté')
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Rejeté</span>
                                    @break
                                @default
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">{{ ucfirst($demande->statut) }}</span>
                            @endswitch
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Aucune demande en attente.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Section: Copies d’acte de naissance --}}
    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 bg-gray-100 rounded-t-md border-b">
            <h2 class="text-xl font-bold text-gray-800">Demandes de copies d’acte de naissance</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full table-auto text-sm text-gray-700">
                <thead class="bg-gray-200 text-left uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-3">Nom Demandeur</th>
                        <th class="px-6 py-3">Nom Enfant</th>
                        <th class="px-6 py-3">Nbre de copies</th>
                        <th class="px-6 py-3">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($demandesCopies as $demande)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">{{ $demande->nom_complet }}</td>
                        <td class="px-6 py-4">
                            {{ $demande->volet?->prenom_enfant }} {{ $demande->volet?->nom_enfant ?? '----' }}
                        </td>
                        <td class="px-6 py-4">{{ $demande->nombre_copie ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @switch($demande->statut)
                                @case('Validé')
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Validé</span>
                                    @break
                                @case('Rejeté')
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Rejeté</span>
                                    @break
                                @default
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">{{ ucfirst($demande->statut) }}</span>
                            @endswitch
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Aucune demande trouvée.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
