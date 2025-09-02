<?php

namespace App\Http\Controllers;

use App\Models\Declarant;
use Illuminate\Validation\Rules\Enum;
use App\Enums\StatusEnum;
use App\Models\Hopital;
use App\Models\Log;
use App\Models\VoletDeclaration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Notification;

class VoletDeclarationController extends Controller
{
    // Afficher toutes les déclarations
    public function dashboard()
    {
        // Statistiques globales
        $totalNaissances = VoletDeclaration::count();

        $anneeActuelle = Carbon::now()->month;

        $totalGarçons = VoletDeclaration::whereMonth('created_at', $anneeActuelle)
            ->where('sexe', 'Masculin')
            ->count();

        $totalFilles = VoletDeclaration::whereMonth('created_at', $anneeActuelle)
            ->where('sexe', 'Féminin')
            ->count();
            $hopital_id = Auth::user()->id_hopital ?? null;
            $notifications = collect();

        if ($hopital_id) {
            $notifications = Notification::where('hopital_id', $hopital_id)
                ->orderBy('created_at', 'desc')
                ->paginate(10); // Pagination (10 par page)
        }
        $notificationsDropdown = Notification::where('hopital_id', $hopital_id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $declarations = VoletDeclaration::with('declarant', 'hopital')->latest()->paginate(20);

        return view('hopital.dashboard', compact('declarations', 'totalNaissances', 'totalGarçons', 'totalFilles', 'notifications', 'notificationsDropdown'));
    }

    public function create()
    {
        return view('hopital.naissances.create');
    }
    public function notifications()
{
    $hopitalId = Auth::user()->id_hopital;

    $notifications = Notification::where('hopital_id', $hopitalId)
        ->orderBy('created_at', 'desc')
        ->paginate(20);
    return view('hopital.notifications.index', compact('notifications'));
}

public function showNotification($id)
{
    $notification = Notification::findOrFail($id);

    // Vérifie que la notification appartient à l'hôpital connecté
    if ($notification->hopital_id !== Auth::user()->id_hopital) {
        abort(403, 'Accès non autorisé');
    }

    if (!$notification->is_read) {
        $notification->is_read = true;
        $notification->save();
    }

    return view('hopital.notifications.show', compact('notification'));
}

public function markAllAsRead()
{
    Notification::where('hopital_id', Auth::user()->id_hopital)
        ->where('is_read', false)
        ->update(['is_read' => true]);

    return response()->json(['success' => true]);
}

public function ajaxMarkRead($id)
{
    $notification = Notification::findOrFail($id);

    // Vérifie que la notification est destinée à l'hôpital connecté
    if ($notification->hopital_id !== Auth::user()->id_hopital) {
        return response()->json(['message' => 'Non autorisé'], 403);
    }

    if (!$notification->is_read) {
        $notification->is_read = true;
        $notification->save();
    }

    $unreadCount = Notification::where('hopital_id', Auth::user()->id_hopital)
        ->where('is_read', false)
        ->count();

    return response()->json([
        'message' => 'Notification marquée comme lue.',
        'unreadCount' => $unreadCount
    ]);
}

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'prenom_pere' => 'required|string|max:100',
            'nom_pere' => 'required|string|max:100',
            'age_pere' => 'required|integer|min:0|max:130',
            'domicile_pere' => 'required|string',
            'ethnie_pere' => 'required|string',
            'situation_matrimonial_pere' => 'required|string',
            'niveau_scolaire_pere' => 'required|string',
            'profession_pere' => 'required|string',

            'prenom_mere' => 'required|string|max:100',
            'nom_mere' => 'required|string|max:100',
            'age_mere' => 'required|integer|min:0|max:130',
            'domicile_mere' => 'required|string',
            'ethnie_mere' => 'required|string',
            'situation_matrimonial_mere' => 'required|string',
            'niveau_instruction_mere' => 'required|string',
            'profession_mere' => 'required|string',

            'prenom_enfant' => 'nullable|string|max:100',
            'nom_enfant' => 'nullable|string|max:100',
            'date_naissance' => 'required|date',
            'sexe' => 'required|string|in:Masculin,Féminin',
            'nbreEnfantAccouchement' => 'nullable|integer|min:1',

            'prenom_declarant' => 'required|string|max:100',
            'nom_declarant' => 'required|string|max:100',
            'age_declarant' => 'required|integer|min:0|max:130',
            'domicile_declarant' => 'required|string',
            'ethnie_declarant' => 'required|string',
            'telephone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        // 1. Enregistrement du déclarant
        $declarant = Declarant::create([
            'prenom_declarant' => $request->prenom_declarant,
            'nom_declarant' => $request->nom_declarant,
            'age_declarant' => $request->age_declarant,
            'domicile_declarant' => $request->domicile_declarant,
            'profession_declarant' => $request->professsion_declarant,
            'ethnie_declarant' => $request->ethnie_declarant,
            'numero_declaration' => rand(1000, 9999),
            'date_declaration' => now(),
            'telephone' => $request->telephone ?? null,
            'email' => $request->email ?? null,
        ]);

        // 2. Enregistrement dans volet_declarations
        VoletDeclaration::create([
            'num_volet' => 'VL' . now()->format('ymd') . rand(10, 99),
            'prenom_pere' => $request->prenom_pere,
            'nom_pere' => $request->nom_pere,
            'age_pere' => $request->age_pere,
            'domicile_pere' => $request->domicile_pere,
            'ethnie_pere' => $request->ethnie_pere,
            'situation_matrimonial_pere' => $request->situation_matrimonial_pere,
            'niveau_instruction_pere' => $request->niveau_scolaire_pere,
            'profession_pere' => $request->profession_pere,

            'prenom_mere' => $request->prenom_mere,
            'nom_mere' => $request->nom_mere,
            'age_mere' => $request->age_mere,
            'domicile_mere' => $request->domicile_mere,
            'ethnie_mere' => $request->ethnie_mere,
            'situation_matrimonial_mere' => $request->situation_matrimonial_mere,
            'niveau_instruction_mere' => $request->niveau_instruction_mere,
            'profession_mere' => $request->profession_mere,

            'prenom_enfant' => $request->prenom_enfant,
            'nom_enfant' => $request->nom_enfant,
            'date_naissance' => $request->date_naissance,
            'sexe' => $request->sexe,
            'heure_naissance' => $request->heure_naissance,
            'date_declaration' => now(),
            'nbreEnfantAccouchement' => $request->nbreEnfantAccouchement ?? 1,
            'nbreEINouvNee' => $request->nbreEINouvNee ?? 1,

            'id_declarant' => $declarant->id_declarant,
            'id_hopital' => Auth::user()->id_hopital,
            'token' => Str::uuid(),
        ]);
        // Log création volet
        Log::create([
            'id_utilisateur' => Auth::id(),
            'action' => 'Création volet',
            'details' => 'Volet créé pour ' . $request->nom_enfant . ' ' . $request->prenom_enfant . ' (date naissance : ' . $request->date_naissance . ')',
        ]);
        return redirect()->route('hopital.dashboard')->with('success', 'Déclaration de naissance enregistrée avec succès.');
    }


    public function show($id)
    {
        $declaration = VoletDeclaration::with('declarant', 'hopital.commune')->findOrFail($id);
        $demandeExistante = \App\Models\Demande::where('id_volet', $id)->exists();
        $mairieCommune = null;
        if ($declaration->hopital && $declaration->hopital->commune) {
            $mairieCommune = \App\Models\Mairie::where('id_commune', $declaration->hopital->commune->id)->first();
        }
        return view('hopital.naissances.show', compact('declaration', 'demandeExistante', 'mairieCommune'));
    }


    public function edit($id)
    {
        $volet = VoletDeclaration::with('declarant')->findOrFail($id);
        return view('hopital.naissances.edit', compact('volet'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            // Enfant
            'prenom_enfant' => 'nullable|string|max:100',
            'nom_enfant' => 'nullable|string|max:100',
            'date_naissance' => 'required|date',
            'heure_naissance' => 'required',
            'sexe' => 'required|in:Masculin,Féminin',
            'nbreEnfantAccouchement' => 'nullable|integer|min:1',

            // Père
            'prenom_pere' => 'required|string|max:100',
            'nom_pere' => 'required|string|max:100',
            'age_pere' => 'required|integer|min:0|max:130',
            'domicile_pere' => 'required|string',
            'ethnie_pere' => 'required|string',
            'situation_matrimonial_pere' => 'required|in:Marié,Célibataire,Divorcé',
            'niveau_instruction_pere' => 'required|string',
            'profession_pere' => 'required|string',

            // Mère
            'prenom_mere' => 'required|string|max:100',
            'nom_mere' => 'required|string|max:100',
            'age_mere' => 'required|integer|min:0|max:130',
            'domicile_mere' => 'required|string',
            'ethnie_mere' => 'required|string',
            'situation_matrimonial_mere' => 'required|in:Marié,Célibataire,Divorcé',
            'niveau_instruction_mere' => 'required|string',
            'profession_mere' => 'required|string',

            // Déclarant
            'prenom_declarant' => 'required|string|max:100',
            'nom_declarant' => 'required|string|max:100',
            'age_declarant' => 'required|integer|min:0|max:130',
            'domicile_declarant' => 'required|string',
            'ethnie_declarant' => 'required|string',
            'telephone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        $volet = VoletDeclaration::findOrFail($id);
        // Mise à jour du déclarant
        $declarant = $volet->declarant;
        $declarant->prenom_declarant = $request->prenom_declarant;
        $declarant->nom_declarant = $request->nom_declarant;
        $declarant->age_declarant = $request->age_declarant;
        $declarant->domicile_declarant = $request->domicile_declarant;
        $declarant->telephone = $request->telephone;
        $declarant->email = $request->email;
        $declarant->ethnie_declarant = $request->ethnie_declarant;
        $declarant->save();

        // Mise à jour du volet
        $volet->update([
            // Enfant
            'prenom_enfant' => $request->prenom_enfant,
            'nom_enfant' => $request->nom_enfant,
            'date_naissance' => $request->date_naissance,
            'heure_naissance' => $request->heure_naissance,
            'sexe' => $request->sexe,
            'nbreEnfantAccouchement' => $request->nbreEnfantAccouchement,

            // Père
            'prenom_pere' => $request->prenom_pere,
            'nom_pere' => $request->nom_pere,
            'age_pere' => $request->age_pere,
            'domicile_pere' => $request->domicile_pere,
            'ethnie_pere' => $request->ethnie_pere,
            'situation_matrimonial_pere' => $request->situation_matrimonial_pere,
            'niveau_instruction_pere' => $request->niveau_instruction_pere,
            'profession_pere' => $request->profession_pere,

            // Mère
            'prenom_mere' => $request->prenom_mere,
            'nom_mere' => $request->nom_mere,
            'age_mere' => $request->age_mere,
            'domicile_mere' => $request->domicile_mere,
            'ethnie_mere' => $request->ethnie_mere,
            'situation_matrimonial_mere' => $request->situation_matrimonial_mere,
            'niveau_instruction_mere' => $request->niveau_instruction_mere,
            'profession_mere' => $request->profession_mere,
        ]);

        return redirect()->route('hopital.dashboard')->with('success', 'Déclaration mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $volet = VoletDeclaration::findOrFail($id);
        $volet->delete();
        // Log suppression volet
        Log::create([
            'id_utilisateur' => Auth::id(),
            'action' => 'Suppression volet',
            'details' => 'Volet supprimé pour ' . $volet->nom_enfant . ' ' . $volet->prenom_enfant . ' (date naissance : ' . $volet->date_naissance . ')',
        ]);
        return redirect()->route('hopital.dashboard')->with('success', 'Volet supprimé avec succès.');
    }
}
