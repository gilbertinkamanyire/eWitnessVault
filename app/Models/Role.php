<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;

    // Table name (optional if using default 'roles')
    protected $table = 'roles';

    // Fillable fields
    protected $fillable = [
        'name',       // e.g., Admin, Judge, Investigator, Lawyer
        'description' // optional description
    ];

    /**
     * Many-to-Many relationship with users
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id');
    }
}
