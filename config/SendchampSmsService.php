<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SendchampSmsService
{
    protected $apiKey;
    protected $sender;

    public function __construct()
    {
        $this->apiKey = config('services.sendchamp.api_key');
        $this->sender = config('services.sendchamp.sms_from'); // optionnel selon Sendchamp
    }

    /**
     * Envoie un SMS via Sendchamp.
     *
     * @param string $to      Numéro du destinataire (format international, ex: +223XXXXXXXXX)
     * @param string $message
     * @return mixed
     */
    public function sendSms($to, $message)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Accept' => 'application/json',
        ])->post('https://api.sendchamp.com/api/v1/sms/send', [
            'to' => [$to],
            'message' => $message,
            'sender_name' => $this->sender,
            // 'route' => 'non_dnd', // optionnel selon votre abonnement Sendchamp
        ]);

        return $response->json();
    }
}
