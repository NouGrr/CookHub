<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use Illuminate\Http\Request;

class RecetteController extends Controller
{
    /**
     * Affiche toutes les recettes.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupère toutes les recettes
        $recettes = Recette::all();

        // Retourne la vue avec les recettes
        return view('recettes.index', compact('recettes'));
    }

    /**
     * Affiche le formulaire pour créer une nouvelle recette.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('recettes.create'); // Vérifie que cette vue existe bien dans resources/views/recettes/create.blade.php
    }

    /**
     * Enregistre une nouvelle recette dans la base de données.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'etapes' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Traitement de l'image (si présente)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
        } else {
            $imagePath = null;
        }

        // Enregistrement de la recette dans la base de données
        $recette = new Recette();
        $recette->titre = $request->input('titre');
        $recette->description = $request->input('description');
        $recette->ingredients = json_encode(explode(',', $request->input('ingredients')));
        $recette->etapes = $request->input('etapes');
        $recette->image = $imagePath;
        $recette->user_id = auth()->id();
        $recette->save();

        // Redirige vers la page des recettes avec un message de succès
        return redirect()->route('recette.index')->with('success', 'Recette créée avec succès!');
    }

    /**
     * Affiche une recette spécifique.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Récupère la recette par son ID
        $recette = Recette::findOrFail($id);

        // Retourne la vue de la recette avec les détails
        return view('recettes.show', compact('recette'));
    }

    /**
     * Affiche le formulaire pour modifier une recette existante.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Récupère la recette à modifier
        $recette = Recette::findOrFail($id);

        // Retourne la vue d'édition avec les données de la recette
        return view('recettes.edit', compact('recette'));
    }

    /**
     * Met à jour une recette existante.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'etapes' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Récupère la recette existante
        $recette = Recette::findOrFail($id);

        // Traitement de l'image (si présente)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $recette->image = $imagePath;
        }

        // Mise à jour des données de la recette
        $recette->titre = $request->input('titre');
        $recette->description = $request->input('description');
        $recette->ingredients = json_encode(explode(',', $request->input('ingredients')));
        $recette->etapes = $request->input('etapes');
        $recette->save();

        // Redirige vers la page des recettes avec un message de succès
        return redirect()->route('recette.index')->with('success', 'Recette mise à jour avec succès!');
    }

    /**
     * Supprime une recette.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Récupère la recette à supprimer
        $recette = Recette::findOrFail($id);

        // Supprime la recette
        $recette->delete();

        // Redirige vers la page des recettes avec un message de succès
        return redirect()->route('recette.index')->with('success', 'Recette supprimée avec succès!');
    }
}
