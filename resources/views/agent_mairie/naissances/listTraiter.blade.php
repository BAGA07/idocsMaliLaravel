@extends('layouts.app')
@section('titre')Liste de tous les demandes @endsection
@section('content')
<div class="bg-white shadow rounded mb-6">
    <div class="border-b px-6 py-3 font-semibold">Demandes pour copie extrait</div>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Nom Demandeur</th>
                    <th class="px-4 py-2 border">Nom Enfant</th>
                    <th class="px-4 py-2 border">Numéro acte</th>
                    <th class="px-4 py-2 border">nombre_copie</th>
                    <th class="px-4 py-2 border">Statut</th>
                    {{-- <th class="px-4 py-2 border">Action</th>
                    <th class="px-4 py-2 border">ID</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($demandesCopies as $demande)
                {{-- @dd($demande->volet) --}}

                <tr>
                    <td class="px-4 py-2 border">{{ $demande->nom_complet }}</td>
                    <td class="px-4 py-2 border">
                        {{ $demande->prenom_enfant}} {{$demande->nom_enfant}}
                    </td>

                    <td class="px-4 py-2 border">{{ $demande->num_acte }}</td>
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


                    {{-- <td class="px-4 py-2 border">
                        <a href="{{ route('acteCopies.create',$demande->id) }}" --}} {{-- ></a>
                            href="{{ route('acteCopies.create.', $demande->acte->id) }}" --}} {{--
                            class="relative z-10 inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded hover:bg-blue-700">Traiter</a>
                    </td>
                    <td class="px-4 py-2 border">{{$demande->id}}</td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Tableau des demandes en attente -->
<div class="bg-white shadow rounded mb-6">
    <div class="border-b px-6 py-3 font-semibold">Demandes en Volet</div>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Nom Demandeur</th>
                    <th class="px-4 py-2 border">Nom Enfant</th>
                    <th class="px-4 py-2 border">Numéro Volet</th>
                    <th class="px-4 py-2 border">Statut</th>
                    {{-- <th class="px-4 py-2 border">Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($demandes as $demande)
                {{-- @dd($demande->volet) --}}

                <tr>
                    <td class="px-4 py-2 border">{{ $demande->nom_complet }}</td>
                    <td class="px-4 py-2 border">
                        {{ $demande->volet ? $demande->volet->prenom_enfant . ' ' . $demande->volet->nom_enfant :
                        'N/A' }}
                    </td>
                    <td class="px-4 py-2 border"> {{ optional($demande->volet)->num_volet ?? 'N/A' }}
                    </td>
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
                    {{-- <td class="px-4 py-2 border">
                        <a href="{{ route('acte.create', $demande->id) }}"
                            class="relative z-10 inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded hover:bg-blue-700">Traiter</a>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection