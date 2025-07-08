<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Modifier un acte de naissance</h5>
            <a href="{{ route('agent.dashboard') }}" class="btn btn-light btn-sm">← Retour au dashboard</a>
        </div>
        <div class="card-body">

            <form action="{{ route('acte.update', $acte->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nom de l'enfant</label>
                            <input type="text" name="nom_enfant" class="form-control" value="{{ old('nom_enfant', $acte->nom) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Prénom de l'enfant</label>
                            <input type="text" name="prenom_enfant" class="form-control" value="{{ old('prenom_enfant', $acte->prenom) }}">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date de naissance</label>
                            <input type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance', $acte->date_naissance_enfant) }}">
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label>Heure de naissance</label>
                            <input type="time" name="heure_naissance" class="form-control" value="{{ old('heure_naissance', $acte->heure_naissance) }}">
                        </div>
                    </div> -->
                </div>

                

                <div class="mt-4 d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-success">
                            💾 Enregistrer les modifications
                        </button>
                        <a href="{{ route('agent.dashboard') }}" class="btn btn-secondary">
                            ❌ Annuler
                        </a>
                    </div>
                  
                </div>

            </form>
            <!-- <div class="d-flex justify-content-end">
              <form action="{{ route('acte.destroy', $acte->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet acte ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            🗑 Supprimer
                        </button>
                    </form>
            </div> -->
        </div>
    </div>
</div>
