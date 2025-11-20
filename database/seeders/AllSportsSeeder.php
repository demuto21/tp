<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Produit;
use Illuminate\Database\Seeder;

class AllSportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un utilisateur admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@allsports.com'],
            [
                'nom' => 'Admin',
                'prenom' => 'AllSports',
                'mot_de_passe' => bcrypt('password'),
                'type_user' => 'admin',
                'role' => 'superadmin',
                'telephone' => '+221771234567',
                'adresse' => 'Dakar, Sénégal',
            ]
        );

        // Créer des utilisateurs clients
        $clients = [
            [
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'email' => 'jean@example.com',
                'telephone' => '+221771234567',
                'adresse' => '123 Rue de la Paix, Dakar',
            ],
            [
                'nom' => 'Martin',
                'prenom' => 'Marie',
                'email' => 'marie@example.com',
                'telephone' => '+221771234568',
                'adresse' => '456 Avenue de l\'Indépendance, Dakar',
            ],
            [
                'nom' => 'Bernard',
                'prenom' => 'Pierre',
                'email' => 'pierre@example.com',
                'telephone' => '+221771234569',
                'adresse' => '789 Boulevard de la République, Dakar',
            ],
        ];

        foreach ($clients as $client) {
            User::firstOrCreate(
                ['email' => $client['email']],
                array_merge($client, [
                    'mot_de_passe' => bcrypt('password'),
                    'type_user' => 'client',
                ])
            );
        }

        // Créer des produits
        $produits = [
            // Football
            [
                'nom' => 'Ballon de Football Officiel',
                'description' => 'Ballon de football professionnel en cuir synthétique',
                'prix' => 25000,
                'stock' => 50,
                'categorie' => 'Football',
                'image_url' => 'https://via.placeholder.com/300x300?text=Ballon+Football',
            ],
            [
                'nom' => 'Crampons de Football',
                'description' => 'Crampons professionnels pour terrain naturel',
                'prix' => 45000,
                'stock' => 30,
                'categorie' => 'Football',
                'image_url' => 'https://via.placeholder.com/300x300?text=Crampons',
            ],
            [
                'nom' => 'Maillot de Football',
                'description' => 'Maillot de football respirant et confortable',
                'prix' => 15000,
                'stock' => 100,
                'categorie' => 'Football',
                'image_url' => 'https://via.placeholder.com/300x300?text=Maillot',
            ],

            // Basketball
            [
                'nom' => 'Ballon de Basketball',
                'description' => 'Ballon de basketball officiel en caoutchouc',
                'prix' => 20000,
                'stock' => 40,
                'categorie' => 'Basketball',
                'image_url' => 'https://via.placeholder.com/300x300?text=Ballon+Basketball',
            ],
            [
                'nom' => 'Chaussures de Basketball',
                'description' => 'Chaussures de basketball haute performance',
                'prix' => 55000,
                'stock' => 25,
                'categorie' => 'Basketball',
                'image_url' => 'https://via.placeholder.com/300x300?text=Chaussures+Basketball',
            ],

            // Tennis
            [
                'nom' => 'Raquette de Tennis',
                'description' => 'Raquette de tennis légère et maniable',
                'prix' => 35000,
                'stock' => 20,
                'categorie' => 'Tennis',
                'image_url' => 'https://via.placeholder.com/300x300?text=Raquette+Tennis',
            ],
            [
                'nom' => 'Balles de Tennis',
                'description' => 'Lot de 3 balles de tennis professionnelles',
                'prix' => 8000,
                'stock' => 200,
                'categorie' => 'Tennis',
                'image_url' => 'https://via.placeholder.com/300x300?text=Balles+Tennis',
            ],

            // Fitness
            [
                'nom' => 'Haltères Ajustables',
                'description' => 'Paire d\'haltères ajustables de 2 à 10 kg',
                'prix' => 40000,
                'stock' => 15,
                'categorie' => 'Fitness',
                'image_url' => 'https://via.placeholder.com/300x300?text=Halteres',
            ],
            [
                'nom' => 'Tapis de Yoga',
                'description' => 'Tapis de yoga antidérapant et écologique',
                'prix' => 12000,
                'stock' => 60,
                'categorie' => 'Fitness',
                'image_url' => 'https://via.placeholder.com/300x300?text=Tapis+Yoga',
            ],
        ];

        foreach ($produits as $produit) {
            Produit::firstOrCreate(
                ['nom' => $produit['nom']],
                array_merge($produit, ['id_admin' => $admin->id])
            );
        }

        $this->command->info('Données de test créées avec succès!');
    }
}
