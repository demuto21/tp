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
        // Cette migration documente la structure attendue
        // Les tables doivent déjà exister selon les migrations existantes

        // Vérifier que la table users a les colonnes nécessaires
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // Ajouter les colonnes si elles n'existent pas
                if (!Schema::hasColumn('users', 'type_user')) {
                    $table->string('type_user')->default('client')->after('email');
                }
                if (!Schema::hasColumn('users', 'role')) {
                    $table->string('role')->nullable()->after('type_user');
                }
                if (!Schema::hasColumn('users', 'telephone')) {
                    $table->string('telephone')->nullable()->after('role');
                }
                if (!Schema::hasColumn('users', 'adresse')) {
                    $table->text('adresse')->nullable()->after('telephone');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Pas de rollback pour cette migration de documentation
    }
};
