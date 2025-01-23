<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    use HasFactory;

    protected $table = 'recettes'; // Spécifie le nom de la table si elle n'est pas le pluriel par défaut
    protected $fillable = [
        'titre',
        'description',
        'ingredients',
        'instructions',
        'temps_preparation',
        'temps_cuisson',
        'difficulte',
    ];
}
