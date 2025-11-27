<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProductController extends Controller
{

    /**
     * 11. Ajouter un produit
     */
    public function create()
    {
return view('admin.produit-create');    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:150',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|url',
            'categorie' => 'nullable|string|max:100',
        ]);

        Produit::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'stock' => $request->stock,
            'image_url' => $request->image_url,
            'categorie' => $request->categorie,
            'id_admin' => Auth::guard('admin')->id(),
        ]);

        return redirect()->route('admin.produits.index')->with('success', 'Produit ajouté avec succès.');
    }

    /**
     * 12. Supprimer un produit
     */
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return back()->with('success', 'Produit supprimé.');
    }


    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:150',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|url',
            'categorie' => 'nullable|string|max:100',
        ]);

        $produit->update($request->only([
            'nom', 'description', 'prix', 'stock', 'image_url', 'categorie'
        ]));

        return redirect()->route('admin.produits.index')->with('success', 'Produit mis à jour.');
    }

    /**
     * 14. Organiser les produits par catégorie
     */
    public function organize()
    {
        $categories = Produit::select('categorie')->distinct()->pluck('categorie');
        $produits = Produit::all();
        return view('admin.produits.organize', compact('categories', 'produits'));
    }

    public function updateCategory(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        $produit->update(['categorie' => $request->categorie]);
        return back()->with('success', 'Catégorie mise à jour.');
    }

    public function index()
    {
        $produits = Produit::orderBy('id_produit', 'desc')->paginate(10);
        // $produits = Produit::with('admin')->latest()->get();
        return view('admin.gestion-produits', compact('produits'));
    }
    
}
