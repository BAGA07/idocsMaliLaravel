<?php

namespace App\Http\Controllers\Hopital;

use App\Http\Controllers\Controller;
use App\Models\VoletDeclaration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NaissanceController extends Controller
{
    public function dashboard()
    {
        $declarations = VoletDeclaration::latest()->paginate(10);
        return view('hopital.dashboard', compact('declarations'));

        // Statistiques globales
        $totalNaissances = VoletDeclaration::count();

        $moisActuel = Carbon::now()->month;

        $totalGarçons = VoletDeclaration::whereMonth('created_at', $moisActuel)
            ->where('sexe', 'Masculin')
            ->count();

        $totalFilles = VoletDeclaration::whereMonth('created_at', $moisActuel)
            ->where('sexe', 'Féminin')
            ->count();

        return view('hopital.dashboard', compact('totalNaissances', 'totalGarçons', 'totalFilles'));
    }
    public function create()
    {
        return view('hopital.naissances.create');
    }
    public function show($id)
    {
        $declaration = VoletDeclaration::findOrFail($id);
        return view('hopital.naissance.show', compact('declaration'));
    }
}
