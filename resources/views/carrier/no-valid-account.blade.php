@extends('layouts._site')

@section('content')
<div class="bg-no-valid-account" style="background: url('{{config('app.url')}}/images/gallery-9_original.jpg') center center no-repeat; background-size: cover;">
    <div class="container" style="min-height: 750px">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="row offset-4">
                    <br/><br/><br/><br/><br/><br/>
                    <div class="col-lg-6 col-lg-offset-3 col-xs-offset-1 col-xs-10 box alert alert-warning">
                        <h2><i class="fa fa-warning"></i> </h2>
                        <h3>Votre compte n'est pas encore actif ! </h3>
                        <hr/>
                        <p class="h4">Veuillez contacter Transvargo pour activer votre compte et acceder à un million d'offres.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection