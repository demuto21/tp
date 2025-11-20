<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Panier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client');
    }

    /**
     * 7. Remplir le formulaire de commande
     */
    public function form()
    {
        $panier = Panier::where('id_client', Auth::guard('client')->id())
            ->where('statut', 'validé')
            ->firstOrFail();

        return view('commande.form', compact('panier'));
    }

    /**
     * 8. Valider la commande
     */
    public function store(Request $request)
    {
        $request->validate([
            'mode_paiement' => 'required|in:carte,mobile_money,livraison',
            'adresse_livraison' => 'required|string',
        ]);

        $panier = Panier::where('id_client', Auth::guard('client')->id())
            ->where('statut', 'validé')
            ->firstOrFail();

        DB::transaction(function () use ($panier, $request) {
            $total = $panier->produits->sum('sous_total');

            $commande = Commande::create([
                'id_client' => Auth::guard('client')->id(),
                'id_panier' => $panier->id_panier,
                'montant_total' => $total,
                'mode_paiement' => $request->mode_paiement,
                'statut' => 'en_attente',
            ]);

            // Mise à jour du stock
            foreach ($panier->produits as $item) {
                $produit = $item->produit;
                $produit->decrement('stock', $item->quantite);
            }

            $panier->update(['statut' => 'abandonné']);
        });

        return redirect()->route('commande.confirmation')->with('success', 'Commande validée avec succès.');
    }

    public function confirmation()
    {
        return view('commande.confirmation');
    }

    /**
     * 9. Consulter l’historique des commandes
     */
    public function history()
    {
        $commandes = Commande::with('panier.produits.produit')
            ->where('id_client', Auth::guard('client')->id())
            ->latest()
            ->get();

        return view('commande.historique', compact('commandes'));
    }
}
