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
use Illuminate\Support\Facades\Storage; // Correctement importé, bien !

class Acte_naissance extends Controller
{
    // =========================================================================
    // Méthodes de visualisation et de gestion des listes (Dashboard Agent)
    // =========================================================================

    /**
     * Display a listing of the resource (Dashboard principal pour l'agent).
     */


    public function index()
    {
        // Statistiques globales pour les déclarations/demandes
        $total = VoletDeclaration::count(); // Total des volets de déclaration
        $totalDeclarations = VoletDeclaration::count();
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $todayCount = VoletDeclaration::whereDate('created_at', $today)->count(); // Compteur du jour
        $todayDeclarationsCount = VoletDeclaration::whereDate('created_at', $today)->count();
        $weekCount = VoletDeclaration::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(); // Compteur de la semaine
        $weekDeclarationsCount = VoletDeclaration::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $monthCount = VoletDeclaration::whereMonth('created_at', Carbon::now()->month)->count(); // Compteur du mois
        $monthDeclarationsCount = VoletDeclaration::whereMonth('created_at', Carbon::now()->month)->count();

        // Récupérer les DEMANDES d'actes originaux (via volet de déclaration)
        $demandes = Demande::where('type_document', 'Extrait original')
            ->whereNotNull('id_volet')
            ->with('volet')
            ->get();

        // Récupérer les DEMANDES de copies (via plateforme publique)
        $demandesCopies = Demande::where('type_document', 'Extrait de naissance')
            ->with('acte')
            ->get();

        // Récupérer les ACTES de naissance originaux (ceux avec type='original' ou NULL)
        $actesNaissanceOriginaux = Acte::where(function ($query) {
            $query->whereNull('type') // Actes sans type défini (présumés originaux)
                ->orWhere('type', 'original'); // Ou explicitement marqués comme originaux
        })->with('declarant')->latest()->get();

        // Récupérer les COPIES D'ACTES (ceux avec type='copie')
        $actesCopies = Acte::where('type', 'copie')->with('declarant')->latest()->get();
        $mairieId = Auth::user()->id_mairie ?? null;
        $notifications = collect();
        if ($mairieId) {
            $notifications = Notification::where('mairie_id', $mairieId)
                ->orderBy('created_at', 'desc')
                ->paginate(10); // Pagination (10 par page)
        }
        $notificationsDropdown = Notification::where('mairie_id', $mairieId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();


        return view('agent_mairie.dasboard', compact(
            'total',
            'todayCount',
            'weekCount',
            'monthCount',
            'demandes',
            'actesNaissanceOriginaux',
            'demandesCopies',
            'actesCopies',
            'notifications',
            'notificationsDropdown'
        ));
    }
    // // public function index()
    // {
    //     // Statistiques globales pour les déclarations/demandes
    //     $total = VoletDeclaration::count(); // Total des volets de déclaration
    //     $totalDeclarations = VoletDeclaration::count();
    //     $today = Carbon::today();
    //     $startOfWeek = Carbon::now()->startOfWeek();
    //     $endOfWeek = Carbon::now()->endOfWeek();
    //     $todayCount = VoletDeclaration::whereDate('created_at', $today)->count(); // Compteur du jour
    //     $todayDeclarationsCount = VoletDeclaration::whereDate('created_at', $today)->count();
    //     $weekCount = VoletDeclaration::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(); // Compteur de la semaine
    //     $weekDeclarationsCount = VoletDeclaration::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
    //     $monthCount = VoletDeclaration::whereMonth('created_at', Carbon::now()->month)->count(); // Compteur du mois
    //     $monthDeclarationsCount = VoletDeclaration::whereMonth('created_at', Carbon::now()->month)->count();

    //     // Récupérer les DEMANDES d'actes originaux (via volet de déclaration)
    //     $demandes = Demande::where('type_document', 'Extrait original')
    //         ->whereNotNull('id_volet')
    //         ->with('volet')
    //         ->get();

    //     // Récupérer les DEMANDES de copies (via plateforme publique)
    //     $demandesCopies = Demande::where('type_document', 'Extrait de naissance')
    //         ->with('acte')
    //         ->get();

    //     // Récupérer les ACTES de naissance originaux (ceux avec type='original' ou NULL)
    //     $actesNaissanceOriginaux = Acte::where(function ($query) {
    //         $query->whereNull('type') // Actes sans type défini (présumés originaux)
    //             ->orWhere('type', 'original'); // Ou explicitement marqués comme originaux
    //     })->with('declarant')->latest()->get();

    //     // Récupérer les COPIES D'ACTES (ceux avec type='copie')
    //     $actesCopies = Acte::where('type', 'copie')->with('declarant')->latest()->get();

    //     return view('agent_mairie.dasboard', compact(
    //         'total',              // Total des volets de déclaration
    //         'totalDeclarations',
    //         'todayCount',         // Compteur du jour
    //         'todayDeclarationsCount',
    //         'weekCount',          // Compteur de la semaine
    //         'weekDeclarationsCount',
    //         'monthCount',         // Compteur du mois
    //         'monthDeclarationsCount',
    //         'demandes',           // Demandes d'actes originaux
    //         'demandesCopies',     // Demandes de copies (qui peuvent être en attente, traitées, etc.)
    //         'actesNaissanceOriginaux', // Les enregistrements des actes originaux
    //         'actesCopies'         // Les enregistrements des copies d'actes
    //     ));
    //     return view('agent_mairie.dasboard', compact(
    //         'total',
    //         'todayCount',
    //         'weekCount',
    //         'monthCount',
    //         'demandes',
    //         'actesNaissance',
    //         'demandesCopies',
    //         'actesCopies',
    //         'notifications'
    //     ));
    // }
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


    // public function index()
    // {
    //     $demandes = Demande::with('volet')->get();
    //     $demandesCopies = Demande::with('acte')->get();
    //     $today = Carbon::today();
    //     $startOfWeek = Carbon::now()->startOfWeek();
    //     $endOfWeek = Carbon::now()->endOfWeek();

    //     // Statistiques sur les volets de déclaration
    //     $total = VoletDeclaration::count();
    //     $todayCount = VoletDeclaration::whereDate('created_at', $today)->count();
    //     $weekCount = VoletDeclaration::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
    //     $monthCount = VoletDeclaration::whereMonth('created_at', Carbon::now()->month)->count();

    //     // Liste des actes de naissance
    //     $actesNaissance = Acte::with('declarant')->latest()->get();
    //     $actesCopies = Acte::with('declarant')->latest()->get();

    //     // Notifications pour la mairie de l'agent connecté
    //     // $mairieId = Auth::user()->id_mairie ?? null;
    //     // $notifications = [];
    //     // if ($mairieId) {
    //     //     $notifications = Notification::where('mairie_id', $mairieId)
    //     //         ->orderBy('created_at', 'desc')
    //     //         ->take(20)
    //     //         ->get();
    //     // }

    //     // return view('agent_mairie.dasboard', compact(
    //     //     'total', 'todayCount', 'weekCount', 'monthCount',
    //     //     'demandes', 'actesNaissance', 'demandesCopies', 'actesCopies', 'notifications'
    //     // ));
    //     $mairieId = Auth::user()->id_mairie ?? null;
    //     $notifications = collect();
    //     if ($mairieId) {
    //         $notifications = Notification::where('mairie_id', $mairieId)
    //             ->orderBy('created_at', 'desc')
    //             ->paginate(10); // Pagination (10 par page)
    //     }
    //     $notificationsDropdown = Notification::where('mairie_id', $mairieId)
    //     ->orderBy('created_at', 'desc')
    //     ->take(5)
    //     ->get();


    //     return view('agent_mairie.dasboard', compact(
    //         'total', 'todayCount', 'weekCount', 'monthCount',
    //         'demandes', 'actesNaissance', 'demandesCopies', 'actesCopies', 'notifications','notificationsDropdown'
    //     ));
    // }


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

    // public function markAllAsRead()
    // {
    //     Notification::where('mairie_id', Auth::user()->id_mairie)
    //         ->where('is_read', false)
    //         ->update(['is_read' => true]);

    //     return redirect()->route('mairie.notifications.index')->with('success', 'Toutes les notifications ont été marquées comme lues.');
    // }
    public function markAllAsRead()
    {
        auth()->user()->notifications()->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }

    // public function ajaxMarkRead($id)
    // {
    //     $notification = Notification::findOrFail($id);

    //     if ($notification->mairie_id !== Auth::user()->id_mairie) {
    //         return response()->json(['message' => 'Non autorisé'], 403);
    //     }

    //     if (!$notification->is_read) {
    //         $notification->is_read = true;
    //         $notification->save();
    //     }

    //     return response()->json(['message' => 'Notification marquée comme lue.']);
    // }
    public function ajaxMarkRead($id)
    {
        // Trouver la notification par ID
        $notification = Notification::findOrFail($id);

        // Vérifier si l'utilisateur appartient à la mairie qui a cette notification
        if ($notification->mairie_id !== Auth::user()->id_mairie) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        // Si la notification n'est pas déjà lue, on la marque comme lue
        if (!$notification->is_read) {
            $notification->is_read = true;
            $notification->save();
        }

        // Récupérer le nombre de notifications non lues
        $unreadCount = Notification::where('mairie_id', Auth::user()->id_mairie)
            ->where('is_read', false)
            ->count();

        // Retourner la réponse avec le message et le nombre de notifications non lues
        return response()->json([
            'message' => 'Notification marquée comme lue.',
            'unreadCount' => $unreadCount // Envoie le nombre de notifications non lues
        ]);
    }




    /**
     * Show the form for creating a new resource.
    /**
     * Liste les demandes traitées (qu'elles soient des demandes d'originaux ou des demandes de copies).
     */
    public function listTraiter()
    {
        // Demandes d'actes originaux (via volet) validées/traitées
        $demandes = Demande::where('type_document', 'Extrait original')
            ->where('statut', 'Validé')
            ->whereNotNull('id_volet')
            ->with('volet')
            ->get();

        $demandesActesOriginauxTraitees = Demande::where('type_document', 'Extrait original')
            ->where('statut', 'Validé')
            ->whereNotNull('id_volet')
            ->with('volet')
            ->get();

        // Demandes de copies d'actes traitées
        $demandesCopies = Demande::where('type_document', 'Extrait de naissance')
            ->where('statut', 'Traitée')
            ->whereNotNull('id')
            ->with('acte')
            ->get();

        $demandesCopiesTraitees = Demande::where('type_document', 'Extrait de naissance')
            ->where('statut', 'Traitée')
            ->whereNotNull('id')
            ->with('acte')
            ->get();

        return view('agent_mairie.naissances.listTraiter', compact('demandes', 'demandesActesOriginauxTraitees', 'demandesCopies', 'demandesCopiesTraitees'));
    }

    /**
     * Liste les demandes en attente (qu'elles soient des demandes d'originaux ou des demandes de copies).
     */
    public function listEnattente()
    {
        // Demandes d'actes originaux (via volet) en attente
        $demandesOriginalesEnAttente = Demande::where('type_document', 'Extrait original')
            ->where('statut', 'En attente')
            ->whereNotNull('id_volet')
            ->with('volet')
            ->get();

        $demandesActesOriginauxEnAttente = Demande::where('type_document', 'Extrait original')
            ->where('statut', 'En attente')
            ->whereNotNull('id_volet')
            ->with('volet')
            ->get();

        // Demandes de copies en attente
        $demandesCopiesEnAttente = Demande::where('type_document', 'Extrait de naissance')
            ->where('statut', 'En attente')
            ->whereNull('id_volet')
            ->get();

        return view('agent_mairie.naissances.listEnattente', compact('demandesOriginalesEnAttente', 'demandesActesOriginauxEnAttente', 'demandesCopiesEnAttente'));
    }

    /**
     * Liste les demandes rejetées (qu'elles soient des demandes d'originaux ou des demandes de copies).
     */
    public function listRejeté()
    {
        // Demandes d'actes originaux rejetées
        $demandesActesOriginauxRejetees = Demande::where('type_document', 'Extrait original')
            ->where('statut', 'Rejeté')
            ->whereNotNull('id_volet')
            ->with('volet')
            ->get();

        // Demandes d'actes originaux rejetées (pour la vue)
        $demandes = Demande::where('type_document', 'Extrait original')
            ->where('statut', 'Rejeté')
            ->whereNotNull('id_volet')
            ->with('volet')
            ->get();

        // Demandes de copies rejetées
        $demandesCopies = Demande::where('type_document', 'Extrait de naissance')
            ->where('statut', 'Rejeté')
            ->get();

        $demandesCopiesRejetees = Demande::where('type_document', 'Extrait de naissance')
            ->where('statut', 'Rejeté')
            ->get();

        return view('agent_mairie.naissances.listRejeté', compact('demandes', 'demandesActesOriginauxRejetees', 'demandesCopies', 'demandesCopiesRejetees'));
    }

    /**
     * Affiche le formulaire pour l'agent pour créer un NOUVEL ACTE ORIGINAL.
     * C'est pour les demandes de "nouveau-né" via déclaration de volet.
     *
     * @param  int  $id L'ID de la Demande de type 'nouveau-ne'
     * @return \Illuminate\View\View
     */
    public function createActeOriginalForm($id) // Renommé pour plus de clarté
    {
        $demande = Demande::with('volet.declarant', 'volet.hopital')->findOrFail($id);

        // Assurez-vous que cette demande est bien de type 'Extrait original' et 'En attente'
        if ($demande->type_document !== 'Extrait original' || $demande->statut !== 'En attente') {
            return redirect()->back()->withErrors('Cette demande n\'est pas une demande d\'acte original en attente.');
        }

        $communes = Commune::all();
        $officiers = Officier::all();
        $declarants = Declarant::all(); // Déclarants existants

        return view('agent_mairie.naissances.create', compact('demande', 'communes', 'officiers', 'declarants'));
    }

    /**
     * Enregistre un NOUVEL ACTE DE NAISSANCE ORIGINAL suite à une demande 'nouveau-ne'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeActeOriginal(Request $request) // Renommé pour plus de clarté
    {
        $request->validate([
            // 'demande_id' => 'required|exists:demandes,id', // L'ID de la demande liée
            'prenom_enfant' => 'required|string',
            'nom_enfant' => 'required|string',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string',
            'heure_naissance' => 'nullable|string|max:20', // Rendu nullable comme souvent
            'sexe_enfant' => 'required|in:M,F', // Utilisation de M/F pour la cohérence
            'prenom_pere' => 'required|string',
            'nom_pere' => 'required|string',
            'profession_pere' => 'nullable|string', // Rendu nullable
            'domicile_pere' => 'nullable|string', // Rendu nullable
            'prenom_mere' => 'required|string',
            'nom_mere' => 'required|string',
            'profession_mere' => 'nullable|string', // Rendu nullable
            'domicile_mere' => 'nullable|string', // Rendu nullable
            'id_officier' => 'required|exists:officier_etat_civil,id', // Correction: officier_etat_civil
            'id_commune' => 'required|exists:communes,id',
            // Champs déclarant non requis ici car ils viennent du volet ou sont firstOrCreate
            'prenom_declarant' => 'nullable|string',
            'nom_declarant' => 'nullable|string',
            'age_declarant' => 'nullable|integer',
            'profession_declarant' => 'nullable|string',
            'domicile_declarant' => 'nullable|string',
            'ethnie_declarant' => 'nullable|string',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string',
        ]);

        $demande = Demande::with('volet')->findOrFail($request->demande_id);

        // Vérification des doublons pour un ACTE ORIGINAL
        $existingOriginalActe = Acte::where(function ($query) {
            $query->whereNull('type')->orWhere('type', 'original');
        })
            ->where('prenom', $request->prenom_enfant)
            ->where('nom', $request->nom_enfant)
            ->where('date_naissance_enfant', $request->date_naissance)
            ->where('prenom_pere', $request->prenom_pere)
            ->where('nom_pere', $request->nom_pere)
            ->where('prenom_mere', $request->prenom_mere)
            ->where('nom_mere', $request->nom_mere)
            ->first();

        if ($existingOriginalActe) {
            return back()->withErrors([
                'general' => 'Un acte de naissance original existe déjà pour cet enfant avec ces informations parentales (N° ' . $existingOriginalActe->num_acte . '). Veuillez annuler cette demande si c\'est un doublon.'
            ])->withInput();
        }

        // Créer ou récupérer le déclarant. Priorise les données du volet de la demande si elles existent,
        // sinon utilise les données du formulaire si l'agent les a saisies (si la demande n'avait pas de volet complet).
        // Ajustez la logique si le déclarant est TOUJOURS issu du volet.
        $declarantData = [
            'prenom_declarant' => $request->prenom_declarant ?? ($demande->volet->declarant->prenom_declarant ?? null),
            'nom_declarant' => $request->nom_declarant ?? ($demande->volet->declarant->nom_declarant ?? null),
            'age_declarant' => $request->age_declarant ?? ($demande->volet->declarant->age_declarant ?? null),
            'profession_declarant' => $request->profession_declarant ?? ($demande->volet->declarant->profession_declarant ?? null),
            'domicile_declarant' => $request->domicile_declarant ?? ($demande->volet->declarant->domicile_declarant ?? null),
        ];

        $declarant = Declarant::firstOrCreate(
            $declarantData,
            array_merge($declarantData, [ // Attributes to create if not found
                'ethnie_declarant' => $request->ethnie_declarant ?? ($demande->volet->declarant->ethnie_declarant ?? null),
                'email' => $request->email ?? ($demande->volet->declarant->email ?? null),
                'telephone' => $request->telephone ?? ($demande->volet->declarant->telephone ?? null),
                'date_declaration' => now(), // Date de la déclaration au moment de la création de l'acte
                'numero_declaration' => Declarant::max('numero_declaration') + 1, // Assure l'unicité du numéro
            ])
        );

        // GÉNERATION DU NUMÉRO UNIQUE POUR L'ACTE ORIGINAL
        $currentYear = Carbon::now()->year;
        $lastSequentialNum = Acte::where(function ($query) {
            $query->whereNull('type')->orWhere('type', 'original');
        })
            ->whereYear('date_enregistrement_acte', $currentYear)
            ->where('id_commune', $request->id_commune)
            ->max('sequential_num');

        $nextSequentialNum = $lastSequentialNum ? $lastSequentialNum + 1 : 1;

        $commune = Commune::find($request->id_commune);
        $communeCode = $commune ? Str::upper(substr($commune->nom_commune, 0, 4)) : 'COMM';

        $officier = Officier::find($request->id_officier);
        $officierCode = $officier ? Str::upper(substr($officier->nom, 0, 3)) : 'OFF';

        $numActe = sprintf(
            "%d/%s/REG/%s/%s",
            $nextSequentialNum,
            $communeCode,
            $currentYear,
            $officierCode
        );

        if (Acte::where('num_acte', $numActe)->exists()) {
            return back()->withErrors(['num_acte' => 'Un problème est survenu lors de la génération du numéro d\'acte. Veuillez réessayer.'])->withInput();
        }

        // Créer l'acte de naissance original
        $acte = new Acte();
        $acte->num_acte = $numActe;
        $acte->sequential_num = $nextSequentialNum;
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
        $acte->id_declarant = $declarant->id; // Utilise l'ID du déclarant trouvé ou créé (assurez-vous que la PK est bien 'id')
        //  $acte->id_demande = $request->demande_id; // Lier à la demande originale
        // $acte->id_declarant = $demande->volet->id_declarant ?? null;
        //$acte->heure_naissance = $demande->volet->heure_naissance ?? null;
        $acte->id_demande = $request->demande_id;
        $acte->id_officier = $request->id_officier;
        $acte->id_commune = $request->id_commune;
        $acte->date_enregistrement_acte = now();
        $acte->type = 'original'; // MARQUER COMME UN ACTE ORIGINAL
        $acte->statut = 'Traité'; // Statut initial de l'acte original créé

        $acte->save();

        // Mettre à jour le statut de la demande associée à cet acte original
        $demande->statut = 'Validé'; // La demande est validée une fois l'acte original créé
        // $demande->id = $acte->id; // Lier la demande à l'acte original créé
        $demande->save();

        // Log création acte
        Log::create([
            'id_utilisateur' => Auth::id() ?? null,
            'action' => 'Création acte original',
            'details' => 'Acte original créé pour ' . $acte->nom . ' ' . $acte->prenom . ' (N°' . $acte->num_acte . ') sur demande ID: ' . $demande->id,
        ]);

        return redirect()->route('agent.dashboard')->with('success', 'Acte de naissance original créé avec succès.');
    }

    /**
     * Prépare le formulaire pour l'agent pour créer une COPIE d'acte.
     * Cette méthode est appelée après que l'agent ait cliqué sur "Traiter" une demande de copie en attente.
     * Elle affiche la photo du justificatif et le formulaire de saisie des données.
     *
     * @param  int  $id L'ID de la Demande de type 'copie' que l'agent veut traiter.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function creates($id)
    {
        try {
            return $this->createsCopieActeForm($id);
        } catch (\Exception $e) {
            \Log::error('Erreur dans creates: ' . $e->getMessage());
            return redirect()->back()->withErrors('Erreur: ' . $e->getMessage());
        }
    }

    public function stores(Request $request)
    {
        return $this->storeCopieFromFormAgent($request);
    }

    /**
     * Create a new resource.
     */
    public function create()
    {
        // Rediriger vers le dashboard ou afficher un formulaire de création
        return redirect()->route('agent.dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Récupérer la demande avec son volet et déclarant
        $demande = Demande::with('volet')->findOrFail($request->demande_id);

        /* $lastNum = Acte::max('num_acte');

        $nextNum = $lastNum ? $lastNum + 1 : 1; */

        //nouveaau logiqqqqque je vaaaais caster la valeur en entier pour éviter ce souci
        $lastNum = (int) Acte::max('num_acte');
        $nextNum = $lastNum + 1;


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
        return $this->storeActeOriginal($request);
    }

    /**
     * Affiche le formulaire pour l'agent pour créer une COPIE d'acte en se basant sur une demande spécifique.
     * Cette méthode est appelée après que l'agent ait cliqué sur "Traiter" une demande en attente.
     * Elle inclut l'affichage de la photo du justificatif.
     *
     * @param  int  $id L'ID de la Demande de type 'copie' que l'agent veut traiter.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function createsCopieActeForm($id) // Renommé pour plus de clarté
    {
        // Assurez-vous que l'utilisateur est un agent de mairie et qu'il est authentifié
        if (!Auth::check() || !Auth::user()->hasRole('agent_mairie')) {
            return redirect()->route('login')->withErrors('Accès non autorisé.');
        }

        $demande = Demande::findOrFail($id);

        // Vérifiez que la demande est bien de type 'Extrait de naissance' et qu'elle est 'En attente'
        if ($demande->type_document !== 'Extrait de naissance' || $demande->statut !== 'En attente') {
            return redirect()->back()->withErrors('Cette demande n\'est pas une demande de copie en attente ou a déjà été traitée.');
        }

        // Déterminer le type de demande
        $isVoletCopy = !empty($demande->id_volet);
        $volet = null;
        $urlJustificatif = null;

        if ($isVoletCopy) {
            // Copie automatique depuis un volet - pas besoin de justificatif
            $volet = $demande->volet;
            if (!$volet) {
                return redirect()->back()->withErrors('Le volet de déclaration associé à cette demande n\'a pas été trouvé.');
            }
        } else {
            // Copie sur demande - vérifier le justificatif
            if ($demande->justificatif) {
                $urlJustificatif = url('/storage/' . $demande->justificatif);
            } else {
                $urlJustificatif = null;
            }
        }

        // Récupérer les listes pour les selects du formulaire
        $communes = Commune::all();
        $officiers = Officier::all();

        // Récupérer tous les actes existants pour la vérification côté client
        $actesExistants = Acte::select('num_acte', 'prenom', 'nom', 'date_naissance_enfant', 'type', 'lieu_naissance_enfant', 'heure_naissance', 'sexe_enfant', 'prenom_pere', 'nom_pere', 'profession_pere', 'domicile_pere', 'prenom_mere', 'nom_mere', 'profession_mere', 'domicile_mere')
            ->get()
            ->keyBy('num_acte')
            ->toArray();

        // Passez les données à la vue
        return view('agent_mairie.naissances.acteCopies', compact(
            'demande',
            'communes',
            'officiers',
            'urlJustificatif',
            'isVoletCopy',
            'volet',
            'actesExistants'
        ));
    }

    /**
     * Traite la soumission du formulaire par l'agent pour créer un enregistrement de COPIE d'acte.
     * Les données de l'acte sont saisies manuellement par l'agent en se basant sur la photo du justificatif.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCopieFromFormAgent(Request $request) // Renommé pour plus de clarté et distinction
    {
        // Assurez-vous que l'utilisateur est un agent de mairie et qu'il est authentifié
        if (!Auth::check() || !Auth::user()->hasRole('agent_mairie')) {
            return redirect()->route('login')->withErrors('Accès non autorisé.');
        }

        // 1. Validation des champs saisis par l'agent (basées sur les données d'un acte de naissance)
        $request->validate([
            'demande_id' => 'required|exists:demandes,id', // L'ID de la demande associée
            'num_acte' => 'required|string|max:255', // Le numéro d'acte LU SUR LA PHOTO. Pas nécessairement unique ici si c'est la copie d'un original.
            'prenom_enfant' => 'required|string|max:255',
            'nom_enfant' => 'required|string|max:255',
            'date_naissance_enfant' => 'required|date',
            'lieu_naissance_enfant' => 'required|string|max:255',
            'heure_naissance' => 'nullable|string|max:20',
            'sexe_enfant' => 'required|in:M,F',
            'prenom_pere' => 'required|string|max:255',
            'nom_pere' => 'required|string|max:255',
            'profession_pere' => 'nullable|string|max:255',
            'domicile_pere' => 'nullable|string|max:255',
            'prenom_mere' => 'required|string|max:255',
            'nom_mere' => 'required|string|max:255',
            'profession_mere' => 'nullable|string|max:255',
            'domicile_mere' => 'nullable|string|max:255',
            'id_officier' => 'required|exists:officier_etat_civil,id', // Correction: officier_etat_civil
            'id_commune' => 'required|exists:communes,id',
        ]);

        // 2. Récupérer la demande associée
        $demande = Demande::findOrFail($request->demande_id);

        // Vérification si une COPIE a déjà été générée pour cette DEMANDE SPÉCIFIQUE
        // Cela évite de créer plusieurs copies pour la même demande.
        if ($demande->statut === 'Traitée' || $demande->id !== null) {
            return back()->withErrors(['general' => 'Cette demande a déjà été traitée et une copie a été générée.'])->withInput();
        }

        // Vérifier si un acte avec ce numéro existe déjà (original ou copie)
        $existingActe = Acte::where('num_acte', $request->num_acte)->first();

        if ($existingActe) {
            // Vérifier si c'est une copie existante
            if ($existingActe->type === 'copie') {
                // Si c'est une copie existante, rediriger vers cette copie
                $demande->statut = 'Traitée';
                $demande->acte_id = $existingActe->id; // Lier à la copie existante
                $demande->save();

                Log::create([
                    'id_utilisateur' => Auth::id(),
                    'action' => 'Redirection vers copie existante',
                    'details' => 'Demande ID ' . $demande->id . ' redirigée vers la copie existante N°' . $request->num_acte . ' (ID: ' . $existingActe->id . ')',
                ]);

                return redirect()->route('mairie.dashboard.copies')->with('info', 'Une copie avec le numéro ' . $request->num_acte . ' existe déjà. La demande a été liée à cette copie existante. Nom: ' . $existingActe->prenom . ' ' . $existingActe->nom . ' - Date: ' . $existingActe->date_naissance_enfant);
            } else {
                // Si c'est un acte original, créer une copie avec le même numéro d'acte
                // La contrainte composite permet d'avoir le même numéro avec des types différents
                $copie = new Acte();
                $copie->num_acte = $request->num_acte; // Même numéro que l'original pour l'authenticité
                $copie->type = 'copie';

                // Copier toutes les données de l'acte original
                $copie->prenom = $existingActe->prenom;
                $copie->nom = $existingActe->nom;
                $copie->date_naissance_enfant = $existingActe->date_naissance_enfant;
                $copie->lieu_naissance_enfant = $existingActe->lieu_naissance_enfant;
                $copie->heure_naissance = $existingActe->heure_naissance;
                $copie->sexe_enfant = $existingActe->sexe_enfant;
                $copie->prenom_pere = $existingActe->prenom_pere;
                $copie->nom_pere = $existingActe->nom_pere;
                $copie->profession_pere = $existingActe->profession_pere;
                $copie->domicile_pere = $existingActe->domicile_pere;
                $copie->prenom_mere = $existingActe->prenom_mere;
                $copie->nom_mere = $existingActe->nom_mere;
                $copie->profession_mere = $existingActe->profession_mere;
                $copie->domicile_mere = $existingActe->domicile_mere;

                $copie->id_demande = $demande->id;
                $copie->id_officier = $request->id_officier;
                $copie->id_commune = $request->id_commune;
                $copie->date_enregistrement_acte = now();
                $copie->statut = 'Traité';
                $copie->sequential_num = 0;
                $copie->is_virtuelle = true; // Marquer comme copie virtuelle (basée sur un original)
                $copie->original_acte_num = $request->num_acte; // Référence vers le numéro d'acte original

                $copie->save();

                // Mettre à jour le statut de la demande
                $demande->statut = 'Traitée';
                $demande->acte_id = $copie->id;
                $demande->save();

                Log::create([
                    'id_utilisateur' => Auth::id(),
                    'action' => 'Création copie - Acte original existant',
                    'details' => 'Copie créée pour l\'acte original N°' . $request->num_acte . ' (demande ID ' . $demande->id . ') - Copie avec le même numéro créée avec les données de l\'original.',
                ]);

                return redirect()->route('agent.dashboard')->with('success', 'Copie créée avec succès ! Basée sur l\'acte original N°' . $request->num_acte . '. Nom: ' . $existingActe->prenom . ' ' . $existingActe->nom . ' - Date: ' . $existingActe->date_naissance_enfant . '. La copie apparaîtra dans le tableau des copies.');
            }
        }

        // Optionnel: Vérifier si un ACTE DE COPIE EXACTEMENT IDENTIQUE (même num_acte, même nom, date naissance, etc.) existe déjà.
        // Cela peut arriver si l'agent actualise la page ou soumet deux fois.
        $existingCopieActe = Acte::where('type', 'copie')
            ->where('id_demande', $request->demande_id)
            ->where('num_acte', $request->num_acte)
            ->where('prenom', $request->prenom_enfant)
            ->where('nom', $request->nom_enfant)
            ->where('date_naissance_enfant', $request->date_naissance_enfant)
            ->first();

        if ($existingCopieActe) {
            return back()->withErrors(['general' => 'Une copie de cet acte a déjà été enregistrée pour cette demande.'])->withInput();
        }

        // 3. Créer le nouvel enregistrement d'acte de type 'copie'
        $copie = new Acte();
        $copie->num_acte = $request->num_acte; // Le numéro de l'acte lu sur la photo du justificatif
        $copie->type = 'copie'; // Marquer explicitement comme une copie

        // Remplir toutes les données à partir de la saisie de l'agent
        $copie->prenom = $request->prenom_enfant;
        $copie->nom = $request->nom_enfant;
        $copie->date_naissance_enfant = $request->date_naissance_enfant;
        $copie->lieu_naissance_enfant = $request->lieu_naissance_enfant;
        $copie->heure_naissance = $request->heure_naissance;
        $copie->sexe_enfant = $request->sexe_enfant;

        $copie->prenom_pere = $request->prenom_pere;
        $copie->nom_pere = $request->nom_pere;
        $copie->profession_pere = $request->profession_pere;
        $copie->domicile_pere = $request->domicile_pere;

        $copie->prenom_mere = $request->prenom_mere;
        $copie->nom_mere = $request->nom_mere;
        $copie->profession_mere = $request->profession_mere;
        $copie->domicile_mere = $request->domicile_mere;

        $copie->id_demande = $demande->id; // Lier la copie à la demande utilisateur
        $copie->id_officier = $request->id_officier;
        $copie->id_commune = $request->id_commune;
        $copie->date_enregistrement_acte = now(); // Date de création de la COPIE dans le système
        $copie->statut = 'Traité'; // Le statut initial de la copie est "Traité" après sa création
        $copie->sequential_num = 0; // Valeur par défaut pour les copies

        $copie->save();

        \Log::info('Copie créée avec succès', [
            'copie_id' => $copie->id,
            'num_acte' => $copie->num_acte,
            'type' => $copie->type,
            'statut' => $copie->statut,
            'demande_id' => $demande->id,
            'user_id' => Auth::id()
        ]);

        // 4. Mettre à jour le statut de la demande et la lier à l'acte de copie créé
        $demande->statut = 'Traitée'; // La demande est passée de 'En attente' à 'Traitée'
        $demande->id = $copie->id; // Lier la demande à la COPIE qui vient d'être créée.
        $demande->save();

        // 5. Enregistrer l'action dans les logs
        Log::create([
            'id_utilisateur' => Auth::id(), // ID de l'agent qui a traité la demande
            'action' => 'Création d\'une copie d\'acte (traitement de demande publique)',
            'details' => 'Copie d\'acte (N°' . $copie->num_acte . ') créée pour la demande ID ' . $demande->id . ' en se basant sur le justificatif fourni. Acte créé ID: ' . $copie->id,
        ]);

        return redirect()->route('agent.dashboard')->with('success', 'Copie d\'acte créée avec succès et demande marquée comme traitée.');
    }


    // =========================================================
    // Méthodes de gestion d'un ACTE (show, edit, update, destroy, download PDF)
    // S'appliquent aux actes originaux et aux copies d'actes enregistrées
    // =========================================================

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Cette méthode doit pouvoir afficher les détails d'un acte original ou d'une copie
        $acte = Acte::with(['demande', 'Commune', 'declarant', 'officier'])->findOrFail($id);
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
        $declarants = Declarant::all(); // Nécessaire si on peut modifier le déclarant de l'acte original

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
            'sexe_enfant' => 'required|in:M,F',
            'heure_naissance' => 'nullable|string|max:20', // Ajouté validation pour heure
            'prenom_pere' => 'required|string', // Rendu required
            'nom_pere' => 'required|string', // Rendu required
            'profession_pere' => 'nullable|string',
            'domicile_pere' => 'nullable|string',
            'prenom_mere' => 'required|string', // Rendu required
            'nom_mere' => 'required|string', // Rendu required
            'profession_mere' => 'nullable|string',
            'domicile_mere' => 'nullable|string',
            'id_officier' => 'required|exists:officier_etat_civil,id', // Correction: officier_etat_civil
            'id_commune' => 'required|exists:communes,id',
        ]);

        $acte = Acte::findOrFail($id);

        // Vérification des doublons pour un ACTE ORIGINAL ou une COPIE qui serait éditée
        // La logique est la même que pour la création d'un original, mais on exclut l'acte en cours d'édition.
        if ($acte->type == 'original' || is_null($acte->type)) { // S'applique uniquement aux originaux
            $existingOriginalActe = Acte::where(function ($query) {
                $query->whereNull('type')->orWhere('type', 'original');
            })
                ->where('id', '!=', $id) // Exclure l'acte actuel de la vérification
                ->where('prenom', $request->prenom_enfant)
                ->where('nom', $request->nom_enfant)
                ->where('date_naissance_enfant', $request->date_naissance)
                ->where('prenom_pere', $request->prenom_pere)
                ->where('nom_pere', $request->nom_pere)
                ->where('prenom_mere', $request->prenom_mere)
                ->where('nom_mere', $request->nom_mere)
                ->first();

            if ($existingOriginalActe) {
                return back()->withErrors([
                    'general' => 'Un autre acte de naissance original existe déjà avec ces informations parentales (N° ' . $existingOriginalActe->num_acte . '). La mise à jour créerait un doublon.'
                ])->withInput();
            }
        }
        // Pour les copies, la modification des informations principales doit être rare et potentiellement interdite
        // Si les données d'une copie sont erronées, il est souvent préférable de rejeter la copie et de la refaire.
        // Si une modification est permise, les champs doivent correspondre à ceux de l'original ou être validés différemment.
        // Ici, je suppose que l'agent peut modifier les champs pour une copie aussi, mais sans la vérification des doublons d'originaux.

        $acte->prenom = $request->prenom_enfant;
        $acte->nom = $request->nom_enfant;
        $acte->date_naissance_enfant = $request->date_naissance;
        $acte->lieu_naissance_enfant = $request->lieu_naissance;
        $acte->heure_naissance = $request->heure_naissance;
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

        Log::create([
            'id_utilisateur' => Auth::id() ?? null,
            'action' => 'Modification acte',
            'details' => 'Acte ' . ($acte->type ?? 'original') . ' ID ' . $acte->id . ' modifié par l\'agent.',
        ]);

        return redirect()->route('agent.dashboard')->with('success', 'Acte de naissance modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $acte = Acte::findOrFail($id);
        $typeActe = $acte->type ?? 'original';

        // Si l'acte est lié à une demande, mettre à jour la demande
        if ($acte->id_demande) {
            $demande = Demande::find($acte->id_demande);
            if ($demande) {
                $demande->statut = 'Rejeté'; // Ou 'Annulée' si la suppression d'un acte signifie l'annulation de la demande
                $demande->id = null; // Dé-lier l'acte
                $demande->save();
            }
        }

        $acte->delete();

        Log::create([
            'id_utilisateur' => Auth::id() ?? null,
            'action' => 'Suppression acte',
            'details' => ucfirst($typeActe) . ' supprimé pour ' . $acte->nom . ' ' . $acte->prenom . ' (N°' . $acte->num_acte . ')',
        ]);

        return redirect()->route('agent.dashboard')->with('success', 'Acte de naissance supprimé avec succès.');
    }

    /**
     * Download PDF for a specific act (original or copy).
     */
    public function downloadPdf($id)
    {
        $acte = Acte::with(['Commune', 'declarant', 'officier'])->findOrFail($id);
        $pdf = Pdf::loadView('agent_mairie.naissances.pdf', compact('acte'));
        $filename = ($acte->type == 'copie' ? 'copie_' : 'acte_') . str_replace('/', '_', $acte->num_acte) . '.pdf'; // Remplacer les '/' pour un nom de fichier valide
        return $pdf->download($filename);
    }

    // =========================================================
    // Dashboards spécifiques et actions pour les copies et originaux
    // =========================================================

    /**
     * Dashboard pour la gestion des copies d'actes.
     * Affiche les actes de type 'copie' avec différents statuts.
     */
    public function dashboardCopies()
    {
        try {
            // Copies traitées par la mairie (prêtes à être envoyées à l'officier)
            $copies = Acte::where('type', 'copie')
                ->where('statut', 'Traité') // Les copies fraîchement générées
                ->with(['declarant', 'demande'])
                ->orderBy('created_at', 'desc')
                ->get();

            $copiesTraitees = Acte::where('type', 'copie')
                ->where('statut', 'Traité') // Les copies fraîchement générées
                ->with(['declarant', 'demande'])
                ->get();

            $copiesEnAttente = Acte::where('type', 'copie')
                ->where('statut', 'En attente de signature')
                ->with(['declarant', 'demande'])
                ->get();

            $copiesEnAttenteSignature = Acte::where('type', 'copie')
                ->where('statut', 'En attente de signature')
                ->with(['declarant', 'demande'])
                ->get();

            $copiesFinalises = Acte::where('type', 'copie')
                ->where('statut', 'Finalisé')
                ->with(['declarant', 'demande'])
                ->get();

            \Log::info('Dashboard Copies - Données récupérées', [
                'copies_count' => $copies->count(),
                'copiesTraitees_count' => $copiesTraitees->count(),
                'copiesEnAttenteSignature_count' => $copiesEnAttenteSignature->count(),
                'copiesFinalises_count' => $copiesFinalises->count(),
                'user_id' => Auth::id(),
                'user_role' => Auth::user() ? Auth::user()->role : 'non connecté'
            ]);

            // Log détaillé des copies trouvées
            foreach ($copies as $copie) {
                \Log::info('Copie trouvée', [
                    'id' => $copie->id,
                    'num_acte' => $copie->num_acte,
                    'type' => $copie->type,
                    'statut' => $copie->statut,
                    'prenom' => $copie->prenom,
                    'nom' => $copie->nom
                ]);
            }

            // Debug: Voir toutes les copies dans la base
            $allCopies = Acte::where('type', 'copie')->get();
            \Log::info('Toutes les copies dans la base', [
                'total_copies' => $allCopies->count(),
                'copies_details' => $allCopies->map(function ($c) {
                    return [
                        'id' => $c->id,
                        'num_acte' => $c->num_acte,
                        'statut' => $c->statut,
                        'created_at' => $c->created_at
                    ];
                })->toArray()
            ]);

            return view('agent_mairie.dashboard_copies', compact('copies', 'copiesTraitees', 'copiesEnAttente', 'copiesEnAttenteSignature', 'copiesFinalises'));
        } catch (\Exception $e) {
            \Log::error('Erreur dans dashboardCopies: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'user_id' => Auth::id()
            ]);
            return response()->json(['error' => 'Erreur lors du chargement du tableau de bord des copies.'], 500);
        }
    }

    /**
     * Afficher les détails d'une copie (enregistrement de type 'copie').
     */
    public function showCopie($id)
    {
        $copie = Acte::with(['declarant', 'demande', 'Commune', 'officier'])
            ->where('type', 'copie')
            ->findOrFail($id);

        return view('agent_mairie.naissances.showCopies', compact('copie'));
    }

    /**
     * Envoyer une copie (enregistrement de type 'copie') à l'officier pour signature.
     */
    public function envoyerCopieOfficier($id)
    {
        $copie = Acte::where('type', 'copie')->findOrFail($id);

        if ($copie->statut !== 'Traité') { // Seules les copies "Traitées" peuvent être envoyées
            return back()->withErrors(['message' => 'Cette copie n\'est pas dans un statut permettant l\'envoi à l\'officier.']);
        }

        $copie->statut = 'En attente de signature';
        $copie->save();

        Log::create([
            'id_utilisateur' => Auth::id() ?? null,
            'action' => 'Envoi copie à l\'officier',
            'details' => 'Copie envoyée à l\'officier pour signature - N°' . $copie->num_acte,
        ]);

        return redirect()->route('mairie.dashboard.copies')
            ->with('success', 'Copie envoyée à l\'officier avec succès.');
    }

    /**
     * Dashboard pour la gestion des actes de naissance originaux.
     */
    public function dashboardActes()
    {
        try {
            // Actes traités par la mairie (prêts à être envoyés à l'officier)
            $actes = Acte::where(function ($query) {
                $query->whereNull('type')->orWhere('type', 'original');
            })
                ->where('statut', 'Traité') // Statut après création
                ->with(['declarant', 'demande'])
                ->get();

            $actesTraites = Acte::where(function ($query) {
                $query->whereNull('type')->orWhere('type', 'original');
            })
                ->where('statut', 'Traité') // Statut après création
                ->with(['declarant', 'demande'])
                ->get();

            $actesAFinaliser = Acte::where(function ($query) {
                $query->whereNull('type')->orWhere('type', 'original');
            })
                ->where('statut', 'À finaliser') // Envoyé à l'officier pour finalisation
                ->with(['declarant', 'demande'])
                ->get();

            $actesFinalises = Acte::where(function ($query) {
                $query->whereNull('type')->orWhere('type', 'original');
            })
                ->where('statut', 'Finalisé') // Finalisé par l'officier
                ->with(['declarant', 'demande'])
                ->get();

            \Log::info('Dashboard Actes - Données récupérées', [
                'actesTraites_count' => $actesTraites->count(),
                'actesAFinaliser_count' => $actesAFinaliser->count(),
                'actesFinalises_count' => $actesFinalises->count(),
                'user_id' => Auth::id(),
                'user_role' => Auth::user() ? Auth::user()->role : 'non connecté'
            ]);

            return view('agent_mairie.dashboard_actes', compact('actes', 'actesTraites', 'actesAFinaliser', 'actesFinalises'));
        } catch (\Exception $e) {
            \Log::error('Erreur dans dashboardActes: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'user_id' => Auth::id()
            ]);
            return response()->json(['error' => 'Erreur lors du chargement du tableau de bord des actes originaux.'], 500);
        }
    }

    /**
     * Envoyer un acte (original) à l'officier pour finalisation.
     */
    public function envoyerActeOfficier($id)
    {
        $acte = Acte::findOrFail($id);

        if ($acte->type == 'copie') { // Seuls les actes originaux sont envoyés pour finalisation
            return back()->withErrors(['message' => 'Seuls les actes originaux peuvent être envoyés pour finalisation.']);
        }
        if ($acte->statut !== 'Traité') { // L'acte doit être 'Traité' pour être envoyé pour finalisation
            return back()->withErrors(['message' => 'Cet acte n\'est pas dans un statut permettant l\'envoi à l\'officier.']);
        }

        $acte->statut = 'À finaliser';
        $acte->save();

        Log::create([
            'id_utilisateur' => Auth::id() ?? null,
            'action' => 'Envoi acte original à l\'officier',
            'details' => 'Acte original envoyé à l\'officier pour finalisation - N°' . $acte->num_acte,
        ]);

        return redirect()->route('mairie.dashboard.actes')
            ->with('success', 'Acte envoyé à l\'officier avec succès.');
    }

    /**
     * Rejeter une demande (originale ou copie).
     */
    public function rejeterDemande($id)
    {
        try {
            $demande = Demande::findOrFail($id);

            // Vérifier que la demande est en attente
            if ($demande->statut !== 'En attente') {
                return redirect()->back()->with('error', 'Seules les demandes en attente peuvent être rejetées.');
            }

            // Mettre à jour le statut de la demande
            $demande->statut = 'Rejetée';
            $demande->save();

            // Enregistrer l'action dans les logs
            Log::create([
                'id_utilisateur' => Auth::id() ?? null,
                'action' => 'Demande rejetée',
                'details' => 'Demande ' . $demande->type_document . ' rejetée - ID: ' . $demande->id . ' - Numéro de suivi: ' . ($demande->numero_suivi ?? 'N/A'),
            ]);

            return redirect()->back()->with('success', 'Demande rejetée avec succès.');
        } catch (\Exception $e) {
            \Log::error('Erreur lors du rejet de la demande: ' . $e->getMessage(), [
                'demande_id' => $id,
                'user_id' => Auth::id()
            ]);

            return redirect()->back()->with('error', 'Une erreur est survenue lors du rejet de la demande.');
        }
    }

    /**
     * Vérifier l'existence d'un acte par son numéro (API endpoint).
     */
    public function checkActeExists($numActe)
    {
        try {
            // Requête simple
            $acte = \App\Models\Acte::where('num_acte', $numActe)->first();

            if ($acte) {
                return response()->json([
                    'exists' => true,
                    'acte' => [
                        'num_acte' => $acte->num_acte,
                        'prenom' => $acte->prenom,
                        'nom' => $acte->nom,
                        'date_naissance_enfant' => $acte->date_naissance_enfant,
                        'type' => $acte->type
                    ],
                    'type' => $acte->type
                ]);
            }

            return response()->json([
                'exists' => false,
                'acte' => null,
                'type' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'exists' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
