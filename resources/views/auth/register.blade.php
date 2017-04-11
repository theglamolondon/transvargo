@extends('layouts._site')

@section('content')
    <section class="bg-light section-lg">
        <ol class="breadcrumb">
            <li class="active">Inscription nouvel utilisateur</li>
        </ol>
    </section>
    <section class="section section-inset-1">
        <div class="container">
            <h2>Creation de de compte</h2>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <div class="row offset-5">
                        <div class="col-lg-6 col-lg-offset-3">
                            <form class="rd-mailform login-form" action="{{ route('register') }}" method="post">
                                {{ csrf_field() }}
                                <div class="mfInput">
                                    <label for="prenoms"></label>
                                    <input type="text" placeholder="Votre prénom..." id="prenoms" name="prenoms" class="form-control">
                                </div>
                                <div class="mfInput">
                                    <label for="nom"></label>
                                    <input type="text" placeholder="Votre nom..." id="nom" name="nom" class="form-control">
                                </div>
                                <div class="mfInput">
                                    <label for="email"></label>
                                    <input type="email" placeholder="email..." id="email" name="email" class="form-control">
                                </div>
                                <div class="mfInput">
                                    <label for="password"></label>
                                    <input type="password" placeholder="Mot de passe..." id="password" name="password" class="form-control">
                                </div>
                                <div class="mfInput">
                                    <label for="password_confirm"></label>
                                    <input type="password" placeholder="Confirmation mot de passe" id="password_confirm" name="password_confirm" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg">Inscription</button>
                            </form>
                            <p class="text-uppercase text-gray offset-7">ou</p>
                        </div>
                    </div>
                    <div class="btn-group-variant"><a href="#" class="btn btn-info-2 btn-sm btn-icon"><span class="icon fa-facebook"></span> Facebook</a><a href="#" class="btn btn-info btn-sm btn-icon"><span class="icon fa-twitter"></span> Twitter</a><a href="#" class="btn btn-danger btn-sm btn-icon"><span class="icon fa-google-plus"></span> Google+</a></div>
                </div>
            </div>
        </div>
    </section>
@endsection