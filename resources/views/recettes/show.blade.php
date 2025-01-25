@extends('app')

@section('content')
    <div class="container mt-5">
        <h1>{{ $recette->titre }}</h1>
        <p>
            <strong>Note moyenne : </strong>
            {{ $recette->ratings->isNotEmpty() ? number_format($recette->ratings->avg('note'), 1) : 'Aucune note' }} / 5
        </p>
        
        @if($recette->image)
            <img src="{{ asset('storage/' . $recette->image) }}" class="img-fluid" alt="{{ $recette->titre }}">
        @else
            <img src="https://via.placeholder.com/800x400" class="img-fluid" alt="Image de la recette">
        @endif
        
        <h4>Description</h4>
        <p>{{ $recette->description }}</p>

        <h4>Ingrédients</h4>
        <ul>
            @foreach(json_decode($recette->ingredients) as $ingredient)
                <li>{{ $ingredient }}</li>
            @endforeach
        </ul>

        <h4>Étapes de préparation</h4>
        <ol>
            @foreach(explode("\n", $recette->etapes) as $etape)
                <li>{{ $etape }}</li>
            @endforeach
        </ol>

        <h4>Créé par :</h4>
        <p>{{ $recette->user->name ?? 'Utilisateur inconnu' }}</p>

        <h4>Donnez une note</h4>
        @auth
        <form action="{{ route('ratings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="recette_id" value="{{ $recette->user_id }}">
        
            <div class="mb-3">
                <label for="note" class="form-label">Votre note (entre 1 et 5)</label>
                <select name="note" id="note" class="form-select" required>
                    <option value="" disabled selected>Choisissez une note</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        
            <div class="mb-3">
                <label for="commentaire" class="form-label">Votre commentaire</label>
                <textarea name="commentaire" id="commentaire" class="form-control" rows="3"></textarea>
            </div>
        
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        @else
            <p><a href="{{ route('login') }}">Connectez-vous</a> pour donner une note.</p>
        @endauth
        </div>
    </div>
    
@endsection
