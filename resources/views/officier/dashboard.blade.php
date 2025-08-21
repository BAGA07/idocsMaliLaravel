@extends('layouts.app')
@section('titre')Dashboard Officier @endsection
@section('content')
<div class="right_col" role="main">
    <h2 class="text-2xl font-semibold mb-6">Tableau de bord - Officier d'état civil</h2>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <!-- Section Actes de naissance -->
    <div class="bg-white shadow rounded mb-6">
        <div class="border-b px-6 py-3 font-semibold">Actes de naissance à finaliser</div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Type</th>
                        <th class="px-4 py-2 border">Numéro acte</th>
                        <th class="px-4 py-2 border">Nom Enfant</th>
                        <th class="px-4 py-2 border">Date Naissance</th>
                        <th class="px-4 py-2 border">Statut</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($actes as $acte)
                    <tr>
                        <td class="px-4 py-2 border">Acte de naissance</td>
                        <td class="px-4 py-2 border">{{ $acte->num_acte }}</td>
                        <td class="px-4 py-2 border">{{ $acte->prenom }} {{ $acte->nom }}</td>
                        <td class="px-4 py-2 border">{{ $acte->date_naissance_enfant }}</td>
                        <td class="px-4 py-2 border">@if(!$acte->finalized) <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded">À finaliser</span> @else <span class="bg-green-200 text-green-800 px-2 py-1 rounded">Finalisé</span> @endif</td>
                        <td class="px-4 py-2 border">
                            @if(!$acte->finalized)
                                <a href="{{ route('officier.actes.finaliser', $acte->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Finaliser</a>
                            @else
                                {{-- <a href="{{ route('officier.actes.pdf', $acte->id) }}" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">PDF</a> --}}
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-4">Aucun acte à finaliser.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section Copies/Extraits -->
    <div class="bg-white shadow rounded mb-6">
        <div class="border-b px-6 py-3 font-semibold">Copies/Extraits à finaliser</div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Type</th>
                        <th class="px-4 py-2 border">Numéro acte</th>
                        <th class="px-4 py-2 border">Nom Enfant</th>
                        <th class="px-4 py-2 border">Date Naissance</th>
                        <th class="px-4 py-2 border">Statut</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($copiesEnAttente as $copie)
                    <tr>
                        <td class="px-4 py-2 border">Copie/Extrait</td>
                        <td class="px-4 py-2 border">{{ $copie->num_acte }}</td>
                        <td class="px-4 py-2 border">{{ $copie->prenom }} {{ $copie->nom }}</td>
                        <td class="px-4 py-2 border">{{ $copie->date_naissance_enfant }}</td>
                        <td class="px-4 py-2 border">
                            <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded">En attente de signature</span>
                        </td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('officier.copies.finaliser', $copie->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Finaliser</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-4">Aucune copie/extrait à finaliser.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

{{-- Historique des actes finalisés --}}
<div class="bg-white shadow rounded mb-6 mt-10">
    <div class="border-b px-6 py-3 font-semibold text-green-700">Historique des actes finalisés</div>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Numéro acte</th>
                    <th class="px-4 py-2 border">Nom Enfant</th>
                    <th class="px-4 py-2 border">Date Naissance</th>
                    <th class="px-4 py-2 border">Date Signature</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($actesFinalises as $acte)
                <tr>
                    <td class="px-4 py-2 border">{{ $acte->num_acte }}</td>
                    <td class="px-4 py-2 border">{{ $acte->prenom }} {{ $acte->nom }}</td>
                    <td class="px-4 py-2 border">{{ $acte->date_naissance_enfant }}</td>
                    <td class="px-4 py-2 border">{{ $acte->signed_at }}</td>
                    <td class="px-4 py-2 border">
                        {{-- <a href="{{ route('officier.actes.pdf', $acte->id) }}" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">PDF</a> --}}
                        <a href="{{ route('acte.show', $acte->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Voir</a>
                    </td>                                                                                

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- Historique des copies/extraits finalisés --}}
<div class="bg-white shadow rounded mb-6">
    <div class="border-b px-6 py-3 font-semibold text-green-700">Historique des copies/extraits finalisés</div>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Numéro acte</th>
                    <th class="px-4 py-2 border">Nom Enfant</th>
                    <th class="px-4 py-2 border">Date Naissance</th>
                    <th class="px-4 py-2 border">Date Signature</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($copiesFinalisees as $copie)
                <tr>
                    <td class="px-4 py-2 border">{{ $copie->num_acte }}</td>
                    <td class="px-4 py-2 border">{{ $copie->prenom }} {{ $copie->nom }}</td>
                    <td class="px-4 py-2 border">{{ $copie->date_naissance_enfant }}</td>
                    <td class="px-4 py-2 border">{{ $copie->signed_at }}</td>
                    <td class="px-4 py-2 border">
                                                                                                        <a href="{{ route('copies.show', $copie->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Voir</a>
                        {{-- <a href="{{ route('officier.copies.pdf', $copie->id) }}" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">PDF</a> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection 