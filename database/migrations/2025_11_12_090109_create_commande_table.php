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
        Schema::create('commande', function (Blueprint $table) {
            $table->integer('id_commande', true);
            $table->integer('id_client')->index('id_client');
            $table->integer('id_panier')->nullable()->unique('id_panier');
            $table->dateTime('date_commande')->nullable()->useCurrent();
            $table->decimal('montant_total', 10);
            $table->enum('mode_paiement', ['carte', 'mobile_money', 'livraison'])->nullable()->default('livraison');
            $table->enum('statut', ['en_attente', 'payée', 'expédiée', 'livrée', 'annulée'])->nullable()->default('en_attente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande');
    }
};
