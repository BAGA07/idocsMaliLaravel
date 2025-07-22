<?php

namespace App\Http\Controllers\Hopital;

use App\Http\Controllers\Controller;
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

        // Vérifier s'il existe déjà une demande pour ce volet
        $existe = \App\Models\Demande::where('id_volet', $id_volet)->first();
        if ($existe) {
            return redirect()->back()->with('error', 'Une demande a déjà été envoyée pour ce volet.');
        }

        \App\Models\Demande::create([
            'id_volet' => $id_volet,
            'numero_volet_naissance' => $declaration->num_volet,
            'nom_complet' => $declarant->nom_declarant . ' ' . $declarant->prenom_declarant,
            'nom_enfant' => $declaration->nom_enfant,
            'prenom_enfant' => $declaration->prenom_enfant,
            'email' => $declarant->email,
            'type_document' => 'Extrait original',
            'statut' => 'En attente',
            'nombre_copies' => 0,
        ]);

        return redirect()->back()->with('success', 'Demande envoyée avec succès.');
    }
}
