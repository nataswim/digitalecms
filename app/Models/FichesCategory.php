<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class FichesCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active',
        'sort_order',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Boot du modèle
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (auth()->check()) {
                $category->created_by = auth()->id();
            }
            
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if (auth()->check()) {
                $category->updated_by = auth()->id();
            }
            
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Obtenir les fiches de cette catégorie
     */
    public function fiches(): HasMany
    {
        return $this->hasMany(Fiche::class, 'fiches_category_id');
    }

    /**
     * Obtenir uniquement les fiches publiées
     */
    public function publishedFiches(): HasMany
    {
        return $this->fiches()->where('is_published', true);
    }

    /**
     * Obtenir les sous-catégories de cette catégorie
     */
    public function sousCategories(): HasMany
    {
        return $this->hasMany(FichesSousCategory::class, 'fiches_category_id');
    }

    /**
     * Obtenir uniquement les sous-catégories actives
     */
    public function activeSousCategories(): HasMany
    {
        return $this->sousCategories()->where('is_active', true)->orderBy('sort_order', 'asc');
    }

    /**
     * Obtenir le créateur
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope pour les catégories actives
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pour les catégories ordonnées
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')
                    ->orderBy('name', 'asc');
    }

    /**
     * Clé de route pour la liaison du modèle
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}