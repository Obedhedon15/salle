<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Auth;

class AdministrateurController extends Controller
{
    /**
     * Affiche le formulaire d'inscription de l'administrateur.
     * Cette méthode retourne simplement la vue contenant le formulaire.
     */
    public function register()
    {
        return view('administrateur.register');
    }

    /**
     * Traite l'enregistrement d'un nouvel administrateur.
     * Valide les données envoyées via le formulaire, puis crée un nouvel administrateur en base.
     */
    public function handleAdminRegister(Request $request)
    {
        // Validation des champs requis
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:administrateurs,email', // doit être unique
            'password' => 'required|string|min:6',
        ]);

        // Création de l'administrateur avec hachage du mot de passe
        Administrateur::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Redirection vers la page de connexion avec un message de succès
        return redirect()->route('admin.login')->with('success', 'Administrateur créé avec succès.');
    }

    /**
     * Affiche le formulaire de connexion de l'administrateur.
     */
    public function Login()
    {
        return view('administrateur.login');
    }

    /**
     * Traite la tentative de connexion de l'administrateur.
     * Vérifie les identifiants avec le guard 'admin' et connecte l'utilisateur.
     */
    public function handleAdminLogin(Request $request)
    {
        // Récupère uniquement l'email et le mot de passe envoyés
        $credentials = $request->only('email', 'password');

        // Vérifie les identifiants via le guard personnalisé 'admin'
        if (Auth::guard('admin')->attempt($credentials)) {
            // Régénère la session pour sécurité (protection CSRF)
            $request->session()->regenerate();

            // Redirige vers la page d'accueil de l'administrateur
            return redirect()->route('welcome.admin');
        }

        // Si échec de connexion, retourne vers le formulaire avec un message d'erreur
        return back()->with('error', 'Identifiants incorrects.');
    }

    /**
     * Affiche la page d’accueil de l’administrateur après une connexion réussie.
     */
    public function welcomeAdmin()
    {
        return view('welcome.admin');
    }

    /**
     * Déconnecte l’administrateur.
     * Cette méthode vide la session et redirige vers la page d'accueil du site.
     */
    public function logout(Request $request)
    {
        // Déconnexion via le guard 'admin'
        Auth::guard('admin')->logout();

        // Invalide la session en cours
        $request->session()->invalidate();

        // Regénère le token CSRF pour la nouvelle session
        $request->session()->regenerateToken();

        // Redirige vers la racine avec message de succès
        return redirect('/')->with('success', 'Déconnexion réussie.');
    }
}
