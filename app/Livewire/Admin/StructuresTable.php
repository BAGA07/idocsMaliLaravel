<?php

namespace App\Livewire\Admin;

use App\Models\Hopital;
use App\Models\Mairie;
use App\Models\Commune;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class StructuresTable extends Component
{
    use WithPagination;

    // Recherche & filtres
    public $search = '';
    public $filterCommune = '';
    public $activeTab = 'hopitaux'; // 'hopitaux' ou 'mairies'

    // Form Hopital
    public $hopitalId;
    public $nomHopital;
    public $communeHopital;
    public $latitudeHopital;
    public $longitudeHopital;

    // Form Mairie
    public $mairieId;
    public $nomMairie;
    public $quartierMairie;
    public $communeMairie;
    public $latitudeMairie;
    public $longitudeMairie;

    // Modals
    public $showCreateModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $structureToDelete = null;
    public $structureType = ''; // hopital ou mairie

    // Pagination & tri
    public $perPage = 10;
    public $sortField = 'nom';
    public $sortDirection = 'asc';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterCommune' => ['except' => ''],
        'activeTab' => ['except' => 'hopitaux'],
    ];

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
        $this->structureToDelete = $type === 'hopital'
            ? Hopital::findOrFail($id)
            : Mairie::findOrFail($id);
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

    public function createStructure()
    {
        if ($this->structureType === 'hopital') {
            $this->validate([
                'nomHopital' => 'required|string|max:255',
                'communeHopital' => 'required|exists:communes,id',
            ]);

            Hopital::create([
                'nom_hopital' => $this->nomHopital,
                'id_commune' => $this->communeHopital,
                'latitude' => $this->latitudeHopital,
                'longitude' => $this->longitudeHopital,
            ]);
            session()->flash('message', 'Hôpital créé avec succès !');
        } else {
            $this->validate([
                'nomMairie' => 'required|string|max:255',
                'quartierMairie' => 'required|string|max:255',
                'communeMairie' => 'required|exists:communes,id',
            ]);

            Mairie::create([
                'nom_mairie' => $this->nomMairie,
                'quartier' => $this->quartierMairie,
                'id_commune' => $this->communeMairie,
                'latitude' => $this->latitudeMairie,
                'longitude' => $this->longitudeMairie,
            ]);
            session()->flash('message', 'Mairie créée avec succès !');
        }

        $this->closeModals();
    }

    public function updateStructure()
    {
        if ($this->structureType === 'hopital') {
            $hopital = Hopital::findOrFail($this->hopitalId);
            $hopital->update([
                'nom_hopital' => $this->nomHopital,
                'id_commune' => $this->communeHopital,
                'latitude' => $this->latitudeHopital,
                'longitude' => $this->longitudeHopital,
            ]);
            session()->flash('message', 'Hôpital mis à jour avec succès !');
        } else {
            $mairie = Mairie::findOrFail($this->mairieId);
            $mairie->update([
                'nom_mairie' => $this->nomMairie,
                'quartier' => $this->quartierMairie,
                'id_commune' => $this->communeMairie,
                'latitude' => $this->latitudeMairie,
                'longitude' => $this->longitudeMairie,
            ]);
            session()->flash('message', 'Mairie mise à jour avec succès !');
        }

        $this->closeModals();
    }

    public function deleteStructure()
    {
        if ($this->structureType === 'hopital') {
            $this->structureToDelete->delete();
            session()->flash('message', 'Hôpital supprimé avec succès !');
        } else {
            $this->structureToDelete->delete();
            session()->flash('message', 'Mairie supprimée avec succès !');
        }

        $this->closeModals();
    }

    public function render()
    {
        $communes = Commune::orderBy('nom_commune')->get();

        if ($this->activeTab === 'hopitaux') {
            $query = Hopital::with('commune');

            if ($this->search) {
                $query->where('nom_hopital', 'like', '%' . $this->search . '%');
            }
            if ($this->filterCommune) {
                $query->where('id_commune', $this->filterCommune);
            }

            $structures = $query->paginate($this->perPage);

            $stats = [
                'total' => Hopital::count(),
                'avec_coords' => Hopital::whereNotNull('latitude')->whereNotNull('longitude')->count(),
                'sans_coords' => Hopital::whereNull('latitude')->orWhereNull('longitude')->count(),
            ];
        } else {
            $query = Mairie::with('commune');

            if ($this->search) {
                $query->where(function ($q) {
                    $q->where('nom_mairie', 'like', '%' . $this->search . '%')
                        ->orWhere('quartier', 'like', '%' . $this->search . '%');
                });
            }
            if ($this->filterCommune) {
                $query->where('id_commune', $this->filterCommune);
            }

            $structures = $query->paginate($this->perPage);

            $stats = [
                'total' => Mairie::count(),
                'avec_coords' => Mairie::whereNotNull('latitude')->whereNotNull('longitude')->count(),
                'sans_coords' => Mairie::whereNull('latitude')->orWhereNull('longitude')->count(),
            ];
        }

        return view('livewire.admin.structures-table', [
            'structures' => $structures,
            'communes' => $communes,
            'stats' => $stats
        ]);
    }
}
