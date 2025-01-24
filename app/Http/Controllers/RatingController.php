<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Recette;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'recette_id' => 'required|exists:recettes,id',
            'note' => 'required|integer|between:1,5',
            'commentaire' => 'nullable|string|max:255',
        ]);

        // Création de la note
        $rating = new Rating();
        $rating->recette_id = $validated['recette_id'];
        $rating->user_id = auth()->id();
        $rating->note = $validated['note'];
        $rating->commentaire = $validated['commentaire'];
        $rating->save();

        // Redirection vers la page de la recette après avoir ajouté la note
        return redirect()->route('recettes.show', ['id' => $validated['recette_id']]);
    }


}
