<?php

namespace App\Http\Controllers;

use App\Mail\DeclarationNotificationMail;
use App\Services\SendchampSmsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;
use App\Models\Declarant;
use App\Models\VoletDeclaration;

class DeclarationController extends Controller
{
    //
    public function sendNotification($id)
    {
        $declaration = VoletDeclaration::findOrFail($id);
        // Logique pour envoyer la notification
        $declarant = $declaration->declarant;

        $data = [
            'nom_declarant' => $declarant->nom,
            'prenom_declarant' => $declarant->prenom,
            'nom_enfant' => $declaration->nom_enfant,
            'date_naissance' => $declaration->date_naissance,
            'date_envoi' => Carbon::now()->format('d-m-Y H:i:s'),
            'hopital' => optional($declaration->hopital)->nom_hopital ?? 'Non renseigné',
            'num_volet' => $declaration->num_volet
        ];
        //envoie par mail
        Mail::to($declarant->email)->send(new DeclarationNotificationMail($data));
        \Log::info('Envoi mail à : ' . $declarant->email);
        //envoie sms avec utilisation de  Twilio service
        $message = "Bonjour {$data['nom_declarant']},\nVotre déclaration de naissance (numéro de <volet:>1data['num_volet']</volet:> pour l’enfant {$data['nom_enfant']}, né(e) le {$data['date_naissance']}, a bien été enregistrée par {$data['hopital']} et transmise à la mairie compétente ce {$data['date_envoi']}.\nVous recevrez une notification dès que votre dossier sera traitée.\nMerci pour votre confiance.\nCordialement, {$data['hopital']} Service de l’état civil";
        //  formate le numero  de telephone
        $telephone = $declarant->telephone;
        if (strpos($telephone, '+') !== 0) {
            $telephone = '+223' . ltrim($telephone, '0');
        }


        \Log::info('SMS envoyé à : ' . $telephone);
        $smsService = new SendchampSmsService();
        $smsResponse = $smsService->sendSms($telephone, $message);

        \Log::info('Réponse Sendchamp SMS:', ['response' => $smsResponse]);


        return back()->with('succes', 'Notification envoyée avec succès au déclarant. Un email et un SMS ont été envoyés.');
    }
}
