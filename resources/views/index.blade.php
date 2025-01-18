@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Liste des Recettes</h2>

            <!-- Bouton pour créer une recette -->
            <div class="text-center mb-4">
                <a href="{{ route('recette.create') }}" class="btn btn-success">Créer une recette</a>
            </div>

            <!-- Si il y a des recettes -->
            @if($recettes->count())
                <div class="row">
                    @foreach($recettes as $recette)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                @if($recette->image)
                                    <img src="{{ Storage::url('images/' . $recette->image) }}" class="card-img-top" alt="Image de la recette">
                                @else
                                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Image par défaut">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $recette->titre }}</h5>
                                    <p class="card-text">{{ Str::limit($recette->description, 100) }}</p>
                                    <a href="{{ route('recette.show', $recette->id) }}" class="btn btn-primary">Voir la recette</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center">Aucune recette n'est disponible pour le moment.</p>
            @endif
        </div>
    </div>
</div>
@endsection
