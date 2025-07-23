@extends('layouts.app')

@section('content')
<head><script src="https://cdn.tailwindcss.com"></script></head>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="bg-cyan-700 text-white px-6 py-4 text-lg font-semibold">
        Liste des extraits de naissance
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider border">Numéro acte</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider border">Nom enfant</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider border">Prénom enfant</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider border">Date naissance</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider border">Déclarant</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider border">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($actesCopies as $demande)
                    @if($demande->acte)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 border">{{ $demande->acte->num_acte ?? 'N/A' }}</td>
                        <td class="px-6 py-3 border">{{ $demande->acte->nom ?? 'N/A' }}</td>
                        <td class="px-6 py-3 border">{{ $demande->acte->prenom ?? 'N/A' }}</td>
                        <td class="px-6 py-3 border">{{ $demande->acte->date_naissance_enfant ?? 'N/A' }}</td>
                        <td class="px-6 py-3 border">
                            {{ $demande->acte->declarant->prenom_declarant ?? 'N/A' }}
                            {{ $demande->acte->declarant->nom_declarant ?? '' }}
                        </td>
                        <td class="px-6 py-3 border space-x-2">
                            <a href="{{ route('acte.show', $demande->acte->id) }}"
                                class="inline-block bg-cyan-600 hover:bg-cyan-700 text-white text-xs font-semibold px-3 py-1 rounded transition">
                                Voir
                            </a>
                            <a href="{{ route('acte.edit', $demande->acte->id) }}"
                                class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold px-3 py-1 rounded transition">
                                Modifier
                            </a>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
