@extends('app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Bienvenue sur CookHub !') }}</div>

                    <div class="card-body">
                        @auth
                            <p>Bonjour, {{ Auth::user()->name }} ! Vous êtes connecté(e) sur votre compte.</p>
                            <p>Commencez à explorer des recettes et à créer les vôtres !</p>
                        @else
                            <p>Bienvenue sur CookHub ! Veuillez vous connecter pour accéder à toutes les fonctionnalités.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
                            <a href="{{ route('register') }}" class="btn btn-secondary">S'inscrire</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
