@extends('app')

@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Liste des Recettes</h2>

    <!-- Si des recettes existent -->
    @if($recettes->count())
        <div class="row">
            @foreach($recettes as $recette)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($recette->image)
                        <img src="{{ Storage::url($recette->image) }}" class="card-img-top" alt="Image de la recette">
                    @else
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Image par défaut">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $recette->titre }}</h5>
                        <p class="card-text">{{ Str::limit($recette->description, 100) }}</p>
                        
                        <!-- Lien vers la page de détails de la recette -->
                        <a href="{{ route('recettes.show', $recette->id) }}" class="btn btn-primary mb-2">Voir la recette</a>
                        
                        <!-- Formulaire de suppression -->
                        <form action="{{ route('recettes.destroy', $recette->user_id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer la recette</button>
                        </form>

                        <!-- Formulaire de note -->
                        <form action="{{ route('ratings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="recette_id" value="{{ $recette->id }}">
                            
                            <div class="form-group">
                                <label for="note">Note</label>
                                <select name="note" id="note" class="form-control" required>
                                    <option value="">Sélectionnez une note</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="commentaire">Commentaire</label>
                                <textarea name="commentaire" id="commentaire" class="form-control" rows="3" maxlength="255"></textarea>
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Soumettre</button>
                        </form>
                        
                        <!-- Affichage de la note moyenne -->
                        <p class="card-text">
                            @if($recette->ratings && $recette->ratings->count() > 0)
                                Note moyenne : {{ number_format($recette->ratings->avg('note'), 1) }} ({{ $recette->ratings->count() }} avis)
                            @else
                                Aucune note pour cette recette
                            @endif
                        </p>

                        <!-- Affichage des commentaires -->
                        @if($recette->ratings && $recette->ratings->count() > 0)
                            <div class="mt-2">
                                <h6>Commentaires :</h6>
                                @foreach($recette->ratings as $rating)
                                    <p><strong>{{ $rating->user->name }} :</strong> {{ $rating->commentaire ?? 'Aucun commentaire' }}</p>
                                @endforeach
                            </div>
                        @endif  
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <p class="text-center">Aucune recette disponible pour le moment.</p>
    @endif
</div>
@endsection
