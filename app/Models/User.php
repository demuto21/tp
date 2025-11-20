<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'telephone',
        'adresse',
        'type_user',
        'role',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_creation' => 'datetime',
    ];

    // Utiliser mot_de_passe au lieu de password
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    // Vérifier si c'est un admin
    public function isAdmin()
    {
        return $this->type_user === 'admin';
    }

    // Vérifier si c'est un client
    public function isClient()
    {
        return $this->type_user === 'client';
    }

    // Vérifier si c'est un super admin
    public function isSuperAdmin()
    {
        return $this->type_user === 'admin' && $this->role === 'superadmin';
    }

    // Relations
    public function produitsAjoutes()
    {
        return $this->hasMany(Produit::class, 'id_admin');
    }

    public function paniers()
    {
        return $this->hasMany(Panier::class, 'id_client');
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class, 'id_client');
    }

    public function panierActif()
    {
        return $this->hasOne(Panier::class, 'id_client')
                    ->where('statut', 'en_cours');
    }

    public function scopeClients($query)
    {
        return $query->where('type_user', 'client');
    }
}
