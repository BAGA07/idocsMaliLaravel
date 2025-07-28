<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Hopital;
use App\Models\Mairie;
use App\Models\Log;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques des agents
        $totalAgents = User::whereIn('role', ['agent_hopital', 'agent_mairie'])->count();
        $agentsHopital = User::where('role', 'agent_hopital')->count();
        $agentsMairie = User::where('role', 'agent_mairie')->count();
        
        // Statistiques des structures
        $totalStructures = Hopital::count() + Mairie::count();
        
        // Logs récents (activités des agents)
        $recentLogs = Log::with('user')
            ->whereHas('user', function($query) {
                $query->whereIn('role', ['agent_hopital', 'agent_mairie']);
            })
            ->latest()
            ->take(10)
            ->get();

        return view('manager.dashboard', compact(
            'totalAgents',
            'agentsHopital', 
            'agentsMairie',
            'totalStructures',
            'recentLogs'
        ));
    }
} 