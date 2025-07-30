<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Hopital;
use App\Models\Mairie;
use App\Models\Commune;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class StructureController extends Controller
{
    // Afficher la liste des structures
    public function index()
    {
        $userCommuneId = auth()->user()->id_mairie;

        $hopitaux = Hopital::where('id_commune', $userCommuneId)->with('commune')->paginate(10);
        $mairies = Mairie::with('commune')->paginate(10);

        return view('manager.structures.index', compact('hopitaux', 'mairies'));
    }

    // Formulaire de création d'hôpital
    public function create()
    {
        $communes = Commune::all();
        return view('manager.structures.create', compact('communes'));
    }

    // Enregistrement de la structure
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:hopital,mairie',
            'nom' => 'required|string|max:255',
            'commune_id' => 'required|exists:communes,id',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($request->type === 'hopital') {
            $structure = new Hopital();
            $structure->nom_hopital = $request->nom;
        } else {
            $structure = new Mairie();
            $structure->nom_mairie = $request->nom;
        }

        $structure->id_commune = $request->commune_id;
        $structure->telephone = $request->telephone;
        $structure->email = $request->email;
        $structure->latitude = $request->latitude;
        $structure->longitude = $request->longitude;
        $structure->save();

        // Log création structure
        Log::create([
            'id_utilisateur' => Auth::id(),
            'action' => 'Création ' . $request->type,
            'details' => ucfirst($request->type) . ' créé : ' . $request->nom,
        ]);

        return redirect()->route('manager.structures.index')
            ->with('success', ucfirst($request->type) . ' créé avec succès.');
    }

    // Afficher les détails d'une structure
    public function show($id)
    {
        $hopital = Hopital::with('commune')->find($id);
        $mairie = Mairie::with('commune')->find($id);

        $structure = $hopital ?? $mairie;

        if (!$structure) {
            abort(404);
        }

        return view('manager.structures.show', compact('structure'));
    }

    // Formulaire de modification
    public function edit($id)
    {
        $hopital = Hopital::find($id);
        $mairie = Mairie::find($id);

        $structure = $hopital ?? $mairie;

        if (!$structure) {
            abort(404);
        }

        $communes = Commune::all();
        $type = $hopital ? 'hopital' : 'mairie';

        return view('manager.structures.edit', compact('structure', 'communes', 'type'));
    }

    // Mise à jour de la structure
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'commune_id' => 'required|exists:communes,id',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $hopital = Hopital::find($id);
        $mairie = Mairie::find($id);

        $structure = $hopital ?? $mairie;
        $type = $hopital ? 'hopital' : 'mairie';

        if (!$structure) {
            abort(404);
        }

        if ($type === 'hopital') {
            $structure->nom_hopital = $request->nom;
        } else {
            $structure->nom_mairie = $request->nom;
        }

        $structure->id_commune = $request->commune_id;
        $structure->telephone = $request->telephone;
        $structure->email = $request->email;
        $structure->latitude = $request->latitude;
        $structure->longitude = $request->longitude;
        $structure->save();

        // Log modification structure
        Log::create([
            'id_utilisateur' => Auth::id(),
            'action' => 'Modification ' . $type,
            'details' => ucfirst($type) . ' modifié : ' . $request->nom,
        ]);

        return redirect()->route('manager.structures.index')
            ->with('success', ucfirst($type) . ' mis à jour avec succès.');
    }

    // Suppression de la structure
    public function destroy($id)
    {
        $hopital = Hopital::find($id);
        $mairie = Mairie::find($id);

        $structure = $hopital ?? $mairie;
        $type = $hopital ? 'hopital' : 'mairie';

        if (!$structure) {
            abort(404);
        }

        $nom = $type === 'hopital' ? $structure->nom_hopital : $structure->nom_mairie;
        $structure->delete();

        // Log suppression structure
        Log::create([
            'id_utilisateur' => Auth::id(),
            'action' => 'Suppression ' . $type,
            'details' => ucfirst($type) . ' supprimé : ' . $nom,
        ]);

        return redirect()->route('manager.structures.index')
            ->with('success', ucfirst($type) . ' supprimé avec succès.');
    }
}