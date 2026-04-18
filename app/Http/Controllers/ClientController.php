<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Facture;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Affiche le formulaire d'inscription du client
     */
    public function register()
    {
        return view('client.register');
    }

    /**
     * Traite l'inscription du client
     */
    public function handleClientRegister(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'postnom' => 'nullable|string|max:255',
            'prenom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'numcompteur' => 'required|string|unique:clients,numcompteur',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Client::create([
            'nom' => $request->nom,
            'postnom' => $request->postnom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'numcompteur' => $request->numcompteur,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('client.login')->with('success', 'Inscription réussie. Connectez-vous.');
    }

    /**
     * Affiche le formulaire de connexion du client
     */
    public function login()
    {
        return view('client.login');
    }

    /**
     * Traite la connexion du client
     */
    public function handleClientLogin(Request $request)
    {
         $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::guard('client')->attempt($credentials)) {
        $request->session()->regenerate();
        // Récupérer le client connecté
        $client = Auth::guard('client')->user();

        // Mettre le client_id dans la session
        session(['client_id' => $client->id]);
        return redirect()->route('welcome.client');
    }

    return back()->with('error', 'Identifiants incorrects.');
    }

    /**
     * Affiche la page d'accueil du client après connexion
     */
    public function welcomeClient()
    {
       // Récupérer le client connecté via le guard 'client'
    $client = Auth::guard('client')->user();

    // Vérifier que le client est bien authentifié
    if (!$client) {
        return redirect()->route('client.login')->with('error', 'Veuillez vous connecter.');
    }

    // Récupérer les factures liées à ce client
    $factures = Facture::where('client_id', $client->id)->get();

    // Transmettre les factures à la vue
    return view('welcome.client', compact('factures'));
    }

    /**
     * Affiche la liste de tous les clients
     */
    public function listeClients()
    {
        $clients = Client::all();
        return view('clients.listeClients', compact('clients'));
    }

    /**
     * Affiche le formulaire de modification d'un client
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.editClient', compact('client'));
    }

    /**
     * Traite la mise à jour d'un client
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'postnom' => 'nullable|string|max:255',
            'prenom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'numcompteur' => 'required|string|unique:clients,numcompteur,' . $client->id,
            'email' => 'required|email|unique:clients,email,' . $client->id,
        ]);

        $client->update($request->all());

        return redirect()->route('client.liste')->with('success', 'Client modifié avec succès.');
    }

    /**
     * Supprime un client
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('client.liste')->with('success', 'Client supprimé avec succès.');
    }
}
