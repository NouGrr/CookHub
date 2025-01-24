<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'titre',
        'description',
        'ingredients',
        'etapes',
        'instructions',
        'temps_cuisson',
        'image',
        'user_id',
    ];


    public function ratings() {
        return $this->hasMany(Rating::class, 'recette_id');
    }

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}