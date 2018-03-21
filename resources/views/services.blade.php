@extends('layouts._site')

@section('slider')
    <div class="row page-head height">
        <img src="{{ asset("working/transport_assurance.png") }}">
    </div>
@endsection

@section('content')
    <section class="section section-inset-2 bg-light">
        <div class="container">
            <h2 class="text-center"> Transport </h2>
            <hr/>
            <p>Pour le transport de vos produits vous pouvez commander votre camion par téléphone au <a href="callto:00225{{ trim(env("APP_CALL")) }}">{{ env("APP_CALL") }}</a> ou en vous connectant directement  sur la plateforme.
                Entrez dans la partie inscription  ou créer son compte pour créer votre compte et commencer à gérer vos expéditions de manière sécurisée. Un commercial entrera en contact avec vous pour vous donner plus d’informations  afin de vous aider à mieux utiliser nos services.</p>
        </div>
    </section>

    <section class="section section-inset-1" id="avantages">
        <div class="container">
            <h2 class="text-center">Assurance</h2>
            <hr>
            <p>Pour vous permettre d’assurer votre marchandise en ligne sans vous déplacer, nous avons choisi comme partenaire NSA assurances. A cet effet nous vous  permettons de souscrire à deux options de garanties, contenues dans les conditions tarifaires ci-dessous.</p>

            <h3>Conditions tarifaires</h3>
            <p>Option 1: Accidents caractérisés + vols consécutifs</p>
            <ul><li>Taux unique RO : 0,20 %</li></ul>
            <p>Option 2: Accidents caractérisés + vols consécutifs +risques de chargement et de déchargement.</p>
            <ul><li>Taux unique RO : 0,25 %</li></ul>
            <p>Autres dispositions</p>
            <ul>
                <li><b>-</b>Prime nette minimum : 10 000 FCFA</li>
                <li><b>-</b>Accessoires : 5 000 par expédition</li>
                <li><b>-</b>Taxe d’enregistrement : 14,5 % applicable sur la prime + accessoires.</li>
            </ul>
            <p>Pour en savoir plus joignez le service commercial au <a href="callto:callto:00225{{ trim(env("APP_CALL")) }}">{{ env("APP_CALL") }}</a></p>
        </div>
    </section>
    <section class="section section-inset-2 bg-light">
        <div class="container">
            <h2 class="text-center">Déménagement</h2>
            <hr/>
            <p>Pour votre  déménagement contacter directement  le service commercial <a href="callto:00225{{ trim(env("APP_CALL")) }}">55 596 855</a>.
                Afin d’avoir plus d’informations. Notre souci est de rester à votre écoute pour que votre déménagement soit pour vous une aventure agréable.
            </p>
        </div>
    </section>
@endsection