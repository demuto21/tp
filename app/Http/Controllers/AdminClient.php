<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Commande;
use Symfony\Component\Console\Command\Command;

class AdminClient extends Controller
{
    /**
     * 16. Gérer les clients
     */
    public function index()
    {
        // Logique pour récupérer et afficher les clients
        $clients = User::where('type_user', 'client')->withCount('commandes')->get();

        // Statistiques
        $totalClients = $clients->count();
        $totalCommandes = Commande::count();
        $totalRevenus = Commande::where('statut', '!=', 'annulée')->sum('montant_total');
        $loyalClients = $clients->where('commandes_count', '>=', 3);


        return view('admin.admin-clients', compact('clients', 'totalClients', 'totalCommandes', 'totalRevenus', 'loyalClients'));
    }
}
