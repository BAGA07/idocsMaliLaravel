<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container py-4">
    <h2 class="mb-4">Tableau de bord - Agent de Mairie</h2>
<!-- Statistiques -->
    <div class="row mb-4">
        
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Volets</h5>
                    <p class="card-text">{{ $total }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Aujourd'hui</h5>
                    <p class="card-text">{{ $todayCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Cette semaine</h5>
                    <p class="card-text">{{ $weekCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Ce mois</h5>
                    <p class="card-text">{{ $monthCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des déclarations -->
    <div class="card mb-4">
        <div class="card-header">Volets de déclaration</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Numéro Volet</th>
                        <th>Nom Enfant</th>
                        <th>Date Naissance</th>
                        <th>Hopital</th>
                        <th>Déclarant</th>
                        <th>Date Déclaration</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($declarations as $volet)
                    <tr>
                        <td>{{ $volet->num_volet }}</td>
                        <td>{{ $volet->prenom_enfant }} {{ $volet->nom_enfant }}</td>
                        <td>{{ $volet->date_naissance }}</td>
                        <td>{{ $volet->hopital->nom_hopital ?? 'N/A' }}</td>
                        <td>{{ $volet->declarant->prenom_declarant }} {{ $volet->declarant->nom_declarant }}</td>
                        <td>{{ $volet->date_declaration }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tableau des demandes en attente -->
    <div class="card">
        <div class="card-header">Demandes en attente</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nom Demandeur</th>
                        <th>Nom Enfant</th>
                        <th>Numéro Volet</th>
                        <th>Statut</th>
                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($demandes as $demande)
                    <tr>
                        <td>{{ $demande->nom_complet }}</td>
                        <td>
                       {{ $demande->volet ? $demande->volet->prenom_enfant . ' ' . $demande->volet->nom_enfant : 'N/A' }}
                        </td>
                        <td>{{ $demande->numero_volet_naissance }}</td>
                        

                      <td>
  @switch($demande->statut)
    @case('Validé')
      <span class="badge bg-success">Validé</span>
      @break
    @case('Rejeté')
      <span class="badge bg-danger">Rejeté</span>
      @break
    @default
      <span class="badge bg-warning">{{ $demande->statut }}</span>
  @endswitch
</td>
                        <td>
                        <a href="{{ route('acte.create', $demande->id) }}" class="btn btn-sm btn-primary">Traiter</a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mt-4">
    <div class="card-header">Liste des actes de naissance</div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Numéro acte</th>
                    <th>Nom enfant</th>
                    <th>Prénom enfant</th>
                    <th>Date naissance</th>
                    <th>Déclarant</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($actesNaissance as $acte)
                    <tr>
                        <td>{{ $acte->num_acte }}</td>
                        <td>{{ $acte->nom }}</td>
                        <td>{{ $acte->prenom }}</td>
                        <td>{{ $acte->date_naissance_enfant }}</td>
                        <td>{{ $acte->declarant->prenom_declarant ?? 'N/A' }} {{ $acte->declarant->nom_declarant ?? '' }}</td>
                        <td>
    <a href="{{ route('acte.show', $acte->id) }}" class="btn btn-sm btn-info">
        Voir
    </a>
    
    <a href="{{ route('acte.edit', $acte->id) }}" class="btn btn-sm btn-warning">
        Modifier
    </a>
</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

