<?php

namespace App\Http\Controllers\Hopital;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use App\Models\VoletDeclaration;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    public function envoyerDemande($id_volet)
    {
        $volet = VoletDeclaration::findOrFail($id_volet);

        // Vérifier s'il existe déjà une demande pour ce volet
        $existe = Demande::where('id_volet', $id_volet)->first();
        if ($existe) {
            return redirect()->back()->with('error', 'Une demande a déjà été envoyée pour ce volet.');
        }

        Demande::create([
            'id_volet' => $volet->id_volet,
            'hopital_id' => Auth::user()->id_hopital, // id de l'hôpital connecté
            'mairie_id' => $volet->id_mairie, // il faut que ce champ existe dans la table volet_declarations
            'type_document' => 'Copie intégrale',
            'statut' => 'En attente',
            'message_hopital' => "Demande d'acte de naissance initiée par l'hôpital pour le volet N° {$volet->id_volet}",
        ]);

        return view('hopital.naissances.show', compact('volet'))
            ->with('success', 'La demande a été envoyée à la mairie avec succès.');
    }
}
