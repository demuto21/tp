<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    /**
     * 15. Suivre les commandes
     */
    public function index()
    {

        
        // $commandes = Commande::with(['client', 'panier.produits'])
        //     ->latest()
        //     ->get();
$commandes = Commande::orderBy('id_commande', 'desc')->paginate(10);
        return view('admin.admin-commandes', compact('commandes'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,payée,expédiée,livrée,annulée',
        ]);

        $commande = Commande::findOrFail($id);
        $commande->update(['statut' => $request->statut]);

        // Ici : ajouter notification client (email, etc.)

        return back()->with('success', 'Statut de la commande mis à jour.');
    }
}
