<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('panier_produit', function (Blueprint $table) {
            $table->integer('id_panier');
            $table->integer('id_produit')->index('id_produit');
            $table->integer('quantite')->default(1);
            $table->decimal('prix_unitaire', 10);

            $table->primary(['id_panier', 'id_produit']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panier_produit');
    }
};
