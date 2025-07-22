<?php

namespace App\Http\Controllers;

use App\Models\VoletDeclaration;
use App\Models\Acte;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verifier($token)
    {
        $volet = VoletDeclaration::where('token', $token)->first();
        $acte = Acte::where('token', $token)->first();
        if ($volet) {
            return view('verification.result', [
                'type' => 'volet',
                'data' => $volet
            ]);
        } elseif ($acte) {
            return view('verification.result', [
                'type' => 'acte',
                'data' => $acte
            ]);
        } else {
            return view('verification.result', [
                'type' => 'invalide',
                'data' => null
            ]);
        }
    }
} 