<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistiques globales
        $totalRevenue = Commande::whereIn('statut', ['livree', 'payee'])
            ->sum('montant_total');

        $totalOrders = Commande::count();
        $totalCustomers = User::where('type_user', 'client')->count();
        $totalProducts = Produit::count();

        // 2. Commandes récentes avec client (filtre sur type_user)
        $recentOrders = Commande::with(['client' => function ($query) {
            $query->select('id', 'nom', 'prenom')
                  ->where('type_user', 'client');
        }])
        ->latest('date_commande')
        ->take(5)
        ->get();

        // 3. Produits en stock faible
        $lowStockThreshold = env('LOW_STOCK_THRESHOLD', 10);
        $lowStockProducts = Produit::where('stock', '<=', $lowStockThreshold)
            ->where('stock', '>', 0)
            ->orderBy('stock')
            ->get();

        // CORRIGÉ : notation pointée sans espace
        return view('admin.tableau de bord', compact(
            'totalRevenue',
            'totalOrders',
            'totalCustomers',
            'totalProducts',
            'recentOrders',
            'lowStockProducts'
        ));
    }
}
