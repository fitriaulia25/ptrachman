<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'can_edit', 'can_delete', 'photo'
    ];

    // Metode untuk memeriksa peran
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class); // Asumsi Anda memiliki model Role
    }
}
