<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SendchampPaymentService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.sendchamp.api_key');
    }

    /**
     * Initialise un paiement via Sendchamp.
     *
     * @param array $data
     * @return mixed
     */
    public function initializePayment(array $data)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ])->post('https://api.sendchamp.com/api/v1/payment/initialize', $data);

        return $response->json();
    }
}
