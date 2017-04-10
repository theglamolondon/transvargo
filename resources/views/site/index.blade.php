@extends('layouts._site')

@section('slider')
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
    <section class="section">
        <div class="container">
            <h2>Calculateur de transport de marchandises</h2>
            <hr>
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-md-5 col-lg-6 visible-md visible-lg">
                        <div class="img-thumbnail-mod-2"><img src="images/index-2.jpg" width="705" height="655" alt=""></div>
                    </div>
                    <div class="col-sm-10 col-md-7 col-lg-6 inset-3">
                        <p class="text-sm-left">Calcul basique de transport de marchandises.</p>
                        <div class="calculator">
                            <div data-price="1" class="form-group distance">
                                <label for="dist" class="h6">Distance (km) *</label>
                                <input type="text" id="dist" class="numbers-only">
                            </div>
                            <div data-price="2" class="form-group weight">
                                <label for="weight" class="h6">Masse (kg)</label>
                                <input type="text" id="weight" class="numbers-only">
                            </div>
                            <div id="capacity" data-price="1" class="capacity clearfix">
                                <div class="form-group">
                                    <label for="length" class="h6">Longueur (m)</label>
                                    <input type="text" id="length" class="numbers-only">
                                </div>
                                <div class="form-group">
                                    <label for="height" class="h6">Hauteur (m)</label>
                                    <input type="text" id="height" class="numbers-only">
                                </div>
                                <div class="form-group">
                                    <label for="width" class="h6">Largeur (m)</label>
                                    <input type="text" id="width" class="numbers-only">
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="h6">Fragile</p>
                                <div class="radio">
                                    <label>
                                        <input data-price="25" type="radio" name="blankRadio" id="blankRadioYes" value="option1" class="numbers-only"><span class="radio-field"></span><span>Oui</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="blankRadio" id="blankRadioNo" value="option2" class="numbers-only"><span class="radio-field"></span><span>Non</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="h6">Extra services:</p>
                                <div class="checkbox-group">
                                    <label class="checkbox-inline">
                                        <input data-price="15" type="checkbox" id="extra1" class="numbers-only"><span class="checkbox-field"></span><span>Assusrance</span>
                                    </label>
                                    <label class="checkbox-inline">
                                        <input data-price="20" type="checkbox" id="extra2" class="numbers-only"><span class="checkbox-field"></span><span>Livraison expresse</span>
                                    </label>
                                    <label class="checkbox-inline">
                                        <input data-price="25" type="checkbox" id="extra3" class="numbers-only"><span class="checkbox-field"></span><span>Emballage</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group border-top inset-4 h4">
                                <p>Total:<span id="total">0</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-inset-1 bg-primary">
        <div class="container">
            <h2 class="text-center">A propos de la compagnie</h2>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 text-center text-md-left inset-1"><img src="images/index-1.jpg" alt=""></div>
                <div class="col-xs-12 col-sm-12 col-md-6 text-sm-left well1">
                    <p>Our transportation company with 30 years of experience is your best choice for shipping cargo of any size, storage, packing or delivering wares to your customers.</p>
                    <p>Our professional employees will take care of your goods, whenever you send them.</p>
                    <div class="progress-container text-left">
                        <p class="font-secondary h6">Air Transportation</p>
                        <!-- Progress Bar-->
                        <div data-value="50" data-stroke="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-horizontal progress-bar-default"></div>
                        <p class="font-secondary h6">Marine Transportation</p>
                        <div data-value="90" data-stroke="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-horizontal progress-bar-default"></div>
                        <p class="font-secondary h6">Trucking Services</p>
                        <div data-value="80" data-stroke="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-horizontal progress-bar-default"></div>
                        <p class="font-secondary h6">Safety Escort Services</p>
                        <div data-value="20" data-stroke="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-horizontal progress-bar-default"></div>
                    </div>
                </div>
            </div><a href="#" class="btn btn-white btn-sm btn-min-width">learn more</a>
        </div>
    </section>
    <section class="section section-inset-2">
        <div class="container">
            <h2 class="text-center">Counters</h2>
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
    <section class="section section-inset-1 bg-light">
        <div class="container">
            <h2>Latest blog posts</h2>
            <hr>
            <div class="row text-sm-left">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="blog-post thumbnail-1 thumbnail-mod-2"><img src="images/index-8.jpg" alt="">
                        <div class="caption">
                            <div class="blog-post-title">
                                <h4 class="text-primary text-transform-none"><a href="blog_post.html">Our network now embraces 5000 cities all over the world</a></h4>
                            </div>
                            <div class="blog-post-time">
                                <time datetime="2015-12-26">December 26, 2015</time>
                            </div>
                            <div class="blog-post-body">
                                <p>You can send your shipments all over the world. We have representatives and warehouses in more than 5000 cities and towns in almost 200 countries.</p><a href="blog_post.html" class="badge fa-comment font-secondary text-primary">10</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="blog-post thumbnail-1 thumbnail-mod-2"><img src="images/index-9.jpg" alt="">
                        <div class="caption">
                            <div class="blog-post-title">
                                <h4 class="text-primary text-transform-none"><a href="blog_post.html">Top-grade security on all levels</a></h4>
                            </div>
                            <div class="blog-post-time">
                                <time datetime="2015-12-26">December 26, 2015</time>
                            </div>
                            <div class="blog-post-body">
                                <p>We are aware of the fact that unforeseen incidents make occur in transit of shipments, so we provide full insurance for your shipments by best insurance companies.</p><a href="blog_post.html" class="badge fa-comment font-secondary text-primary">16</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="blog-post thumbnail-1 thumbnail-mod-2"><img src="images/index-10.jpg" alt="">
                        <div class="caption">
                            <div class="blog-post-title">
                                <h4 class="text-primary text-transform-none"><a href="blog_post.html">Less Than a Container Loads</a></h4>
                            </div>
                            <div class="blog-post-time">
                                <time datetime="2015-12-26">December 26, 2015</time>
                            </div>
                            <div class="blog-post-body">
                                <p>You can receive an addition discount using our Less than a Container Load (LCL) options. This type of freight is similar to the consolidated cargo, but is much faster to deliver.</p><a href="blog_post.html" class="badge fa-comment font-secondary text-primary">20</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><a href="blog_default.html" class="btn btn-primary-variant-1 btn-sm btn-min-width">view all blog posts</a>
        </div>
    </section>
    <section class="section section-inset-1">
        <div class="container">
            <h2 class="text-center">Our satisfied clients</h2>
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
    <section class="bg-light rd-parallax">
        <div data-speed="0" data-md-speed="0.2" data-type="media" data-url="images/index-11.jpg" class="rd-parallax-layer"></div>
        <div class="container section section-inset-1 z-index">
            <h2 class="text-center">Contactez-nous</h2>
            <hr>
            <div class="row offset-3">
                <div class="col-xs-12 col-md-9 col-lg-6 col-md-offset-2 col-lg-offset-3">
                    <!--p.fw-l.h5.text-transform-none Enter your email address to receive all company news, special offers and other discount information.-->
                    <!-- RD Mailform-->
                    <form data-result-class="rd-mailform-validate" data-form-type="contact" method="post" action="bat/rd-mailform.php" class="rd-mailform row">
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="name" data-constraints="@NotEmpty" placeholder="Votre prénoms...">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="name" data-constraints="@NotEmpty" placeholder="Votre nom...">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="email" data-constraints="@NotEmpty @Email" placeholder="Votre email...">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" data-constraints="@Phone" name="phone" placeholder="Votre contact..." class="form-input">
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <textarea name="message" data-constraints="@NotEmpty" placeholder="Ecrivez-nous votre message ici"></textarea>
                        </div>
                        <!-- RD SelectMenu-->
                        <button class="btn btn-primary btn-sm btn-min-width">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-inset-1">
        <div class="container">
            <h2>testimonials</h2>
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