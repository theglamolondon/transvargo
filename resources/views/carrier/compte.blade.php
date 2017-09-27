@extends('layouts._site')

@section('content')
<section class="section section-inset-1">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <h3 class="titre">Mon compte</h3>
                <div class="separateur"></div>

                <form class="form-horizontal col-md-8" action="{{ route('update.transporteur') }}" method="post">
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
                            <input type="text" placeholder="Votre nom..." id="nom" name="nom" class="form-control" value="{{old('nom')}}" required>
                        </div>
                    </div>

                    <div class="nav nav-tabs"></div>
                    <br/>

                    <div class="form-group date">
                        <label for="datenaissance" class="control-label col-md-4 col-sm-6 col-xs-12">Date de naissance *</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <div class="input-group">
                                <input type="text" required class="form-control datepicker" data-date-format="dd/mm/yyyy" name="datenaissance" id="datenaissance" data-date-end-date="-18y" value="{{ old('datenaissance',\Carbon\Carbon::now()->addYear(-18)->format('d/m/Y')) }}">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Lieu de naissance *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Lieu de naissance..." id="lieunaissance" name="lieunaissance" class="form-control" value="{{old('lieunaissance')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Nationnalité *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Nationalité..." id="nationalite" name="nationalite" class="form-control" value="{{old('nationalite')}}" required>
                        </div>
                    </div>

                    <div class="nav nav-tabs"></div>
                    <br/>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Raison sociale *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input class="form-control" name="raisonsociale" type="text" placeholder="Votre raison sociale" value="{{old('raisonsociale')}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Compte contribuable</label>
                        <div class="col-sm-8 col-xs-12">
                            <input class="form-control" name="comptecontribuable" type="text" placeholder="Votre compte contribuable" value="{{old('comptecontribuable')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Contact *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input class="form-control" name="contact" type="text" placeholder="Votre contact..." value="{{old('contact')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Ville *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Ville..." id="ville" name="ville" class="form-control" value="{{old('ville')}}" required>
                        </div>
                    </div>

                    <div class="nav nav-tabs"></div>
                    <br/>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Identifiant *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Email ou n° de téléphone" id="email" name="email" class="form-control" value="{{old('email')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Mot de passe *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="password" placeholder="Mot de passe..." id="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Confirmation *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="password" placeholder="Confirmation mot de passe" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <div class="nav nav-tabs"></div>
                    <br/>

                    <div class="form-group">
                        <div class="col-sm-1 col-xs-2">
                            <input type="radio" name="typetransporteur_id" class="form-control" value="{{ \App\TypeTransporteur::TYPE_CHAUFFEUR_PATRON }}" @if(old('typetransporteur_id') == \App\TypeTransporteur::TYPE_CHAUFFEUR_PATRON ) checked @endif>
                        </div>
                        <label class="col-sm-5 col-xs-4">
                            <strong>Chauffeur patron</strong>
                            <p>
                                <small>Si vous possedez un seul véhicule de transport (quelque soit le type) et que vous êtes vous même le conducteur du véhicule,
                                    alors cette option est faite pour vous.</small>
                            </p>
                        </label>

                        <div class="col-sm-1 col-xs-2">
                            <input type="radio" name="typetransporteur_id" class="form-control" value="{{ \App\TypeTransporteur::TYPE_PROPRIETAIRE_FLOTTE }} @if(old('typetransporteur_id') == \App\TypeTransporteur::TYPE_PROPRIETAIRE_FLOTTE ) checked @endif">
                        </div>
                        <label class="col-sm-5 col-xs-4">
                            <strong>Proprétaire de flotte</strong>
                            <p>
                                <small class="small">Si vous possedez plusieurs véhicules (quelque soit le type) et/ou plusieurs chauffeurs,
                                    alors cette option est faite pour vous.</small>
                            </p>
                        </label>
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

                    <div class="photo">
                        <img src="" id="pp" />
                        <input name="pp-input" id="pp-input" type="file" >
                    </div>

                    <h3>Compte professionnel</h3>
                    <div class="separateur"></div>
                    <p class="text-sm-left description">Accéder à des centaines d’offres  gratuitement sur notre plateforme et augmenter vos revenus.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection