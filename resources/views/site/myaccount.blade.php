@extends('layouts._site')

@section('content')
<section class="section section-inset-1">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <h3 class="titre">Mon profil</h3>
                <div class="separateur"></div>


                <form class="form-horizontal col-md-8" action="{{ route("client.myaccount") }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-sm-4">Prénoms</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Votre prénom..." id="prenoms" name="prenoms" class="form-control" value="{{old('prenoms', \Illuminate\Support\Facades\Auth::user()->client->prenoms)}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Nom *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Votre nom..." id="nom" name="nom" class="form-control" value="{{old('nom', \Illuminate\Support\Facades\Auth::user()->client->nom)}}" required>
                        </div>
                    </div>

                    <div class="nav nav-tabs"></div>
                    <br/>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Raison sociale</label>
                        <div class="col-sm-8 col-xs-12">
                            <input class="form-control" name="raisonsociale" type="text" placeholder="Votre raison sociale" value="{{old('raisonsociale', \Illuminate\Support\Facades\Auth::user()->client->raisonsociale)}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">N° téléphone *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input class="form-control" name="contact" type="text" placeholder="Votre contact..." value="{{old('contact', \Illuminate\Support\Facades\Auth::user()->client->contact)}}" required>
                        </div>
                    </div>

                    <div class="nav nav-tabs"></div>
                    <br/>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Email *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="email" disabled placeholder="email..." id="email" name="email" class="form-control" value="{{old('email', \Illuminate\Support\Facades\Auth::user()->email)}}">
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
                    <h3 >Compte client</h3>
                    <div class="separateur"></div>
                    <p class="text-sm-left description">Travailler avec <b>Transvargo</b>, c’est travailler  de manière professionnelle. C’est aussi faire du transport un avantage compétitif pour augmenter la satisfaction client.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section("script")
<script type="application/javascript">
    $("#passwordupdate").click(function () {
        if($("#passwordupdate").is(":checked") )
        {
            $("#passwordToggle").fadeIn();
        }else {
            $("#passwordToggle").fadeOut();
        }
    });
</script>
@endsection