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
        Schema::create('produit', function (Blueprint $table) {
            $table->integer('id_produit', true);
            $table->string('nom', 150);
            $table->text('description')->nullable();
            $table->decimal('prix', 10);
            $table->integer('stock')->nullable()->default(0);
            $table->string('image_url')->nullable();
            $table->string('categorie', 100)->nullable();
            $table->dateTime('date_ajout')->nullable()->useCurrent();
            $table->integer('id_admin')->nullable()->index('id_admin');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit');
    }
};
