<?php

namespace App\Livewire;

use App\Models\Demande;
use Livewire\Component;

class TrackRequest extends Component
{
    public $trackingNumber = '';
    public $status = null;
    public $message = '';
    public $isLoading = false;

    public function track()
    {
        $this->validate([
            'trackingNumber' => 'required|string|min:5|max:255', // Ajustez les règles de validation si besoin
        ]);

        $this->isLoading = true;
        $this->status = null; // Réinitialiser le statut précédent
        $this->message = ''; // Réinitialiser le message précédent

        // --- Logique réelle de recherche du statut ---
        // Rechercher uniquement les demandes de copies via plateforme (avec numero_suivi)
        $foundDemande = Demande::where('numero_suivi', $this->trackingNumber)
                               ->where('type_document', 'Extrait de naissance') // Seules les demandes de copies
                               ->first();

        if ($foundDemande) {
            $this->status = $foundDemande->statut; // Utiliser le statut de la base de données
            $this->message = "Le statut de votre demande de copie (N° " . $this->trackingNumber . ") est : " . $this->status . ".";
        } else {
            // Si aucune demande n'est trouvée dans la base de données
            $this->status = 'non_trouvee';
            $this->message = 'Aucune demande de copie trouvée avec ce numéro de suivi. Veuillez vérifier le numéro et réessayer.';
        }

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.track-request');
    }
}