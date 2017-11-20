@extends('layouts._site')

@section("content")
<section class="section section-inset-1">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <h3 class="titre">Nouvel utilisateur</h3>
                <div class="separateur"></div>
            </div>

            <div class="col-md-10 col-md-offset-1">
                <form class="form-horizontal col-md-8" action="" method="post">
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

                <div class="form-group">
                    <label class="control-label col-sm-4">Rôle *</label>
                    <div class="col-sm-8 col-xs-12">
                        <input class="form-control" name="role" type="text" placeholder="Role de l'utilisateur" value="{{old('role')}}" required>
                    </div>
                </div>

                <div class="nav nav-tabs"></div>
                <br/>

                <div class="form-group">
                    <label class="control-label col-sm-4">Email *</label>
                    <div class="col-sm-8 col-xs-12">
                        <div class="input-group">
                            <input type="text" placeholder="email..." id="email" name="email" class="form-control" value="{{old('email')}}">
                            <span class="input-group-addon">@transvargo.com</span>
                        </div>
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
                    <label class="control-label col-sm-4"></label>
                    <div class="col-sm-8 col-xs-12">
                        <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg">Ajouter</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</section>
@endsection