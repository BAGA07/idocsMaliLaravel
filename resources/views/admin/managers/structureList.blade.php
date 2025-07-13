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
                                <td>{{ $structure->nom_hopital }}</td>
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

    </div>
</div>
@endsection