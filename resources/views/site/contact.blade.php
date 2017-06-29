@extends('layouts._site')

@section('content')
    <section class="section section-inset-1">
        <div class="container">
            <h2 class="titre">Contactez-nous</h2>
            <div class="separateur"></div>
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">

                    <form method="post" action="" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-4 col-xs-12 col-sm-5">Nom et prénoms *</label>
                            <div class="col-md-8 col-xs-12 col-sm-7">
                                <input type="text" name="fullname" class="form-control" placeholder="Votre nom et prénoms" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-xs-12 col-sm-5">Objet du message</label>
                            <div class="col-md-8 col-xs-12 col-sm-7">
                                <input type="text" name="subject" placeholder="Objet du message" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-xs-12 col-sm-5">Email *</label>
                            <div class="col-md-8 col-xs-12 col-sm-7">
                                <input type="text" name="email" class="form-control" placeholder="Votre adresse email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-xs-12 col-sm-5">Téléphone (facultatif)</label>
                            <div class="col-md-8 col-xs-12 col-sm-7">
                                <input type="text" name="contact" placeholder="Votre téléphone" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-xs-12 col-sm-5">Message *</label>
                            <div class="col-md-8 col-xs-12 col-sm-7">
                                <textarea name="message" placeholder="Laissez nous votre message" class="form-control" required></textarea>
                            </div>
                        </div>

                        <br class="clearfix"/>
                        <button class="btn btn-primary btn-sm btn-min-width" type="submit">Envoyer</button>
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
                                <p class="h6">Adresse postale</p><span>
                                    <a href="#">
                                      {{config('app.name','Transvargo')}} SARL.
                                      Marcory résidentiel</a></span>
                            </div>
                        </div>
                    </address>
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-3 col-lg-offset-1">
                    <address>
                        <div class="media">
                            <div class="media-left"><span class="icon icon-primary icon-sm fa-phone"></span></div>
                            <div class="media-body">
                                <p class="h6">Contact</p>
                                <dl class="dl-horizontal">
                                    <dt>Phone:</dt>
                                    <dd><a href="callto:0022540504663">(+225) 40 50 46 63</a></dd>
                                    <dt>FAX:</dt>
                                    <dd><a href="callto:78264623">(+225) 78 26 46 23</a></dd>
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
                                <p class="h6">Email</p><a href="mailto:contact@transvargo.com">contact@transvargo.com</a>
                            </div>
                        </div>
                    </address>
                </div>
            </div>
        </div>
    </section>
@endsection