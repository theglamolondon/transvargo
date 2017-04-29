@extends('layouts._site')

@section('content')
    <section class="bg-light section-lg">
        <ol class="breadcrumb">
            <li class="active">Inscription professionnel du transport</li>
        </ol>
    </section>
    <section class="section section-inset-1">
        <div class="container">
            <div class="">
                <h3>Creation de compte professionnel</h3>
                <p>Un compte professionnel de transport vous permet d'être alerté des demandes que les clients feront sur la plateforme et vous permettra d'y répondre. Vous bénéficiez d'un service
                    unique de qualité sans limitation en nombre de demande et à coûts réduits.</p>
                <p>Si vous souhaiter plutôt faire des demande de transport, alors <a href="{{ route('register') }}" class="">veuillez vous inscrire ici</a> et faites vos demande de transport de marchandises.</p>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">

                    @foreach($errors->all() as $erreur)
                        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>{{ $erreur }}</div>
                    @endforeach

                    <form class="form-horizontal" action="{{ route('register.transporteur') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12">
                                <input type="text" placeholder="Votre prénom..." id="prenoms" name="prenoms" class="form-control" value="{{old('prenoms')}}">
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <input type="text" placeholder="Votre nom..." id="nom" name="nom" class="form-control" value="{{old('nom')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12">
                                <input type="email" placeholder="email..." id="email" name="email" class="form-control" value="{{old('email')}}">
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <input class="form-control" name="raisonsociale" type="text" placeholder="Votre raison sociale" value="{{old('raisonsociale')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12">
                                <input class="form-control" name="comptecontribuable" type="text" placeholder="Votre compte contribuable" value="{{old('comptecontribuable')}}">
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <input class="form-control" name="contact" type="text" placeholder="Votre contact..." value="{{old('contact')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12">
                                <select class="form-control" name="pays">
                                    @foreach($countries as $pays)
                                    <option value="{{ $pays->id }}" @if(old('pays') == $pays->id) selected @endif>{{ $pays->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <select class="form-control" name="ville_id">
                                    @foreach($villes as $ville)
                                    <option value="{{ $ville->id }}" @if(old('ville_id') == $ville->id) selected @endif>{{ $ville->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12">
                                <input type="password" placeholder="Mot de passe..." id="password" name="password" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <input type="password" placeholder="Confirmation mot de passe" id="password_confirmation" name="password_confirmation" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-1 col-xs-2">
                                <input type="radio" name="typetransporteur_id" class="form-control" value="{{ \App\TypeTransporteur::TYPE_CHAUFFEUR_PATRON }}" @if(old('typetransporteur_id') == \App\TypeTransporteur::TYPE_CHAUFFEUR_PATRON ) checked @endif>
                            </div>
                            <label class="col-sm-5 col-xs-4">
                                <strong>Chauffeur patron</strong>
                                <p>
                                    <small class="description">Si vous possedez un seul véhicule de transport (quelque soit le type) et que vous êtes vous même le conducteur du véhicule,
                                    alors cette option est faite pour vous.</small>
                                </p>
                            </label>

                            <div class="col-sm-1 col-xs-2">
                                <input type="radio" name="typetransporteur_id" class="form-control" value="{{ \App\TypeTransporteur::TYPE_PROPRIETAIRE_FLOTTE }} @if(old('typetransporteur_id') == \App\TypeTransporteur::TYPE_PROPRIETAIRE_FLOTTE ) checked @endif">
                            </div>
                            <label class="col-sm-5 col-xs-4">
                                <strong>Proprétaire de flotte</strong>
                                <p>
                                    <small class="description">Si vous possedez plusieurs véhicules (quelque soit le type) et/ou plusieurs chauffeurs,
                                    alors cette option est faite pour vous. Vous aurez la possibilité de </small>
                                </p>
                            </label>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 col-xs-12">
                                <input name="terms" type="checkbox" value="1">
                                En cliquant ici, vous acceptez <a class="" href="{{ route('terms') }}">les termes et conditions d'utilisations</a>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg">Inscription</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection