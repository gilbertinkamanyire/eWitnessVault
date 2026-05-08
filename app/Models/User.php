<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Evidence;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Fillable fields for mass assignment
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_verified',
        'role_requested',
    ];

    // Hidden fields when serializing
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casts
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

    /**
     * Relationship: A user can have many roles (Many-to-Many)
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    /**
     * Check if user has any role in array
     */
    public function hasAnyRole($roles)
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    /**
     * Relationship: User uploads many evidence files
     */
    public function evidence()
    {
        return $this->hasMany(Evidence::class, 'uploaded_by');
    }
}
