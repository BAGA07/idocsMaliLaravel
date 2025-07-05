@extends('layouts.app')

@section('content')
<div class="right_col" role="main">
    <div class="container-fluid mt-4">

        <div class="x_panel">
            <div class="x_title d-flex justify-content-between align-items-center">
                <h2><i class="fa fa-users"></i> Liste des Managers</h2>
                <a href="{{ route('managers.create') }}" class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i> Ajouter un manager
                </a>
            </div>

            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="bg-info text-black">
                            <tr class="text-center">
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Structure</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($managers as $manager)
                            <tr>
                                <td>{{ $manager->nom }}</td>
                                <td>{{ $manager->prenom }}</td>
                                <td>{{ $manager->email }}</td>
                                <td>{{ $manager->telephone }}</td>
                                <td>
                                    @if($manager->role === 'agent_hopital')
                                    <span class="badge bg-info">Hôpital</span>
                                    {{ $manager->hopital->nom_hopital }}
                                    @elseif($manager->role === 'agent_mairie')

                                    <span class="badge bg-success">Mairie</span>
                                    {{ $manager->mairie->nom_mairie }}
                                    @else
                                    <span class="badge bg-danger">Non assigné</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('managers.show', $manager->id) }}"
                                        class="btn btn-sm btn-outline-info" title="Voir les détails">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="{{ route('managers.edit', $manager->id) }}"
                                        class="btn btn-sm btn-outline-warning" title="Modifier">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{ route('managers.destroy', $manager->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Confirmer la suppression de ce manager ?')">
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
                                <td colspan="6" class="text-center text-muted">Aucun manager enregistré pour le moment.
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