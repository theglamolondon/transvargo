@extends('layouts._site')

@section('content')
    <section class="bg-light section-lg">
        <ol class="breadcrumb">
            <li class="active">Connexion</li>
        </ol>
    </section>
    <section class="section section-inset-1">
        <div class="container">
            <h2>Connexion</h2>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <div class="row offset-5">
                        <div class="col-lg-6 col-lg-offset-3">
                            @if($errors->has('email'))<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>{{ $errors->first('email') }}</div>@endif

                            <form class="login-form" method="post" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <div class="mfInput">
                                    <label for="exampleInputEmail"></label>
                                    <input type="email" placeholder="E-mail..." id="exampleInputEmail" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                                <div class="mfInput">
                                    <label for="exampleInputPassword1"></label>
                                    <input type="password" placeholder="Mot de passe..." id="exampleInputPassword1" class="form-control" name="password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg">Connexion</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

@endsection