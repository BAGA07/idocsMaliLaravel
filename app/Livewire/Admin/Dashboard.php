<?php

namespace App\Livewire\Admin;

use App\Models\Demande;
use Livewire\Component;
use App\Models\User;
use App\Models\VoletDeclaration;
use App\Models\Hopital;
use App\Models\Mairie;

class Dashboard extends Component
{
    public $totalDocuments;
    public $documentsEnAttente;
    public $totalStructures;
    public $totalUsers;
    public $statsByStatus = [];
    public $structuresGeo = [];

    public function mount()
    {
        $this->totalDocuments = VoletDeclaration::count();
        $this->documentsEnAttente = Demande::where('statut', 'En attente')->count();
        $this->totalStructures = Hopital::count() + Mairie::count();
        $this->totalUsers = User::count();

        $this->statsByStatus = Demande::selectRaw('statut, COUNT(*) as total')
            ->groupBy('statut')
            ->pluck('total', 'statut')
            ->toArray();

        // Autres statistiques...

        $hopitaux = Hopital::select('nom_hopital', 'latitude', 'longitude')->get();
        $mairies = Mairie::select('nom_mairie', 'latitude', 'longitude')->get();

        $this->structuresGeo = $hopitaux
            ->merge($mairies)
            ->filter(fn($s) => $s->latitude && $s->longitude)
            ->values();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
