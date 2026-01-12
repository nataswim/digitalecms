<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations
     */
    public function up(): void
    {
        Schema::create('fiches_sous_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('slug', 191)->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            
            // Relation avec la catégorie parente
            $table->foreignId('fiches_category_id')->constrained('fiches_categories')->cascadeOnDelete();
            
            // Champs SEO
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            
            // Traçabilité
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Index pour les performances
            $table->index('is_active');
            $table->index('sort_order');
            $table->index('fiches_category_id');
            $table->unique(['slug', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('fiches_sous_categories');
    }
};