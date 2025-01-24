<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    // Les champs qui peuvent être remplis via l'attribution de masse
    protected $fillable = [
        'recette_id',
        'user_id',
        'note',
        'commentaire',
    ];

    /**
     * Relation avec le modèle Recette.
     */
    public function recette() 
    {
        return $this->belongsTo(Recette::class);
    }

    /**
     * Relation avec le modèle User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
