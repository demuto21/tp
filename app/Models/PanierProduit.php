<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PanierProduit extends Pivot
{
    protected $table = 'panier_produit';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_panier',
        'id_produit',
        'quantite',
        'prix_unitaire',
    ];

    protected $casts = [
        'quantite' => 'integer',
        'prix_unitaire' => 'decimal:2',
    ];
}
