<?php

namespace App\Http\Controllers;

use App\Mail\DeclarationNotificationMail;
use App\Services\SendchampSmsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;
use Mail;
use App\Models\Declarant;
use App\Models\VoletDeclaration;
use App\Models\Notification;

use Illuminate\Support\Facades\Auth;

class DeclarationController extends Controller
{
    public function sendNotification($id)
    {
        $declaration = VoletDeclaration::findOrFail($id);
        $declarant = $declaration->declarant;

        // Vérification des coordonnées
        $hasEmail = !empty($declarant->email);
        $hasPhone = !empty($declarant->telephone);

        if (!$hasEmail && !$hasPhone) {
            return back()->with('error', 'Aucune information de contact disponible pour ce déclarant (ni email ni téléphone).');
        }

        $data = [
            'nom_declarant' => $declarant->nom_declarant ?? '',
            'prenom_declarant' => $declarant->prenom_declarant ?? '',
            'nom_enfant' => $declaration->nom_enfant ?? '',
            'date_naissance' => $declaration->date_naissance ?? '',
            'date_envoi' => Carbon::now()->format('d-m-Y H:i:s'),
            'hopital' => optional($declaration->hopital)->nom_hopital ?? 'Non renseigné',
            'num_volet' => $declaration->num_volet ?? '',
        ];

        $message = "Bonjour {$data['nom_declarant']},\nVotre déclaration de naissance (numéro de volet: {$data['num_volet']}) pour l’enfant {$data['nom_enfant']}, né(e) le {$data['date_naissance']}, a bien été enregistrée par {$data['hopital']} et transmise à la mairie compétente ce {$data['date_envoi']}.\nVous recevrez une notification dès que votre dossier sera traité.\nMerci pour votre confiance.\nCordialement, {$data['hopital']} Service de l’état civil";

        // Envoi email si email disponible
        if ($hasEmail) {
            Mail::to($declarant->email)->send(new DeclarationNotificationMail($data));
            \Log::info('Envoi mail à : ' . $declarant->email);
        }

        // Envoi SMS si téléphone disponible ici dans ce code
        if ($hasPhone) {
            $telephone = $declarant->telephone;
            // Format international
            if (strpos($telephone, '+') !== 0) {
                $telephone = '+223' . ltrim($telephone, '0');
            }
            $smsService = new SendchampSmsService();
            $smsResponse = $smsService->sendSms($telephone, $message);
            \Log::info('SMS envoyé à : ' . $telephone);
            \Log::info('Réponse Sendchamp SMS:', ['response' => $smsResponse]);
        }
        //mes modification

        // Envoi email à la mairie de la commune correspondant à l'hôpital
        $mairieEmail = null;
        $hopital = $declaration->hopital;
        if ($hopital && !empty($hopital->commune)) {
            $commune = $hopital->commune;
            if (!empty($commune->mairie) && !empty($commune->mairie->email)) {
                $mairieEmail = $commune->mairie->email;
                $mairieData = $data;
                $mairieData['destinataire'] = 'mairie';
                // Message spécifique pour la mairie differnt de celui du déclarant
                $mairieData['message'] = "Bonjour,\nUne nouvelle déclaration de naissance a été enregistrée pour l’enfant {$data['nom_enfant']} (numéro de volet: {$data['num_volet']}), né(e) le {$data['date_naissance']} à {$data['hopital']}.\nMerci de bien vouloir traiter ce dossier.\nCordialement, Service de l’état civil de {$data['hopital']}";
                \Log::info('ID mairie utilisé pour notification : ' . ($commune->mairie->id ?? 'null'));
                \Log::info('ID mairie connecté : ' . Auth::user()->id_mairie);
                Mail::to($mairieEmail)->send(new DeclarationNotificationMail($mairieData));
                \Log::info('Envoi mail à la mairie : ' . $mairieEmail);
                // Enregistrement de la notification dans la base de données

                Notification::create([
    'mairie_id'    => $commune->mairie->id, // ou l'id correct de la mairie
    'from_hopital' => $data['hopital'],
    'message'      => $mairieData['message'],
]);
            }
        }

        $successMsg = 'Notification envoyée avec succès au déclarant.';
        if ($hasEmail && $hasPhone) {
            $successMsg .= ' Un email et un SMS ont été envoyés.';
        } elseif ($hasEmail) {
            $successMsg .= ' Un email a été envoyé.';
        } elseif ($hasPhone) {
            $successMsg .= ' Un SMS a été envoyé.';
        }
        if ($mairieEmail) {
            $successMsg .= ' Un email a été envoyé à la mairie.';
        }
        return back()->with('success', $successMsg);
    }
}
