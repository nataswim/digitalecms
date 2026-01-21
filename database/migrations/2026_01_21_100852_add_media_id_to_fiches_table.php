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
        Schema::table('fiches', function (Blueprint $table) {
            // Ajouter le champ media_id comme clé étrangère
            $table->foreignId('media_id')
                ->nullable()
                ->after('image')
                ->constrained('media')
                ->onDelete('set null')
                ->comment('Relation vers la table media pour l\'image de la fiche');
            
            // Modifier le champ image pour le rendre nullable (optionnel, pour rétrocompatibilité)
            $table->string('image', 2048)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fiches', function (Blueprint $table) {
            // Supprimer la clé étrangère et le champ
            $table->dropForeign(['media_id']);
            $table->dropColumn('media_id');
        });
    }
};