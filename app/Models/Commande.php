<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commande';
    protected $primaryKey = 'id_commande';
    public $timestamps = false;

    protected $fillable = [
        'id_client',
        'id_panier',
        'montant_total',
        'mode_paiement',
        'statut',
    ];

    protected $casts = [
        'montant_total' => 'decimal:2',
        'date_commande' => 'datetime',
    ];

    // Relations
    public function client()
    {
        return $this->belongsTo(User::class, 'id_client', 'id');
    }

    public function panier()
    {
        return $this->belongsTo(Panier::class, 'id_panier');
    }

    // Créer une commande depuis un panier
    public static function creerDepuisPanier(Panier $panier, $mode_paiement = 'livraison')
    {
        $commande = self::create([
            'id_client' => $panier->id_client,
            'id_panier' => $panier->id_panier,
            'montant_total' => $panier->calculerTotal(),
            'mode_paiement' => $mode_paiement,
            'statut' => 'en_attente',
        ]);

        // Marquer le panier comme validé
        $panier->statut = 'validé';
        $panier->save();

        // Réduire le stock des produits
        foreach ($panier->produits as $produit) {
            $produit->reduireStock($produit->pivot->quantite);
        }

        return $commande;
    }

    // Changer le statut de la commande
    public function changerStatut($nouveauStatut)
    {
        $this->statut = $nouveauStatut;
        return $this->save();
    }

    // Annuler la commande
    public function annuler()
    {
        if ($this->statut !== 'annulée') {
            // Remettre les produits en stock
            $panier = $this->panier;
            if ($panier) {
                foreach ($panier->produits as $produit) {
                    $produit->augmenterStock($produit->pivot->quantite);
                }
            }

            $this->statut = 'annulée';
            return $this->save();
        }
        return false;
    }
}
