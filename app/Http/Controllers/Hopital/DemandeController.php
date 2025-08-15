<?php

namespace App\Http\Controllers\Hopital;

use App\Http\Controllers\Controller;
use App\Models\Acte;
use App\Models\Declarant;
use App\Models\Demande;
use App\Models\VoletDeclaration;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    public function envoyerDemande($id_volet)
    {
        $declaration = \App\Models\VoletDeclaration::findOrFail($id_volet);
        $declarant = \App\Models\Declarant::where('id_declarant', $declaration->id_declarant)->first();

        /* // Vérifier s'il existe déjà une demande pour ce volet
        $existe = \App\Models\Demande::where('id_volet', $id_volet)->first();
        if ($existe) {
            return redirect()->back()->with('error', 'Une demande a déjà été envoyée pour ce volet.');
        } */

        // Créer la demande
        $demande = \App\Models\Demande::create([
            'id_volet' => $id_volet,
            'numero_volet_naissance' => $declaration->num_volet,
            'nom_complet' => $declarant->nom_declarant . ' ' . $declarant->prenom_declarant,
            'nom_enfant' => $declaration->nom_enfant,
            'prenom_enfant' => $declaration->prenom_enfant,
            'email' => $declarant->email,
            'telephone' => $declarant->telephone,
            'type_document' => 'Extrait original',
            'statut' => 'En attente',
            'nombre_copie' => 0,
            'id_utilisateur' => Auth::id(),
            'numero_suivi' => null
        ]);
        return redirect()->route('naissances.show', $id_volet)
            ->with('success', 'Demande envoyée avec succès. Numéro de suivi : ' . $demande->numero_suivi);
    }
}