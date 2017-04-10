@extends('layouts._site')

@section('content')
    <section class="bg-light section-lg">
        <ol class="breadcrumb">
            <li class="active">Contactez-nous !</li>
        </ol>
    </section>
    <section class="section section-inset-1">
        <div class="container">
            <h2>Contact us</h2>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <!-- RD Mailform-->
                    <form data-result-class="rd-mailform-validate" data-form-type="contact" method="post" action="bat/rd-mailform.php" class="rd-mailform row">
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="name" data-constraints="@NotEmpty" placeholder="Your first name...">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="name" data-constraints="@NotEmpty" placeholder="Your last name...">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="email" data-constraints="@NotEmpty @Email" placeholder="Your e-mail...">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" data-constraints="@Phone" name="phone" placeholder="Your phone..." class="form-input">
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <textarea name="message" data-constraints="@NotEmpty" placeholder="Message:"></textarea>
                        </div>
                        <!-- RD SelectMenu-->
                        <button class="btn btn-primary btn-sm btn-min-width">send message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-inset-3">
        <div class="container">
            <div class="row text-sm-left">
                <div class="col-xs-12 col-sm-6 col-lg-3 col-lg-offset-1">
                    <address>
                        <div class="media">
                            <div class="media-left"><span class="icon icon-primary icon-sm fa-map-marker"></span></div>
                            <div class="media-body">
                                <p class="h6">Postal Address</p><span><a href="#">
                          The Company Name Inc.
                          9863 - 9867 Mill Road,
                          Cambridge, MG09 99HT.</a></span>
                            </div>
                        </div>
                    </address>
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-3 col-lg-offset-1">
                    <address>
                        <div class="media">
                            <div class="media-left"><span class="icon icon-primary icon-sm fa-phone"></span></div>
                            <div class="media-body">
                                <p class="h6">Phones</p>
                                <dl class="dl-horizontal">
                                    <dt>Phone:</dt>
                                    <dd><a href="callto:#">+1 800 603 6035</a></dd>
                                    <dt>FAX:</dt>
                                    <dd><a href="callto:#">+1 800 889 9898</a></dd>
                                </dl>
                            </div>
                        </div>
                    </address>
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-3 col-lg-offset-1">
                    <address>
                        <div class="media">
                            <div class="media-left"><span class="icon icon-primary icon-sm fa-envelope"></span></div>
                            <div class="media-body">
                                <p class="h6">Email</p><a href="mailto:#">mail@demolink.org</a>
                            </div>
                        </div>
                    </address>
                </div>
            </div>
        </div>
    </section>
@endsection