<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Demande;
use App\Models\Hopital;
use App\Models\Mairie;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $totalDocuments;
    public $documentsEnAttente;
    public $totalStructures;
    public $totalUsers;

    public $alertes = [
        'En attente_retard' => 0,
        'managers_inactifs' => 0,
        'demandes_details' => [],
        'managers_details' => []
    ];

    public $structuresGeo = [];
    public $statsByStatus = [];
    public $periode = 'jour';

    public function mount()
    {
        $this->loadData();
    }

    public function updatedPeriode()
    {
        $this->loadData();
    }

    protected function loadData()
    {
        // Filtrage par période
        $dateDebut = match ($this->periode) {
            'jour'    => Carbon::today(),
            'semaine' => Carbon::now()->startOfWeek(),
            'mois'    => Carbon::now()->startOfMonth(),
            'annee'   => Carbon::now()->startOfYear(),
            default   => Carbon::today(),
        };

        // 📊 Statistiques globales
        $this->totalDocuments = Demande::where('statut', 'Valide')->count();

        $this->documentsEnAttente = Demande::where('statut', 'En attente')
            ->count();

        $this->totalStructures = Hopital::count() + Mairie::count();

        $this->totalUsers = User::count();

        // ⚠️ Documents en attente depuis > 7 jours
        $this->alertes['en_attente_retard'] = Demande::where('statut', 'En attente')
            ->where('created_at', '<', Carbon::now()->subDays(7))
            ->count();

        $this->alertes['demandes_details'] = Demande::where('statut', 'En attente')
            ->where('created_at', '<', Carbon::now()->subDays(7))
            ->with('volet')
            ->get();

        // ⚠️ Managers inactifs depuis > 15 jours
        $this->alertes['managers_inactifs'] = User::where('role', 'manager')
            ->where(function ($q) {
                $q->whereNull('last_login_at')
                    ->orWhere('last_login_at', '<', Carbon::now()->subDays(15));
            })
            ->count();

        $this->alertes['managers_details'] = User::where('role', 'manager')
            ->where(function ($q) {
                $q->whereNull('last_login_at')
                    ->orWhere('last_login_at', '<', Carbon::now()->subDays(15));
            })
            ->get();

        // 📍 Structures avec coordonnées GPS
        $this->structuresGeo = Hopital::all()->merge(Mairie::all())
            ->filter(function ($structure) {
                return !is_null($structure->latitude) && !is_null($structure->longitude);
            })->map(function ($structure) {
                return [
                    'id' => $structure->id,
                    'name' => $structure->name,
                    'latitude' => $structure->latitude,
                    'longitude' => $structure->longitude,
                ];
            })->toArray();

        // 📊 Statistiques par statut pour Chart.js
        $this->statsByStatus = Demande::select('statut', DB::raw('COUNT(*) as total'))
            ->groupBy('statut')
            ->pluck('total', 'statut')
            ->toArray();
    }

    public function exportCsv()
    {
        // 🔹 Ici tu peux utiliser Laravel Excel
        session()->flash('message', 'Export CSV lancé (à implémenter)');
    }

    public function exportPdf()
    {
        // 🔹 Ici tu peux utiliser DomPDF ou Snappy
        session()->flash('message', 'Export PDF lancé (à implémenter)');
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}