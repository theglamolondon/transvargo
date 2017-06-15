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
            <p>Transvargo est une plateforme de réservation de camion en ligne qui met en relation transporteur et expéditeur.
                A travers notre plateforme web  et notre application mobile nous voulons révolutionner ce secteur délaissé en aidant les expéditeurs
                à expédier rapidement, simplement et à moindre  coût mais aussi les transporteurs à trouver du fret. </p>
        </div>
    </section>

    <section class="section section-inset-1">
        <div class="container">
            <h2 class="text-center">Vos avantages</h2>
            <hr>
            <div class="row text-sm-left flow-offset-4 clearleft-custom">
                <div class="col-xs-12 col-sm-6">
                    <div class="media">
                        <div class="media-left"><img src="working/money.png" alt="" class="square_150"/></div>
                        <div class="media-body">
                            <h4 class="text-primary">Meilleur prix</h4>
                            <p class="h6">Payez le tarif le plus juste  du marché.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="media">
                        <div class="media-left"><img src="working/locate.jpg" alt="" class="square_150"/></div>
                        <div class="media-body">
                            <h4 class="text-primary">Suivi en temps réel.</h4>
                            <p class="h6">Avec notre outil de géolocalisation vous pouvez suivre  chaque étape de votre expédition.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="media">
                        <div class="media-left"><img src="working/valide.jpg" alt="" class="square_150"/></div>
                        <div class="media-body">
                            <h4 class="text-primary">Fiable et sécurisé</h4>
                            <p class="h6">Nos transporteurs sont uniquement des professionnels. Nous vérifions leur conformité.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="media">
                        <div class="media-left"><img src="working/process.png" alt="" class="square_150"/></div>
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