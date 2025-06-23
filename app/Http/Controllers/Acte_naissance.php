<?php

namespace App\Http\Controllers;
use Carbon\Carbon;


use Illuminate\Http\Request;
use App\Models\VoletDeclaration;


class Acte_naissance extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today();
    $startOfWeek = Carbon::now()->startOfWeek(); // Lundi
    $endOfWeek = Carbon::now()->endOfWeek();     // Dimanche

    // Toutes les déclarations avec relations
    $declarations = VoletDeclaration::with('declarant', 'hopital')->latest()->get();
    

    // Statistiques
    $total = VoletDeclaration::count();
    $todayCount = VoletDeclaration::whereDate('created_at', $today)->count();
    $weekCount = VoletDeclaration::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
    $monthCount = VoletDeclaration::whereMonth('created_at', Carbon::now()->month)->count();

    return view('agent_mairie.dashboard', compact('declarations', 'total', 'todayCount', 'weekCount', 'monthCount'));
       

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_volet , Request $request)
{
    // Si la route n'envoie pas le paramètre directement, chercher dans query string(get)
    if (!$id_volet) {
        $id_volet = $request->query('id_volet');
    }

    $declaration = null;

    if ($id_volet) {
        $declaration = VoletDeclaration::with(['declarant', 'hopital'])->where('id_volet', $id_volet)->first();
    }

    if (!$declaration) {
        return redirect()->route('agent_mairie.dashboard')->with('error', 'Déclaration non trouvée.');
    }

    return view('agent_mairie.naissances.create', compact('declaration'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
