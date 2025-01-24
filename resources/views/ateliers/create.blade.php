@extends('app')

@section('content')
    <div class="container">
        <h2>Créer un nouvel atelier</h2>

        <!-- Affichage des erreurs de validation -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ateliers.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nom">Nom de l'atelier</label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="date">Date de l'atelier</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
            </div>

            <div class="form-group">
                <label for="heure">Heure de l'atelier</label>
                <input type="time" name="heure" id="heure" class="form-control" value="{{ old('heure') }}" required>
            </div>

            <div class="form-group">
                <label for="duree">Durée (en minutes)</label>
                <input type="number" name="duree" id="duree" class="form-control" value="{{ old('duree') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Créer l'atelier</button>
        </form>
    </div>
@endsection
