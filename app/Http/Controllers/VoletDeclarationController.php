<?php

namespace App\Http\Controllers;

use App\Models\Declarant;
use App\Models\Hopital;
use App\Models\Log;
use App\Models\VoletDeclaration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoletDeclarationController extends Controller
{
    // Afficher toutes les déclarations
    public function index()
    {
        $declarations = VoletDeclaration::with('declarant', 'hopital')->latest()->get();
        return view('declarations.index', compact('declarations'));
    }

    public function create()
    {
        return view('hopital.naissances.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'prenom_pere' => 'required|string|max:100',
            'nom_pere' => 'required|string|max:100',
            'age_pere' => 'required|integer|min:0|max:130',
            'domicile_pere' => 'required|string',
            'ethnie_pere' => 'required|string',
            'situation_matrimoniale_pere' => 'required|string',
            'niveau_scolaire_pere' => 'required|string',
            'profession_pere' => 'required|string',

            'prenom_mere' => 'required|string|max:100',
            'nom_mere' => 'required|string|max:100',
            'age_mere' => 'required|integer|min:0|max:130',
            'domicile_mere' => 'required|string',
            'ethnie_mere' => 'required|string',
            'situation_matrimoniale_mere' => 'required|string',
            'niveau_scolaire_mere' => 'required|string',
            'profession_mere' => 'required|string',

            'prenom_enfant' => 'nullable|string|max:100',
            'nom_enfant' => 'nullable|string|max:100',
            'date_naissance' => 'required|date',

            'prenom_declarant' => 'required|string|max:100',
            'nom_declarant' => 'required|string|max:100',
            'age_declarant' => 'required|integer|min:0|max:130',
            'domicile_declarant' => 'required|string',
            'ethnie_declarant' => 'required|string',
        ]);

        // 1. Enregistrement du déclarant
        $declarant = Declarant::create([
            'prenom_declarant' => $request->prenom_declarant,
            'nom_declarant' => $request->nom_declarant,
            'age_declarant' => $request->age_declarant,
            'domicile_declarant' => $request->domicile_declarant,
            'profession_declarant' => '-', // Pas fourni
            'numero_declaration' => rand(1000, 9999), // À améliorer
            'date_declaration' => now(),
        ]);

        /* var_dump($declarant->id_declarant);
        exit; */
        //dd($declarant->id);
        $lastVolet = VoletDeclaration::orderBy('id_volet', 'desc')->first();
        $nextNumber = $lastVolet ? ((int) $lastVolet->num_volet + 1) : 1;
        $num_volet_format = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // 2. Enregistrement dans volet_declaration
        VoletDeclaration::create([
            'num_volet' => $num_volet_format,

            'prenom_pere' => $request->prenom_pere,
            'nom_pere' => $request->nom_pere,
            'age_pere' => $request->age_pere,
            'domicile_pere' => $request->domicile_pere,
            'ethnie_pere' => $request->ethnie_pere,
            'situation_matrimonial_pere' => $request->situation_matrimoniale_pere,
            'niveau_instruction_pere' => $request->niveau_scolaire_pere,
            'profession_pere' => $request->profession_pere,

            'prenom_mere' => $request->prenom_mere,
            'nom_mere' => $request->nom_mere,
            'age_mere' => $request->age_mere,
            'domicile_mere' => $request->domicile_mere,
            'ethnie_mere' => $request->ethnie_mere,
            'situation_matrimonial_mere' => $request->situation_matrimoniale_mere,
            'niveau_instruction_mere' => $request->niveau_scolaire_mere,
            'profession_mere' => $request->profession_mere,

            'prenom_enfant' => $request->prenom_enfant,
            'nom_enfant' => $request->nom_enfant,
            'date_naissance' => $request->date_naissance,
            'heure_naissance' => now()->format('H:i:s'), // à personnaliser si nécessaire
            'date_declaration' => now(),
            'nbreEnfantAccouchement' => 1,
            'nbreEINouvNee' => 1,

            'id_declarant' => $declarant->id_declarant,
            'id_hopital' => Auth::user()->id,
        ]);

        return redirect()->route('hopital.dashboard')->with('success', 'Déclaration de naissance enregistrée avec succès.');
    }

    public function show($id)
    {
        $declaration = VoletDeclaration::with('declarant', 'hopital')->findOrFail($id);
        return view('hopital.naissances.show', compact('declaration'));
    }
    public function edit($id) {}
}