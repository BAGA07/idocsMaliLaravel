@extends('layouts.app')

@section('titre')
Modification du profile
@endsection

@section('content')
<div class="right_col" role="main">
    <h2 class="text-2xl font-semibold mb-6">Tableau de bord - Agent de Mairie</h2>

    {{-- Messages Flash --}}
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
        <div class="flex">
            <div class="py-1">
                <svg class="fill-current h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <p class="font-bold">Succès !</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if(session('info'))
    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4" role="alert">
        <div class="flex">
            <div class="py-1">
                <svg class="fill-current h-4 w-4 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <p class="font-bold">Information</p>
                <p class="text-sm">{{ session('info') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
        <div class="flex">
            <div class="py-1">
                <svg class="fill-current h-4 w-4 text-red-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <p class="font-bold">Erreur !</p>
                <p class="text-sm">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif
    <div align="right">
        @include('agent_mairie.partials.notifications', ['notifications' => $notifications])
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-600 text-white rounded shadow p-4">
            <h5 class="text-sm font-semibold">Total Démandes</h5>
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



    <!-- Tableau Demandes actes en attente (volet) -->
    <div class="bg-white shadow rounded mb-6">
        <div class="border-b px-6 py-3 font-semibold">Demandes actes en attente</div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Nom Demandeur</th>
                        <th class="px-4 py-2 border">Nom Enfant</th>
                        <th class="px-4 py-2 border">Numéro Volet</th>
                        <th class="px-4 py-2 border">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($demandes as $demande)
                    <tr>
                        <td class="px-4 py-2 border">{{ $demande->nom_complet }}</td>
                        <td class="px-4 py-2 border">
                            {{ $demande->volet ? $demande->volet->prenom_enfant . ' ' . $demande->volet->nom_enfant :
                            'N/A' }}
                        </td>
                        <td class="px-4 py-2 border">{{ optional($demande->volet)->num_volet ?? 'N/A' }}</td>
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">Aucune demande d'acte en attente.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Liste des actes -->
    <div class="bg-white shadow rounded mb-6">
        <div class="border-b px-6 py-3 font-semibold">Demande pour les copie d'acte naissance</div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Nom Demandeur</th>
                        <th class="px-4 py-2 border">Nom Enfant</th>
                        <th class="px-4 py-2 border">Num acte</th>
                        <th class="px-4 py-2 border">Nombre de copie</th>
                        <th class="px-4 py-2 border">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($demandesCopies as $demande)
                    <tr>
                        <td class="px-4 py-2 border">{{ $demande->nom_complet }}</td>
                        <td class="px-4 py-2 border">
                            {{ $demande->volet ? $demande->volet->prenom_enfant . ' ' . $demande->volet->nom_enfant :
                            '----' }}
                        </td>
                        <td class="px-4 py-2 border">{{ $demande->num_acte ?? '-----' }}</td>
                        <td class="px-4 py-2 border">{{ $demande->nombre_copie }}</td>
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

                    </tr>
                    @endforeach
                    
                    {{-- @foreach($demandeNaissance as $demande)
                    <tr>
                        <td>{{$demande->acte->date_naissance_enfant}}</td>
                    </tr>
                    @endforeach --}}

                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection