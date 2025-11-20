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
        Schema::create('panier', function (Blueprint $table) {
            $table->integer('id_panier', true);
            $table->integer('id_client')->index('id_client');
            $table->dateTime('date_creation')->nullable()->useCurrent();
            $table->enum('statut', ['en_cours', 'validé', 'abandonné'])->nullable()->default('en_cours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panier');
    }
};
