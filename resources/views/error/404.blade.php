@extends('layouts._site')
@section('content')
    <div class="row page-head bg-maintenance height">
        <div class="col-xs-12 col-md-10 col-md-offset-1 page-head">
            <div class="jumbotron text-center">
                <h1><small>404</small><span class='text-bold'>page non trouvée</span></h1>
                <p></p>
                <p class="h5 fw-l">La page que vous essayez d'afficher est temporairement indisponible ou a été retirée. Vérifier aussi si votre URL ne comporte pas de d'erreur.</p>
                <a href="{{ route('accueil') }}" class="btn btn-sm btn-primary">retour à la page d'accueil</a>
            </div>
        </div>
    </div>
@endsection