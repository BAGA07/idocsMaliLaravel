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
        $declaration = VoletDeclaration::findOrFail($id_volet);
        $declarant = Declarant::where('id_declarant', $declaration->id_declarant)->first();

        // Vérifier s'il existe déjà une demande pour ce volet
        $existe = Demande::where('id_volet', $id_volet)->first();
        if ($existe) {
            return redirect()->back()->with('error', 'Une demande a déjà été envoyée pour ce volet.');
        }

        // Récupérer les champs édités depuis la requête
        $nom_complet = request('nom_complet') ?? ($declarant->nom_declarant . ' ' . $declarant->prenom_declarant);
        $email = request('email') ?? $declarant->email;
        $telephone = request('telephone') ?? $declarant->telephone;
        $nombre_copies = request('nombre_copies') ?? 1;
        $message_hopital = request('message_hopital') ?? ("Demande d'acte de naissance initiée par l'hôpital pour le volet N° {$declaration->num_volet}");

        Demande::create([
            'id_volet' => $id_volet,
            'numero_volet_naissance' => $declaration->num_volet,
            'nom_complet' => $declarant->nom_declarant . ' ' . $declarant->prenom_declarant,
            'nom_enfant' => $declaration->nom_enfant,
            'prenom_enfant' => $declaration->prenom_enfant,
            'email' => $declarant->email,
            'type_document' => 'Extrait original',
            'statut' => 'En attente',
            'nombre_copies' => 0,
            'message_hopital' => "Demande d'acte de naissance initiée par l'hôpital pour le volet N° {$declaration->num_volet}",
        ]);

        return redirect()->back()->with('success', 'Demande envoyée avec succès à la mairie.');
    }
}