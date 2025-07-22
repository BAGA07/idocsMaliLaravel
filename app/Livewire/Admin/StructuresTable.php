<?php

namespace App\Livewire\Admin;

use App\Models\Hopital;
use App\Models\Mairie;
use App\Models\Commune;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

class StructuresTable extends Component
{
    use WithPagination, WithFileUploads;

    // Propriétés pour la recherche et filtres
    public $search = '';
    public $filterType = '';
    public $filterCommune = '';
    public $activeTab = 'hopitaux'; // 'hopitaux' ou 'mairies'

    // Propriétés pour le formulaire hôpital
    public $hopitalId = null;
    public $nomHopital = '';
    public $communeHopital = '';
    public $latitudeHopital = '';
    public $longitudeHopital = '';

    // Propriétés pour le formulaire mairie
    public $mairieId = null;
    public $nomMairie = '';
    public $quartierMairie = '';
    public $communeMairie = '';
    public $latitudeMairie = '';
    public $longitudeMairie = '';

    // Propriétés pour les modals
    public $showCreateModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $structureToDelete = null;
    public $structureType = ''; // 'hopital' ou 'mairie'

    // Propriétés pour la pagination
    public $perPage = 10;
    public $sortField = 'nom';
    public $sortDirection = 'asc';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterType' => ['except' => ''],
        'filterCommune' => ['except' => ''],
        'activeTab' => ['except' => 'hopitaux'],
    ];

    protected $listeners = [
        'refreshStructures' => '$refresh',
        'structureCreated' => '$refresh',
        'structureUpdated' => '$refresh',
        'structureDeleted' => '$refresh'
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterCommune()
    {
        $this->resetPage();
    }

    public function updatingActiveTab()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function openCreateModal($type)
    {
        $this->structureType = $type;
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function openEditModal($type, $id)
    {
        $this->structureType = $type;
        
        if ($type === 'hopital') {
            $hopital = Hopital::findOrFail($id);
            $this->hopitalId = $hopital->id;
            $this->nomHopital = $hopital->nom_hopital;
            $this->communeHopital = $hopital->id_commune;
            $this->latitudeHopital = $hopital->latitude;
            $this->longitudeHopital = $hopital->longitude;
        } else {
            $mairie = Mairie::findOrFail($id);
            $this->mairieId = $mairie->id;
            $this->nomMairie = $mairie->nom_mairie;
            $this->quartierMairie = $mairie->quartier;
            $this->communeMairie = $mairie->id_commune;
            $this->latitudeMairie = $mairie->latitude;
            $this->longitudeMairie = $mairie->longitude;
        }
        
        $this->showEditModal = true;
    }

    public function openDeleteModal($type, $id)
    {
        $this->structureType = $type;
        if ($type === 'hopital') {
            $this->structureToDelete = Hopital::findOrFail($id);
        } else {
            $this->structureToDelete = Mairie::findOrFail($id);
        }
        $this->showDeleteModal = true;
    }

    public function closeModals()
    {
        $this->showCreateModal = false;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
        $this->structureToDelete = null;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->hopitalId = null;
        $this->nomHopital = '';
        $this->communeHopital = '';
        $this->latitudeHopital = '';
        $this->longitudeHopital = '';

        $this->mairieId = null;
        $this->nomMairie = '';
        $this->quartierMairie = '';
        $this->communeMairie = '';
        $this->latitudeMairie = '';
        $this->longitudeMairie = '';
    }

    public function createStructure()
    {
        if ($this->structureType === 'hopital') {
            $this->validate([
                'nomHopital' => 'required|string|max:255',
                'communeHopital' => 'required|exists:communes,id',
                'latitudeHopital' => 'nullable|numeric|between:-90,90',
                'longitudeHopital' => 'nullable|numeric|between:-180,180',
            ]);

            try {
                $hopital = Hopital::create([
                    'nom_hopital' => $this->nomHopital,
                    'id_commune' => $this->communeHopital,
                    'latitude' => $this->latitudeHopital,
                    'longitude' => $this->longitudeHopital,
                ]);

                // Log de l'action
                Log::info('Hôpital créé', [
                    'user_id' => auth()->id(),
                    'hopital_id' => $hopital->id,
                    'hopital_nom' => $hopital->nom_hopital,
                    'action' => 'create'
                ]);

                $this->closeModals();
                $this->dispatch('structureCreated');
                session()->flash('message', 'Hôpital créé avec succès !');
            } catch (\Exception $e) {
                session()->flash('error', 'Erreur lors de la création de l\'hôpital : ' . $e->getMessage());
            }
        } else {
            $this->validate([
                'nomMairie' => 'required|string|max:255',
                'quartierMairie' => 'required|string|max:255',
                'communeMairie' => 'required|exists:communes,id',
                'latitudeMairie' => 'nullable|numeric|between:-90,90',
                'longitudeMairie' => 'nullable|numeric|between:-180,180',
            ]);

            try {
                $mairie = Mairie::create([
                    'nom_mairie' => $this->nomMairie,
                    'quartier' => $this->quartierMairie,
                    'id_commune' => $this->communeMairie,
                    'latitude' => $this->latitudeMairie,
                    'longitude' => $this->longitudeMairie,
                ]);

                // Log de l'action
                Log::info('Mairie créée', [
                    'user_id' => auth()->id(),
                    'mairie_id' => $mairie->id,
                    'mairie_nom' => $mairie->nom_mairie,
                    'action' => 'create'
                ]);

                $this->closeModals();
                $this->dispatch('structureCreated');
                session()->flash('message', 'Mairie créée avec succès !');
            } catch (\Exception $e) {
                session()->flash('error', 'Erreur lors de la création de la mairie : ' . $e->getMessage());
            }
        }
    }

    public function updateStructure()
    {
        if ($this->structureType === 'hopital') {
            $this->validate([
                'nomHopital' => 'required|string|max:255',
                'communeHopital' => 'required|exists:communes,id',
                'latitudeHopital' => 'nullable|numeric|between:-90,90',
                'longitudeHopital' => 'nullable|numeric|between:-180,180',
            ]);

            try {
                $hopital = Hopital::findOrFail($this->hopitalId);
                $oldData = $hopital->toArray();
                
                $hopital->update([
                    'nom_hopital' => $this->nomHopital,
                    'id_commune' => $this->communeHopital,
                    'latitude' => $this->latitudeHopital,
                    'longitude' => $this->longitudeHopital,
                ]);

                // Log de l'action
                Log::info('Hôpital mis à jour', [
                    'user_id' => auth()->id(),
                    'hopital_id' => $hopital->id,
                    'hopital_nom' => $hopital->nom_hopital,
                    'old_data' => $oldData,
                    'new_data' => $hopital->toArray(),
                    'action' => 'update'
                ]);

                $this->closeModals();
                $this->dispatch('structureUpdated');
                session()->flash('message', 'Hôpital mis à jour avec succès !');
            } catch (\Exception $e) {
                session()->flash('error', 'Erreur lors de la mise à jour de l\'hôpital : ' . $e->getMessage());
            }
        } else {
            $this->validate([
                'nomMairie' => 'required|string|max:255',
                'quartierMairie' => 'required|string|max:255',
                'communeMairie' => 'required|exists:communes,id',
                'latitudeMairie' => 'nullable|numeric|between:-90,90',
                'longitudeMairie' => 'nullable|numeric|between:-180,180',
            ]);

            try {
                $mairie = Mairie::findOrFail($this->mairieId);
                $oldData = $mairie->toArray();
                
                $mairie->update([
                    'nom_mairie' => $this->nomMairie,
                    'quartier' => $this->quartierMairie,
                    'id_commune' => $this->communeMairie,
                    'latitude' => $this->latitudeMairie,
                    'longitude' => $this->longitudeMairie,
                ]);

                // Log de l'action
                Log::info('Mairie mise à jour', [
                    'user_id' => auth()->id(),
                    'mairie_id' => $mairie->id,
                    'mairie_nom' => $mairie->nom_mairie,
                    'old_data' => $oldData,
                    'new_data' => $mairie->toArray(),
                    'action' => 'update'
                ]);

                $this->closeModals();
                $this->dispatch('structureUpdated');
                session()->flash('message', 'Mairie mise à jour avec succès !');
            } catch (\Exception $e) {
                session()->flash('error', 'Erreur lors de la mise à jour de la mairie : ' . $e->getMessage());
            }
        }
    }

    public function deleteStructure()
    {
        try {
            if ($this->structureType === 'hopital') {
                $hopital = $this->structureToDelete;
                
                // Vérifier s'il y a des utilisateurs associés
                if ($hopital->users()->count() > 0) {
                    session()->flash('error', 'Impossible de supprimer cet hôpital car il a des utilisateurs associés.');
                    $this->closeModals();
                    return;
                }

                // Vérifier s'il y a des déclarations associées
                if ($hopital->declarations()->count() > 0) {
                    session()->flash('error', 'Impossible de supprimer cet hôpital car il a des déclarations associées.');
                    $this->closeModals();
                    return;
                }

                $hopitalName = $hopital->nom_hopital;
                $hopital->delete();

                // Log de l'action
                Log::info('Hôpital supprimé', [
                    'user_id' => auth()->id(),
                    'hopital_nom' => $hopitalName,
                    'action' => 'delete'
                ]);

                session()->flash('message', 'Hôpital supprimé avec succès !');
            } else {
                $mairie = $this->structureToDelete;
                
                // Vérifier s'il y a des utilisateurs associés
                if ($mairie->users()->count() > 0) {
                    session()->flash('error', 'Impossible de supprimer cette mairie car elle a des utilisateurs associés.');
                    $this->closeModals();
                    return;
                }

                // Vérifier s'il y a des actes de naissance associés
                if ($mairie->acteNaissances()->count() > 0) {
                    session()->flash('error', 'Impossible de supprimer cette mairie car elle a des actes de naissance associés.');
                    $this->closeModals();
                    return;
                }

                $mairieName = $mairie->nom_mairie;
                $mairie->delete();

                // Log de l'action
                Log::info('Mairie supprimée', [
                    'user_id' => auth()->id(),
                    'mairie_nom' => $mairieName,
                    'action' => 'delete'
                ]);

                session()->flash('message', 'Mairie supprimée avec succès !');
            }

            $this->closeModals();
            $this->dispatch('structureDeleted');
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }

    public function render()
    {
        $communes = Commune::orderBy('nom_commune')->get();

        if ($this->activeTab === 'hopitaux') {
            $query = Hopital::with('commune');

            // Appliquer les filtres
            if ($this->search) {
                $query->where(function ($q) {
                    $q->where('nom_hopital', 'like', '%' . $this->search . '%')
                      ->orWhereHas('commune', function ($communeQuery) {
                          $communeQuery->where('nom_commune', 'like', '%' . $this->search . '%');
                      });
                });
            }

            if ($this->filterCommune) {
                $query->whereHas('commune', function ($q) {
                    $q->where('nom_commune', 'like', '%' . $this->filterCommune . '%');
                });
            }

            // Appliquer le tri
            if ($this->sortField === 'nom') {
                $query->orderBy('nom_hopital', $this->sortDirection);
            } elseif ($this->sortField === 'commune') {
                $query->join('communes', 'hopitals.id_commune', '=', 'communes.id')
                      ->orderBy('communes.nom_commune', $this->sortDirection)
                      ->select('hopitals.*');
            } else {
                $query->orderBy($this->sortField, $this->sortDirection);
            }

            $structures = $query->paginate($this->perPage);

            // Statistiques
            $stats = [
                'total' => Hopital::count(),
                'avec_coords' => Hopital::whereNotNull('latitude')->whereNotNull('longitude')->count(),
                'sans_coords' => Hopital::whereNull('latitude')->orWhereNull('longitude')->count(),
            ];
        } else {
            $query = Mairie::with('commune');

            // Appliquer les filtres
            if ($this->search) {
                $query->where(function ($q) {
                    $q->where('nom_mairie', 'like', '%' . $this->search . '%')
                      ->orWhere('quartier', 'like', '%' . $this->search . '%')
                      ->orWhereHas('commune', function ($communeQuery) {
                          $communeQuery->where('nom_commune', 'like', '%' . $this->search . '%');
                      });
                });
            }

            if ($this->filterCommune) {
                $query->whereHas('commune', function ($q) {
                    $q->where('nom_commune', 'like', '%' . $this->filterCommune . '%');
                });
            }

            // Appliquer le tri
            if ($this->sortField === 'nom') {
                $query->orderBy('nom_mairie', $this->sortDirection);
            } elseif ($this->sortField === 'commune') {
                $query->join('communes', 'mairie.id_commune', '=', 'communes.id')
                      ->orderBy('communes.nom_commune', $this->sortDirection)
                      ->select('mairie.*');
            } else {
                $query->orderBy($this->sortField, $this->sortDirection);
            }

            $structures = $query->paginate($this->perPage);

            // Statistiques
            $stats = [
                'total' => Mairie::count(),
                'avec_coords' => Mairie::whereNotNull('latitude')->whereNotNull('longitude')->count(),
                'sans_coords' => Mairie::whereNull('latitude')->orWhereNull('longitude')->count(),
            ];
        }

        return view('livewire.admin.structures-table', [
            'structures' => $structures,
            'stats' => $stats,
            'communes' => $communes
        ]);
    }
}
