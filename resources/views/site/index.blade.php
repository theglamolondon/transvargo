@extends('layouts._site')

@section('slider')
    <section>
        <div class="swiper-container swiper-slider swiper-slider-height-1">
            <div class="jumbotron-mod-1 text-center">
                <div>
                    <h1>
                        <small>rapide et fiable</small>
                        <span class='text-bold question'>Souhaitez-vous transporter vos produits ?</span>
                    </h1>
                    <div class="slogan">
                        <p class="response">Profitez de notre vaste réseau de camions partout en Côte d’ivoire.</p>
                    </div><div class='btn-group-variant'> <div><!--<a class='btn btn-primary btn-sm' href='{{ route('apropos') }}#avantages'>Nos avantages</a>--> <a class='btn btn-white btn-sm' href='{{ route('register') }}'>Créer son compte</a></div></div>
                </div>
            </div>
            <div class="swiper-wrapper">
                <div data-slide-bg="{{config('app.url')}}/images/slider-1.jpg" class="swiper-slide">
                    <div class="swiper-slide-caption"></div>
                </div>
                <div data-slide-bg="{{config('app.url')}}/images/typography-2.jpg" class="swiper-slide">
                    <div class="swiper-slide-caption"></div>
                </div>
                <div data-slide-bg="{{config('app.url')}}/images/slider-3.jpg" class="swiper-slide">
                    <div class="swiper-slide-caption"></div>
                </div>
            </div>
            <!-- Swiper Pagination-->
            <div class="swiper-pagination"></div>
        </div>
    </section>
@endsection

@section('content')
    <div class="" style="display:none;">
        <div class="col-md-12 col-sm-12 col-xs-12" style="height: 550px">
            <aside id="map" style="height: 100%;"></aside>
        </div>
        <span class="clearfix"></span>
    </div>
    <section class="section section-inset-2" style="padding-top: 20px; display: none;">
        <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
            <form class="form-inline calculatrice" action="" method="post">
                <div class="form-group">
                    <div class="col-md-2 col-sm-4 col-xs-12 input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-upload"></i> </span>
                        <input class="form-control" placeholder="Lieu d'enlèvement">
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12 input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-download"></i> </span>
                        <input class="form-control" placeholder="Lieu de livraison">
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12 input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i> </span>
                        <input class="form-control" type="number" placeholder="poids total">
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12 input-group">
                        <select class="form-control">
                            <option value="T">Tonnes</option>
                            <option value="KG">Kilos</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-2 col-xs-12 input-group">
                        <input type="submit" class="form-control btn btn-primary" style="padding: 5px 10px;" value="Tarif direct">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="section section-inset-2 bg-light">
        <div class="container">
            <h2 class="text-center">Devenez client Transvargo</h2>
            <h3 class="text-center">Faites du transport un avantage compétitif pour augmenter la satisfaction client</h3>
            <hr>
            <div class="row">
                <div class="progress-container row offset-7 flow-offset-1">
                    <!-- Progress Bar-->
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail-mod-1">
                            <div class="progress-bar-wrapper">
                                <img src="{{ config('app.url')}}/working/desk.png"/>
                            </div>
                            <p class="h5 fw-l inline-block">Prix Compétitif</p>
                            <p class="h5 fw-l inline-block">les prix que propose transvargo est très abordable et stable. Vous ne payez que pour le service effectué.</p>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail-mod-1">
                            <div class="progress-bar-wrapper">
                                <img src="{{ config('app.url')}}/working/package.png"/>
                            </div>
                            <p class="h5 fw-l inline-block">Rapide</p>
                            <p class="h5 fw-l inline-block">Avec transvargo vous ne perdez plus de temps et vôtre équipe  a le temps de se consacrer à autre chose car vous expédiez vos produits en seulement quelques clics.</p>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail-mod-1">
                            <div class="progress-bar-wrapper">
                                <img src="{{ config('app.url')}}/working/phone.png"/>
                            </div>
                            <p class="h5 fw-l inline-block">Transparent</p>
                            <p class="h5 fw-l inline-block">Vous faites des économies sur le contrat de transport car tout transparent et justifié, pas besoin de frais supplémentaires. </p>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail-mod-1">
                            <div class="progress-bar-wrapper">
                                <img src="{{ config('app.url')}}/working/sent.png"/>
                            </div>
                            <p class="h5 fw-l inline-block" >Sécurisé</p>
                            <p class="h5 fw-l inline-block">Nos partenaires transporteurs sont uniquement des professionnels et en plus vous pouvez suivre l’acheminement de vos produits  en temps réel grâce notre outil de géolocalisation.</p>

                        </div>
                    </div>
                   <!-- <div class="col-sm-6 col-md-2">
                        <div class="thumbnail-mod-1">
                            <div class="progress-bar-wrapper">
                                <img src="{{ config('app.url')}}/working/car.png"/>
                            </div>
                            <p class="h5 fw-l inline-block">Suivez votre expédition</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="thumbnail-mod-1">
                            <div class="progress-bar-wrapper">
                                <img src="{{ config('app.url')}}/working/finish.png"/>
                            </div>
                            <p class="h5 fw-l inline-block">Livraison du colis</p>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </section>
    <section class="section section-inset-1">
        <div class="container">
            <h2 class="text-center">Devenez transporteur partenaire Transvargo</h2>
            <h4 class="text-center">Désormais travailler de manière professionnelle et rendez votre entreprise pérenne.</h4>
            <hr>
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail-mod-1">
                        <div class="progress-bar-wrapper">
                            <img src="{{ config('app.url')}}/working/car.png"/>
                        </div>
                        <p class="h5 fw-l inline-block">Augmentez vos revenues </p>
                        <p class="h5 fw-l inline-block">Ne peinez plus pour trouver de la marchandise à transporter  car avec transvargo vous avez accès à des centaines d’offres.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail-mod-1">
                        <div class="progress-bar-wrapper">
                            <img src="{{ config('app.url')}}/working/finish.png"/>
                        </div>
                        <p class="h5 fw-l inline-block">Transparence </p>
                        <p class="h5 fw-l inline-block">Vous avez une maitrise sur votre activité car  vous savez désormais ce que vous gagnez.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail-mod-1">
                        <div class="progress-bar-wrapper">
                            <img src="{{ config('app.url')}}/working/finish.png"/>
                        </div>
                        <p class="h5 fw-l inline-block">Accès gratuit </p>
                        <p class="h5 fw-l inline-block">L’inscription à la plateforme transvargo est gratuite.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-inset-1 bg-light">
        <div class="container">
            <h2>Les avis de nos clients</h2>
            <hr>
            <div class="row">
                <div class="col-xs-12">
                    <!-- Owl Carousel-->
                    <div data-items="1" data-sm-items="2" data-lg-items="3" data-loop="false" data-margin="30" data-dots="true" data-autoplay="true" class="owl-carousel owl-carousel-mod-2">
                        <div class="owl-item">
                            <blockquote class="quote"><img src="working/client.png" alt="" width="70" height="70" class="img-circle"/>
                                <p>
                                    <cite>Wilfied KOFFI</cite>
                                </p>
                                <p class="citation">
                                    <q>Les prix sont parmi les plus compétitifs que j'ai pu obtenir [...] on est prévenus à chaque étape de la livraison</q>
                                </p>
                            </blockquote>
                        </div>
                        <div class="owl-item">
                            <blockquote class="quote"><img src="working/client.png" alt="" width="70" height="70" class="img-circle"/>
                                <p>
                                    <cite>Sidoine AKE</cite>
                                </p>
                                <p class="citation">
                                    <q>Facile à utiliser et pratique pour organiser un transport de palettes en quelques instants [...] Plus avantageux en prix que les autres solutions que nous avions étudiées</q>
                                </p>
                            </blockquote>
                        </div>
                        <div class="owl-item">
                            <blockquote class="quote"><img src="working/client.png" alt="" width="70" height="70" class="img-circle"/>
                                <p>
                                    <cite>Yanick TOUBO</cite>
                                </p>
                                <p class="citation">
                                    <q>Ce qui est inédit, c'est d'avoir un tarif instantanément [...] Réactivité excellente : généralement un transporteur valide nos demandes dans les minutes qui suivent</q>
                                </p>
                            </blockquote>
                        </div>
                        <div class="owl-item">
                            <blockquote class="quote"><img src="working/client.png" alt="" width="70" height="70" class="img-circle"/>
                                <p>
                                    <cite>Flavie AKE</cite>
                                </p>
                                <p class="citation">
                                    <q>Avoir un devis instantanément est un énorme plus [...] Transvargo gère tout à notre place : chargement de la palette sans souci et suivi de livraison top</q>
                                </p>
                            </blockquote>
                        </div>
                        <div class="owl-item">
                            <blockquote class="quote"><img src="working/client.png" alt="" width="70" height="70" class="img-circle"/>
                                <p>
                                    <cite>Jean Philippe KOBLAN</cite>
                                </p>
                                <p class="citation">
                                    <q>Prix compétitifs et aucun souci du chargement à la livraison [...] Transvargo a tout géré à notre place sans que nous nous occupions de rien</q>
                                </p>
                            </blockquote>
                        </div>
                        <div class="owl-item">
                            <blockquote class="quote"><img src="working/client.png" alt="" width="70" height="70" class="img-circle"/>
                                <p>
                                    <cite>Virgile EKRA</cite>
                                </p>
                                <p class="citation">
                                    <q>La rapidité d'exécution qui nous a plu [...] Le temps annoncé à l'avance pour rechercher un chauffeur nous a séduit, c'est un vrai plus pour notre organisation</q>
                                </p>
                            </blockquote>
                        </div>
                        <!--
                        <div class="owl-item">
                            <blockquote class="quote"><img src="working/client.png" alt="" width="70" height="70" class="img-circle"/>
                                <p>
                                    <cite>Sharon Willis</cite>
                                </p>
                                <p>
                                    <q>Thanks a lot for the quick response. I was really impressed, your solution is excellent! Your competence is justified!</q>
                                </p>
                            </blockquote>
                        </div>
                        <div class="owl-item">
                            <blockquote class="quote"><img src="images/index-14.jpg" alt="" width="70" height="70" class="img-circle"/>
                                <p>
                                    <cite>Alan Smith</cite>
                                </p>
                                <p>
                                    <q>Great organization!! Your prompt answer became a pleasant surprise for me. You've rendered an invaluable service!</q>
                                </p>
                            </blockquote>
                        </div>
                        <div class="owl-item">
                            <blockquote class="quote"><img src="images/index-13.jpg" alt="" width="70" height="70" class="img-circle"/>
                                <p>
                                    <cite>Jack Wilson</cite>
                                </p>
                                <p>
                                    <q>I just don't know how to describe your services... They are extraordinary! I am quite happy with them! Just keep up going this way!</q>
                                </p>
                            </blockquote>
                        </div>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <!--
    <script type="application/ecmascript">
        function initMap() {
            var points = [
                new google.maps.LatLng(5.332671, -3.944913),
                new google.maps.LatLng(5.372388, -4.008172),
                new google.maps.LatLng(5.496260, -3.366919),
                new google.maps.LatLng(7.866661, -5.251074),
                new google.maps.LatLng(9.435738, -5.593572),
                new google.maps.LatLng(6.679373, -3.478391)
            ];
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 5.341620,
                    lng:  -3.993370
                },
                zoom: 12
            });

            for (var i = 0; i < points.length; i++) {
                var marker = new google.maps.Marker({
                    position: points[i],
                    map: map,
                    icon: '{{ config('app.url') }}/working/truck-map-marker30x42.png'
                });
            }
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ \App\Http\Controllers\MapController::API_KEY }}&libraries=places&callback=initMap">
    </script>
    -->
@endsection