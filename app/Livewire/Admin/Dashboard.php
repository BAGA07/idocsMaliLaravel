<?php

namespace App\Livewire\Admin;

use App\Models\Demande;
use Livewire\Component;
use App\Models\User;
use App\Models\VoletDeclaration;
use App\Models\Hopital;
use App\Models\Mairie;
use App\Models\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class Dashboard extends Component
{
    public $totalDocuments;
    public $documentsEnAttente;
    public $totalStructures;
    public $totalUsers;
    public $statsByStatus = [];
    public $structuresGeo = [];
    public $recentLogs = [];
    public $periode = 'mois';
    public $alertes = [];

    public function updatedPeriode()
    {
        $this->recalculerStats();
    }

    public function recalculerStats()
    {
        $periode = $this->periode;
        $queryVolet = VoletDeclaration::query();
        $queryDemande = Demande::query();
        $queryUser = User::query();
        $queryHopital = Hopital::query();
        $queryMairie = Mairie::query();

        switch ($periode) {
            case 'jour':
                $date = now()->toDateString();
                $queryVolet->whereDate('created_at', $date);
                $queryDemande->whereDate('created_at', $date);
                $queryUser->whereDate('created_at', $date);
                break;
            case 'semaine':
                $queryVolet->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                $queryDemande->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                $queryUser->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'annee':
                $queryVolet->whereYear('created_at', now()->year);
                $queryDemande->whereYear('created_at', now()->year);
                $queryUser->whereYear('created_at', now()->year);
                break;
            case 'mois':
            default:
                $queryVolet->whereMonth('created_at', now()->month);
                $queryDemande->whereMonth('created_at', now()->month);
                $queryUser->whereMonth('created_at', now()->month);
                break;
        }
        $this->totalDocuments = $queryVolet->count();
        $this->documentsEnAttente = $queryDemande->where('statut', 'En attente')->count();
        $this->totalStructures = $queryHopital->count() + $queryMairie->count();
        $this->totalUsers = $queryUser->count();
        $this->statsByStatus = $queryDemande->selectRaw('statut, COUNT(*) as total')
            ->groupBy('statut')
            ->pluck('total', 'statut')
            ->toArray();
    }

    public function mount()
    {
        $this->recalculerStats();
        $this->totalDocuments = VoletDeclaration::count();
        $this->documentsEnAttente = Demande::where('statut', 'En attente')->count();
        $this->totalStructures = Hopital::count() + Mairie::count();
        $this->totalUsers = User::count();

        $this->statsByStatus = Demande::selectRaw('statut, COUNT(*) as total')
            ->groupBy('statut')
            ->pluck('total', 'statut')
            ->toArray();

        // Alertes : demandes en attente >7 jours
        $enAttenteRetard = Demande::where('statut', 'En attente')
            ->where('created_at', '<', now()->subDays(7))
            ->count();
        // Alertes : managers inactifs >15 jours
        $managersInactifs = User::whereIn('role', ['agent_hopital', 'agent_mairie'])
            ->where(function ($q) {
                $q->whereNull('last_login_at')->orWhere('last_login_at', '<', now()->subDays(15));
            })->count();
        $this->alertes = [
            'en_attente_retard' => $enAttenteRetard,
            'managers_inactifs' => $managersInactifs,
        ];

        // Autres statistiques...

        $hopitaux = Hopital::select('nom_hopital', 'latitude', 'longitude')->get();
        $mairies = Mairie::select('nom_mairie', 'latitude', 'longitude')->get();

        $this->structuresGeo = $hopitaux
            ->merge($mairies)
            ->filter(fn($s) => $s->latitude && $s->longitude)
            ->values();

        $this->recentLogs = Log::with('user')->latest()->take(10)->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }

    public function exportCsv()
    {
        $filename = 'statistiques_dashboard_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $filename,
        ];
        $data = [
            ['Statistique', 'Valeur'],
            ['Documents traités', $this->totalDocuments],
            ['En attente', $this->documentsEnAttente],
            ['Structures', $this->totalStructures],
            ['Utilisateurs', $this->totalUsers],
        ];
        foreach ($this->statsByStatus as $statut => $total) {
            $data[] = ['Demandes ' . $statut, $total];
        }
        return new StreamedResponse(function () use ($data) {
            $handle = fopen('php://output', 'w');
            foreach ($data as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }, 200, $headers);
    }

    public function exportPdf()
    {
        $data = [
            'totalDocuments' => $this->totalDocuments,
            'documentsEnAttente' => $this->documentsEnAttente,
            'totalStructures' => $this->totalStructures,
            'totalUsers' => $this->totalUsers,
            'statsByStatus' => $this->statsByStatus,
            'periode' => $this->periode,
        ];
        $pdf = Pdf::loadView('admin.dashboard_pdf', $data);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'statistiques_dashboard_' . now()->format('Ymd_His') . '.pdf');
    }
}
