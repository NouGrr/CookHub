<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Champs remplissables
    protected $fillable = ['name', 'email', 'password', 'is_admin'];

    // Champs cachés dans les tableaux
    protected $hidden = ['password', 'remember_token'];

    // Type des colonnes
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
