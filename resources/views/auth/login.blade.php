<!DOCTYPE html>
<html lang="en" class="wide wow-animation">
<head>
    <!-- Site Title-->
    <title>{{config('app.name','TRANSVARGO')}}</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta charset="utf-8">
    <link rel="icon" href="{{config('app.url')}}/images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu:400,500,700%7COpen+Sans:400,300);">

    <link rel="stylesheet" href="{{config('app.url')}}/css/style.css">
    <link rel="stylesheet" href="{{config('app.url')}}/css/custom.css">
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="Vous utilisez un navigateur ancien et peu sécurisé. Pour une meilleure expérience, veuillez utiliser un navigateur récent."></a></div>
    <script src="{{config('app.url')}}/js/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body style="background: #333 url('{{config('app.url')}}/images/index-11.jpg') center center no-repeat fixed;background-size: cover;">
    <section class="section section-inset-1 connexion" >
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <div class="row offset-5">

                        <div class="col-lg-6 col-lg-offset-3 col-xs-offset-1 col-xs-10 box">
                            <h3 class="titre">Connexion</h3>
                            <div class="separateur"></div>

                            @foreach($errors->all() as $erreur)
                                <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>{{ $erreur }}</div>
                            @endforeach

                            <form class="login-form" method="post" action="{{ route('login') }}" id="login">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail" class="control-label">Email ou N° de téléphone</label>
                                    <input type="text" placeholder="E-mail ou n° de téléphone" id="exampleInputEmail" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1" class="control-label">Mot de passe</label>
                                    <input type="password" placeholder="Mot de passe..." id="exampleInputPassword1" class="form-control" name="password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg">Connexion</button>
                                <br/><br/>
                                <a href="#">Mot de passe oublié ?</a>
                            </form>

                            <form class="login-form" method="post" action="" id="forget" style="display: none;">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="control-label">Email ou N° de téléphone</label>
                                    <input type="text" placeholder="E-mail ou n° de téléphone" id="exampleInputEmail1" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg">Envoyer</button>
                                <br/><br/>
                                <a href="#">Connexion</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="application/ecmascript">
    $('#login a').click(function (e) {
        $('#forget').fadeIn();
        $('#login').fadeOut();
    });
    $('#forget a').click(function (e) {
        $('#login').fadeIn();
        $('#forget').fadeOut();
    });
</script>
</html>