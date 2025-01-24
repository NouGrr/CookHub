<?php

namespace App\Http\Controllers;

use App\Models\Atelier;
use Illuminate\Http\Request;

class AtelierController extends Controller
{
    // Afficher tous les ateliers
    public function index()
    {
        $ateliers = Atelier::all() ?: collect();
        return view('ateliers.index', compact('ateliers'));
    }

    // Afficher un atelier spécifique
    public function show($id)
    {
        $atelier = Atelier::findOrFail($id);
        return view('ateliers.show', compact('atelier'));
    }

    // Créer un nouvel atelier (afficher le formulaire)
    public function create()
    {
        return view('ateliers.create');
    }

    // Enregistrer un atelier dans la base de données
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'duree' => 'required|integer',
        ]);

        $atelier = Atelier::create($validated);
        return redirect()->route('ateliers.show', $atelier->id)->with('success', 'Atelier créé avec succès!');
    }

    // Supprimer un atelier
    public function destroy($id)
    {
        $atelier = Atelier::findOrFail($id);
        $atelier->delete();

        return redirect()->route('ateliers.index')->with('success', 'Atelier supprimé avec succès!');
    }

    // Ajouter un participant à un atelier
    public function addParticipant(Request $request, $id)
    {
        $atelier = Atelier::findOrFail($id);
        $user = auth()->user();
        $atelier->participants()->attach($user);

        session()->flash('success', 'Vous êtes inscrit(e) à l\'atelier avec succès!');
        return redirect()->route('ateliers.show', $atelier->id);
    }
}
