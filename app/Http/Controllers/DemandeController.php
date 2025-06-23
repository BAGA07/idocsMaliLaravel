<?php

namespace App\Http\Controllers;

use App\Models\Demande; // Assurez-vous que ce modèle existe et est correct
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function storeNouveauNe(Request $request)
    {
        $validatedData = $request->validate([
            'nom_demandeur' => 'required|string|max:255',
            'email_demandeur' => 'required|email|max:255',
            'telephone_demandeur' => 'required|string|max:20',
            'nom_enfant' => 'required|string|max:255',
            'prenom_enfant' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'hopital_declaration' => 'nullable|string|max:255',
            'numero_volet_naissance' => 'nullable|string|max:50',
            'justificatif_demande' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'informations_complementaires_nouveau_ne' => 'nullable|string',
        ]);

        $filePath = null;
        if ($request->hasFile('justificatif_demande')) {
            $filePath = $request->file('justificatif_demande')->store('justificatifs_demande_nouveau_ne', 'public');
        }

        Demande::create([
            'nom_complet' => $validatedData['nom_demandeur'],
            'email' => $validatedData['email_demandeur'],
            'telephone' => $validatedData['telephone_demandeur'],
            'type_document' => 'Acte de Naissance (Nouveau-né)',
            'informations_complementaires' => $validatedData['informations_complementaires_nouveau_ne'],
            'justificatif_path' => $filePath,
            'statut' => 'En attente',
            'nom_personne_concernee' => $validatedData['nom_enfant'],
            'prenom_personne_concernee' => $validatedData['prenom_enfant'],
            'date_evenement' => $validatedData['date_naissance'],
            'lieu_evenement' => $validatedData['lieu_naissance'],
            'hopital_declaration' => $validatedData['hopital_declaration'],
            'numero_volet' => $validatedData['numero_volet_naissance'],
        ]);

        return redirect()->route('demande.choix_type')->with('success', 'Votre demande d\'acte de naissance pour le nouveau-né a été soumise avec succès !');
    }

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
        $validatedData = $request->validate([
            'nom_demandeur' => 'required|string|max:255',
            'email_demandeur' => 'required|email|max:255',
            'telephone_demandeur' => 'required|string|max:20',
            'nom_personne_acte' => 'required|string|max:255',
            'prenom_personne_acte' => 'required|string|max:255',
            'date_evenement_acte' => 'required|date',
            'lieu_evenement_acte' => 'required|string|max:255',
            'type_acte_demande' => 'required|string|max:255',
            'justificatif_copie' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'informations_complementaires_copie' => 'nullable|string',
        ]);

        $filePath = null;
        if ($request->hasFile('justificatif_copie')) {
            $filePath = $request->file('justificatif_copie')->store('justificatifs_copie_extrait', 'public');
        }

        Demande::create([
            'nom_complet' => $validatedData['nom_demandeur'],
            'email' => $validatedData['email_demandeur'],
            'telephone' => $validatedData['telephone_demandeur'],
            'type_document' => $validatedData['type_acte_demande'],
            'informations_complementaires' => $validatedData['informations_complementaires_copie'],
            'justificatif_path' => $filePath,
            'statut' => 'En attente',
            'nom_personne_concernee' => $validatedData['nom_personne_acte'],
            'prenom_personne_concernee' => $validatedData['prenom_personne_acte'],
            'date_evenement' => $validatedData['date_evenement_acte'],
            'lieu_evenement' => $validatedData['lieu_evenement_acte'],
        ]);

        return redirect()->route('demande.create')->with('success', 'Votre demande a été envoyée avec succès.');
    }
}