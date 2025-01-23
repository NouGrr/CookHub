@extends('app')

@section('content')
    <div class="container mt-5">
        <h1>{{ $recette->titre }}</h1>
        <p><strong>Note moyenne : </strong>{{ number_format($recette->note_moyenne, 1) }} / 5</p>
        
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
    </div>
@endsection
