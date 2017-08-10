@extends('layouts._site')

@section('content')
    <section class="section section-inset-1">
        <div class="container">
            <h3 class="text-left">Paiement des frais d'expédition</h3>
            <div class="separateur"></div>

            <div class="col-md-12">

            </div>

            <div class="col-md-12">
                <h3>Veuillez choisir votre moyen de paiement ci-dessous :</h3>
                <div class="col-md-4">
                    <form action="{{ $OM::URL_SENT_DATA }}" method="post" enctype="application/x-www-form-urlencoded">
                        <input type="hidden" name="merchandid" value="{{ $OM->getComteId() }}" />
                        <input type="hidden" name="purchaseref" value="{{ $expedition->reference }}" />
                        <input type="hidden" name="amount" value="{{ $expedition->prix }}" />
                        <input type="hidden" name="token" value="{{ $OM->getToken() }}" >
                        <input type="hidden" name="sessionid" value="{{ $OM->getSessionId() }}" />
                        <input type="hidden" name="description"  value="{{ $expedition->__toString() }}" />
                        <input type="hidden" name="tag"   value="{{ csrf_token() }}" />
                        <input type="hidden" name="contact_partenaire"  value="{{ "XX XX XX XX" }}" />
                        <input type="hidden" name="logo_url" value="{{ $OM->getLogoUrl() }}" />
                        <input type="hidden" name="site_title"  value="{{ $OM->getSiteTitle() }}" />
                        <input type="hidden" name="returnAdress"  value="{{ $OM->getReturnAdress() }}" />
                        <input type="hidden" name="errorReturnAdress"  value="{{ $OM->getErrorReturnAdress() }}" />

                        <button class="x200" type="submit"><img class="money" src="{{ asset("money/pay-orange-money.png") }}" alt="Orange-money"/> </button>
                    </form>
                </div>
                <div class="col-md-4">
                    <form action="#" method="post">
                        <button class="x200" type="button"><img class="money" style="padding-top: 4px;" src="{{ asset("money/pay-visa.png") }}" alt="Visa"/> </button>
                    </form>

                </div>
                <div class="col-md-4">
                    <form action="#" method="post">
                        <button class="x200" type="submit"><img class="money" src="{{ asset("money/pay-mtn-money.jpg") }}" alt="MTN-money"/> </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection