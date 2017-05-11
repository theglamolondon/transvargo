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
                <div class="rd-navbar-brand"><a href="{{ route('accueil') }}" class="brand-name"><span class="icon fa-truck"></span><span>Transvargo</span></a></div>
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
                <div class="rd-navbar-brand undefined"><a href="{{ route('accueil') }}" class="brand-name"><span class="icon fa-truck"></span><span>{{ config('app.name') }}</span></a></div>
                <p>Feel free to contact us. We are always ready to help you.</p>
                <address>
                  <dl>
                    <dt>Headquarters:</dt>
                    <dd>795 Folsom Ave, Suite 600 San Francisco, CA 94107</dd>
                  </dl>
                  <dl class="dl-horizontal-mod-1">
                    <dt>Phone</dt>
                    <dd><a href="callto:#" class="text-primary">(91) 8547 632521</a></dd>
                  </dl>
                  <dl class="dl-horizontal-mod-1">
                    <dt>Fax</dt>
                    <dd><a href="callto:#" class="text-primary">(91) 11 4752 1433</a></dd>
                  </dl>
                  <dl class="dl-horizontal-mod-1">
                    <dt>Email</dt>
                    <dd><a href="mailto:#" class="text-primary">info@demolink.org</a></dd>
                  </dl>
                </address>
                <!--
                <ul class="well6 offset-5">
                  <li><a href="#" class="text-gray small"><span class="icon icon-xs icon-info-2 fa-facebook postfix-1"></span>Suivez-nous sur Facebook</a></li>
                  <li><a href="#" class="text-gray small"><span class="icon icon-xs icon-warning fa-rss postfix-1"></span>Subscribe to RSS Feeds</a></li>
                </ul>
                -->
              </div>
              <div class="col-xs-12 col-sm-6 col-lg-3">
                <h4>Blogroll</h4>
                <ul class="list-marked well6">
                  <li><a href="#">Documentation</a></li>
                  <li><a href="#">Feedback</a></li>
                  <li><a href="#">Plugins</a></li>
                  <li><a href="#">Support Forums</a></li>
                  <li><a href="#">Themes</a></li>
                  <li><a href="#">WordPress Blog</a></li>
                  <li><a href="#">Transporteur</a></li>
                </ul>
              </div>
              <div class="col-xs-12 col-lg-offset-3 col-sm-6 col-lg-3">
                <h4>Newsletter</h4>
                <p>Enter your email address to receive all company news, special offers and other discount information.</p>
                <!-- RD Mailform-->
                <form data-result-class="rd-mailform-validate" data-form-type="subscribe" method="post" action="bat/rd-mailform.php" class="rd-mailform subscribe">
                  <input type="text" name="email" data-constraints="@NotEmpty @Email" placeholder="Your e-mail...">
                  <button class="btn btn-sm btn-min-width btn-primary">S'incrire</button>
                </form>
                <p class="count h6 pull-lg-left offset-2">15 473 654<span class="text-gray fw-r">Total de chargement</span></p>
                <p class="count h6 pull-lg-right offset-2 preffix-3">18 654<span class="text-gray fw-r">Clients</span></p>
              </div>
            </div>
          </div>
        </section>
        <section class="copyright bg-darkest well5">
          <div class="container">
            <p class="pull-sm-left">&#169; <span id="copyright-year"></span> Tous droits réservés - <a href="{{ route('terms') }}">Conditions d'utilisation</a></p>
            <ul class="list-inline pull-sm-right offset-3">
              <li><a href="#" class="fa-facebook"></a></li>
              <li><a href="#" class="fa-twitter"></a></li>
            </ul>
          </div>
        </section>
        <small>Powered by <a rel="nofollow" href="#" target="_blank"> Glamo Corporation </a></small>
      </footer>
      <!-- Rd Mailform result field-->
      <div class="rd-mailform-validate"></div>
    </div>

    <div class="message">
      @if(session()->has(\App\Work\Tools::MESSAGE_SUCCESS))
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Succès!</strong> {{ session(\App\Work\Tools::MESSAGE_SUCCESS) }}
          </div>
      @endif
    </div>

    <!-- Java script-->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="{{config('app.url')}}/js/core.min.js"></script>
    <script src="{{config('app.url')}}/js/script.js"></script>
    <script src="{{config('app.url')}}/js/custom.js"></script>

    @yield('script')

  </body>
</html>