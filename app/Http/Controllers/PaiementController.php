<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SendchampPaymentService;

class PaiementController extends Controller
{
    public function payer(SendchampPaymentService $sendchamp, Request $request)
    {
        $data = [
            'amount' => 500,
            'customer_email' => 'client@example.com',
            'customer_mobile_number' => '+22398765432',
            'payment_method' => 'mobile_money',
            'currency' => 'XOF',
            //'redirect_url' => 'https://votre-site.com/paiement/confirmation',
            'redirect_url' => route('paiement.confirmation'),
        ];

        $result = $sendchamp->initializePayment($data);

        // Redirige l'utilisateur vers la page de paiement si succès
        if (isset($result['data']['checkout_url'])) {
            return redirect($result['data']['checkout_url']);
        }

        // Gérer l'erreur sinon
        return back()->withErrors(['paiement' => 'Erreur lors de l\'initialisation du paiement.']);
    }
    public function confirmation(Request $request)
    {
        // Ici, tu peux afficher une vue de confirmation ou traiter la réponse du service de paiement
        // Par exemple :
        return view('paiement.confirmation');
    }
}
