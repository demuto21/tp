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
        Schema::table('panier_produit', function (Blueprint $table) {
            $table->foreign(['id_panier'], 'panier_produit_ibfk_1')->references(['id_panier'])->on('panier')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['id_produit'], 'panier_produit_ibfk_2')->references(['id_produit'])->on('produit')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('panier_produit', function (Blueprint $table) {
            $table->dropForeign('panier_produit_ibfk_1');
            $table->dropForeign('panier_produit_ibfk_2');
        });
    }
};
