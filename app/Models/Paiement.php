<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'client_id',
        'facture_id',
        'reference',
        'montant',
        'status',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
}
