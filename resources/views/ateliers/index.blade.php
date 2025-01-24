@extends('app')

@section('content')
    <style>
        /* Style global pour le corps */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
        }

        /* Conteneur principal */
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Titres */
        h1, h2, h3, h4 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: bold;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            font-size: 2.5rem;
        }

        h2 {
            font-size: 2rem;
            border-bottom: 2px solid #f4f4f9;
            padding-bottom: 5px;
        }

        /* Liens */
        a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        /* Liste */
        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        ul li:last-child {
            border-bottom: none;
        }

        /* Boutons */
        .button-container {
            position: relative;
            display: inline-block;
            padding: 10px 20px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #333;
            border: none;
            cursor: pointer;
            overflow: hidden;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
            margin-top: 10px;
            text-align: center;
        }

        .button-container:hover {
            background-color: #000000;
        }

        .border {
            position: absolute;
            background: none;
            transition: all 0.5s ease-in-out;
        }

        .border:nth-of-type(1) {
            top: 0;
            left: 0;
            border-left: 1px solid white;
            border-top: 1px solid white;
            width: 30px;
            height: 30px;
        }

        .border:nth-of-type(2) {
            bottom: 0;
            right: 0;
            border-right: 1px solid white;
            border-bottom: 1px solid white;
            width: 30px;
            height: 30px;
        }

        .button-container:hover .border {
            width: 102%;
            height: 105%;
        }
    </style>

    <div class="container">
        <h2>Liste des Ateliers</h2>

        @if($ateliers->count())
            <ul>
                @foreach($ateliers as $atelier)
                    <li>
                        <h3>{{ $atelier->nom }}</h3>
                        <p>{{ $atelier->description }}</p>
                        <a href="{{ route('ateliers.show', $atelier->id) }}" class="button-container">
                            Voir l'atelier
                            <div class="border"></div>
                            <div class="border"></div>
                        </a>
                        <!-- Formulaire de suppression -->
                        <form action="{{ route('ateliers.destroy', $atelier->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet atelier ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button-container">
                                Supprimer l'atelier
                                <div class="border"></div>
                                <div class="border"></div>
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Aucun atelier trouvé.</p>
        @endif

        <a href="{{ route('ateliers.create') }}" class="button-container">
            Créer un atelier
            <div class="border"></div>
            <div class="border"></div>
        </a>
    </div>
@endsection
