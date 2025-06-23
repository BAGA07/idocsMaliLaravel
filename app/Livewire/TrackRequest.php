<?php

namespace App\Livewire;

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

        // Simuler un délai de chargement pour l'expérience utilisateur
        sleep(1); // À retirer en production

        // --- Logique réelle de recherche du statut ---
        // Dans une application réelle, vous feriez une requête à votre base de données ici
        // Par exemple:
        // $requestData = \App\Models\Request::where('tracking_number', $this->trackingNumber)->first();
        // if ($requestData) {
        //     $this->status = $requestData->status;
        //     $this->message = "Le statut de votre demande est : " . $this->status;
        // } else {
        //     $this->status = 'non_trouvee';
        //     $this->message = 'Aucune demande trouvée avec ce numéro de suivi.';
        // }

        // Simulation du statut pour l'exemple
        $mockStatuses = ['En attente', 'En cours de traitement', 'Prêt pour retrait', 'Terminée', 'Annulée'];
        if ($this->trackingNumber === 'MALIACTES123') { // Exemple de numéro valide
            $this->status = $mockStatuses[array_rand($mockStatuses)];
            $this->message = "Le statut de votre demande (MALIACTES123) est : " . $this->status;
        } elseif ($this->trackingNumber === 'ERROR404') { // Exemple d'erreur
             $this->status = 'non_trouvee';
             $this->message = 'Aucune demande trouvée avec ce numéro de suivi.';
        }
        else {
            $this->status = 'non_trouvee';
            $this->message = 'Numéro de suivi invalide ou demande introuvable.';
        }

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.track-request');
    }
}
