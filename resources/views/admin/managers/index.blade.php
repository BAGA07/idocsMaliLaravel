@extends('layouts.app')

@section('content')
<div class="right_col" role="main">
    <div class="p-6">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fa fa-users text-blue-600"></i> Liste des Managers
                </h2>
                <a href="{{ route('managers.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded hover:bg-green-700 transition">
                    <i class="fa fa-plus mr-2"></i> Ajouter un manager
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border border-gray-200 divide-y divide-gray-200 text-sm">
                    <thead class="bg-blue-50 text-gray-700 text-center uppercase">
                        <tr>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Prénom</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Téléphone</th>
                            <th class="px-4 py-2">Structure</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-center">
                        @forelse($managers as $manager)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $manager->nom }}</td>
                            <td class="px-4 py-2">{{ $manager->prenom }}</td>
                            <td class="px-4 py-2">{{ $manager->email }}</td>
                            <td class="px-4 py-2">{{ $manager->telephone }}</td>
                            <td class="px-4 py-2">
                                @if($manager->role === 'agent_hopital')
                                <span
                                    class="inline-block px-2 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">Hôpital</span>
                                <div class="text-xs text-gray-700 mt-1">{{ $manager->hopital->nom_hopital }}</div>
                                @elseif($manager->role === 'agent_mairie')
                                <span
                                    class="inline-block px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Mairie</span>
                                <div class="text-xs text-gray-700 mt-1">{{ $manager->mairie->nom_mairie }}</div>
                                @else
                                <span
                                    class="inline-block px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">Non
                                    assigné</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('managers.show', $manager->id) }}"
                                        class="text-blue-600 hover:text-blue-800" title="Voir">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('managers.edit', $manager->id) }}"
                                        class="text-yellow-500 hover:text-yellow-700" title="Modifier">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('managers.destroy', $manager->id) }}" method="POST"
                                        onsubmit="return confirm('Confirmer la suppression de ce manager ?')"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Supprimer">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-4 text-gray-500 italic">Aucun manager enregistré pour le moment.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection