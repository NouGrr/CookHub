<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atelier extends Model
{
    use HasFactory;

    // Autoriser l'assignation de masse sur les champs spécifiés
    protected $fillable = [
        'nom',
        'description',
        'date',
        'duree',
    ];

    public function participants()
    {
        return $this->belongsToMany(User::class, 'atelier_user');
    }
}
