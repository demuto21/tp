<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    protected $table = 'panier';
    protected $primaryKey = 'id_panier';
    public $timestamps = false;

    protected $fillable = [
        'id_client',
        'statut',
    ];

    protected $casts = [
        'date_creation' => 'datetime',
    ];

    // Relations
    public function client()
    {
        return $this->belongsTo(User::class, 'id_client', 'id');
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'panier_produit', 'id_panier', 'id_produit')
                    ->withPivot('quantite', 'prix_unitaire');
    }

    public function commande()
    {
        return $this->hasOne(Commande::class, 'id_panier');
    }

    // Calculer le montant total du panier
    public function calculerTotal()
    {
        return $this->produits->sum('pivot.sous_total');
    }

    // Nombre total d'articles
    public function nombreArticles()
    {
        return $this->produits->sum('pivot.quantite');
    }

    // Ajouter un produit au panier
    public function ajouterProduit(Produit $produit, $quantite = 1)
    {
        if (!$produit->estDisponible($quantite)) {
            return false;
        }

        $existant = $this->produits()->where('id_produit', $produit->id_produit)->first();

        if ($existant) {
            $nouvelleQuantite = $existant->pivot->quantite + $quantite;
            $this->produits()->updateExistingPivot($produit->id_produit, [
                'quantite' => $nouvelleQuantite,
                'prix_unitaire' => $produit->prix,
            ]);
        } else {
            $this->produits()->attach($produit->id_produit, [
                'quantite' => $quantite,
                'prix_unitaire' => $produit->prix,
            ]);
        }

        return true;
    }

    // Retirer un produit du panier
    public function retirerProduit($id_produit)
    {
        return $this->produits()->detach($id_produit);
    }

    // Mettre à jour la quantité
    public function mettreAJourQuantite($id_produit, $quantite)
    {
        if ($quantite <= 0) {
            return $this->retirerProduit($id_produit);
        }

        $produit = Produit::find($id_produit);
        if (!$produit || !$produit->estDisponible($quantite)) {
            return false;
        }

        return $this->produits()->updateExistingPivot($id_produit, [
            'quantite' => $quantite,
            'prix_unitaire' => $produit->prix,
        ]);
    }

    // Vider le panier
    public function vider()
    {
        return $this->produits()->detach();
    }
}
