<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Fiche extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'long_description',
        'image',
        'visibility',
        'is_published',
        'is_featured',
        'views_count',
        'sort_order',
        'fiches_category_id',
        'fiches_sous_category_id',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'meta_og_image',
        'meta_og_url',
        'created_by',
        'created_by_name',
        'updated_by',
        'deleted_by',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'views_count' => 'integer',
        'sort_order' => 'integer',
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Boot du modèle
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($fiche) {
            if (auth()->check()) {
                $fiche->created_by = auth()->id();
                $fiche->created_by_name = auth()->user()->name;
            }

            // Définir automatiquement la catégorie parente si sous-catégorie sélectionnée
            if ($fiche->fiches_sous_category_id && !$fiche->fiches_category_id) {
                $sousCategory = FichesSousCategory::find($fiche->fiches_sous_category_id);
                if ($sousCategory) {
                    $fiche->fiches_category_id = $sousCategory->fiches_category_id;
                }
            }

            if (empty($fiche->slug)) {
                $fiche->slug = Str::slug($fiche->title);
            }

            if ($fiche->is_published && !$fiche->published_at) {
                $fiche->published_at = now();
            }
        });

        static::updating(function ($fiche) {
            if (auth()->check()) {
                $fiche->updated_by = auth()->id();
            }

            // Mettre à jour automatiquement la catégorie parente si sous-catégorie modifiée
            if ($fiche->isDirty('fiches_sous_category_id')) {
                if ($fiche->fiches_sous_category_id) {
                    $sousCategory = FichesSousCategory::find($fiche->fiches_sous_category_id);
                    if ($sousCategory) {
                        $fiche->fiches_category_id = $sousCategory->fiches_category_id;
                    }
                }
            }

            if ($fiche->isDirty('is_published') && $fiche->is_published && !$fiche->published_at) {
                $fiche->published_at = now();
            }
        });
    }

    /**
     * Obtenir la catégorie de cette fiche
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(FichesCategory::class, 'fiches_category_id');
    }

    /**
     * Obtenir la sous-catégorie de cette fiche
     */
    public function sousCategory(): BelongsTo
    {
        return $this->belongsTo(FichesSousCategory::class, 'fiches_sous_category_id');
    }

    /**
     * Obtenir le créateur de cette fiche
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Obtenir le modificateur de cette fiche
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Scope pour les fiches publiées
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope pour les fiches mises en avant
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope pour les fiches ordonnées
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')
            ->orderBy('published_at', 'desc');
    }

    /**
     * Scope pour les fiches par catégorie
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('fiches_category_id', $categoryId);
    }

    /**
     * Scope pour les fiches par sous-catégorie
     */
    public function scopeBySousCategory($query, $sousCategoryId)
    {
        return $query->where('fiches_sous_category_id', $sousCategoryId);
    }

    /**
     * Scope pour les fiches visibles selon l'utilisateur
     */
    public function scopeVisibleTo($query, $user = null)
    {
        return $query->where(function ($q) use ($user) {
            // Fiches publiques et authentifiées publiées
            $q->where('is_published', true)
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now())
                ->whereIn('visibility', ['public', 'authenticated']);

            // Si admin/editor, voir toutes les fiches
            if ($user && ($user->hasRole('admin') || $user->hasRole('editor'))) {
                $q->orWhere(function ($subQ) {
                    $subQ->whereIn('is_published', [false, true]);
                });
            }
        });
    }

    /**
     * Vérifier si l'utilisateur peut voir le contenu
     */
    public function canViewContent($user = null): bool
    {
        // Admins/editors voient toujours le contenu
        if ($user && ($user->hasRole('admin') || $user->hasRole('editor'))) {
            return true;
        }

        // Si non publié, seuls les admins peuvent voir
        if (!$this->is_published) {
            return false;
        }

        // Vérifier la visibilité
        if ($this->visibility === 'public') {
            return true;
        }

        if ($this->visibility === 'authenticated') {
            return $user !== null;
        }

        return false;
    }

    /**
     * Obtenir le message d'accès pour le contenu restreint
     */
    public function getAccessMessage($user = null): string
    {
        if ($this->visibility === 'public') {
            return 'Ce contenu est accessible à tous.';
        }

        if ($this->visibility === 'authenticated') {
            if (!$user) {
                return 'Connectez-vous pour accéder à l\'intégralité de cette fiche.';
            }

            return 'Ce contenu est réservé aux membres authentifiés.';
        }

        return 'Accès au contenu non autorisé.';
    }

    /**
     * Obtenir l'URL complète de cette fiche
     */
    public function getUrlAttribute(): string
    {
        if ($this->category) {
            return route('public.fiches.show', [
                'category' => $this->category->slug,
                'fiche' => $this->slug
            ]);
        }
        return '#';
    }

    /**
     * Obtenir un extrait du contenu
     */
    public function getExcerptAttribute(): string
    {
        if ($this->short_description) {
            return strip_tags($this->short_description);
        }

        return Str::limit(strip_tags($this->long_description), 160);
    }

    /**
     * Incrémenter le compteur de vues
     */
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    /**
     * Clé de route pour la liaison du modèle
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}