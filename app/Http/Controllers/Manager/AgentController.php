<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Hopital;
use App\Models\Mairie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class AgentController extends Controller
{
    // Afficher la liste des agents
    public function index()
    {

        $agents = User::with(['hopital', 'mairie'])
            ->whereIn('role', ['agent_hopital', 'agent_mairie'])
            ->paginate(10);
        $last_login_at = User::whereIn('role', ['agent_hopital', 'agent_mairie'])
            ->orderBy('last_login_at', 'desc')
            ->pluck('last_login_at');

        return view('manager.agents.index', compact('agents'));
    }

    // Formulaire de création
    public function create()
    {
        $hopitaux = Hopital::all();
        $mairies = Mairie::all();
        return view('manager.agents.create', compact('hopitaux', 'mairies'));
    }

    // Enregistrement de l'agent
    public function store(Request $request)
    {
        $request->validate([
            'nom'       => 'required|string|max:100',
            'prenom'       => 'required|string|max:100',
            'adresse'       => 'required|string|max:100',
            'telephone'       => 'required|string|max:20',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|string|min:8|confirmed',
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
            $user->id_hopital = $request->structure_id;
        } else {
            $user->role     = 'agent_mairie';
            $user->id_mairie = $request->structure_id;
        }

        $user->save();

        // Log création agent
        Log::create([
            'id_utilisateur' => Auth::id(),
            'action' => 'Création agent',
            'details' => 'Agent créé : ' . $user->nom . ' ' . $user->prenom . ' (' . $user->email . ')',
        ]);

        return redirect()->route('manager.agents.index')->with('success', 'Agent créé avec succès.');
    }

    // Afficher les détails d'un agent
    public function show($id)
    {
        $manager = User::with(['hopital', 'mairie'])->findOrFail($id);
        return view('manager.agents.show', compact('manager'));
    }

    // Formulaire de modification
    public function edit($id)
    {
        $manager = User::findOrFail($id);
        $hopitaux = Hopital::all();
        $mairies = Mairie::all();
        return view('manager.agents.edit', compact('manager', 'hopitaux', 'mairies'));
    }

    // Mise à jour de l'agent
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom'       => 'required|string|max:100',
            'prenom'       => 'required|string|max:100',
            'adresse'       => 'required|string|max:100',
            'telephone'       => 'required|string|max:20',
            'email'      => 'email|unique:users,email,' . $id,
            'password'   => 'nullable|string|min:6',
            'structure'  => 'required|in:hopital,mairie',
            'structure_id' => 'required|integer',
        ]);

        $user = User::findOrFail($id);
        $user->nom     = $request->nom;
        $user->prenom     = $request->prenom;
        $user->adresse     = $request->adresse;
        $user->telephone     = $request->telephone;
        $user->email    = $user->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->structure === 'hopital') {
            $user->role     = 'agent_hopital';
            $user->id_hopital = $request->structure_id;
            $user->id_mairie = null;
        } else {
            $user->role     = 'agent_mairie';
            $user->id_mairie = $request->structure_id;
            $user->id_hopital = null;
        }

        $user->save();

        // Log modification agent
        Log::create([
            'id_utilisateur' => Auth::id(),
            'action' => 'Modification agent',
            'details' => 'Agent modifié : ' . $user->nom . ' ' . $user->prenom . ' (' . $user->email . ')',
        ]);

        return redirect()->route('manager.agents.index')->with('success', 'Agent mis à jour avec succès.');
    }

    // Suppression de l'agent
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // Log suppression agent
        Log::create([
            'id_utilisateur' => Auth::id(),
            'action' => 'Suppression agent',
            'details' => 'Agent supprimé : ' . $user->nom . ' ' . $user->prenom . ' (' . $user->email . ')',
        ]);

        return redirect()->route('manager.agents.index')->with('success', 'Agent supprimé avec succès.');
    }
}