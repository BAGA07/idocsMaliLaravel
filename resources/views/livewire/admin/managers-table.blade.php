<div class="bg-white p-6 rounded-xl shadow">

    <form wire:submit.prevent="searchManagers" class="flex flex-wrap gap-4 mb-4 items-center">
        <input type="text" wire:model.defer="search" placeholder="Recherche nom, prénom, email..."
            class="rounded border-gray-300 px-3 py-2 w-56" />
        <select wire:model="role" class="rounded border-gray-300 px-2 py-2">
            <option value="">Tous rôles</option>
            <option value="superadmin">Superadmin</option>
            <option value="admin">Admin</option>
            <option value="agent_hopital">Agent hôpital</option>
            <option value="agent_mairie">Agent mairie</option>
        </select>
        <select wire:model="structure" class="rounded border-gray-300 px-2 py-2">
            <option value="">Toutes structures</option>
            <option value="hopital">Hôpital</option>
            <option value="mairie">Mairie</option>
        </select>
        <select wire:model="status" class="rounded border-gray-300 px-2 py-2">
            <option value="">Tous statuts</option>
            <option value="1">Actif</option>
            <option value="0">Inactif</option>
        </select>
        <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">Rechercher</button>
        <div class="text-center">
            <a href="{{ route('admin.managers.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 inline-block">
                <i class="fas fa-plus mr-2"></i> Ajouter un Utilisateur
            </a>
        </div>


    </form>

    <table class="min-w-full text-sm border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Nom</th>
                <th class="p-2 border">Prénom</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Rôle</th>
                <th class="p-2 border">Structure</th>
                <th class="p-2 border">Statut</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($managers as $manager)
            <tr class="hover:bg-gray-50">
                <td class="p-2 border">{{ $manager->nom }}</td>
                <td class="p-2 border">{{ $manager->prenom }}</td>
                <td class="p-2 border">{{ $manager->email }}</td>
                <td class="p-2 border">
                    <select wire:change="updateRole({{ $manager->id }}, $event.target.value)"
                        class="rounded border-gray-300 px-1 py-1">

                        <option value="admin" @if($manager->role=='manager') selected @endif>manager</option>
                        <option value="admin" @if($manager->role=='officier') selected @endif>officier</option>
                        <option value="admin" @if($manager->role=='admin') selected @endif>Admin</option>
                        <option value="agent_hopital" @if($manager->role=='agent_hopital') selected @endif>Agent hôpital
                        </option>
                        <option value="agent_mairie" @if($manager->role=='agent_mairie') selected @endif>Agent mairie
                        </option>
                    </select>
                </td>
                <td class="p-2 border">
                    @if($manager->id_hopital) Hôpital @elseif($manager->id_mairie) Mairie @else - @endif
                </td>
                <td class="p-2 border">
                    <span
                        class="px-2 py-1 rounded text-xs {{ $manager->actif ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $manager->actif ? 'Actif' : 'Inactif' }}
                    </span>
                </td>
                <td class="p-2 border">
                    <button onclick="window.location='{{ route('admin.managers.show', $manager->id) }}'" type="button"
                        class="px-2 py-1 rounded bg-blue-500 hover:bg-blue-600 text-white text-xs">
                        Voir
                    </button>
                    <button wire:click="toggleStatus({{ $manager->id }})"
                        class="px-2 py-1 rounded {{ $manager->actif ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }} text-white text-xs">
                        {{ $manager->actif ? 'Désactiver' : 'Activer' }}
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center p-4">Aucun manager trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">{{ $managers->links() }}</div>
</div>