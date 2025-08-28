<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
// Optionnel: implements ShouldQueue et use Queueable si tu veux passer par la queue
// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Queue\SerializesModels;

class ActeFinaliseMail extends Mailable
{
    // use Queueable, SerializesModels;

    /** @var mixed */
    public $acte;

    /**
     * @param mixed $acte
     */
    public function __construct($acte)
    {
        $this->acte = $acte;
    }

    public function build()
    {
        return $this->subject('Votre acte de naissance a été finalisé')
            ->view('emails.acte_finalise')
            ->with([
                'acte' => $this->acte,
                'declarant' => optional($this->acte->declarant),
            ]);
    }
}
