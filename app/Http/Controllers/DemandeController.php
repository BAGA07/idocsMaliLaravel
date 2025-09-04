<?php

namespace App\Http\Controllers;

use App\Models\VoletDeclaration;
use App\Models\PieceJointe;
use App\Models\Demande;
use App\Models\Log;
use App\Models\Acte;
use App\Models\Commune;
use App\Models\Officier;
use App\Models\Mairie;
use App\Models\Notification;
use App\Mail\DemandeCopieNotificationMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DemandeController extends Controller
{
    // =========================================================
    // Méthodes pour les demandes PUBLIQUES (sans connexion)
    // =========================================================

    /**
     * C'est la page que l'utilisateur non connecté verra pour faire sa demande.
     * @return \Illuminate\View\View
     */
    public function createCopieExtraitFormPublique()
    {
        // Récupérer toutes les communes pour le select
        $communes = Commune::orderBy('nom_commune')->get();

        // Cette vue doit contenir les champs pour le nom, prénom, email, téléphone et le fichier justificatif.
        return view('presentation.copie_extrait_form', compact('communes')); // J'ai gardé le même nom de vue, assurez-vous qu'il contient les champs de contact.
    }

    /**
     * Enregistre une nouvelle demande de copie d'acte existant, faite par un utilisateur public.
     * Le justificatif est la photo de l'extrait de naissance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeDemandeCopiePublique(Request $request)
    {
        \Log::info('storeDemandeCopiePublique appelée'); // Log temporaire pour vérifier l'appel

        // 1. Validation des données du formulaire.
        // Tous les champs de contact sont obligatoires car l'utilisateur n'est pas connecté.
        $request->validate([
            'nom_demandeur' => 'required|string|max:255',
            'prenom_demandeur' => 'required|string|max:255',
            'email_demandeur' => 'required|email|max:255',
            'telephone_demandeur' => 'required|string|max:20',
            'commune_demandeur' => 'required|exists:communes,id',
            'justificatif' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120', // Augmenté la taille max à 5MB
            'nombre_copie' => 'required|integer|min:1',
            'informations_complementaires_copie' => 'nullable|string',
        ]);

        // 2. Gérer le téléchargement du justificatif (photo de l'extrait de naissance)
        $cheminJustificatif = null;
        if ($request->hasFile('justificatif') && $request->file('justificatif')->isValid()) {
            $fichier = $request->file('justificatif');
            // Générer un nom de fichier unique pour éviter les conflits
            $nomFichier = time() . '_' . Str::random(10) . '.' . $fichier->getClientOriginalExtension();
            // Stocker le fichier dans le dossier 'justificatifs_copie_extrait'
            $cheminJustificatif = $fichier->storeAs('justificatifs_copie_extrait', $nomFichier, 'public');

            if (!$cheminJustificatif) {
                return back()->withInput()->withErrors(['justificatif' => 'Erreur lors du téléchargement du fichier.']);
            }

            // Synchroniser le fichier vers public/storage pour Windows
            $sourcePath = storage_path('app/public/' . $cheminJustificatif);
            $destPath = public_path('storage/' . $cheminJustificatif);
            $destDir = dirname($destPath);

            if (!is_dir($destDir)) {
                mkdir($destDir, 0755, true);
            }

            if (file_exists($sourcePath)) {
                copy($sourcePath, $destPath);
            }
        } else {
            return back()->withInput()->withErrors(['justificatif' => 'Le justificatif est requis et doit être un fichier valide.']);
        }

        // 3. Générer le numéro de suivi unique pour la demande de copie
        do {
            // Ex: DCOP-2025-XXXXXX (Demande Copie - Année - 6 caractères alphanumériques)
            $numeroSuivi = 'DCOP-' . date('Y') . '-' . Str::upper(Str::random(6));
        } while (Demande::where('numero_suivi', $numeroSuivi)->exists()); // Assure l'unicité

        try {
            // 4. Créer la demande dans la base de données
            $demande = Demande::create([
                'numero_suivi' => $numeroSuivi,
                'statut' => 'En attente',
                'nombre_copie' => $request->nombre_copie,
                'justificatif' => $cheminJustificatif,
                'nom_complet' => $request->prenom_demandeur . ' ' . $request->nom_demandeur,
                'email' => $request->email_demandeur,
                'telephone' => $request->telephone_demandeur,
                'commune_demandeur' => $request->commune_demandeur,
                'informations_complementaires' => $request->informations_complementaires_copie,
                'id_utilisateur' => null,
                'type_document' => 'Extrait de naissance'
            ]);

            // 5. Enregistrer l'action dans les logs
            Log::create([
                'id_utilisateur' => null,
                'action' => 'Demande de copie publique déposée',
                'details' => 'Demande de copie déposée par ' . $demande->nom_complet . ' (ID Demande: ' . $demande->id . ').',
            ]);

            // 6. Envoyer notification à la mairie de la commune sélectionnée
            $this->envoyerNotificationMairie($demande);

            // 7. Redirection avec message de succès et le numéro de suivi
            return redirect()->route('demande.copie_extrait.create')
                ->with('numero_suivi_succes', $numeroSuivi);
        } catch (\Exception $e) {
            // Log de l'erreur
            \Log::error('Erreur lors de la création de la demande de copie', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Rediriger avec un message d'erreur
            return redirect()->route('demande.copie_extrait.create')
                ->with('error', 'Une erreur est survenue lors de la soumission de votre demande. Veuillez réessayer.');
        }
    }




    // =========================================================
    // Méthodes pour l'AGENT (traitement des demandes)
    // =========================================================

    /**
     * Affiche le formulaire pour l'agent pour créer une COPIE d'acte en se basant sur une demande spécifique.
     * Cette méthode est appelée après que l'agent ait cliqué sur "Traiter" une demande en attente.
     * Elle inclut l'affichage de la photo du justificatif.
     *
     * @param  int  $id L'ID de la Demande en attente que l'agent veut traiter.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function createsCopieActe($id) // Renommé pour plus de clarté
    {
        // Assurez-vous que l'utilisateur est un agent et qu'il est authentifié
        if (!Auth::check() || !Auth::user()->hasRole('agent')) { // Exemple de vérification de rôle
            return redirect()->route('login')->withErrors('Accès non autorisé.');
        }

        $demande = Demande::findOrFail($id);

        // Vérifiez que la demande est bien de type 'copie' et qu'elle est 'En attente'
        if ($demande->type_document !== 'Extrait de naissance' || $demande->statut !== 'En attente') {
            return redirect()->back()->withErrors('Cette demande n\'est pas une demande de copie en attente ou a déjà été traitée.');
        }

        // Vérifiez la présence du justificatif
        if (empty($demande->justificatif) || !Storage::disk('public')->exists($demande->justificatif)) {
            return redirect()->back()->withErrors('Aucun justificatif valide trouvé pour cette demande. Impossible de créer la copie.');
        }

        // URL publique pour afficher l'image du justificatif
        $urlJustificatif = url('/storage/' . $demande->justificatif);

        // Déterminer si c'est une copie depuis un volet ou depuis un justificatif
        $isVoletCopy = !empty($demande->id_volet);

        // Récupérer les listes pour les selects du formulaire
        $communes = Commune::all();
        $officiers = Officier::all();
        // $declarants = Declarant::all(); // Généralement pas nécessaire pour la création d'une COPIE via photo

        // Passez les données à la vue (qui affichera le formulaire et l'image)
        return view('agent_mairie.naissances.acteCopies', compact(
            'demande', // Renommé de 'demandeCopies' à 'demande' pour la clarté
            'communes',
            'officiers',
            'urlJustificatif', // C'est la variable clé pour afficher l'image du justificatif
            'isVoletCopy' // Variable pour déterminer le type de copie
        ));
    }

    /**
     * Traite la soumission du formulaire par l'agent pour créer un enregistrement de copie d'acte.
     * Les données de l'acte sont saisies manuellement par l'agent en se basant sur la photo du justificatif.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCopieFromFormAgent(Request $request) // Renommé pour distinguer des autres 'store'
    {
        // Assurez-vous que l'utilisateur est un agent et qu'il est authentifié
        if (!Auth::check() || !Auth::user()->hasRole('agent')) {
            return redirect()->route('login')->withErrors('Accès non autorisé.');
        }

        // 1. Validation des champs saisis par l'agent
        $request->validate([
            'demande_id' => 'required|exists:demandes,id', // L'ID de la demande associée
            'num_acte' => 'required|string|unique:actes,num_acte,NULL,id,type,original', // Le numéro d'acte LU SUR LA PHOTO. Unique pour les 'originaux' s'ils existent, ou ici pour les 'copies'
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'date_naissance_enfant' => 'required|date',
            'lieu_naissance_enfant' => 'required|string|max:255',
            'heure_naissance' => 'nullable|string|max:20', // L'heure n'est pas toujours présente ou obligatoire sur les extraits
            'sexe_enfant' => 'required|in:M,F', // 'M' pour Masculin, 'F' pour Féminin
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
            // Pas de champ 'declarant' ici car l'agent recopie l'acte, pas la déclaration initiale.
        ]);

        // 2. Récupérer la demande associée
        $demande = Demande::findOrFail($request->demande_id);

        // Optionnel : Vérifier si une copie pour cette DEMANDE a déjà été générée
        // Cela évite de créer plusieurs copies pour la même demande.
        if ($demande->acte_id !== null) { // Si la demande a déjà un acte lié (sa copie)
            return back()->withErrors(['general' => 'Une copie a déjà été générée pour cette demande.']);
        }
        // Autre vérification : Une copie avec le même numéro d'acte pour la même demande
        $existingCopie = Acte::where('type', 'copie')
            ->where('id_demande', $request->demande_id)
            ->where('num_acte', $request->num_acte)
            ->first();
        if ($existingCopie) {
            return back()->withErrors(['general' => 'Une copie de cet acte (' . $request->num_acte . ') a déjà été générée pour cette demande.']);
        }


        // 3. Créer le nouvel enregistrement d'acte de type 'copie'
        $copie = new Acte();
        $copie->num_acte = $request->num_acte; // Le numéro de l'acte lu sur la photo du justificatif
        $copie->type = 'copie'; // Marquer explicitement comme une copie

        // Remplir toutes les données à partir de la saisie de l'agent
        $copie->prenom = $request->prenom;
        $copie->nom = $request->nom;
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
        $copie->statut = 'Validé'; // Le statut de l'acte de copie est "Validé" une fois créé
        $copie->sequential_num = 0; // Valeur par défaut pour les copies

        // Génération d'un token unique pour la vérification QR code
        $copie->token = \Illuminate\Support\Str::random(32);

        $copie->save();

        // 4. Mettre à jour le statut de la demande et la lier à l'acte de copie créé
        $demande->statut = 'Traitée'; // La demande est passée de 'En attente' à 'Traitée'
        $demande->acte_id = $copie->id; // Lier la demande à la COPIE qui vient d'être créée.
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
    // Anciennes méthodes ou méthodes non directement liées à la demande de copie publique
    // =========================================================

    /**
     * Affiche la page de choix pour le type de demande spécifique (nouveau-né ou copie extrait).
     * @return \Illuminate\View\View
     */
    public function choixType()
    {
        return view('presentation.choix_type');
    }

    /**
     * Les demandes de nouveau-né se font uniquement via le volet de déclaration.
     * Rediriger vers la page d'information appropriée.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createNouveauNeForm()
    {
        return redirect()->route('demande.nouveau_ne.guide')
            ->with('info', 'Les demandes d\'actes de naissance pour nouveau-né se font uniquement via le volet de déclaration à l\'hôpital.');
    }

    /**
     * Cette méthode ne devrait pas être utilisée car les demandes de nouveau-né
     * se font uniquement via le volet de déclaration (hôpital).
     * Les demandes via la plateforme publique sont uniquement pour des copies d'extraits.
     */
    public function storeNouveauNe(Request $request)
    {
        return redirect()->back()->with('error', 'Les demandes d\'actes de naissance pour nouveau-né se font uniquement via le volet de déclaration à l\'hôpital.');
    }

    /**
     * Méthode de test pour vérifier l'affichage des justificatifs
     */
    public function testJustificatifs()
    {
        $demandes = Demande::whereNotNull('justificatif')->get();
        $resultats = [];

        foreach ($demandes as $demande) {
            $chemin = $demande->justificatif;
            $existe = Storage::disk('public')->exists($chemin);
            $url = $existe ? Storage::disk('public')->url($chemin) : null;

            $resultats[] = [
                'id' => $demande->id,
                'nom_complet' => $demande->nom_complet,
                'chemin' => $chemin,
                'existe' => $existe,
                'url' => $url,
                'type_document' => $demande->type_document,
                'statut' => $demande->statut
            ];
        }

        return response()->json([
            'total' => count($resultats),
            'demandes' => $resultats
        ]);
    }

    /**
     * Envoie une notification à la mairie de la commune sélectionnée pour une demande de copie
     */
    private function envoyerNotificationMairie($demande)
    {
        try {
            // Récupérer la commune et la mairie associées
            $commune = Commune::with('mairie')->find($demande->commune_demandeur);

            if (!$commune || !$commune->mairie) {
                \Log::warning('Aucune mairie trouvée pour la commune ID: ' . $demande->commune_demandeur);
                return;
            }

            $mairie = $commune->mairie;

            // Vérifier que la mairie a un email
            if (empty($mairie->email)) {
                \Log::warning('Aucun email configuré pour la mairie ID: ' . $mairie->id);
                return;
            }

            // Envoyer l'email à la mairie
            Mail::to($mairie->email)->send(new DemandeCopieNotificationMail($demande, $commune, $mairie));

            // Enregistrer la notification dans la base de données
            Notification::create([
                'mairie_id' => $mairie->id,
                'from_hopital' => 'Plateforme IdocsMali',
                'message' => "Nouvelle demande de copie d'extrait d'acte de naissance (N° {$demande->numero_suivi}) déposée par {$demande->nom_complet}.",
                'type' => 'demande_copie',
                'demande_id' => $demande->id,
                'is_read' => false
            ]);

            \Log::info('Notification envoyée à la mairie de ' . $commune->nom_commune . ' pour la demande ' . $demande->numero_suivi);

        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'envoi de notification à la mairie', [
                'demande_id' => $demande->id,
                'commune_id' => $demande->commune_demandeur,
                'error' => $e->getMessage()
            ]);
        }
    }
}
