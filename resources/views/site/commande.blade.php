@extends('layouts._site')

@section('content')
    <div class="container bg-light">
        <div class="row">
            <div class="col-xs-12 box">
                <div class="ibox-content clearfix steps">
                    <div class="col-md-4 col-xs-4">
                        <div class="step">
                            <div class="round">
                                <div class="ring one"></div>
                                <div class="cutout">
                                    <h3 class="time">1</h3>
                                </div>
                            </div>
                            <h3 class="title">Tarif définitif</h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-4">
                        <div class="step active">
                            <div class="round">
                                <div class="ring one"></div>
                                <div class="ring two"></div>
                                <div class="cutout">
                                    <h3 class="time">2</h3>
                                </div>
                            </div>
                            <h3 class="title">Commande</h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-4">
                        <div class="step">
                            <div class="round">
                                <div class="ring one"></div>
                                <div class="ring two"></div>
                                <div class="ring three"></div>
                                <div class="ring four"></div>
                                <div class="cutout">
                                    <h3 class="time">3</h3>
                                </div>
                            </div>
                            <h3 class="title">Confirmation</h3>
                        </div>
                    </div>
                </div>

                <br/> <br/>

                @foreach($errors->all() as $erreur)
                    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>{{ $erreur }}</div>
                @endforeach

                <form class="form-horizontal col-md-8" action="{{ route('register') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-sm-4">Prénoms</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Votre prénom..." id="prenoms" name="prenoms" class="form-control" value="{{old('prenoms')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Nom *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Votre nom..." id="nom" name="nom" class="form-control" value="{{old('nom')}}">
                        </div>
                    </div>

                    <div class="nav nav-tabs"></div>
                    <br/>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Raison sociale</label>
                        <div class="col-sm-8 col-xs-12">
                            <input class="form-control" name="raisonsociale" type="text" placeholder="Votre raison sociale" value="{{old('raisonsociale')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">N° téléphone *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input class="form-control" name="contact" type="text" placeholder="Votre contact..." value="{{old('contact')}}" required>
                        </div>
                    </div>

                    <div class="nav nav-tabs"></div>
                    <br/>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Email *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="email" placeholder="email..." id="email" name="email" class="form-control" value="{{old('email')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Mot de passe *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="password" placeholder="Mot de passe..." id="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Connfirmation *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="password" placeholder="Confirmation mot de passe" id="password_confirmation" name="password_confirmation" class="form-control">
                        </div>
                    </div>

                    <div class="nav nav-tabs"></div>
                    <br/>

                    <div class="form-group">
                        <div class="col-sm-12 col-xs-12">
                            <input name="terms" type="checkbox" value="1">
                            En cliquant ici, vous acceptez <a class="" href="{{ route('terms') }}">les termes et conditions d'utilisations</a>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg">Inscription</button>
                </form>


                <div class="col-md-offset-1 col-md-3">
                    <h3 >Compte client</h3>
                    <div class="separateur"></div>
                    <p class="text-sm-left description">Un compte client vous permet de faire des demandes de transport de marchandises à une grande flotte de transporteurs disponible sur notre plateforme. Vous bénéficiez d'un service
                        unique de qualité sans limitation en nombre de demande et à coût réduits.</p>
                </div>

            </div>
        </div>
    </div>
@endsection