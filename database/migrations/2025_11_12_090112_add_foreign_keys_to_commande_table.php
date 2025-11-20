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
        Schema::table('commande', function (Blueprint $table) {
            $table->foreign(['id_client'], 'commande_ibfk_1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['id_panier'], 'commande_ibfk_2')->references(['id_panier'])->on('panier')->onUpdate('no action')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commande', function (Blueprint $table) {
            $table->dropForeign('commande_ibfk_1');
            $table->dropForeign('commande_ibfk_2');
        });
    }
};
