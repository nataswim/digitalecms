<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class MediaCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'slug', 
        'description', 
        'color', 
        'order', 
        'is_active', 
        'created_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relation avec les médias
     */
    public function media()
    {
        return $this->hasMany(Media::class);
    }

    /**
     * Relation avec le créateur
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Générer automatiquement le slug
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    /**
     * Scope pour les catégories actives
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope ordonné
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (auth()->check()) {
                $category->created_by = auth()->id();
            }
        });
    }
}