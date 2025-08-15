@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Demandes en attente</h2>
    <table class="min-w-full table-auto border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">Nom Demandeur</th>
                <th class="px-4 py-2 border">Nom Enfant</th>
                <th class="px-4 py-2 border">Numéro Volet</th>
                <th class="px-4 py-2 border">Statut</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @dd($demandes)
            @foreach($demandes as $demande)
            <tr>
                <td class="px-4 py-2 border">{{ $demande->nom_complet }}</td>
                <td class="px-4 py-2 border">{{ $demande->volet ? $demande->volet->prenom_enfant . ' ' .
                    $demande->volet->nom_enfant : 'N/A' }}</td>
                <td class="px-4 py-2 border">{{ optional($demande->volet)->num_volet ?? 'N/A' }}</td>
                <td class="px-4 py-2 border">{{ $demande->statut }}</td>
                <td class="px-4 py-2 border space-x-2">
                    <a href="{{ route('mairie.demandes.traiter', $demande->id) }}"
                        class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Traiter</a>
                    <form action="{{ route('mairie.demandes.rejeter', $demande->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Rejeter</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection