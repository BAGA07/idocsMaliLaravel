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
        $declaration = VoletDeclaration::findOrFail($id_volet);

        // Vérifier s'il existe déjà une demande pour ce volet
        $existe = Demande::where('id_volet', $id_volet)->first();
        if ($existe) {
            return redirect()->back()->with('error', 'Une demande a déjà été envoyée pour ce volet.');
        }

        Demande::create([
            'id_volet' => $declaration->id_volet,
            'type_document' => 'Copie intégrale',
            'statut' => 'En attente',
            'message_hopital' => "Demande d'acte de naissance initiée par l'hôpital pour le volet N° {$declaration->id_volet}",
        ]);

        return redirect()->back()->with('success', 'Demande envoyée avec succès à la mairie.');
    }
}
