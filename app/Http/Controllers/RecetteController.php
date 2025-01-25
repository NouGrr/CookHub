<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecetteController extends Controller
{
    public function index()
    {
        // Récupérer toutes les recettes (ou avec un filtrage si nécessaire)
        $recettes = Recette::all();

        // Retourner la vue avec les recettes
        return view('recettes.index', compact('recettes'));
    }

    public function create()
    {
        return view('recettes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'etapes' => 'required|string',
            'instructions' => 'nullable|string',  // Validation de l'instruction
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Stockage de l'image dans le répertoire public/images
            $imagePath = $request->file('image')->store('images', 'public'); // Utilisation du disque public
        } else {
            $imagePath = null;
        }

        $recette = new Recette();
        $recette->titre = $request->input('titre');
        $recette->description = $request->input('description');
        $recette->ingredients = json_encode(explode(',', $request->input('ingredients')));
        $recette->etapes = $request->input('etapes');
        $recette->instructions = $request->input('instructions') ?: 'Aucune instruction';  // Valeur par défaut
        $recette->temps_cuisson = $request->input('temps_cuisson') ?: 0;
        $recette->image = $imagePath;
        $recette->user_id = auth()->id();
        $recette->save();

        return redirect()->route('recette.index')->with('success', 'Recette créée avec succès!');
    }

    public function show($id)
    {
        $recette = Recette::with('ratings')->findOrFail($id);

        return view('recettes.show', compact('recette'));
    }


    public function edit($user_id)
    {
        $recette = Recette::findOrFail($user_id);
        return view('recettes.edit', compact('recette'));
    }

    public function update(Request $request, $user_id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'etapes' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $recette = Recette::findOrFail($user_id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $recette->image = $imagePath;
        }

        $recette->titre = $request->input('titre');
        $recette->description = $request->input('description');
        $recette->ingredients = json_encode(explode(',', $request->input('ingredients')));
        $recette->etapes = $request->input('etapes');
        $recette->save();

        return redirect()->route('recette.index')->with('success', 'Recette mise à jour avec succès!');
    }

    public function destroy($user_id)
    {
        // Trouver la recette par son id
        $recette = Recette::where('user_id', $user_id)->firstOrFail();  

        // Supprimer la recette
        $recette->delete();

        // Rediriger vers la page d'index des recettes avec un message de succès
        return redirect()->route('recette.index')->with('success', 'Recette supprimée avec succès.');
    }

    public function rate(Request $request, $user_id)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
        ]);

        $recette = Recette::findOrFail($id);

        // Vérifier si l'utilisateur a déjà noté
        $rating = $recette->ratings()->where('user_id', auth()->id())->first();

        if ($rating) {
            $rating->update(['note' => $request->input('note')]);
        } else {
            $recette->ratings()->create([
                'user_id' => auth()->id(),
                'note' => $request->input('note'),
            ]);
        }

        // Recalculer la note moyenne
        $recette->note_moyenne = $recette->ratings()->avg('note');
        $recette->nombre_notes = $recette->ratings()->count();
        $recette->save();

        session()->flash('success', 'Recette créée avec succès!');

        return redirect()->route('recette.index', $id)->with('success', 'Votre note a été enregistrée.');
    }

}
