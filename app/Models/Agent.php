<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Pour permettre à ce modèle d'être authentifiable avec un guard personnalisé
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

/**
 * Classe représentant le modèle Agent.
 * Ce modèle permet d’authentifier un agent (utilisateur ayant un rôle spécifique dans l'application).
 */
class Agent extends Model implements AuthenticatableContract
{
    // HasFactory : permet d’utiliser les factories pour ce modèle (utile pour les tests, le seed, etc.)
    // Authenticatable : fournit les méthodes requises pour l’authentification
    use HasFactory, Authenticatable;

    /**
     * Attributs pouvant être assignés en masse (lors d’un create ou update).
     *
     * @var array
     */
    protected $fillable = [
        'nom',       // Nom de l’agent
        'email',     // Adresse email de connexion
        'password',  // Mot de passe haché
    ];

    /**
     * Attributs qui doivent être masqués lorsqu’on transforme le modèle en tableau ou JSON.
     * Cela protège les données sensibles.
     *
     * @var array
     */
    protected $hidden = [
        'password',         // On cache le mot de passe haché
        'remember_token',   // Token utilisé pour les sessions persistantes ("se souvenir de moi")
    ];

    /**
     * Relation entre l’agent et les factures qu’il gère.
     * Un agent peut avoir plusieurs factures associées.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function factures()
    {
        // L’agent est lié aux factures via la colonne 'agent_id'
        return $this->hasMany(Facture::class, 'agent_id');
    }
}
