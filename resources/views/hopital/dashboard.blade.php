@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-4 shadow rounded-lg border-l-4 border-blue-600">
            <p class="text-sm text-gray-600">Total des naissances</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalNaissances ?? 0 }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg border-l-4 border-blue-600">
            <p class="text-sm text-gray-600">Total Garçons (année)</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalGarçons ?? 0 }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg border-l-4 border-pink-600">
            <p class="text-sm text-gray-600">Total Filles (année)</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalFilles ?? 0 }}</p>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-gray-700">Liste des naissances enregistrées</h2>
            <a href="{{ route('naissances.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Nouvelle naissance
            </a>
        </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 uppercase">Date</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 uppercase">Nom du père</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 uppercase">Nom de la mère</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 uppercase">Contact</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 uppercase">Sexe</th>
                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($declarations as $declaration)
                <tr>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($declaration->heure_naissance)->format('d/m/Y H:i')
                        }}</td>
                    <td class="px-4 py-2">{{ $declaration->prenom_pere }} {{ $declaration->nom_pere }}</td>
                    <td class="px-4 py-2">{{ $declaration->prenom_mere }} {{ $declaration->nom_mere }}</td>
                    <td class="px-4 py-2">+223 {{ $declaration->declarant->telephone }}</td>
                    <td class="px-4 py-2">
                        @if ($declaration->sexe === 'M')
                        <span
                            class="text-blue-800 bg-blue-100 px-2 py-1 rounded-full text-xs font-semibold">Masculin</span>
                        @elseif ($declaration->sexe === 'F')
                        <span
                            class="text-pink-800 bg-pink-100 px-2 py-1 rounded-full text-xs font-semibold">Féminin</span>
                        @else
                        <span
                            class="text-gray-800 bg-gray-200 px-2 py-1 rounded-full text-xs font-semibold">Indéfini</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-center space-x-2">
                        <a href="{{ route('naissances.show', $declaration->id_volet) }}" class="text-blue-600"><i
                                class="fa fa-eye"></i></a>
                        <a href="{{ route('naissances.edit', $declaration->id_volet) }}" class="text-yellow-500"><i
                                class="fa fa-edit"></i></a>
                        <form id="delete-form-{{ $declaration->id_volet }}"
                            action="{{ route('naissances.destroy', $declaration->id_volet) }}" method="POST"
                            class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button onclick="confirmDelete({{ $declaration->id_volet }})" class="text-red-600"><i
                                class="fa fa-trash"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 py-4">Aucune déclaration enregistrée.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $declarations->links() }}
        </div>
    </div>
</div>
@endsection