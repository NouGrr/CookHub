@extends('app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">{{ $recette->titre }}</h2>

    <div class="row">
        <div class="col-md-8">
            <h3>Description</h3>
            <p>{{ $recette->description }}</p>

            <h3>Ingrédients</h3>
            <ul>
                @foreach(json_decode($recette->ingredients) as $ingredient)
                    <li>{{ $ingredient }}</li>
                @endforeach
            </ul>

            <h3>Étapes</h3>
            <p>{{ $recette->etapes }}</p>
        </div>
        <div class="col-md-4">
            @if($recette->image)
                <img src="{{ Storage::url('images/' . $recette->image) }}" class="img-fluid" alt="Image de la recette">
            @else
                <img src="https://via.placeholder.com/150" class="img-fluid" alt="Image par défaut">
            @endif
        </div>
    </div>
</div>
@endsection
