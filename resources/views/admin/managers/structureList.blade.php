@extends('layouts.app')

@section('content')
<div class="right_col" role="main">
    <div class="container-fluid mt-4">

        <div class="x_panel">
            <div class="x_title d-flex justify-content-between align-items-center">
                <h2><i class="fa fa-users"></i> Liste des Structure</h2>
                <a href="{{ route('structure.list') }}" class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i> Ajouter une structure
                </a>
            </div>

            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="bg-info text-black">
                            <tr class="text-center">
                                <th>Nom</th>
                                <th>Localité</th>
                                <th>Commune</th>
                                <th>Téléphone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($structures as $structure)
                            <tr>

                                <td>{{ $structure->nom_hopital ?? $structure->nom_mairie }}</td>
                                <td>{{ $structure-> }}</td>
                                <td>{{ $structure->commune }}</td>
                                <td>{{ $structure->telephone }}</td>
                                <td>
                                    @if($structure->nom_hopital)
                                    <span class="badge bg-info">Hôpital</span>
                                    @elseif($structure->nom_mairie)
                                    <span class="badge bg-success">Mairie</span>
                                    @else
                                    <span class="badge bg-danger">Non assigné</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('structure.list', $structure->id) }}"
                                        class="btn btn-sm btn-outline-info" title="Voir les détails">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="{{ route('structure.list', $structure->id) }}"
                                        class="btn btn-sm btn-outline-warning" title="Modifier">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{ route('structure.list', $structure->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Confirmer la suppression de ce structure ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Aucun structure enregistré pour le
                                    moment.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- table-responsive -->
            </div> <!-- x_content -->
        </div> <!-- x_panel -->

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 text-sm text-gray-700">
                <thead class="bg-blue-100 text-gray-800">
                    <tr class="text-center">
                        <th class="border px-4 py-2">Nom</th>
                        <th class="border px-4 py-2">Localité</th>
                        <th class="border px-4 py-2">Commune</th>
                        <th class="border px-4 py-2">Téléphone</th>
                        <th class="border px-4 py-2">Type</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($structures as $structure)

                    <tr class="text-center hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $structure->hopitaux->nom_hopital ?? $structure->nom_mairie }}
                        </td>
                        {{-- <td class="border px-4 py-2">{{ $structure->nom_hopital }}</td>
                        <td class="border px-4 py-2">{{ $structure->commune}}</td>
                        <td class="border px-4 py-2">{{ $structure->telephone }}</td> --}}
                        <td class="border px-4 py-2">
                            @if($structure->nom_hopital)
                            <span
                                class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">Hôpital</span>
                            @elseif($structure->nom_mairie)
                            <span
                                class="inline-block bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">Mairie</span>
                            @else
                            <span class="inline-block bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded">Non
                                assigné</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2 flex justify-center space-x-2">
                            <a href="{{ route('structure.list', $structure->id) }}"
                                class="text-blue-600 hover:text-blue-800" title="Voir les détails">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('structure.list', $structure->id) }}"
                                class="text-yellow-600 hover:text-yellow-800" title="Modifier">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('structure.list', $structure->id) }}" method="POST"
                                onsubmit="return confirm('Confirmer la suppression de cette structure ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" title="Supprimer">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="border px-4 py-4 text-center text-gray-500">Aucun structure enregistré
                            pour le moment.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection