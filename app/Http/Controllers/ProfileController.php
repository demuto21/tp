<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    // Affiche le formulaire de profil
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    // Traite la mise à jour du profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            // Validation optionnelle du mot de passe
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        // Mise à jour des infos de base
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->adresse = $request->adresse;

        // Mise à jour du mot de passe si renseigné
        if ($request->filled('new_password')) {
            // Vérifier l'ancien mot de passe
            if (!Hash::check($request->current_password, $user->mot_de_passe)) {
                throw ValidationException::withMessages([
                    'current_password' => 'Votre mot de passe actuel est incorrect.',
                ]);
            }
            $user->mot_de_passe = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profil mis à jour avec succès !');
    }
}