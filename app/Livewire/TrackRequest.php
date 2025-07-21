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
            'trackingNumber' => 'required|string|min:5|max:255',
        ]);

        $this->isLoading = true;
        $this->status = null;
        $this->message = '';

        $demande = Demande::where('numero_volet_naissance', $this->trackingNumber)->first();

        if ($demande) {
            $this->status = $demande->statut;
            $this->message = "Le statut de votre demande est : " . $this->status;
        } else {
            $this->status = 'non_trouvee';
            $this->message = 'Aucune demande trouvée avec ce numéro de suivi.';
        }

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.track-request');
    }
}