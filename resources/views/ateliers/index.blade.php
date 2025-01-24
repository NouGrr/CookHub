@extends('app')

@section('content')
    <div class="container">
        <h2>Liste des Ateliers</h2>

        <!-- Ajouter un bouton pour créer un atelier -->
        <a href="{{ route('ateliers.create') }}" class="btn btn-success mb-3">Créer un atelier</a>

        @if($ateliers && $ateliers->count())
            <ul>
                @foreach($ateliers as $atelier)
                    <li>
                        <h3>{{ $atelier->nom }}</h3>
                        <p>{{ $atelier->description }}</p>
                        <a href="{{ route('ateliers.show', $atelier->id) }}" class="btn btn-info">Voir l'atelier</a>
                        <!-- Formulaire de suppression -->
                        <form action="{{ route('ateliers.destroy', $atelier->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet atelier ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer l'atelier</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Aucun atelier trouvé.</p>
        @endif

    </div>
@endsection
