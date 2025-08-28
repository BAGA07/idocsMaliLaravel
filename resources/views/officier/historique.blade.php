@extends('layouts.app')
@section('titre')Historique des actes et copies finalisés @endsection
@section('content')
<div class="right_col" role="main">
    <h2 class="text-2xl font-semibold mb-6">Historique des actes et copies finalisés</h2>
    {{-- Historique des actes finalisés --}}
    <div class="bg-white shadow rounded mb-6 mt-10">
        <div class="border-b px-6 py-3 font-semibold text-green-700">Actes de naissance finalisés</div>
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
                            {{-- <a href="{{ route('officier.actes.pdf', $acte->id) }}" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">PDF</a>
                            <button onclick="window.print()" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Imprimer</button> --}}
                                                                                <a href="{{ route('officier.acte.show', $acte->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Voir</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Historique des copies/extraits finalisés --}}
    <div class="bg-white shadow rounded mb-6">
        <div class="border-b px-6 py-3 font-semibold text-green-700">Copies/extraits finalisés</div>
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
                        <td class="px-4 py-2 border">{{ $copie->prenom_enfant }} {{ $copie->nom_enfant }}</td>
                        <td class="px-4 py-2 border">{{ $copie->date_naissance }}</td>
                        <td class="px-4 py-2 border">{{ $copie->signed_at }}</td>
                        <td class="px-4 py-2 border">
                            {{-- <a href="{{ route('officier.copies.pdf', $copie->id) }}" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">PDF</a>
                            <button onclick="window.print()" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Imprimer</button> --}}
                                                                                <a href="{{ route('officier.copies.show', $copie->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Voir</a>
                        </td> 

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 