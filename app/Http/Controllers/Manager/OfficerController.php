<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Hopital;
use App\Models\Mairie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OfficerController extends Controller
{
    public function index()
    {
        //dd('Liste des officiers'); // Pour vérifier que la route fonctionne correctement
        // Récupérer uniquement les users avec le rôle officer
        $officers = User::where('role', 'officer')->latest()->paginate(10);
        return view('manager.officiers.index', compact('officers'));
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
            'role' => 'officer', // ICI le rôle
            'id_mairie' => $request->structure_id,
        ]);

        return redirect()->route('manager.officers.index')->with('success', 'Officer créé avec succès.');
    }

    public function edit(User $officer)
    {

        $mairies = Mairie::all();
        return view('manager.officiers.edit', compact('officer', 'mairies'));
    }

    public function update(Request $request, User $officer)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $officer->id,
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'structure' => 'required|string|in:hopital,mairie',
            'structure_id' => 'required|integer',
        ]);

        $officer->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'id_mairie' => $request->structure === 'mairie' ? $request->structure_id : null,
        ]);

        if ($request->filled('password')) {
            $officer->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('manager.officers.index')->with('success', 'Officer mis à jour avec succès.');
    }

    public function show(User $officer)
    {
        return view('manager.officiers.show', compact('officer'));
    }


    public function destroy(User $officer)
    {
        $officer->delete();
        return redirect()->route('manager.officers.index')->with('success', 'Officer supprimé avec succès.');
    }
}