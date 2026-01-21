<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_name',
        'original_name',
        'mime_type',
        'path',
        'size',
        'metadata',
        'alt_text',
        'description',
        'media_category_id',
        'uploaded_by',
        'used_at'
    ];

    protected $casts = [
        'metadata' => 'array',
        'size' => 'integer',
        'used_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * AJOUT CRUCIAL : Ces attributs seront inclus dans les réponses JSON
     * C'est ce qui permet au JavaScript de lire "item.url"
     */
    protected $appends = [
        'url', 
        'full_url', 
        'formatted_size', 
        'is_image', 
        'dimensions'
    ];

    /**
     * Relation avec la catégorie
     */
    public function category()
    {
        return $this->belongsTo(MediaCategory::class, 'media_category_id');
    }

    /**
     * Relation avec l'uploader
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * URL publique du fichier
     * Utilisé par le sélecteur de média
     */
    public function getUrlAttribute()
    {
        if ($this->path && Storage::disk('public')->exists($this->path)) {
            return asset('storage/' . $this->path);
        }
        
        return asset('images/default-image.jpg');
    }

    /**
     * URL complète (avec domaine)
     */
    public function getFullUrlAttribute()
    {
        return $this->url;
    }

    /**
     * Taille formatée (ex: 1.2 MB)
     */
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->size;
        if ($bytes <= 0) return '0 B';
        
        $units = ['B', 'KB', 'MB', 'GB'];
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Vérifier si c'est une image
     */
    public function getIsImageAttribute()
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    /**
     * Dimensions de l'image
     */
    public function getDimensionsAttribute()
    {
        if ($this->is_image && isset($this->metadata['width'], $this->metadata['height'])) {
            return $this->metadata['width'] . ' × ' . $this->metadata['height'];
        }
        
        return null;
    }

    /**
     * Marquer comme utilisé
     */
    public function markAsUsed()
    {
        $this->update(['used_at' => now()]);
    }

    /**
     * Scopes pour filtrer les requêtes
     */
    public function scopeImages($query)
    {
        return $query->where('mime_type', 'like', 'image/%');
    }

    public function scopeInCategory($query, $categoryId)
    {
        return $query->where('media_category_id', $categoryId);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Boot method pour gérer les événements du modèle
     */
    protected static function boot()
    {
        parent::boot();

        // Attribuer automatiquement l'ID de l'utilisateur lors de l'upload
        static::creating(function ($media) {
            if (auth()->check()) {
                $media->uploaded_by = auth()->id();
            }
        });

        // Supprimer physiquement le fichier du disque lors de la suppression en BDD
        static::deleting(function ($media) {
            if ($media->path && Storage::disk('public')->exists($media->path)) {
                Storage::disk('public')->delete($media->path);
            }
        });
    }
}