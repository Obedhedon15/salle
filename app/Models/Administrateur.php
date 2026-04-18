<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Import de l’interface et du trait nécessaires à l’authentification personnalisée
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

/**
 * Classe représentant le modèle Administrateur.
 * Ce modèle implémente l'interface Authenticatable pour pouvoir être utilisé avec un guard personnalisé.
 */
class Administrateur extends Model implements AuthenticatableContract
{
    // Trait qui ajoute les méthodes nécessaires pour l’authentification
    use HasFactory, Authenticatable;

    /**
     * Les attributs qui peuvent être assignés en masse lors de la création ou la mise à jour.
     * Exemple : Administrateur::create([...])
     *
     * @var array
     */
    protected $fillable = [
        'nom',       // Nom de l'administrateur
        'email',     // Adresse e-mail
        'password',  // Mot de passe haché
    ];

    /**
     * Les attributs qui doivent être masqués lorsqu'on transforme le modèle en tableau ou JSON.
     * Cela permet de cacher des informations sensibles.
     *
     * @var array
     */
    protected $hidden = [
        'password',          // Ne pas exposer le mot de passe
        'remember_token',    // Utilisé par Laravel pour la "connexion automatique"
    ];
}
