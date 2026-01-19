<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'first_name',
        'last_name',
        'password',
        'avatar',
        'phone',
        'bio',
        'email_verification_token',
        'last_ip',
        'last_login_at',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verification_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Cache des permissions chargées
     */
    protected ?Collection $cachedPermissions = null;

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_user')
            ->withTimestamps();
    }

    /**
     * Récupère toutes les permissions (directes + via rôle) avec CACHE
     */
    public function getAllPermissions(): Collection
    {
        if ($this->cachedPermissions !== null) {
            return $this->cachedPermissions;
        }

        // Permissions directes actives
        $directPermissions = $this->permissions()
            ->where('is_active', true)
            ->get();

        // Permissions via le rôle (avec eager loading)
        $rolePermissions = collect();
        if ($this->role) {
            $rolePermissions = $this->role->permissions()
                ->where('is_active', true)
                ->get();
        }

        // Fusionner et dédupliquer par ID
        $this->cachedPermissions = $directPermissions
            ->merge($rolePermissions)
            ->unique('id');

        return $this->cachedPermissions;
    }

    /**
     * Vérifie si l'utilisateur a une permission (OPTIMISÉ)
     */
    public function hasPermission(string $permissionSlug): bool
    {
        return $this->getAllPermissions()
            ->contains('slug', $permissionSlug);
    }

    public function hasRole(string $roleSlug): bool
    {
        return $this->role?->slug === $roleSlug;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Vide le cache des permissions (après modification)
     */
    public function clearPermissionCache(): void
    {
        $this->cachedPermissions = null;
    }
}