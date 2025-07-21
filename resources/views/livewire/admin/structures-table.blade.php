<div class="container-fluid">
    <!-- Messages Flash -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- En-tête avec statistiques -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                <h4 class="text-primary">{{ $stats['total'] }}</h4>
                                <p class="text-muted">Total {{ $activeTab === 'hopitaux' ? 'Hôpitaux' : 'Mairies' }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h4 class="text-success">{{ $stats['avec_coords'] }}</h4>
                                <p class="text-muted">Avec coordonnées</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h4 class="text-warning">{{ $stats['sans_coords'] }}</h4>
                                <p class="text-muted">Sans coordonnées</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <button wire:click="openCreateModal('{{ $activeTab === 'hopitaux' ? 'hopital' : 'mairie' }}')" 
                                        class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Ajouter {{ $activeTab === 'hopitaux' ? 'Hôpital' : 'Mairie' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Onglets -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'hopitaux' ? 'active' : '' }}" 
                                    wire:click="$set('activeTab', 'hopitaux')" type="button">
                                <i class="fas fa-hospital"></i> Hôpitaux
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'mairies' ? 'active' : '' }}" 
                                    wire:click="$set('activeTab', 'mairies')" type="button">
                                <i class="fas fa-building"></i> Mairies
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et recherche -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input wire:model.live.debounce.300ms="search" type="text" 
                                       class="form-control" placeholder="Rechercher...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                <input wire:model.live.debounce.300ms="filterCommune" type="text" 
                                       class="form-control" placeholder="Filtrer par commune...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-end">
                                <select wire:model.live="perPage" class="form-select" style="width: auto;">
                                    <option value="10">10 par page</option>
                                    <option value="25">25 par page</option>
                                    <option value="50">50 par page</option>
                                    <option value="100">100 par page</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table des structures -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th wire:click="sortBy('nom')" style="cursor: pointer;">
                                        Nom
                                        @if($sortField === 'nom')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @else
                                            <i class="fas fa-sort text-muted"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('commune')" style="cursor: pointer;">
                                        Commune
                                        @if($sortField === 'commune')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @else
                                            <i class="fas fa-sort text-muted"></i>
                                        @endif
                                    </th>
                                    @if($activeTab === 'mairies')
                                        <th>Quartier</th>
                                    @endif
                                    <th>Coordonnées</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($structures as $structure)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    @if($activeTab === 'hopitaux')
                                                        <i class="fas fa-hospital text-primary fa-lg"></i>
                                                    @else
                                                        <i class="fas fa-building text-success fa-lg"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <strong>{{ $activeTab === 'hopitaux' ? $structure->nom_hopital : $structure->nom_mairie }}</strong>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $structure->commune->nom_commune ?? 'N/A' }}
                                            </span>
                                        </td>
                                        @if($activeTab === 'mairies')
                                            <td>{{ $structure->quartier }}</td>
                                        @endif
                                        <td>
                                            @if($structure->latitude && $structure->longitude)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-map-marker-alt"></i> Disponible
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-exclamation-triangle"></i> Manquant
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button wire:click="openEditModal('{{ $activeTab === 'hopitaux' ? 'hopital' : 'mairie' }}', {{ $structure->id }})" 
                                                        class="btn btn-sm btn-outline-primary" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button wire:click="openDeleteModal('{{ $activeTab === 'hopitaux' ? 'hopital' : 'mairie' }}', {{ $structure->id }})" 
                                                        class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ $activeTab === 'mairies' ? '5' : '4' }}" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <p>Aucune {{ $activeTab === 'hopitaux' ? 'hôpital' : 'mairie' }} trouvée</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            Affichage de {{ $structures->firstItem() ?? 0 }} à {{ $structures->lastItem() ?? 0 }} 
                            sur {{ $structures->total() }} résultats
                        </div>
                        <div>
                            {{ $structures->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de création -->
    @if($showCreateModal)
        <div class="modal fade show" style="display: block;" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Ajouter {{ $structureType === 'hopital' ? 'un Hôpital' : 'une Mairie' }}
                        </h5>
                        <button type="button" class="btn-close" wire:click="closeModals"></button>
                    </div>
                    <form wire:submit.prevent="createStructure">
                        <div class="modal-body">
                            @if($structureType === 'hopital')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nom de l'hôpital *</label>
                                            <input wire:model="nomHopital" type="text" class="form-control @error('nomHopital') is-invalid @enderror">
                                            @error('nomHopital') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Commune *</label>
                                            <select wire:model="communeHopital" class="form-select @error('communeHopital') is-invalid @enderror">
                                                <option value="">Sélectionner une commune</option>
                                                @foreach($communes as $commune)
                                                    <option value="{{ $commune->id }}">{{ $commune->nom_commune }}</option>
                                                @endforeach
                                            </select>
                                            @error('communeHopital') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Latitude</label>
                                            <input wire:model="latitudeHopital" type="number" step="any" class="form-control @error('latitudeHopital') is-invalid @enderror" placeholder="12.3456789">
                                            @error('latitudeHopital') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Longitude</label>
                                            <input wire:model="longitudeHopital" type="number" step="any" class="form-control @error('longitudeHopital') is-invalid @enderror" placeholder="-7.1234567">
                                            @error('longitudeHopital') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nom de la mairie *</label>
                                            <input wire:model="nomMairie" type="text" class="form-control @error('nomMairie') is-invalid @enderror">
                                            @error('nomMairie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Quartier *</label>
                                            <input wire:model="quartierMairie" type="text" class="form-control @error('quartierMairie') is-invalid @enderror">
                                            @error('quartierMairie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Commune *</label>
                                            <select wire:model="communeMairie" class="form-select @error('communeMairie') is-invalid @enderror">
                                                <option value="">Sélectionner une commune</option>
                                                @foreach($communes as $commune)
                                                    <option value="{{ $commune->id }}">{{ $commune->nom_commune }}</option>
                                                @endforeach
                                            </select>
                                            @error('communeMairie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Latitude</label>
                                            <input wire:model="latitudeMairie" type="number" step="any" class="form-control @error('latitudeMairie') is-invalid @enderror" placeholder="12.3456789">
                                            @error('latitudeMairie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Longitude</label>
                                            <input wire:model="longitudeMairie" type="number" step="any" class="form-control @error('longitudeMairie') is-invalid @enderror" placeholder="-7.1234567">
                                            @error('longitudeMairie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModals">Annuler</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif

    <!-- Modal d'édition -->
    @if($showEditModal)
        <div class="modal fade show" style="display: block;" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Modifier {{ $structureType === 'hopital' ? 'l\'Hôpital' : 'la Mairie' }}
                        </h5>
                        <button type="button" class="btn-close" wire:click="closeModals"></button>
                    </div>
                    <form wire:submit.prevent="updateStructure">
                        <div class="modal-body">
                            @if($structureType === 'hopital')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nom de l'hôpital *</label>
                                            <input wire:model="nomHopital" type="text" class="form-control @error('nomHopital') is-invalid @enderror">
                                            @error('nomHopital') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Commune *</label>
                                            <select wire:model="communeHopital" class="form-select @error('communeHopital') is-invalid @enderror">
                                                <option value="">Sélectionner une commune</option>
                                                @foreach($communes as $commune)
                                                    <option value="{{ $commune->id }}">{{ $commune->nom_commune }}</option>
                                                @endforeach
                                            </select>
                                            @error('communeHopital') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Latitude</label>
                                            <input wire:model="latitudeHopital" type="number" step="any" class="form-control @error('latitudeHopital') is-invalid @enderror" placeholder="12.3456789">
                                            @error('latitudeHopital') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Longitude</label>
                                            <input wire:model="longitudeHopital" type="number" step="any" class="form-control @error('longitudeHopital') is-invalid @enderror" placeholder="-7.1234567">
                                            @error('longitudeHopital') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nom de la mairie *</label>
                                            <input wire:model="nomMairie" type="text" class="form-control @error('nomMairie') is-invalid @enderror">
                                            @error('nomMairie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Quartier *</label>
                                            <input wire:model="quartierMairie" type="text" class="form-control @error('quartierMairie') is-invalid @enderror">
                                            @error('quartierMairie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Commune *</label>
                                            <select wire:model="communeMairie" class="form-select @error('communeMairie') is-invalid @enderror">
                                                <option value="">Sélectionner une commune</option>
                                                @foreach($communes as $commune)
                                                    <option value="{{ $commune->id }}">{{ $commune->nom_commune }}</option>
                                                @endforeach
                                            </select>
                                            @error('communeMairie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Latitude</label>
                                            <input wire:model="latitudeMairie" type="number" step="any" class="form-control @error('latitudeMairie') is-invalid @enderror" placeholder="12.3456789">
                                            @error('latitudeMairie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Longitude</label>
                                            <input wire:model="longitudeMairie" type="number" step="any" class="form-control @error('longitudeMairie') is-invalid @enderror" placeholder="-7.1234567">
                                            @error('longitudeMairie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModals">Annuler</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif

    <!-- Modal de suppression -->
    @if($showDeleteModal)
        <div class="modal fade show" style="display: block;" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger">
                            <i class="fas fa-exclamation-triangle"></i> Confirmation de suppression
                        </h5>
                        <button type="button" class="btn-close" wire:click="closeModals"></button>
                    </div>
                    <div class="modal-body">
                        <p>Êtes-vous sûr de vouloir supprimer <strong>{{ $structureType === 'hopital' ? $structureToDelete->nom_hopital : $structureToDelete->nom_mairie }}</strong> ?</p>
                        <p class="text-muted">Cette action est irréversible.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModals">Annuler</button>
                        <button type="button" class="btn btn-danger" wire:click="deleteStructure">
                            <i class="fas fa-trash"></i> Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
