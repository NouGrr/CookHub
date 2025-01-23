<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecetteController extends Controller
{
    public function index()
    {
        $recettes = Recette::all();
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
            $imagePath = $request->file('image')->store('public/images');
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
        $recette = Recette::findOrFail($id);  // On récupère la recette par son ID
        return view('recettes.show', compact('recette'));
    }

    public function edit($id)
    {
        $recette = Recette::findOrFail($id);
        return view('recettes.edit', compact('recette'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'etapes' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $recette = Recette::findOrFail($id);

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

    public function destroy($id)
{
    $recette = Recette::findOrFail($id);

    // Supprimer l'image associée si elle existe
    if ($recette->image && Storage::exists($recette->image)) {
        Storage::delete($recette->image);
    }

    // Supprimer la recette
    $recette->delete();

    return redirect()->route('recette.index')->with('success', 'Recette supprimée avec succès!');
}
}
