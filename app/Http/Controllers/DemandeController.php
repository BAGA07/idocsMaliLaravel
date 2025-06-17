<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    public function create()
    {
        return view('citoyen.form_demande');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'required|string|max:20',
            'type_document' => 'required|string',
            'informations_complementaires' => 'nullable|string',
            'justificatif' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $fichier = null;
        if ($request->hasFile('justificatif')) {
            $fichier = $request->file('justificatif')->store('justificatifs', 'public');
        }

        Demande::create([
            'nom_complet' => $request->nom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'type_document' => $request->type_document,
            'informations_complementaires' => $request->informations_complementaires,
            'justificatif' => $fichier,
        ]);


        return redirect()->route('demande.create')->with('success', 'Votre demande a été envoyée avec succès.');
    }
}
