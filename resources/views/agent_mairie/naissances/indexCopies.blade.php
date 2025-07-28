@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Copies créées</h2>
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
            @foreach($copies as $copie)
                <tr>
                    <td class="px-4 py-2 border">{{ $copie->num_acte }}</td>
                    <td class="px-4 py-2 border">{{ $copie->prenom_enfant }} {{ $copie->nom_enfant }}</td>
                    <td class="px-4 py-2 border">{{ $copie->date_naissance }}</td>
                    <td class="px-4 py-2 border">{{ $copie->statut }}</td>
                    <td class="px-4 py-2 border space-x-2">
                        <a href="{{ route('acteCopies.show', $copie->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Show</a>
                        <form action="{{ route('acteCopies.destroy', $copie->id) }}" method="POST" class="inline">
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