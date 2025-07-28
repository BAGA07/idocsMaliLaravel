@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Actes créés</h2>
    <table class="min-w-full table-auto border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">Numéro acte</th>
                <th class="px-4 py-2 border">Nom enfant</th>
                <th class="px-4 py-2 border">Date naissance</th>
                <th class="px-4 py-2 border">Statut</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($actes as $acte)
            <tr>
                <td class="px-4 py-2 border">{{ $acte->num_acte }}</td>
                <td class="px-4 py-2 border">{{ $acte->prenom }} {{ $acte->nom }}</td>
                <td class="px-4 py-2 border">{{ $acte->date_naissance_enfant }}</td>
                <td class="px-4 py-2 border">{{ $acte->statut }}</td>
                <td class="px-4 py-2 border space-x-2">
                    <a href="{{ route('acte.show', $acte->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Show</a>
                    <form action="{{ route('acte.destroy', $acte->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection