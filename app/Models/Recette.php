<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 'description', 'ingredients', 'etapes', 'image', 'user_id'
    ];

    protected $casts = [
        'ingredients' => 'array', // Convertit le champ JSON 'ingredients' en tableau
    ];
}
