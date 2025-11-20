<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'produit';
    protected $primaryKey = 'id_produit';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'stock',
        'image_url',
        'categorie',
        'id_admin',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'stock' => 'integer',
        'date_ajout' => 'datetime',
    ];

    // Relations
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id');
    }

    public function paniers()
    {
        return $this->belongsToMany(Panier::class, 'panier_produit', 'id_produit', 'id_panier')
                    ->withPivot('quantite', 'prix_unitaire');
    }

    // Vérifier la disponibilité
    public function estDisponible($quantite = 1)
    {
        return $this->stock >= $quantite;
    }

    // Réduire le stock
    public function reduireStock($quantite)
    {
        if ($this->estDisponible($quantite)) {
            $this->stock -= $quantite;
            return $this->save();
        }
        return false;
    }

    // Augmenter le stock
    public function augmenterStock($quantite)
    {
        $this->stock += $quantite;
        return $this->save();
    }
}
