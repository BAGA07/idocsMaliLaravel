@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Tableau de bord - Agent Mairie</h2>

    <!-- Section Actes de naissance -->
    <div class="mb-12 p-6 bg-blue-50 border border-blue-200 rounded">
        <h2 class="text-xl font-bold mb-4 text-blue-800">Gestion des actes de naissance</h2>
        {{-- Tableau 1 : Actes de naissance traités par la mairie --}}
        <div class="mb-10">
            <h3 class="text-xl font-semibold mb-4">Actes de naissance traités par la mairie (prêts à être envoyés à l'officier)</h3>
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
                        <td class="px-4 py-2 border">
                            @if($acte->statut)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $acte->statut }}
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Traité
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border space-x-2">
                            <a href="{{ route('acte.show', $acte->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Voir</a>
                            <a href="{{ route('acte.edit', $acte->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Modifier</a>
                            <button type="button" 
                                class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-sm"
                                onclick="confirmSend({{ $acte->id }})">
                                Envoyer à l'officier
                            </button>
                            <!-- Formulaire caché -->
                            <form id="send-form-{{ $acte->id }}" 
                                action="{{ route('acte.envoyer_officier', $acte->id) }}" 
                                method="POST" 
                                style="display: none;">
                                @csrf
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tableau 2 : Actes de naissance à finaliser par l'officier --}}
        <div class="mb-10 mt-12">
            <h3 class="text-xl font-semibold mb-4 text-yellow-700">Actes de naissance à finaliser (envoyés à l'officier)</h3>
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
                    @foreach($actesAFinaliser as $acte)
                    <tr>
                        <td class="px-4 py-2 border">{{ $acte->num_acte }}</td>
                        <td class="px-4 py-2 border">{{ $acte->prenom }} {{ $acte->nom }}</td>
                        <td class="px-4 py-2 border">{{ $acte->date_naissance_enfant }}</td>
                        <td class="px-4 py-2 border">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                {{ $acte->statut }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border space-x-2">
                            <a href="{{ route('acte.show', $acte->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Voir</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tableau 3 : Actes de naissance finalisés par l'officier --}}
        <div class="mb-10 mt-12">
            <h3 class="text-xl font-semibold mb-4 text-green-700">Actes de naissance finalisés (signés par l'officier)</h3>
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
                    @foreach($actesFinalises as $acte)
                    <tr>
                        <td class="px-4 py-2 border">{{ $acte->num_acte }}</td>
                        <td class="px-4 py-2 border">{{ $acte->prenom }} {{ $acte->nom }}</td>
                        <td class="px-4 py-2 border">{{ $acte->date_naissance_enfant }}</td>
                        <td class="px-4 py-2 border">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $acte->statut }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border space-x-2">
                            <a href="{{ route('acte.show', $acte->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Voir</a>
                            <a href="{{ route('acte.show', $acte->id) }}?imprimer=1" target="_blank" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-sm">Imprimer</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
function confirmSend(id) {
    if(confirm("Êtes-vous sûr de vouloir envoyer cet acte à l'officier ?")) {
        document.getElementById('send-form-' + id).submit();
    }
}
</script>
@endsection
