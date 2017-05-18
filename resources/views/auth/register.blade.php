@extends('layouts._site')

@section('content')
    <section class="section section-inset-1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <h3 class="titre">Inscription</h3>
                    <div class="separateur"></div>

                    @foreach($errors->all() as $erreur)
                        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>{{ $erreur }}</div>
                    @endforeach

                    <div class="form-group nav nav-tabs" role="tablist">
                        <label class="control-label col-md-2 col-sm-4 col-xs-4"> Vous êtes :</label>
                        <div class="col-md-3 col-sm-4 col-xs-4">
                            <input type="radio" name="iam" class="" id="chk-client" checked> un expéditeur
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-4">
                            <input type="radio" name="iam" class="" id="chk-transporteur"> un transporteur
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <br/>

                    <div class="tab-content" id="myTab">
                        <div id="client" class="tab-pane active">
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
                                    <label class="control-label col-sm-4">Confirmation *</label>
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
                        <div id="transporteur" class="tab-pane ">
                            <form class="form-horizontal col-md-8" action="{{ route('register.transporteur') }}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Prénoms</label>
                                    <div class="col-sm-8 col-xs-12">
                                        <input type="text" placeholder="Votre prénom..." id="prenoms" name="prenoms" class="form-control" value="{{old('prenoms')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Nom</label>
                                    <div class="col-sm-8 col-xs-12">
                                        <input type="text" placeholder="Votre nom..." id="nom" name="nom" class="form-control" value="{{old('nom')}}">
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

                                <div class="nav nav-tabs"></div>
                                <br/>

                                <div class="form-group">
                                    <label class="control-label col-sm-4">Pays</label>
                                    <div class="col-sm-8 col-xs-12">
                                        <select class="form-control" name="pays">
                                            @foreach($countries as $pays)
                                                <option value="{{ $pays->id }}" @if(old('pays') == $pays->id) selected @endif>{{ $pays->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Ville *</label>
                                    <div class="col-sm-8 col-xs-12">
                                        <select class="form-control" name="ville_id" required>
                                            @foreach($villes as $ville)
                                                <option value="{{ $ville->id }}" @if(old('ville_id') == $ville->id) selected @endif>{{ $ville->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="nav nav-tabs"></div>
                                <br/>

                                <div class="form-group">
                                    <label class="control-label col-sm-4">Email *</label>
                                    <div class="col-sm-8 col-xs-12">
                                        <input type="email" placeholder="email..." id="email" name="email" class="form-control" value="{{old('email')}}" required>
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
                                <h3>Compte professionnel</h3>
                                <div class="separateur"></div>
                                <p class="text-sm-left description">Un compte professionnel de transport vous permet d'être alerté des demandes que les clients feront sur la plateforme et vous permettra d'y répondre. Vous bénéficiez d'un service
                                    unique de qualité sans limitation en nombre de demande et à coûts réduits.</p>
                            </div>
                        </div>
                    </div>

                   </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="application/ecmascript">
        $('#chk-client').click(function () {
            $("#client").fadeIn();
            $("#transporteur").fadeOut();
        });

        $('#chk-transporteur').click(function () {
            $("#transporteur").fadeIn();
            $("#client").fadeOut();
        });
    </script>
@endsection