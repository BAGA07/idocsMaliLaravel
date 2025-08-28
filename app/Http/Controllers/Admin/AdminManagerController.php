<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Hopital;
use App\Models\Mairie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class AdminManagerController extends Controller
{
    // Afficher la liste des managers
    public function index()
    {
        $managers = User::with(['hopital', 'mairie'])
            ->whereIn('role', ['agent_hopital', 'agent_mairie'])
            ->get();

        return view('admin.managers.index', compact('managers',));
    }
    public function structureList()
    {
        $structures = Hopital::where('id_communes', Auth::user()->id_commune)
            ->get();

        return view('admin.managers.structureList', compact('structures'));
    }
    // Formulaire de création
    public function create()
    {
        $hopitaux = Hopital::all();
        $mairies = Mairie::all();
        return view('admin.managers.create', compact('hopitaux', 'mairies'));
    }

    // Enregistrement du manager
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nom'       => 'required|string|max:100',
            'prenom'       => 'required|string|max:100',
            'adresse'       => 'required|string|max:100',
            'telephone'       => 'required|string|max:20',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|string|min:6',
            'structure'  => 'required|in:hopital,mairie',
            'structure_id' => 'required|integer',
        ]);


        $user = new User();
        $user->nom     = $request->nom;
        $user->prenom     = $request->prenom;
        $user->adresse     = $request->adresse;
        $user->telephone     = $request->telephone;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        if ($request->structure === 'hopital') {
            $user->role     = 'agent_hopital';
        } else {
            $user->role     = 'agent_mairie';
        }


        if ($request->structure === 'hopital') {
            $user->id_hopital = $request->structure_id;
        } else {
            $user->id_mairie = $request->structure_id;
        }


        $user->save();
        // Log création manager
        Log::create([
            'id_utilisateur' => Auth::id(),
            'action' => 'Création utilisateur',
            'details' => 'Manager créé : ' . $user->nom . ' ' . $user->prenom . ' (' . $user->email . ')',
        ]);
        return redirect()->route('admin.managers.index')->with('success', 'Utilisateur créé avec succès.');
    }

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        $manager = User::findOrFail($id);
        $hopitaux = Hopital::all();
        $mairies = Mairie::all();

        return view('admin.managers.edit', compact('manager', 'hopitaux', 'mairies'));
    }

    // Mettre à jour le manager
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'adresse' => 'required|string',
            'telephone' => 'required|string',
            'structure' => 'required|in:hopital,mairie',
            'structure_id' => 'required|integer',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
        ]);

        // Mise à jour de la structure
        $user->id_hopital = null;
        $user->id_mairie = null;
        $user->role = null;

        if ($request->structure == 'hopital') {
            $user->id_hopital = $request->structure_id;
            $user->role = 'agent_hopital';
        } else {
            $user->id_mairie = $request->structure_id;
            $user->role = 'agent_mairie';
        }

        $user->save();
        // Log mise à jour manager
        Log::create([
            'id_utilisateur' => Auth::id(),
            'action' => 'Mise à jour manager',
            'details' => 'Manager modifié : ' . $user->nom . ' ' . $user->prenom . ' (' . $user->email . ')',
        ]);
        return redirect()->route('admin.managers.index')->with('success', 'Manager mis à jour avec succès.');
    }

    //voir le manager
    public function show($id)
    {
        $manager = User::findOrFail($id);
        return view('admin.managers.show', compact('manager'));
    }

    // Supprimer le manager
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        // Log suppression manager
        Log::create([
            'id_utilisateur' => Auth::id(),
            'action' => 'Suppression manager',
            'details' => 'Manager supprimé : ' . $user->nom . ' ' . $user->prenom . ' (' . $user->email . ')',
        ]);
        return redirect()->route('admin.managers.index')->with('success', 'Manager supprimé avec succès.');
    }
}
