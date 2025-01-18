@extends('app')

@section('content')
<div class="container">
    <h2 class="mb-4">Créer une nouvelle recette</h2>
    <form action="{{ route('recette.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="ingredients">Ingrédients (séparés par une virgule)</label>
            <input type="text" name="ingredients" id="ingredients" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="etapes">Étapes de préparation</label>
            <textarea name="etapes" id="etapes" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image (facultative)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Créer la recette</button>
    </form>
</div>
@endsection
