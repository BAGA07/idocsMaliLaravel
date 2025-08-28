@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Gestion des officiers</h1>
                <p class="text-gray-600 mt-2">Gérez les officiers hôpital et mairie</p>
            </div>
            <a href="{{ route('manager.officiers.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-200">
                <i class="fa fa-user-plus mr-2"></i> Ajouter un officier
            </a>
        </div>



        <!-- Tableau des officiers -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Officier</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Structure</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dernière connexion</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($officiers as $officier)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div
                                            class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-sm font-medium text-gray-700">
                                                {{ strtoupper(substr($officier->prenom, 0, 1) . substr($officier->nom,
                                                0,
                                                1)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $officier->prenom }} {{ $officier->nom }}
                                        </div>
                                        <div class="text-sm text-gray-500">{{ $officier->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">

                                @if($officier->hopital)
                                {{ $officier->hopital->nom_hopital }}
                                @elseif($officier->mairie)
                                {{ $officier->mairie->nom_mairie }}
                                @else
                                <span class="text-gray-400">Non assigné</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div>{{ $officier->telephone }}</div>
                                <div class="text-gray-500">{{ $officier->adresse }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($officier->last_login_at)
                                {{ \Carbon\Carbon::parse($officier->last_login_at)->format('d/m/Y à H:i') }}
                                @else
                                <span class="text-gray-400">Jamais connecté</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('manager.officiers.show', $officier->id) }}"
                                        class="text-blue-600 hover:text-blue-900" title="Voir">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('manager.officiers.edit', $officier->id) }}"
                                        class="text-green-600 hover:text-green-900" title="Modifier">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    {{-- Bouton visible suppression --}}
                                    <button type="button" onclick="confirmDelete({{ $officier->id }})"
                                        class="text-red-600 hover:text-red-900" title="Supprimer">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    {{-- Formulaire caché --}}
                                    <form id="delete-form-{{ $officier->id }}"
                                        action="{{ route('manager.officiers.destroy', $officier->id) }}" method="POST"
                                        class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Aucun officier trouvé</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($officiers->hasPages())
        <div class="mt-6">
            {{ $officiers->links() }}
        </div>
        @endif
    </div>
</div>
@endsection