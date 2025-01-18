@extends('app')

@section('content')
    <div class="container mt-5">
        <!-- Affichage de la recette -->
        <div class="row">
            <div class="col-md-8">
                <!-- Titre de la recette -->
                <h1>{{ $recette->titre }}</h1>

                <!-- Note moyenne -->
                <p>
                    <strong>Note moyenne : </strong>
                    {{ number_format($recette->note_moyenne, 1) }} / 5
                </p>

                <!-- Image de la recette -->
                @if($recette->image)
                    <img src="{{ asset('storage/' . $recette->image) }}" class="img-fluid" alt="{{ $recette->titre }}">
                @else
                    <img src="https://via.placeholder.com/800x400" class="img-fluid" alt="Image de la recette">
                @endif

                <!-- Description de la recette -->
                <h4>Description</h4>
                <p>{{ $recette->description }}</p>

                <!-- Ingrédients -->
                <h4>Ingrédients</h4>
                <ul>
                    @foreach(json_decode($recette->ingredients) as $ingredient)
                        <li>{{ $ingredient }}</li>
                    @endforeach
                </ul>

                <!-- Étapes de préparation -->
                <h4>Étapes de préparation</h4>
                <ol>
                    @foreach(explode("\n", $recette->etapes) as $etape)
                        <li>{{ $etape }}</li>
                    @endforeach
                </ol>
            </div>

            <div class="col-md-4">
                <!-- Section pour les avis utilisateurs (facultatif) -->
                <div class="card">
                    <div class="card-header">
                        Avis des utilisateurs
                    </div>
                    <div class="card-body">
                        <!-- Formulaire de notation et commentaires -->
                        <form action="{{ route('recette.commenter', $recette->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="note" class="form-label">Note :</label>
                                <input type="number" class="form-control" id="note" name="note" min="1" max="5" required>
                            </div>
                            <div class="mb-3">
                                <label for="commentaire" class="form-label">Commentaire :</label>
                                <textarea class="form-control" id="commentaire" name="commentaire" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection