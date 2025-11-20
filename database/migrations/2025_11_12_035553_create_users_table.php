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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nom', 100);
            $table->string('prenom', 100)->nullable();
            $table->string('email', 150)->unique('email');
            $table->string('mot_de_passe');
            $table->string('telephone', 20)->nullable();
            $table->text('adresse')->nullable();
            $table->enum('type_user', ['admin', 'client']);
            $table->enum('role', ['superadmin', 'gestionnaire', 'client'])->nullable()->default('client');
            $table->dateTime('date_creation')->nullable()->useCurrent();
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
