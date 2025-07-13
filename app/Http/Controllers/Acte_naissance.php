<?php

namespace App\Http\Controllers;

use App\Models\Acte;
use App\Models\Commune;
use App\Models\Declarant;
use Carbon\Carbon;


use Illuminate\Http\Request;
use App\Models\VoletDeclaration;
use App\Models\Demande;
use App\Models\Officier;

class Acte_naissance extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $demandes = Demande::with('volet')->get();


    $today = Carbon::today();
    $startOfWeek = Carbon::now()->startOfWeek(); 
    $endOfWeek = Carbon::now()->endOfWeek(); 

    // Toutes les déclarations avec relations
    $declarations = VoletDeclaration::with( 'hopital','declarant')->latest()->get();
    

    // Statistiques
    $total = VoletDeclaration::count();
    $todayCount = VoletDeclaration::whereDate('created_at', $today)->count();
    $weekCount = VoletDeclaration::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
    $monthCount = VoletDeclaration::whereMonth('created_at', Carbon::now()->month)->count();
     // Récupérer la liste des actes de naissance
    $actesNaissance = Acte::with('declarant')->latest()->get();
    return view('agent_mairie.dasboard', compact('declarations', 'total', 'todayCount', 'weekCount', 'monthCount','demandes','actesNaissance'));
       

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
{
    $demande = Demande::with('volet.declarant','volet.hopital')->findOrFail($id);
    $communes = Commune::all();
    $officiers = Officier::all();
    $declarants=Declarant::all();

   
    return view('agent_mairie.naissances.create', compact('demande', 'communes', 'officiers','declarants'));

}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Récupérer la demande avec son volet et déclarant
    $demande = Demande::with('volet')->findOrFail($request->demande_id);

   $lastNum = Acte::max('num_acte');

    $nextNum = $lastNum ? $lastNum + 1 : 1;

    // Créer l’acte avec correspondance précise
    $acte = new Acte();
    $acte->num_acte = $nextNum;

    $acte->date_naissance_enfant = $request->date_naissance;
    $acte->lieu_naissance_enfant = $request->lieu_naissance;
    $acte->heure_naissance = $request->heure_naissance;
    $acte->sexe_enfant = $request->sexe_enfant;

    $acte->prenom = $request->prenom_enfant;
    $acte->nom = $request->nom_enfant;

    $acte->prenom_pere = $request->prenom_pere;
    $acte->nom_pere = $request->nom_pere;
    $acte->proffesion_pere = $request->profession_pere; 
    $acte->domicile_pere = $request->domicile_pere;

    $acte->prenom_mere = $request->prenom_mere;
    $acte->nom_mere = $request->nom_mere;
    $acte->proffesion_mere = $request->profession_mere;
    $acte->domicile_mere = $request->domicile_mere;
    $acte->id_declarant = $demande->volet->id_declarant ?? null;  
    //$acte->heure_naissance = $demande->volet->heure_naissance ?? null;  
    $acte->id_demande = $request->demande_id;
    $acte->id_officier = $request->id_officier;
    $acte->id_commune = $request->id_commune;
    $acte->date_enregistrement_acte = now();

    $acte->save();

    // Mettre à jour le statut de la demande
    $demande = Demande::find($request->demande_id);
    $demande->statut = 'Validé';
    $demande->save();

    

    return redirect()->route('agent.dashboard')->with('success', 'Acte de naissance créé avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $acte = Acte::with(['Commune', 'declarant', 'officier'])->findOrFail($id);

    return view('agent_mairie.naissances.show', compact('acte'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $acte = Acte::findOrFail($id);
    $communes = Commune::all();
    $officiers = Officier::all();
    $declarants = Declarant::all();

    return view('agent_mairie.naissances.edit', compact('acte', 'communes', 'officiers', 'declarants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

$request->validate([
        'prenom_enfant' => 'required|string',
        'nom_enfant' => 'required|string',
        'date_naissance' => 'required|date',
        'lieu_naissance' => 'required|string',
        'sexe_enfant' => 'required|string',
        'prenom_pere' => 'nullable|string',
        'nom_pere' => 'nullable|string',
        'profession_pere' => 'nullable|string',
        'domicile_pere' => 'nullable|string',
        'prenom_mere' => 'nullable|string',
        'nom_mere' => 'nullable|string',
        'profession_mere' => 'nullable|string',
        'domicile_mere' => 'nullable|string',
        'id_officier' => 'required|integer',
        'id_commune' => 'required|integer',
    ]);

    $acte = Acte::findOrFail($id);

    $acte->prenom = $request->prenom_enfant;
    $acte->nom = $request->nom_enfant;
    $acte->date_naissance_enfant = $request->date_naissance;
    $acte->lieu_naissance_enfant = $request->lieu_naissance;
    $acte->sexe_enfant = $request->sexe_enfant;

    $acte->prenom_pere = $request->prenom_pere;
    $acte->nom_pere = $request->nom_pere;
    $acte->proffesion_pere = $request->profession_pere;
    $acte->domicile_pere = $request->domicile_pere;

    $acte->prenom_mere = $request->prenom_mere;
    $acte->nom_mere = $request->nom_mere;
    $acte->proffesion_mere = $request->profession_mere;
    $acte->domicile_mere = $request->domicile_mere;

    $acte->id_officier = $request->id_officier;
    $acte->id_commune = $request->id_commune;

    $acte->save();
    

    return redirect()->route('agent.dashboard')->with('success', 'Acte de naissance modifié avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $acte = Acte::findOrFail($id);
        $acte->delete();

    return redirect()->route('agent.dashboard')->with('success', 'Acte de naissance supprimé avec succès.');
    }
}
