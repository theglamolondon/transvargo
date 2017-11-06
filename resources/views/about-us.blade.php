@extends('layouts._site')

@section('slider')
    <div class="row page-head height">
        <img src="images/about-us.jpg">
    </div>
@endsection

@section('content')
    <section class="section section-inset-2 bg-light">
        <div class="container">
            <h2 class="text-center"> Qui sommes-nous ?</h2>
            <hr/>
            <p class="about-us">Transvargo est une plateforme de réservation de camion qui entend révolutionner le transport routier de marchandise. A travers notre application web et mobile nous connectons, quiconque veut expédier des produits avec des transporteurs, quel que soit sa position géographique.</p>
            <p class="about-us">En plus d’offrir à nos clients une solution simple, rapide  et économique nous propulsons l’avenir du transport routier de marchandise en Afrique en aidant l’expéditeur à déplacer leurs marchandises de manière efficace et les transporteurs à augmenter leurs revenues.</p>
        </div>
    </section>

    <section class="section section-inset-1" id="avantages">
        <div class="container">
            <h2 class="text-center">Vos avantages</h2>
            <hr>
            <div class="row text-sm-left flow-offset-4 clearleft-custom">
                <div class="col-xs-12 col-sm-6">
                    <div class="media">
                        <div class="media-left"><img src="{{asset('working/money.png')}}" alt="" class="square_150"/></div>
                        <div class="media-body">
                            <h4 class="text-primary">Meilleur prix</h4>
                            <p class="h6">Payez le tarif le plus juste  du marché.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="media">
                        <div class="media-left"><img src="{{asset('working/local.png')}}" alt="" class="square_150"/></div>
                        <div class="media-body">
                            <h4 class="text-primary">Suivi en temps réel.</h4>
                            <p class="h6">Avec notre outil de géolocalisation vous pouvez suivre  chaque étape de votre expédition.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="media">
                        <div class="media-left"><img src="{{ asset('working/FINGER.png')}}" class="square_150"/></div>
                        <div class="media-body">
                            <h4 class="text-primary">Fiable et sécurisé</h4>
                            <p class="h6">Nos transporteurs sont uniquement des professionnels. Nous vérifions leur conformité.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="media">
                        <div class="media-left"><img src="{{asset('working/boulecrou.png')}}" alt="" class="square_150"/></div>
                        <div class="media-body">
                            <h4 class="text-primary">Gestion automatisée</h4>
                            <p class="h6">grâce au tableau de bord accéder à toutes vos expéditions, vos  documents de transport et vos factures.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection