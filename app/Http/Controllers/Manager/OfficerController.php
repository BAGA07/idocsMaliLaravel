<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Officier;
use App\Models\Hopital;
use App\Models\Mairie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OfficerController extends Controller
{
    public function index()
    {
        //dd('Liste des officiers'); // Pour vérifier que la route fonctionne correctement
        // Récupérer uniquement les users avec le rôle officier
        $officiers = User::where('role', 'officier')->latest()->paginate(10);
        return view('manager.officiers.index', compact('officiers'));
    }

    public function create()
    {
        $hopitaux = Hopital::all();
        $mairies = Mairie::all();
        return view('manager.officiers.create', compact('hopitaux', 'mairies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'password' => 'required|confirmed|min:6',
            'structure' => 'required|string|in:hopital,mairie',
            'structure_id' => 'required|integer',
        ]);

        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'password' => Hash::make($request->password),
            'role' => 'officier', // ICI le rôle
            'id_mairie' => $request->structure_id,
        ]);

        return redirect()->route('manager.officiers.index')->with('success', 'Officier créé avec succès.');
    }

    public function edit($officier)
    {
        $officier = User::findOrFail($officier);
        $mairies = Mairie::all();
        return view('manager.officiers.edit', compact('officier', 'mairies'));
    }

    public function update(Request $request, User $officier)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $officier->id,
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'structure' => 'required|string|in:hopital,mairie',
            'structure_id' => 'required|integer',
        ]);

        $officier->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'id_mairie' => $request->structure === 'mairie' ? $request->structure_id : null,
        ]);

        if ($request->filled('password')) {
            $officier->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('manager.officiers.index')->with('success', 'Officier mis à jour avec succès.');
    }

    public function show($officier)
    {
        $officier = User::findOrFail($officier);
        return view('manager.officiers.show', compact('officier'));
    }


    public function destroy(Officier $officier)
    {
    $officier->delete();

    return redirect()->route('manager.officiers.index')
                     ->with('success', 'Officier supprimé avec succès.');
    }


    /* public function destroy($officier)
    {
        $officier->delete();
        return redirect()->route('manager.officiers.index')->with('success', 'Officier supprimé avec succès.');
    } */
}
