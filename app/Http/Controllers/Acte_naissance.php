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
        //  $statut = $request->input('statut');  
 
        // $demandes = Demande::with('volet')->where('statut', 'En attente')->get();
        // $demandesCopies = Demande::where('nombre_copie')->get();
 // $demandeNaissance=Demande::whereHas('acte')->WhereRelation('acte','date_naissance_enfant','<',now())->get();  
 $demandes = Demande::with('volet')
    ->whereNotNull('id_volet')
    ->get();

        $demandesCopies = Demande::with('acte')
    ->where('nombre_copie', '>', 0)
    ->whereNull('id_volet')
    ->get();

            $total = Demande::count();
               $today = Carbon::today();
    $startOfWeek = Carbon::now()->startOfWeek(); 
    $endOfWeek = Carbon::now()->endOfWeek(); 
    $todayCount = Demande::whereDate('created_at', $today)->count();
    $weekCount = Demande::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
    $monthCount = Demande::whereMonth('created_at', Carbon::now()->month)->count();

 





    return view('agent_mairie.dasboard', compact( 'total', 'todayCount', 'weekCount', 'monthCount','demandes','demandesCopies'));
       

    }

    /** 
     * Show the form for creating a new resource.
     */
    public function listNaissancesVolet(){
        
    // On récupère les ID des demandes liées à un volet
    $demandesAvecVolet = Demande::whereNotNull('id_volet')->pluck('id');

    // On récupère les actes liés à ces demandes
    $actesNaissance = Acte::with(['declarant', 'demande'])
        ->whereIn('id_demande', $demandesAvecVolet)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('agent_mairie.naissances.volets',compact('actesNaissance'));
    

    }
    public function listNaissancesCopie(){
        
   $actesCopies = Demande::with('acte')
        ->where('nombre_copie', '>', 0)
        ->whereNull('id_volet')
        ->whereHas('acte') // s'assurer que l'acte existe
        ->orderBy('created_at', 'desc')
        ->get();
    return view('agent_mairie.naissances.copies',compact('actesCopies'));

    }
    public function listTraiter(){
    $demandes = Demande::with('volet')
        ->where('statut', 'Validé')
        ->whereNotNull('id_volet')
        ->get();

    $demandesCopies = Demande::with('acte')
        ->where('statut', 'Validé')
        ->whereNull('id_volet') 
        ->where('nombre_copie', '>', 0)
        ->whereHas('acte')
        ->get();

        // ->whereHas('acte') 
        // ->whereHas('volet')->
        
 
        return view('agent_mairie.naissances.listTraiter',compact('demandes','demandesCopies'));
    }
     public function listEnattente(){
$demandes = Demande::with('volet')
        ->where('statut', 'En attente')
        ->whereNotNull('id_volet')
        ->get();

    $demandesCopies = Demande::with('acte')
        ->where('statut', 'En attente')
       -> whereNull('id_volet') 
        ->where('nombre_copie', '>', 0)
        ->get();
       


        return view('agent_mairie.naissances.listEnattente',compact('demandes','demandesCopies'));
    }
     public function listRejeté(){
       $demandes = Demande::with('volet')->Where('statut','Rejeté')->whereNotNull('id_volet')
->get();
        $demandesCopies = Demande::with('acte')->where('statut', 'Rejeté')
        ->whereNull('id_volet')
        ->where('nombre_copie', '>', 0)
        ->get();
        return view('agent_mairie.naissances.listRejeté',compact('demandes','demandesCopies'));
    }
    public function create($id)
{
    $demande = Demande::with('volet.declarant','volet.hopital')->findOrFail($id);
    $communes = Commune::all();
    $officiers = Officier::all();
    $declarants=Declarant::all();
   


   
    return view('agent_mairie.naissances.create', compact('demande', 'communes', 'officiers','declarants'));

}
   public function creates($id){
 $demandeCopies = Demande::findOrFail($id);
//  $demandeCopies = Demande::with('acte', 'volet.declarant', 'volet.hopital')->findOrFail($id);
 $communes = Commune::all();
    $officiers = Officier::all();
    $declarants=Declarant::all();
    $acte=Acte::all();
    return view('agent_mairie.naissances.acteCopies', compact('demandeCopies','acte','communes', 'officiers','declarants'));

   }
public function stores(Request $request){
        $request->validate([
        'prenom_enfant' => 'required|string',
        'nom_enfant' => 'required|string',
        'date_naissance' => 'required|date',
        'lieu_naissance' => 'required|string',
        'heure_naissance' => 'required',
        'sexe_enfant' => 'required|string',
        'prenom_pere' => 'required|string',
        'nom_pere' => 'required|string',
        'profession_pere' => 'required|string',
        'domicile_pere' => 'required|string',
        'prenom_mere' => 'required|string',
        'nom_mere' => 'required|string',
        'profession_mere' => 'required|string',
        'domicile_mere' => 'required|string',
        'prenom_declarant' => 'required|string',
        'nom_declarant' => 'required|string',
        'age_declarant' => 'required|numeric',
        'profession_declarant' => 'required|string',
        'domicile_declarant' => 'required|string',
        'ethnie_declarant' => 'nullable',
        
        'id_officier' => 'required|exists:officier_etat_civil,id',
        // 'id_declarand' => 'required|exists:declarants,id_declarant',
        'id_commune' => 'required|exists:communes,id',
    ]);
        //  Créer le déclarant
         $lastNum = Declarant::max('numero_declaration');

    $nextNum = $lastNum ? $lastNum + 1 : 1;
    $declarant = Declarant::create([
        'prenom_declarant' => $request->prenom_declarant,
        'nom_declarant' => $request->nom_declarant,
        'age_declarant' => $request->age_declarant,
        'profession_declarant' => $request->profession_declarant,
        'domicile_declarant' => $request->domicile_declarant,
        'ethnie_declarant' => $request->ethnie_declaration,
        'email' => $request->email,
        'telephone' => $request->telephone,
        'date_declaration'=>now() ,
        'numero_declaration'=>$nextNum,

    ]);
// dd($declarant);



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
    $acte->profession_pere = $request->profession_pere; 
    $acte->domicile_pere = $request->domicile_pere;

    $acte->prenom_mere = $request->prenom_mere;
    $acte->nom_mere = $request->nom_mere;
    $acte->profession_mere = $request->profession_mere;
    $acte->domicile_mere = $request->domicile_mere;
    // $acte->id_declarant = $demande->volet->id_declarant ?? null;  
    //$acte->heure_naissance = $demande->volet->heure_naissance ?? null;  
    $acte->id_demande = $request->demande_id;
    $acte->id_officier = $request->id_officier;
    $acte->id_commune = $request->id_commune;
   $acte->id_declarant = $declarant->id_declarant;

    $acte->date_enregistrement_acte = now();
// $acte->id_volet = $demande->volet->id_volet;

    $acte->save();

    // Mettre à jour le statut de la demande
    $demande = Demande::find($request->demande_id);
    $demande->statut = 'Validé';
    $demande->save();

    

    return redirect()->route('copie')->with('success', 'Acte de naissance créé avec succès.');

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
    $acte->sexe_enfant = $request->sexe_enfant;

    $acte->prenom = $request->prenom_enfant;
    $acte->nom = $request->nom_enfant;

    $acte->prenom_pere = $request->prenom_pere;
    $acte->nom_pere = $request->nom_pere;
    $acte->profession_pere = $request->profession_pere; 
    $acte->domicile_pere = $request->domicile_pere;
    $acte->heure_naissance = $request->heure_naissance;


    $acte->prenom_mere = $request->prenom_mere;
    $acte->nom_mere = $request->nom_mere;
    $acte->profession_mere = $request->profession_mere;
    $acte->domicile_mere = $request->domicile_mere;
    $acte->id_declarant = $demande->volet->id_declarant ?? null;  
    //$acte->heure_naissance = $demande->volet->heure_naissance ?? null;  
    $acte->id_demande = $request->demande_id;
    $acte->id_officier = $request->id_officier;
    $acte->id_commune = $request->id_commune;
    
    $acte->date_enregistrement_acte = now();
// $acte->id_volet = $demande->volet->id_volet;

    $acte->save();

    // Mettre à jour le statut de la demande
    $demande = Demande::find($request->demande_id);
    $demande->statut = 'Validé';
    $demande->save();

    

    return redirect()->route('volet')->with('success', 'Acte de naissance créé avec succès.');

    }
    /**
     * Store a newly created resource in storage.
     */
//     public function store(Request $request)
//     {
//         // Récupérer la demande avec son volet et déclarant
//     $demande = Demande::with('volet')->findOrFail($request->demande_id);

//    $lastNum = Acte::max('num_acte');

//     $nextNum = $lastNum ? $lastNum + 1 : 1;

//     // Créer l’acte avec correspondance précise
//     $acte = new Acte();
//     $acte->num_acte = $nextNum;

//     $acte->date_naissance_enfant = $request->date_naissance;
//     $acte->lieu_naissance_enfant = $request->lieu_naissance;
//     $acte->sexe_enfant = $request->sexe_enfant;

//     $acte->prenom = $request->prenom_enfant;
//     $acte->nom = $request->nom_enfant;

//         $acte->prenom_pere = $request->prenom_pere;
//         $acte->nom_pere = $request->nom_pere;
//         $acte->profession_pere = $request->profession_pere;
//         $acte->domicile_pere = $request->domicile_pere;
//         $acte->heure_naissance = $request->heure_naissance;


//         $acte->prenom_mere = $request->prenom_mere;
//         $acte->nom_mere = $request->nom_mere;
//         $acte->profession_mere = $request->profession_mere;
//         $acte->domicile_mere = $request->domicile_mere;
//         $acte->id_declarant = $demande->volet->id_declarant ?? null;
//         //$acte->heure_naissance = $demande->volet->heure_naissance ?? null;  
//         $acte->id_demande = $request->demande_id;
//         $acte->id_officier = $request->id_officier;
//         $acte->id_commune = $request->id_commune;

//         $acte->date_enregistrement_acte = now();
//         // $acte->id_volet = $demande->volet->id_volet;

//     $acte->save();

//     // Mettre à jour le statut de la demande
//     $demande = Demande::find($request->demande_id);
//     $demande->statut = 'Validé';
//     $demande->save();

    

//     return redirect()->route('volet')->with('success', 'Acte de naissance créé avec succès.');

//     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $acte = Acte::with(['demande.volet','Commune', 'declarant', 'officier.mairie'])->findOrFail($id);

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
        'prenom' => 'required|string',
        'nom' => 'required|string',
        'date_naissance_enfant' => 'required|date',
        'lieu_naissance_enfant' => 'required|string',
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

    $acte->prenom = $request->prenom;
    $acte->nom = $request->nom;
    $acte->date_naissance_enfant = $request->date_naissance_enfant;
    $acte->lieu_naissance_enfant = $request->lieu_naissance_enfant;
    $acte->sexe_enfant = $request->sexe_enfant;

    $acte->prenom_pere = $request->prenom_pere;
    $acte->nom_pere = $request->nom_pere;
    $acte->profession_pere = $request->profession_pere;
    $acte->domicile_pere = $request->domicile_pere;

    $acte->prenom_mere = $request->prenom_mere;
    $acte->nom_mere = $request->nom_mere;
    $acte->profession_mere = $request->profession_mere;
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
