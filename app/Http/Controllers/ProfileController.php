<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Affiche la page de profil.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Met à jour les informations du profil.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // ✅ Validation des champs
        $request->validate([
            'nom'       => 'required|string|max:255',
            'prenom'    => 'required|string|max:255',
            'email'     => 'required|email|max:255|unique:users,email,' . $user->id,
            'telephone' => 'nullable|string|max:20',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // 🔹 Supprimer l'ancienne photo
            if ($user->photo) {
                $oldPath = ltrim(str_replace('/storage/', '', $user->photo), '/');
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // 🔹 Enregistrer la nouvelle photo
            $path = $request->file('photo')->store('photos', 'public');
            $user->photo = '/storage/' . $path;
        }


        // ✅ Mise à jour des infos
        $user->nom       = $request->nom;
        $user->prenom    = $request->prenom;
        $user->telephone = $request->telephone;

        // Si email modifié, reset la vérification
        if ($user->email !== $request->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
        }

        $user->save();

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * Met à jour le mot de passe de l'utilisateur.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password'     => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Mot de passe modifié avec succès.');
    }

    /**
     * Supprime le compte de l'utilisateur.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Mot de passe incorrect']);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Compte supprimé.');
    }
}
