<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Pour le formulaire de contact
use App\Mail\ContactMail; // Nous créerons cette classe de mail

class PresentationController extends Controller
{
    // Méthodes existantes (gardez-les si vous les avez)
    public function index()
    {
        return view('presentation.index');
    }

    public function laDemarche()
    {
        return view('presentation.la-demarche');
    }

    public function demanderActe()
    {
        return view('presentation.choix_type');
    }

    public function aProposPrincipal() // <-- Assurez-vous que cette méthode existe
    {
        return view('presentation.a_propos'); // Ceci renvoie resources/views/presentation/a_propos.blade.php
    }

    // Méthodes pour les pages "À Propos" (si vous les utilisez)
    public function aPropos()
    {
        return view('presentation.a_propos.index'); // Ou rediriger vers notre_vision par défaut
    }

    public function notreVision()
    {
        return view('presentation.a_propos.notre_vision');
    }

    public function securiteConfidentialite()
    {
        return view('presentation.a_propos.securite-confidentialite');
    }

    public function partenaires()
    {
        return view('presentation.a_propos.partenaires');
    }


    /**
     * Affiche la page de guide détaillée pour la demande d'acte de naissance d'un nouveau-né.
     */
    public function nouveauNeGuide()
    {
        return view('presentation.nouveau_ne'); // Vous devrez créer ce fichier Blade
    }

    /**
     * Affiche la page de guide détaillée pour la demande de copie/extrait d'un acte existant.
     */
    public function copieExtraitGuide()
    {
        return view('presentation.copie-extrait'); // Vous devrez créer ce fichier Blade
    }

    /**
     * Affiche la page de guide détaillée pour la procédure de jugement supplétif.
     */
    public function jugementSuppletifGuide()
    {
        return view('presentation.jugement_suppletif'); // Vous devrez créer ce fichier Blade
    }



    // --- NOUVELLES MÉTHODES ---

    /**
     * Affiche la page pour suivre une demande.
     * Pour Livewire, cette méthode peut simplement retourner la vue.
     */
    public function suivreDemande()
    {
        return view('presentation.suivre_demande');
    }

    /**
     * Affiche la page des Questions Fréquentes (FAQ).
     */
    public function faq()
    {
        // Vous pouvez passer des données de FAQ depuis une base de données ici
        $faqs = [
            [
                'question' => 'Quel est le délai pour obtenir un acte de naissance ?',
                'answer' => 'Le délai de traitement est généralement de 5 à 10 jours ouvrables après la validation de votre demande. Vous serez notifié par email à chaque étape.'
            ],
            [
                'question' => 'Comment puis-je suivre l\'état de ma demande ?',
                'answer' => 'Utilisez le numéro de suivi que vous avez reçu par email sur notre page "Suivre ma Demande".'
            ],
            [
                'question' => 'Mes données personnelles sont-elles sécurisées ?',
                'answer' => 'Oui, nous utilisons des technologies de cryptage avancées et des protocoles stricts pour protéger toutes vos informations. Votre confidentialité est notre priorité absolue.'
            ],
            [
                'question' => 'Quels documents sont nécessaires pour une demande ?',
                'answer' => 'Généralement, une pièce d\'identité valide et des informations sur l\'acte (date de naissance, noms des parents, lieu de naissance) sont requises. Des documents supplémentaires peuvent être demandés selon le cas.'
            ],
            [
                'question' => 'Puis-je faire une demande pour quelqu\'un d\'autre ?',
                'answer' => 'Oui, mais vous devrez fournir une procuration ou un justificatif de lien de parenté, ainsi que les pièces d\'identité nécessaires.'
            ],
            // Ajoutez d'autres questions/réponses ici
        ];

        return view('presentation.faq', compact('faqs'));
    }

    /**
     * Affiche la page de contact.
     */
    public function contact()
    {
        return view('presentation.contact');
    }

    /**
     * Traite la soumission du formulaire de contact.
     */
    public function submitContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Envoyer l'e-mail (vous devrez configurer votre service de mail dans .env)
        // Créez la classe Mailable avec `php artisan make:mail ContactMail`
        // et configurez le dans `app/Mail/ContactMail.php`
        try {
            Mail::to('votre_email_de_support@example.com')->send(new ContactMail(
                $request->input('name'),
                $request->input('email'),
                $request->input('subject'),
                $request->input('message')
            ));
            return redirect()->back()->with('success', 'Votre message a été envoyé avec succès !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer.');
        }
    }

    /**
     * Cette méthode sera appelée par Livewire pour obtenir le statut d'une demande.
     * Pour l'instant, c'est un placeholder.
     * Quand vous utiliserez Livewire, la logique sera dans le composant Livewire lui-même.
     */
    public function getDemandeStatus(Request $request)
    {
        // Logique pour récupérer le statut de la demande.
        // Ceci sera probablement géré par un composant Livewire directement.
        // Pour l'exemple, nous allons juste retourner un message JSON.
        $numeroSuivi = $request->input('numero_suivi');
        if ($numeroSuivi) {
            // Ici, vous feriez une recherche en base de données
            // Par exemple: $demande = Demande::where('numero_suivi', $numeroSuivi)->first();
            // Pour l'instant, on simule :
            $status = ['En attente', 'En cours de traitement', 'Prêt pour retrait', 'Terminée', 'Annulée'][array_rand([0,1,2,3,4])];
            return response()->json(['status' => $status, 'message' => "Le statut de votre demande ($numeroSuivi) est : $status."]);
        }
        return response()->json(['status' => 'error', 'message' => 'Numéro de suivi invalide.'], 400);
    }
}