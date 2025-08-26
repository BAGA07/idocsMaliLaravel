@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Gestion des Agents</h1>
                <p class="text-gray-600 mt-2">Gérez les agents hôpital et mairie</p>
            </div>
            <a href="{{ route('manager.agents.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-200">
                <i class="fa fa-user-plus mr-2"></i> Ajouter un agent
            </a>
        </div>

        <!-- Filtres -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-48">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Rechercher</label>
                    <input type="text" id="search" placeholder="Nom, prénom, email..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex-1 min-w-48">
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Rôle</label>
                    <select id="role"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Tous les rôles</option>
                        <option value="agent_hopital">Agent Hôpital</option>
                        <option value="agent_mairie">Agent Mairie</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Tableau des agents -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table id="usersTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Agent
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rôle
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Structure
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dernière connexion
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($agents as $agent)
                        <tr class="hover:bg-gray-50">
                            <!-- Nom + email -->
                            <td class="px-6 py-4 whitespace-nowrap name">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div
                                            class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-sm font-medium text-gray-700">
                                                {{ strtoupper(substr($agent->prenom, 0, 1) . substr($agent->nom, 0, 1))
                                                }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $agent->prenom }} {{ $agent->nom }}
                                        </div>
                                        <div class="text-sm text-gray-500 email">
                                            {{ $agent->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Rôle -->
                            <td class="px-6 py-4 whitespace-nowrap role" data-role="{{ $agent->role }}">
                                @if($agent->role === 'agent_hopital')
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fa fa-hospital-o mr-1"></i> Agent Hôpital
                                </span>
                                @else
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    <i class="fa fa-building mr-1"></i> Agent Mairie
                                </span>
                                @endif
                            </td>

                            <!-- Structure -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($agent->hopital)
                                {{ $agent->hopital->nom_hopital }}
                                @elseif($agent->mairie)
                                {{ $agent->mairie->nom_mairie }}
                                @else
                                <span class="text-gray-400">Non assigné</span>
                                @endif
                            </td>

                            <!-- Contact -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div>{{ $agent->telephone }}</div>
                                <div class="text-gray-500">{{ $agent->adresse }}</div>
                            </td>

                            <!-- Connexion -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($agent->last_login_at)
                                {{ \Carbon\Carbon::parse($agent->last_login_at)->diffForHumans() }}
                                @else
                                <span class="text-gray-400">Jamais connecté</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('manager.agents.show', $agent->id) }}"
                                        class="text-blue-600 hover:text-blue-900" title="Voir">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="{{ route('manager.agents.edit', $agent->id) }}"
                                        class="text-green-600 hover:text-green-900" title="Modifier">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    {{-- Bouton visible --}}
                                    <button type="button" onclick="confirmDelete({{ $agent->id }})"
                                        class="text-red-600 hover:text-red-900" title="Supprimer">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    {{-- Formulaire caché --}}
                                    <form id="delete-form-{{ $agent->id }}"
                                        action="{{ route('manager.agents.destroy', $agent->id) }}" method="POST"
                                        class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Aucun agent trouvé
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($agents->hasPages())
        <div class="mt-6">
            {{ $agents->links() }}
        </div>
        @endif
    </div>
</div>

<script>
    document.getElementById('search').addEventListener('input', filterData);
    document.getElementById('role').addEventListener('change', filterData);

    function filterData() {
        let search = document.getElementById('search').value.toLowerCase();
        let role = document.getElementById('role').value;

        let rows = document.querySelectorAll("#usersTable tbody tr");

        rows.forEach(row => {
            let name = row.querySelector(".name").textContent.toLowerCase();
            let email = row.querySelector(".email").textContent.toLowerCase();
            let userRole = row.querySelector(".role").dataset.role;

            let matchSearch = name.includes(search) || email.includes(search);
            let matchRole = role === "" || userRole === role;

            row.style.display = (matchSearch && matchRole) ? "" : "none";
        });
    }
</script>
@endsection