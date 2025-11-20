<?php

namespace App\Http\Authentification;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.admin-login');
    }

    /**
     * Connexion Admin
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->mot_de_passe,
        ];

        // Tentative de connexion
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Vérifier si c'est un admin
            if ($user->type_user !== 'admin') {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => 'Accès refusé. Seuls les administrateurs peuvent se connecter ici.',
                ]);
            }

            $request->session()->regenerate();

            // Redirige vers la page des produits
            return redirect()->route('admin.dashboard')
                             ->with('success', 'Connexion réussie en tant qu’administrateur.');
        }

        throw ValidationException::withMessages([
            'email' => 'Les identifiants fournis sont incorrects.',
        ]);
    }

    /**
     * Inscription Client
     */
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email', // table users
            'mot_de_passe' => 'required|string|min:6|confirmed',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
        ]);

        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->mot_de_passe), // ← password, pas mot_de_passe
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'type_user' => 'client',
        ]);

        return redirect()->route('login')
                         ->with('success', 'Inscription réussie. Vous pouvez vous connecter.');
    }

    /**
     * Déconnexion
     */
    public function logout()
    {
        Auth::logout();
        // use the global request() helper to access the session without relying on a $request parameter
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
