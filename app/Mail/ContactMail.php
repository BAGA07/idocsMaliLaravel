<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $subject;
    public $messageText; // Renommé pour éviter le conflit avec la propriété $message de la classe Mailable

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $subject, $messageText)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->messageText = $messageText;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address($this->email, $this->name), // L'expéditeur sera la personne qui remplit le formulaire
            subject: 'Message de contact e-Naissance Mali: ' . $this->subject, // Le sujet de l'email que vous recevrez
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact', // Nous allons créer cette vue pour le contenu de l'e-mail
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'subject' => $this->subject,
                'messageText' => $this->messageText,
            ],
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
