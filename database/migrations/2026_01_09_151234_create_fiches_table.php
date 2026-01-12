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
        Schema::create('fiches', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191);
            $table->string('slug', 191)->unique();
            $table->text('short_description');
            $table->longText('long_description')->nullable();
            $table->string('image')->nullable();
            $table->string('visibility', 50)->default('public');
            $table->boolean('is_published')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('views_count')->default(0);
            $table->integer('sort_order')->default(0);
            
            // Relations avec catégories
            $table->foreignId('fiches_category_id')->nullable()->constrained('fiches_categories')->nullOnDelete();
            $table->foreignId('fiches_sous_category_id')->nullable()->constrained('fiches_sous_categories')->nullOnDelete();
            
            // Champs SEO
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_og_image', 255)->nullable();
            $table->string('meta_og_url', 255)->nullable();
            
            // Traçabilité
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('created_by_name', 150)->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Index pour les performances
            $table->index('is_published');
            $table->index('is_featured');
            $table->index('visibility');
            $table->index('sort_order');
            $table->index('published_at');
            $table->index('fiches_category_id');
            $table->index('fiches_sous_category_id');
            $table->index(['is_published', 'published_at', 'deleted_at']);
            $table->index(['visibility', 'is_published', 'deleted_at']);
            $table->unique(['slug', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('fiches');
    }
};