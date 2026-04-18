<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Pour rendre ce modèle authentifiable (login)
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

/**
 * Modèle représentant un client dans le système.
 * Un client peut se connecter et consulter ses factures.
 */
class Client extends Model implements AuthenticatableContract
{
    // HasFactory : permet d’utiliser les "factories" Laravel pour ce modèle (tests, seeders, etc.)
    // Authenticatable : fournit les méthodes nécessaires à l’authentification
    use HasFactory, Authenticatable;

    /**
     * Attributs qui peuvent être remplis automatiquement lors d’un enregistrement (create/update).
     * Laravel empêche par défaut le "mass assignment" sur des champs non listés ici.
     *
     * @var array
     */
    protected $fillable = [
        'nom',         // Nom du client
        'postnom',     // Postnom du client
        'prenom',      // Prénom du client
        'adresse',     // Adresse physique
        'telephone',   // Numéro de téléphone (optionnel)
        'numcompteur', // Numéro de compteur électrique
        'email',       // Adresse e-mail utilisée pour se connecter
        'password',    // Mot de passe haché
    ];

    /**
     * Attributs cachés lorsqu'on convertit ce modèle en tableau ou JSON.
     * Cela protège les données sensibles.
     *
     * @var array
     */
    protected $hidden = [
        'password',         // On ne veut pas que le mot de passe soit affiché
        'remember_token',   // Utilisé pour les sessions "remember me"
    ];
    
    /**
     * Déclare la relation entre un client et ses factures.
     * Un client peut avoir plusieurs factures.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function factures()
    {
        return $this->hasMany(Facture::class, 'client_id');
    }
    
    public function paiements()
{
    return $this->hasMany(Paiement::class);
}

}
