<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
        // Log connexion
        Log::create([
            'id_utilisateur' => $user->id,
            'action' => 'Connexion',
            'details' => 'Connexion de ' . $user->prenom . ' ' . $user->nom . ' (' . $user->email . ')',
        ]);

        switch ($user->role) {
            case 'agent_hopital':
                return redirect()->route('hopital.dashboard');
            case 'agent_mairie':
                return redirect()->route('agent.dashboard');
            case 'admin':
                return redirect()->route('managers.index');
            default:
                return redirect('login'); // Default redirection for other roles
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}