<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\FactureController;

// ===================== PAGE D'ACCUEIL =====================
Route::get('/', function () {
    return view('welcome');
});

// ===================== DECONNEXION =====================
// Route de déconnexion pour tous les utilisateurs
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/login', function () {
    return redirect()->route('client.login'); // ou 'agent.login' ou une page qui explique
})->name('login');

// ===================== CLIENT =====================

// Afficher le formulaire d'inscription du client
Route::get('/registerClient', [ClientController::class, 'register'])->name('client.register');

// Traiter l'inscription du client
Route::post('/registerClient', [ClientController::class, 'handleClientRegister'])->name('handleClientRegister');

// Afficher le formulaire de connexion du client
Route::get('/loginClient', [ClientController::class, 'login'])->name('client.login');

// Traiter la connexion du client
Route::post('/loginClient', [ClientController::class, 'handleClientLogin'])->name('handleClientLogin');

// Page d'accueil du client connecté
Route::get('/welcomeClient', [ClientController::class, 'welcomeClient'])->name('welcome.client');


// ===================== AGENT =====================

// Afficher le formulaire d'inscription de l'agent
Route::get('/registerAgent', [AgentController::class, 'register'])->name('agent.register');

// Traiter l'inscription de l'agent
Route::post('/registerAgent', [AgentController::class, 'handleAgentRegister'])->name('handleAgentRegister');

// Afficher le formulaire de connexion de l'agent
Route::get('/loginAgent', [AgentController::class, 'login'])->name('agent.login');

// Traiter la connexion de l'agent
Route::post('/loginAgent', [AgentController::class, 'handleAgentLogin'])->name('handleAgentLogin');

// Page d'accueil de l'agent connecté
Route::get('/welcomeAgent', [AgentController::class, 'welcomeAgent'])->name('welcome.agent');


// ===================== ADMINISTRATEUR =====================

// Afficher le formulaire d'inscription de l'admin
Route::get('/registerAdmin', [AdministrateurController::class, 'register'])->name('admin.register');

// Traiter l'inscription de l'admin
Route::post('/registerAdmin', [AdministrateurController::class, 'handleAdminRegister'])->name('handleAdminRegister');

// Afficher le formulaire de connexion de l'administrateur
Route::get('/loginAdmin', [AdministrateurController::class, 'login'])->name('admin.login');

// Traiter la connexion de l'administrateur
Route::post('/loginAdmin', [AdministrateurController::class, 'handleAdminLogin'])->name('handleAdminLogin');

// Page d'accueil de l'administrateur connecté
Route::get('/welcomeAdmin', [AdministrateurController::class, 'welcomeAdmin'])->name('welcome.admin');


// ===================== FACTURES =====================

// Afficher la liste de toutes les factures
Route::get('/listeFactures', [FactureController::class, 'listeFactures'])->name('facture.liste');

// Afficher la liste de toutes les factures
Route::get('/listeFacturesClient', [FactureController::class, 'listeFacturesClient'])->name('facture.listeClient');

// Afficher le formulaire d'ajout d'une facture
Route::get('/ajouterFacture', [FactureController::class, 'ajouterFacture'])->name('facture.ajouter');

// Traiter l'ajout d'une facture
Route::post('/ajouterFacture', [FactureController::class, 'handleAjouterFacture'])->name('handleFactureAjouter');

// Afficher le formulaire de mise à jour d'une facture
Route::get('/updateFacture/{id}', [FactureController::class, 'updateFacture'])->name('facture.update');

// Traiter la mise à jour d'une facture
Route::post('/updateFacture/{id}', [FactureController::class, 'handleUpdateFacture'])->name('handleFactureModifier');

// Supprimer une facture
Route::delete('/facture/{id}', [FactureController::class, 'supprimerFacture'])->name('facture.destroy');

// Télécharger une facture en format PDF
Route::get('/facture/{id}/pdf', [FactureController::class, 'telechargerFacture'])->name('facture.pdf');

//paiement 

// Paiements
Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index');
Route::get('/paiements/ajouter', [PaiementController::class, 'ajouter'])->name('paiements.ajouter');
Route::post('/paiements/ajouter', [PaiementController::class, 'handleAjouter'])->name('paiements.handleAjouter');
Route::get('/paiements/liste', [PaiementController::class, 'liste'])->name('paiements.liste');

// Routes pour retour et notification CinetPay
Route::get('/paiement/retour', [PaiementController::class, 'retour'])->name('paiements.retour');
Route::post('/paiement/notify', [PaiementController::class, 'notify'])->name('paiements.notify');


Route::get('/paiements/ajouterForm', [PaiementController::class, 'formulaire'])->name('formulaire.ajouter');

