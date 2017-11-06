@extends('layouts._site')

@section('content')
<section class="section section-inset-1">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <h3 class="titre">Mon compte</h3>
                <div class="separateur"></div>

                <form class="form-horizontal col-md-8" action="{{ route('update.transporteur') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-sm-4">Prénoms</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Votre prénom..." id="prenoms" name="prenoms" class="form-control" value="{{old('prenoms', \Illuminate\Support\Facades\Auth::user()->transporteur->prenoms)}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Nom *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Votre nom..." id="nom" name="nom" class="form-control" value="{{old('nom', \Illuminate\Support\Facades\Auth::user()->transporteur->nom)}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Photo</label>
                        <div class="col-sm-8 col-xs-12">
                            <input name="photo" id="photo" class="form-control" type="file" >
                        </div>
                    </div>

                    <div class="nav nav-tabs"></div>
                    <br/>

                    <div class="form-group date">
                        <label for="datenaissance" class="control-label col-md-4 col-sm-6 col-xs-12">Date de naissance *</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <div class="input-group">
                                <input type="text" required class="form-control datepicker" data-date-format="dd/mm/yyyy" name="datenaissance" id="datenaissance" data-date-end-date="-18y" value="{{ old('datenaissance',(new \Carbon\Carbon(\Illuminate\Support\Facades\Auth::user()->transporteur->datenaissance))->format('d/m/Y')) }}">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Lieu de naissance *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Lieu de naissance..." id="lieunaissance" name="lieunaissance" class="form-control" value="{{old('lieunaissance', \Illuminate\Support\Facades\Auth::user()->transporteur->lieunaissance)}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Nationnalité *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Nationalité..." id="nationalite" name="nationalite" class="form-control" value="{{old('nationalite', \Illuminate\Support\Facades\Auth::user()->transporteur->nationalite)}}" required>
                        </div>
                    </div>

                    <div class="nav nav-tabs"></div>
                    <br/>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Raison sociale *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input class="form-control" name="raisonsociale" type="text" placeholder="Votre raison sociale" value="{{old('raisonsociale', \Illuminate\Support\Facades\Auth::user()->transporteur->raisonsociale)}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Compte contribuable</label>
                        <div class="col-sm-8 col-xs-12">
                            <input class="form-control" name="comptecontribuable" type="text" placeholder="Votre compte contribuable" value="{{old('comptecontribuable', \Illuminate\Support\Facades\Auth::user()->transporteur->comptecontribuable)}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Contact *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input class="form-control" name="contact" type="text" placeholder="Votre contact..." value="{{old('contact', \Illuminate\Support\Facades\Auth::user()->transporteur->contact)}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Ville *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Ville..." id="ville" name="ville" class="form-control" value="{{old('ville', \Illuminate\Support\Facades\Auth::user()->transporteur->ville)}}" required>
                        </div>
                    </div>

                    <div class="nav nav-tabs"></div>
                    <br/>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Identifiant *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Email ou n° de téléphone" id="email" disabled name="email" class="form-control" value="{{old('email', \Illuminate\Support\Facades\Auth::user()->email)}}" required>
                        </div>
                    </div>

                    <input name="passwordupdate" id="passwordupdate" type="checkbox" value="1"> Modifier le mot de passe

                    <div id="passwordToggle" class="" style="display: none;">
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
                    </div>

                    <div class="nav nav-tabs"></div>
                    <br/>

                    <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg">Mettre à jour</button>
                </form>
                <div class="col-md-offset-1 col-md-3">

                    <div class="photo">
                        <img src="{{asset("working/".\Illuminate\Support\Facades\Auth::user()->transporteur->photo)}}" id="pp" />
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

@section("script")
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.fr.min.js"></script>
<script type="application/javascript">
    $("#passwordupdate").click(function () {
        if($("#passwordupdate").is(":checked") )
        {
            $("#passwordToggle").fadeIn();
        }else {
            $("#passwordToggle").fadeOut();
        }
    });
    $('#datenaissance').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: true,
        language: "fr",
        autoclose: true,
    });

    $('#chk-client').click(function () {
        $("#client").fadeIn();
        $("#transporteur").fadeOut();
    });

    $('#chk-transporteur').click(function () {
        $("#transporteur").fadeIn();
        $("#client").fadeOut();
    });

    //Map
    function initMap() {
        var options = {
            componentRestrictions: {country: ['ci']}
        };

        var input = document.getElementById('ville');
        var autocomplete = new google.maps.places.Autocomplete(input,options);
        var inputL = document.getElementById('lieunaissance');
        var autocompleteL = new google.maps.places.Autocomplete(inputL,options);
    }
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ \App\Http\Controllers\MapController::API_KEY }}&libraries=places&callback=initMap">
</script>
@endsection