@extends('layouts._site')

@section('content')
    <section class="bg-light section-lg">
        <ol class="breadcrumb">
            <li class="active">Inscription nouvel utilisateur</li>
        </ol>
    </section>
    <section class="section section-inset-1">
        <div class="container">
            <h2>Creation de compte</h2>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <form class="form-horizontal" action="{{ route('register') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12">
                                <input type="text" placeholder="Votre prénom..." id="prenoms" name="prenoms" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <input type="text" placeholder="Votre nom..." id="nom" name="nom" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12">
                                <input type="email" placeholder="email..." id="email" name="email" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <input class="form-control" name="raisonsociale" type="text" placeholder="Votre raison sociale">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12">
                                <input class="form-control" name="contact" type="text" placeholder="Votre contact...">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12">
                                <select class="form-control" name="pays">
                                    @foreach($countries as $pays)
                                    <option value="{{ $pays->id }}">{{ $pays->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <select class="form-control" name="ville_id">
                                    @foreach($villes as $ville)
                                    <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12">
                                <input type="password" placeholder="Mot de passe..." id="password" name="password" class="form-control">
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <input type="password" placeholder="Confirmation mot de passe" id="password_confirm" name="password_confirm" class="form-control">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg">Inscription</button>
                    </form>

                    <p class="text-uppercase text-gray offset-7">ou</p>

                    <div class="btn-group-variant"><a href="#" class="btn btn-info-2 btn-sm btn-icon"><span class="icon fa-facebook"></span> Facebook</a><a href="#" class="btn btn-info btn-sm btn-icon"><span class="icon fa-twitter"></span> Twitter</a><a href="#" class="btn btn-danger btn-sm btn-icon"><span class="icon fa-google-plus"></span> Google+</a></div>
                </div>
            </div>
        </div>
    </section>
@endsection