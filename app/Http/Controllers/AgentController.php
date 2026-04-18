<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Facture;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    /**
     * Affiche le formulaire d'enregistrement d'un agent
     */
    public function register()
    {
        return view('agent.register');
    }

    /**
     * Traite l'enregistrement d'un agent
     */
    public function handleAgentRegister(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email',
            'password' => 'required|string|min:6',
        ]);

        Agent::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('welcome.admin')->with('success', 'Agent ajouté avec succès.');
    }

    /**
     * Affiche le formulaire de connexion de l'agent
     */
    public function login()
    {
        return view('agent.login');
    }

    /**
     * Traite la connexion de l'agent
     */
    public function handleAgentLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('agent')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('welcome.agent');
        }

        return back()->with('error', 'Identifiants incorrects.');
    }

    /**
     * Page d’accueil de l’agent après connexion
     */
    public function welcomeAgent()
    {
        // Récupérer toutes les factures
    $factures = Facture::all();

    // Transmettre les factures à la vue
    return view('welcome.agent', compact('factures'));
    }

    /**
     * Affiche la liste des agents
     */
    public function listeAgents()
    {
        $agents = Agent::all();
        return view('agents.listeAgents', compact('agents'));
    }

    /**
     * Supprime un agent
     */
    public function destroy($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->delete();

        return redirect()->route('agent.liste')->with('success', 'Agent supprimé avec succès.');
    }
}
