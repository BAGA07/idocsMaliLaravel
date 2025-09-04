<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DemandeCopieNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $commune;
    public $mairie;

    /**
     * Create a new message instance.
     */
    public function __construct($demande, $commune, $mairie)
    {
        $this->demande = $demande;
        $this->commune = $commune;
        $this->mairie = $mairie;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle demande de copie d\'extrait d\'acte de naissance',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.demande_copie_notification',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
