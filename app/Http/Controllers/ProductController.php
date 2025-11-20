<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * 3. Voir les détails du produit
     * Acteur : Client (ou visiteur)
     */
    public function index()
    {
        $produits = Produit::all();
        return view('admin.gestion-produits', compact('produits'));
    }

    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return view('produits.show', compact('produit'));
    }
}
