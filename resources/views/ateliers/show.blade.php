@extends('app')

@section('content')
    <div class="container">
        <h2>{{ $atelier->nom }}</h2>
        <p>{{ $atelier->description }}</p>
        <p><strong>Date : </strong>{{ $atelier->date }}</p>
        <p><strong>Durée : </strong>{{ $atelier->duree }} minutes</p>

        <h4>Participants</h4>
        @if($atelier->participants && $atelier->participants->count())
            <ul>
                @foreach($atelier->participants as $participant)
                    <li>{{ $participant->name }}</li>
                @endforeach
            </ul>
        @else
            <p>Aucun participant pour cet atelier.</p>
        @endif

        @auth
            <form action="{{ route('ateliers.addParticipant', $atelier->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Rejoindre cet atelier</button>
            </form>
        @else
            <p><a href="{{ route('login') }}">Connectez-vous</a> pour rejoindre cet atelier.</p>
        @endauth
    </div>
@endsection
