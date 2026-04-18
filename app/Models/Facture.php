<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant une facture dans la base de données.
 */
class Facture extends Model
{
    // Spécifie explicitement le nom de la table si différent de la convention Laravel (factures)
    protected $table = 'factures';

    /**
     * Attributs pouvant être assignés en masse (mass assignment).
     *
     * @var array
     */
    protected $fillable = [
        'numero_facture',   // Numéro unique de la facture
        'date_emission',    // Date d'émission de la facture
        'montant_ht',       // Montant hors taxes
        'tva',              // Montant de la TVA
        'montant_ttc',      // Montant toutes taxes comprises
        'statut_paiement',  // Statut du paiement (ex : payé, en attente)
        'fichier_pdf',      // Nom/fichier PDF stocké
        'client_id',        // Clé étrangère vers le client
        'agent_id',         // Clé étrangère vers l’agent
    ];

    /**
     * Spécifie que la colonne date_emission est une instance Carbon (objet date).
     *
     * @var array
     */
    protected $dates = ['date_emission'];

    /**
     * Relation inverse vers le client.
     * Une facture appartient à un client.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * Relation inverse vers l’agent.
     * Une facture appartient à un agent qui l’a traitée.
     */
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function paiements()
{
    return $this->hasMany(Paiement::class);
}
}
