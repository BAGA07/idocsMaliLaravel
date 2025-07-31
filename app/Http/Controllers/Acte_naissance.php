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
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
class Acte_naissance extends Controller
{


    /**
     * Display a listing of the resource.
     */
//     public function index()
//     {

//         //  $statut = $request->input('statut');

//         // $demandes = Demande::with('volet')->where('statut', 'En attente')->get();
//         // $demandesCopies = Demande::where('nombre_copie')->get();


//         $demandes = Demande::with('volet')->get();
//         $demandesCopies = Demande::with('acte')->get();
//         $total = Demande::count();
//         $today = Carbon::today();
//         $startOfWeek = Carbon::now()->startOfWeek();
//         $endOfWeek = Carbon::now()->endOfWeek();
//         $todayCount = Demande::whereDate('created_at', $today)->count();
//         $weekCount = Demande::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
//         $monthCount = Demande::whereMonth('created_at', Carbon::now()->month)->count();


//         $actesNaissance = Acte::with('declarant')->latest()->get();
//         $actesCopies = Acte::with('declarant')->latest()->get();



//         // Statistiques
//         $total = VoletDeclaration::count();
//         $todayCount = VoletDeclaration::whereDate('created_at', $today)->count();
//         $weekCount = VoletDeclaration::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
//         $monthCount = VoletDeclaration::whereMonth('created_at', Carbon::now()->month)->count();
//         // Récupérer la liste des actes de naissance
//         $actesNaissance = Acte::with('declarant')->latest()->get();
//         return view('agent_mairie.dasboard', compact('total', 'todayCount', 'weekCount', 'monthCount', 'demandes', 'actesNaissance', 'demandesCopies','notifications'));



//         // Statistiques
//         $total = Demande::count();
//         $todayCount = Demande::whereDate('created_at', $today)->count();
//         $weekCount = Demande::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
//         $monthCount = Demande::whereMonth('created_at', Carbon::now()->month)->count();
//         // Récupérer la liste des actes de naissance
//         $actesNaissance = Acte::with('declarant')->latest()->get();
//         $mairieId = Auth::user()->mairie_id ?? null;
// $notifications = [];
// if ($mairieId) {
//     $notifications = Notification::where('mairie_id', $mairieId)
//         ->orderBy('created_at', 'desc')
//         ->take(20)
//         ->get();
// }
//         return view('agent_mairie.dasboard', compact('declarations', 'total', 'todayCount', 'weekCount', 'monthCount', 'demandes', 'actesNaissance', 'actesCopies', 'notifications'));
//     }
public function index()
{
    $demandes = Demande::with('volet')->get();
    $demandesCopies = Demande::with('acte')->get();
    $today = Carbon::today();
    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek = Carbon::now()->endOfWeek();

    // Statistiques sur les volets de déclaration
    $total = VoletDeclaration::count();
    $todayCount = VoletDeclaration::whereDate('created_at', $today)->count();
    $weekCount = VoletDeclaration::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
    $monthCount = VoletDeclaration::whereMonth('created_at', Carbon::now()->month)->count();

    // Liste des actes de naissance
    $actesNaissance = Acte::with('declarant')->latest()->get();
    $actesCopies = Acte::with('declarant')->latest()->get();

    // Notifications pour la mairie de l'agent connecté
    // $mairieId = Auth::user()->id_mairie ?? null;
    // $notifications = [];
    // if ($mairieId) {
    //     $notifications = Notification::where('mairie_id', $mairieId)
    //         ->orderBy('created_at', 'desc')
    //         ->take(20)
    //         ->get();
    // }

    // return view('agent_mairie.dasboard', compact(
    //     'total', 'todayCount', 'weekCount', 'monthCount',
    //     'demandes', 'actesNaissance', 'demandesCopies', 'actesCopies', 'notifications'
    // ));
    $mairieId = Auth::user()->id_mairie ?? null;
    $notifications = collect();
    if ($mairieId) {
        $notifications = Notification::where('mairie_id', $mairieId)
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Pagination (10 par page)
    }

    return view('agent_mairie.dasboard', compact(
        'total', 'todayCount', 'weekCount', 'monthCount',
        'demandes', 'actesNaissance', 'demandesCopies', 'actesCopies', 'notifications'
    ));
}
public function notifications()
{
    $mairieId = Auth::user()->id_mairie;
    $notifications = Notification::where('mairie_id', $mairieId)
        ->orderBy('created_at', 'desc')
        ->paginate(20);

    return view('agent_mairie.notifications.index', compact('notifications'));
}
// public function showNotification($id)
// {
//     $notification = Notification::findOrFail($id);



//     return view('agent_mairie.notifications.show', compact('notification'));
// }
public function showNotification($id)
{
    $notification = Notification::findOrFail($id);

    // Vérifie que la notification appartient à la mairie connectée
    if ($notification->mairie_id !== Auth::user()->id_mairie) {
        abort(403, 'Accès non autorisé');
    }

    // Marquer comme lue si ce n'est pas déjà fait
    if (!$notification->is_read) {
        $notification->is_read = true;
        $notification->save();
    }

    return view('agent_mairie.notifications.show', compact('notification'));
}

public function markAllAsRead()
{
    Notification::where('mairie_id', Auth::user()->id_mairie)
        ->where('is_read', false)
        ->update(['is_read' => true]);

    return redirect()->route('mairie.notifications.index')->with('success', 'Toutes les notifications ont été marquées comme lues.');
}


    /**
     * Show the form for creating a new resource.
     */
    public function listTraiter()
    {
        $demandes = Demande::with('volet')->Where('statut', 'Validé')->get();
        $demandesCopies = Demande::with('acte')->Where('statut', 'Validé')->get();

        return view('agent_mairie.naissances.listTraiter', compact('demandes', 'demandesCopies'));
    }
    public function listEnattente()
    {
        $demandes = Demande::with('volet')->where('statut', 'En attente')->get();
        $demandesCopies = Demande::with('acte')->where('statut', 'En attente')->get();
        return view('agent_mairie.naissances.listEnattente', compact('demandes', 'demandesCopies'));
    }
    public function listRejeté()
    {
        $demandes = Demande::with('volet')->where('statut', 'Rejeté')->get();
        $demandesCopies = Demande::with('acte')->where('statut', 'Rejeté')->get();
        return view('agent_mairie.naissances.listRejeté', compact('demandes', 'demandesCopies'));
    }
    public function create($id)

    {
        $demande = Demande::with('volet.declarant', 'volet.hopital')->findOrFail($id);
        $communes = Commune::all();
        $officiers = Officier::all();
        $declarants = Declarant::all();
    }
    public function creates($id)
    {
        $demandeCopies = Demande::findOrFail($id);
        //  $demandeCopies = Demande::with('acte', 'volet.declarant', 'volet.hopital')->findOrFail($id);
        $communes = Commune::all();
        $officiers = Officier::all();
        $declarants = Declarant::all();
        $acte = Acte::all();
        return view('agent_mairie.naissances.acteCopies', compact('demandeCopies', 'acte', 'communes', 'officiers', 'declarants'));
    }
    public function stores(Request $request)
    {
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
            'date_declaration' => now(),
            'numero_declaration' => $nextNum,

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



        return redirect()->route('agent.dashboard')->with('success', 'Acte de naissance créé avec succès.');
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


        $acte->date_enregistrement_acte = now();
        // $acte->id_volet = $demande->volet->id_volet;

        $acte->save();
        // Log création acte
        Log::create([
            'id_utilisateur' => Auth::id(),
            'action' => 'Création acte',
            'details' => 'Acte créé pour ' . $acte->nom . ' ' . $acte->prenom . ' (N°' . $acte->num_acte . ')',
        ]);

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
        $acte = Acte::with(['demande.volet', 'Commune', 'declarant', 'officier.mairie'])->findOrFail($id);

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
        // Log suppression acte
        Log::create([
            'id_utilisateur' => Auth::id(),
            'action' => 'Suppression acte',
            'details' => 'Acte supprimé pour ' . $acte->nom . ' ' . $acte->prenom . ' (N°' . $acte->num_acte . ')',
        ]);

        return redirect()->route('agent.dashboard')->with('success', 'Acte de naissance supprimé avec succès.');
    }

    public function downloadPdf($id)
    {
        $acte = \App\Models\Acte::with(['Commune', 'declarant', 'officier'])->findOrFail($id);
        $pdf = Pdf::loadView('agent_mairie.naissances.pdf', compact('acte'));
        $filename = 'acte_naissance_' . $acte->num_acte . '.pdf';
        return $pdf->download($filename);
    }
}
