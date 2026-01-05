<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_user')
            ->withTimestamps();
    }

    public function hasRole(string $roleSlug): bool
    {
        return $this->role?->slug === $roleSlug;
    }

    public function hasPermission(string $permissionSlug): bool
    {
        // Vérifier permission directe
        if ($this->permissions()->where('slug', $permissionSlug)->where('is_active', true)->exists()) {
            return true;
        }

        // Vérifier permission via rôle
        return $this->role?->hasPermission($permissionSlug) ?? false;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
}