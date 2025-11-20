<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\PanierProduit;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client');
    }

    /**
     * 4. Ajouter un produit au panier
     */
    public function add(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);

        if ($produit->stock <= 0) {
            return back()->with('error', 'Produit en rupture de stock.');
        }

        $panier = Panier::firstOrCreate(
            ['id_client' => Auth::guard('client')->id(), 'statut' => 'en_cours']
        );

        $existe = PanierProduit::where('id_panier', $panier->id_panier)
            ->where('id_produit', $produit->id_produit)
            ->first();

        if ($existe) {
            $existe->increment('quantite');
        } else {
            PanierProduit::create([
                'id_panier' => $panier->id_panier,
                'id_produit' => $produit->id_produit,
                'quantite' => 1,
            ]);
        }

        return back()->with('success', 'Produit ajouté au panier.');
    }

    /**
     * 5. Supprimer un produit du panier
     */
    public function remove($idProduit)
    {
        $panier = Panier::where('id_client', Auth::guard('client')->id())
            ->where('statut', 'en_cours')
            ->firstOrFail();

        PanierProduit::where('id_panier', $panier->id_panier)
            ->where('id_produit', $idProduit)
            ->delete();

        return back()->with('success', 'Produit retiré du panier.');
    }

    /**
     * 6. Valider le panier
     */
    public function validateCart()
    {
        $panier = Panier::where('id_client', Auth::guard('client')->id())
            ->where('statut', 'en_cours')
            ->firstOrFail();

        if ($panier->produits()->count() === 0) {
            return back()->with('error', 'Le panier est vide.');
        }

        $panier->update(['statut' => 'validé']);

        return redirect()->route('commande.form')->with('success', 'Panier validé.');
    }

    public function show()
    {
        $panier = Panier::with('produits')->where('id_client', Auth::guard('client')->id())
            ->where('statut', 'en_cours')
            ->firstOrCreate(['id_client' => Auth::guard('client')->id()]);

        return view('panier.show', compact('panier'));
    }
}
