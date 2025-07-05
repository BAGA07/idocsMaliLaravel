<div>
    <input type="text" class="form-control mb-3" placeholder="Rechercher..." wire:model.debounce.500ms="search">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom Enfant</th>
                <th>Prénom Père</th>
                <th>Nom Mère</th>
                <th>Numéro Déclaration</th>
                <th>Date Naissance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($declarations as $declaration)
            <tr>
                <td>{{ $declaration->nom_enfant }}</td>
                <td>{{ $declaration->prenom_pere }}</td>
                <td>{{ $declaration->nom_mere }}</td>
                <td>{{ $declaration->declarant->numero_declaration ?? '---' }}</td>
                <td>{{ \Carbon\Carbon::parse($declaration->date_naissance)->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('naissances.show', $declaration->id) }}" class="btn btn-sm btn-info">Voir</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-danger">Aucun résultat trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div>
        {{ $declarations->links() }}
    </div>
</div>