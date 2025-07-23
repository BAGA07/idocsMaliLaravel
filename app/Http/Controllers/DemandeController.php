<?php

namespace App\Http\Controllers;

use App\Models\VoletDeclaration; // Assurez-vous que ce modèle existe et est correct
use App\Models\PieceJointe;

use App\Models\Demande; // Assurez-vous que ce modèle existe et est correct
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Acte;

class DemandeController extends Controller
{
    // =========================================================
    // Méthodes pour les demandes SPÉCIFIQUES d'actes d'état civil (préservées et adaptées)
    // =========================================================

    /**
     * Affiche la page de choix pour le type de demande spécifique (nouveau-né ou copie extrait).
     *
     * @return \Illuminate\View\View
     */
    public function choixType()
    {
        // La vue est dans resources/views/presentation/choix_type.blade.php
        return view('presentation.choix_type');
    }

    /**
     * Affiche le formulaire pour demander un acte de naissance pour un nouveau-né déjà déclaré.
     *
     * @return \Illuminate\View\View
     */
    public function createNouveauNeForm()
    {
        // La vue est dans resources/views/presentation/nouveau_ne_form.blade.php
        return view('presentation.nouveau_ne_form');
    }

    /**
     * Enregistre une demande d'acte de naissance pour un nouveau-né déjà déclaré.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /* public function storeNouveauNe(Request $request)
    {
         $validatedData = $request->validate([
            'nom_demandeur' => 'required|string|max:255',
            'email_demandeur' => 'required|email|max:255',
            'telephone_demandeur' => 'required|string|max:20',

            'nom_enfant' => 'required|string|max:255',
            'prenom_enfant' => 'required|string|max:255',
            //'date_naissance' => 'required|date',
            //'lieu_naissance' => 'required|string|max:255',

            'numero_volet_naissance' => 'required|string|max:50',
            //'hopital_declaration' => 'nullable|string|max:255',
            'justificatif_demande' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'informations_complementaires_nouveau_ne' => 'nullable|string',
        ]);

        // Gestion du fichier justificatif
        // Enregistrement pièce jointe
    if ($request->hasFile('pieces_jointe')) {
        $file = $request->file('pieces_jointe');
        $piece = new PieceJointe();
        
        $piece->demande_id = $request->demande_id;
        $piece->nom_fichier = $file->getClientOriginalName();
        $piece->chemin_fichier = $file->store('pieces_jointes', 'public');
        $piece->save();
    }

        //  Chercher le volet par numéro
        $volet = VoletDeclaration::where('num_volet', $validatedData['numero_volet_naissance'])->first();

        //  Si trouvé, mettre à jour nom/prénom enfant
        $idVolet = null;
        if ($volet) {
            $volet->nom_enfant = $validatedData['nom_enfant'];
            $volet->prenom_enfant = $validatedData['prenom_enfant'];
            $volet->save();

            $idVolet = $volet->id_volet;
        }

        // Créer la demande
        Demande::create([
            'nom_complet' => $validatedData['nom_demandeur'],
            'email' => $validatedData['email_demandeur'],
            'telephone' => $validatedData['telephone_demandeur'],
            'type_document' => 'Acte de Naissance (Nouveau-né)',

            'nom_personne_concernee' => $validatedData['nom_enfant'],
            'prenom_personne_concernee' => $validatedData['prenom_enfant'],
            // 'date_evenement' => $validatedData['date_naissance'],
            // 'lieu_evenement' => $validatedData['lieu_naissance'],

            'numero_volet_naissance' => $validatedData['numero_volet_naissance'],
            
            'id_volet' => $idVolet,
            //'hopital_declaration' => $validatedData['hopital_declaration'],
            'informations_complementaires' => $validatedData['informations_complementaires_nouveau_ne'],
            

            'statut' => 'En attente',
        ]);

        return redirect()->route('agent')
            ->with('success', 'Votre demande a été soumise avec succès.');
    
    } */

    /**
     * Affiche le formulaire pour demander une copie d'un acte existant (non nouveau-né).
     *
     * @return \Illuminate\View\View
     */
    public function createCopieExtraitForm()
    {
        // La vue est dans resources/views/presentation/copie_extrait_form.blade.php
        return view('presentation.copie_extrait_form');
    }

    /**
     * Enregistre une nouvelle demande de copie d'acte existant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCopieExtrait(Request $request)
    {
        $request->validate([
            'nom_demandeur' => 'required|string',
            'email_demandeur' => 'required|email',
            'telephone_demandeur' => 'required|string',
            'type_acte_demande' => 'required|string',
            'nom_personne_acte' => 'nullable|string',
            'prenom_personne_acte' => 'nullable|string',
            'date_evenement_acte' => 'nullable|date',
            'lieu_evenement_acte' => 'nullable|string',
            'nombre_copies' => 'nullable|integer|min:1',
            'justificatif_copie' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'informations_complementaires_copie' => 'nullable|string',
        ]);

    // Enregistrement du justificatif
    $filePath = null;
    if ($request->hasFile('justificatif_copie')) {
        $filePath = $request->file('justificatif_copie')->store('justificatifs_copie_extrait', 'public');
    }

    // Création de la demande
    Demande::create([
        'nom_complet' => $validatedData['nom_demandeur'],
        'email' => $validatedData['email_demandeur'],
        'telephone' => $validatedData['telephone_demandeur'],
        'type_document' => $validatedData['type_acte_demande'],
        'informations_complementaires' => $validatedData['informations_complementaires_copie'],
        'justificatif' => $validatedData['justificatif'],
        'statut' => 'En attente',
        'num_acte' => $validatedData['num_acte'],
        'nombre_copie' => $validatedData['nombre_copie'],
        'nom_personne_concernee' => $validatedData['nom_personne_acte'],
        'prenom_personne_concernee' => $validatedData['prenom_personne_acte'],
        'date_evenement' => $validatedData['date_evenement_acte'],
        'lieu_evenement' => $validatedData['lieu_evenement_acte'],
    ]);
    dd($validatedData);

        //  @dd($demande);

        $demande = new Demande();
        $demande->nom_complet = $request->nom_demandeur;
        $demande->email = $request->email_demandeur;
        $demande->telephone = $request->telephone_demandeur;
        $demande->type_document = $request->type_acte_demande;
        $demande->nom_enfant = $request->nom_personne_acte;
        $demande->prenom_enfant = $request->prenom_personne_acte;
        $demande->date_evenement = $request->date_evenement_acte;
        $demande->lieu_evenement = $request->lieu_evenement_acte;
        $demande->informations_complementaires = $request->informations_complementaires_copie;

        // Gestion du fichier justificatif
        if ($request->hasFile('justificatif_copie')) {
            $filename = $request->file('justificatif_copie')->store('justificatifs', 'public');
            $demande->justificatif = $filename;
        }

        $demande->save();
        //demande log
        Log::create([
            'id_utilisateur' => Auth::id(),
            'action' => 'Demande ',
            'details' => 'Demande initier par ' . Auth::user()->nom  . ' pour ' . $request->nom_enfant . ' ' . $request->prenom_enfant . ')',
        ]);
    }
}
