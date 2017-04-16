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
                    <div class="btn-group-variant">
                        <a href="#" class="btn btn-info-2 btn-sm btn-icon"><span class="icon fa-facebook"></span> Facebook</a>
                        <a href="#" class="btn btn-info btn-sm btn-icon"><span class="icon fa-twitter"></span> Twitter</a>
                        <a href="#" class="btn btn-danger btn-sm btn-icon"><span class="icon fa-google-plus"></span> Google+</a></div>
                    <div class="row offset-5">
                        <div class="col-lg-6 col-lg-offset-3">
                            <p class="text-uppercase text-gray">ou</p>

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
                            <p class="text-uppercase text-gray offset-7">ou</p>
                            <a href="{{ route('register')  }}" class="btn btn-sm btn-primary-variant-1 ">Nouvelle inscription</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

    <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
    </fb:login-button>

    <div id="status"></div>
@endsection

@section('script')
    <script>
        // This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response)
        {
            console.log('statusChangeCallback');
            console.log(response);
            // The response object is returned with a status field that lets the
            // app know the current login status of the person.
            // Full docs on the response object can be found in the documentation
            // for FB.getLoginStatus().
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                testAPI();
            } else {
                // The person is not logged into your app or we are unable to tell.
                document.getElementById('status').innerHTML = 'Please log ' +
                        'into this app.';
            }
        }

        // This function is called when someone finishes with the Login
        // Button.  See the onlogin handler attached to it in the sample
        // code below.
        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
        }

        window.fbAsyncInit = function() {
            FB.init({
                appId      : '710672485780182',
                cookie     : true,  // enable cookies to allow the server to access
                                    // the session
                xfbml      : true,  // parse social plugins on this page
                version    : 'v2.8' // use graph api version 2.8
            });

            // Now that we've initialized the JavaScript SDK, we call
            // FB.getLoginStatus().  This function gets the state of the
            // person visiting this page and can return one of three states to
            // the callback you provide.  They can be:
            //
            // 1. Logged into your app ('connected')
            // 2. Logged into Facebook, but not your app ('not_authorized')
            // 3. Not logged into Facebook and can't tell if they are logged into
            //    your app or not.
            //
            // These three cases are handled in the callback function.

            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });

        };

        // Load the SDK asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // Here we run a very simple test of the Graph API after login is
        // successful.  See statusChangeCallback() for when this call is made.
        function testAPI() {
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', function(response) {
                console.log('Successful login for: ' + response.name);
                document.getElementById('status').innerHTML =
                        'Thanks for logging in, ' + response.name + '!';
            });
        }
    </script>
@endsection