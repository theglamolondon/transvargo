<!DOCTYPE html>
<html lang="en" class="wide wow-animation">
  <head>
    <!-- Site Title-->
    <title>{{config('app.name','TRANSVARGO')}}</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta charset="utf-8">
    <link rel="icon" href="{{asset('/images/pico.png')}}" type="image/png">
    <!-- Stylesheets-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu:400,500,700%7COpen+Sans:400,300);">

    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/custom.css')}}">
		<!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="Vous utilisez un navigateur ancien et peu sécurisé. Pour une meilleure expérience, veuillez utiliser un navigateur récent."></a></div>
    <script src="{{asset('/js/html5shiv.min.js')}}"></script>
		<![endif]-->
  </head>
  <body>
    <!-- Page-->
    <div class="page text-center">
      <!-- Page Header-->
      <header class="page-head">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap header-corporate">
          <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fullwidth" data-md-layout="rd-navbar-fullwidth" data-lg-layout="rd-navbar-static" data-device-layout="rd-navbar-fixed" data-sm-device-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-static" data-lg-stick-up-offset="117px">
            <div class="rd-navbar-inner">
              <!-- RD Navbar Panel-->
              <div class="rd-navbar-panel">
                <!-- RD Navbar Toggle-->
                <button data-rd-navbar-toggle=".rd-navbar-nav-wrap" type="submit" class="rd-navbar-toggle"><span></span></button>
                <!-- RD Navbar Brand-->
                <div class="rd-navbar-brand"><a href="{{ route('accueil') }}" class="brand-name"><img src="{{ config('app.url') }}/images/transvargo-logo.png"/> </a></div>
              </div>
              @if( \Illuminate\Support\Facades\Auth::guest() || request()->user()->typeidentite_id == \App\TypeIdentitite::TYPE_CLIENT )
                @include('site.navigation.nav')
              @elseif( request()->user()->typeidentite_id == \App\TypeIdentitite::TYPE_TRANSPORTEUR )
                @include('carrier.navigation.nav')
              @elseif( request()->user()->typeidentite_id == \App\TypeIdentitite::TYPE_STAFF_USER )
                @include('staff.navigation.nav')
              @endif
            </div>
          </nav>
        </div>

        @yield('slider')

      </header>
      <!-- Page Content-->
      <main class="page-content">

        @yield('content')

      </main>
      <!-- Page Footer-->
      <footer class="page-foot section-inset-4 bg-dark">
        <section class="footer-content">
          <div class="container">
            <div class="row text-left clearleft-custom">
              <div class="col-xs-12 col-sm-6 col-lg-3">
                <h4>Notre société</h4>
                  <ul class="list-marked well6">
                    <li><a href="{{ route('apropos') }}">Qui sommes-nous</a></li>
                    <li><a href="{{ route('terms') }}">Conditions d'utilisations</a></li>
                    <li><a href="{{ route('contact') }}">Nous contacter</a></li>
                </ul>
            <!--
                <div class="rd-navbar-brand undefined"><a href="{{ route('accueil') }}" class="brand-name"><span class="icon fa-truck"></span><span>{{ config('app.name') }}</span></a></div>
                <p>Feel free to contact us. We are always ready to help you.</p>
                <address>
                  <dl>
                    <dt>Headquarters:</dt>
                    <dd>795 Folsom Ave, Suite 600 San Francisco, CA 94107</dd>
                  </dl>
                  <dl class="dl-horizontal-mod-1">
                    <dt>Phone</dt>
                    <dd><a href="callto:0022500112233" class="text-primary">(+225) 00 11 22 33</a></dd>
                  </dl>
                  <dl class="dl-horizontal-mod-1">
                    <dt>Fax</dt>
                    <dd><a href="callto:0022544556677" class="text-primary">(+225) 44 55 66 77</a></dd>
                  </dl>
                  <dl class="dl-horizontal-mod-1">
                    <dt>Email</dt>
                    <dd><a href="mailto:contact@transvargo.com" class="text-primary">contact@transvargo.com</a></dd>
                  </dl>
                </address>
                  -->
                <!--
                <ul class="well6 offset-5">
                  <li><a href="#" class="text-gray small"><span class="icon icon-xs icon-info-2 fa-facebook postfix-1"></span>Suivez-nous sur Facebook</a></li>
                  <li><a href="#" class="text-gray small"><span class="icon icon-xs icon-warning fa-rss postfix-1"></span>Subscribe to RSS Feeds</a></li>
                </ul>
                -->
              </div>
              <div class="col-xs-12 col-sm-6 col-lg-3">
                <h4>Téléchargement</h4>
                <ul class="list-marked well6">
                  <li><a href="#">Bientôt</a></li>
                </ul>
                <a href="#"><img src="{{config('app.url')}}/working/playstore.png" style="width: 180px;"></a>
              </div>
              <div class="col-xs-12 col-sm-6 col-lg-3">
                <h4>Espace membre</h4>
                <ul class="list-marked well6">
                  <li><a href="{{ route('login') }}">Connexion</a></li>
                  <li><a href="{{ route('password.request') }}">Mot de passe oublié</a></li>
                  <li><a href="{{ route('register') }}">Inscription</a></li>
                </ul>
              </div>
              <div class="col-xs-12 col-sm-6 col-lg-3">
                <h4>Newsletter</h4>
                <p>Entrez votre adresse email pour recevoir nos offres de promo et de remises exceptionnelles.</p>
                <form method="post" action="{{ route('newsletter.add') }}" class="rd-mailform subscribe">
                  <input type="email" class="form-control" name="email" placeholder="Votre email">
                  <button type="submit" class="btn btn-sm btn-min-width btn-primary">s'inscrire</button>
                </form>
              </div>
            </div>
          </div>
        </section>
        <section class="copyright bg-darkest well5">
          <div class="container">
            <p class="pull-sm-left">&#169; <span id="copyright-year"></span> Tous droits réservés - <a href="{{ route('terms') }}">Conditions d'utilisation</a></p>
            <ul class="list-inline pull-sm-right offset-3">
              <li><a href="https://www.facebook.com/transvargo" target="_blank" class="fa-facebook"></a></li>
              <li><a href="#" class="fa-twitter"></a></li>
            </ul>
          </div>
        </section>
      </footer>
      <!-- Rd Mailform result field-->
      <div class="rd-mailform-validate"></div>
    </div>

    <div class="message">
      @if(session()->has(\App\Work\Tools::MESSAGE_SUCCESS))
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Succès ! </strong> {{ session(\App\Work\Tools::MESSAGE_SUCCESS) }}
          </div>
      @endif
      @if(session()->has(\App\Work\Tools::MESSAGE_WARNING))
          <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Attention ! </strong> {{ session(\App\Work\Tools::MESSAGE_WARNING) }}
          </div>
      @endif
      @if(session()->has(\App\Work\Tools::MESSAGE_INFO))
          <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Info ! </strong> {{ session(\App\Work\Tools::MESSAGE_INFO) }}
          </div>
      @endif
      @if(isset($errors) && $errors->count())
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            @foreach($errors->all() as $erreur)
            <p><strong>Erreur ! </strong> <i class="fa fa-exclamation-circle"></i>{{ $erreur }}</p>
            @endforeach
          </div>
      @endif
    </div>

    <!-- Java script-->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--
    -->
    <script src="{{config('app.url')}}/js/core.min.js"></script>
    <script src="{{config('app.url')}}/js/script.js"></script>
    <script src="{{config('app.url')}}/js/custom.js"></script>

    @yield('script')

  </body>
</html>