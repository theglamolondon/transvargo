 @extends('layouts._site')

@section('slider2')
    <section>
        <div class="swiper-container swiper-slider swiper-slider-height-1">
            <div class="jumbotron-mod-1 text-center">
                <div>
                    <h1><small>fast and safe</small><span class='text-bold'>transportation</span></h1>
                    <div class="slogan">
                        <p>Freight, warehousing, accounting, packaging and distribution are just a few examples of what we can do to ensure your success.</p>
                    </div><div class='btn-group-variant'> <div><a class='btn btn-primary btn-sm' href='#'>Nos avantages</a> <a class='btn btn-white btn-sm' href='#'>Tour virtuel</a></div></div>
                </div>
            </div>
            <div class="swiper-wrapper">
                <div data-slide-bg="{{config('app.url')}}/images/slider-1.jpg" class="swiper-slide">
                    <div class="swiper-slide-caption"></div>
                </div>
                <div data-slide-bg="{{config('app.url')}}/images/slider-2.jpg" class="swiper-slide">
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
    <div class="">
        <div class="col-md-12 col-sm-12 col-xs-12" style="height: 550px">
            <aside id="map" style="height: 100%;"></aside>
        </div>
        <span class="clearfix"></span>
    </div>
    <section class="section section-inset-2" style="padding-top: 20px;">
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
            <h2 class="text-center">Quelques chiffres</h2>
            <hr>
            <div class="row">
                <div class="progress-container row offset-7 flow-offset-1">
                    <!-- Progress Bar-->
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail-mod-1">
                            <div class="progress-bar-wrapper">
                                <div data-value="50" data-stroke="10" data-trail="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-radial progress-bar-default"></div>
                            </div>
                            <p class="h5 fw-l inline-block">Air Transportation</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail-mod-1">
                            <div class="progress-bar-wrapper">
                                <div data-value="75" data-stroke="10" data-trail="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-radial progress-bar-default"></div>
                            </div>
                            <p class="h5 fw-l inline-block">Marine Transportation</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail-mod-1">
                            <div class="progress-bar-wrapper">
                                <div data-value="25" data-stroke="10" data-trail="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-radial progress-bar-default"></div>
                            </div>
                            <p class="h5 fw-l inline-block">Trucking Services</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail-mod-1">
                            <div class="progress-bar-wrapper">
                                <div data-value="100" data-stroke="10" data-trail="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-radial progress-bar-default"></div>
                            </div>
                            <p class="h5 fw-l inline-block">Safety Escort Services</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-inset-1">
        <div class="container">
            <h2 class="text-center">Ils nous ont fait confiance</h2>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="thumbnail thumbnail-mod-1"><img src="images/partner-8.png" alt="">
                        <div class="caption-mod-1">
                            <h6 class="text-primary">Tourner</h6><a href="#" class="text-gray">www.tourner.com</a>
                            <p>We believe in the ability of all people to thrive, not just exist.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="thumbnail thumbnail-mod-1"><img src="images/partner-9.png" alt="">
                        <div class="caption-mod-1">
                            <h6 class="text-primary">Frank`s Co.</h6><a href="#" class="text-gray">www.franksco.com</a>
                            <p>We are open and transparent about the work we do and how we do it.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="thumbnail thumbnail-mod-1"><img src="images/partner-10.png" alt="">
                        <div class="caption-mod-1">
                            <h6 class="text-primary">Retro Press</h6><a href="#" class="text-gray">www.retropress.com</a>
                            <p>We are commited to achieving demonstrable impact for our stakeholders.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-inset-1 bg-light">
        <div class="container">
            <h2>Témoinages</h2>
            <hr>
            <div class="row">
                <div class="col-xs-12">
                    <!-- Owl Carousel-->
                    <div data-items="1" data-sm-items="2" data-lg-items="3" data-loop="false" data-margin="30" data-dots="true" data-autoplay="true" class="owl-carousel owl-carousel-mod-2">
                        <div class="owl-item">
                            <blockquote class="quote"><img src="images/index-12.jpg" alt="" width="70" height="70" class="img-circle"/>
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
                        <div class="owl-item">
                            <blockquote class="quote"><img src="images/index-12.jpg" alt="" width="70" height="70" class="img-circle"/>
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
                                    <q>Great organization!! Your prompt answer became a pleasant surprise for me. You've rendered an invaluable service!s</q>
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
                        <div class="owl-item">
                            <blockquote class="quote"><img src="images/index-12.jpg" alt="" width="70" height="70" class="img-circle"/>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
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
@endsection