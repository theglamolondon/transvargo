@extends('layouts._site')

@section('content')
    <style href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"></style>
    <section class="container-fluid">
        <div class="col-md-offset-1 col-md-6 col-sm-5 col-xs-12">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <h3 class="titre">Détails</h3>
                <div class="separateur"></div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <p class="text-left">
                        <img src="{{ config('app.url') }}/working/package32.png">
                        <strong>{{ $expedition->lieudepart }}</strong><br/>
                        <small class="small">A partir du {{ (new \Carbon\Carbon($expedition->datechargement))->format("d/m/Y") }}</small>
                    </p>
                    <hr class=""/>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <p class="text-left">
                        <img src="{{ config('app.url') }}/working/drapeaudamier32.gif">
                        <strong>{{ $expedition->lieuarrivee }}</strong><br/>
                        <small class="small">Jusqu'au {{ (new \Carbon\Carbon($expedition->dateexpiration))->format("d/m/Y") }}</small>
                    </p>
                    <hr class=""/>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <h3 class="text-center">{{ number_format($expedition->prix * \App\Transporteur::POURCENTAGE,0,',',' ') }} F CFA</h3>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <p class="text-left">
                        <span><i class="glyphicon glyphicon-briefcase"></i> Sociéte au chargement </span> <br/>
                        <strong>{{ $expedition->chargement->societechargement }}</strong>
                    </p>
                    <p class="text-left">
                        <span><i class="glyphicon glyphicon-user"></i> Contact au chargement </span> <br/>
                        <strong>{{ $expedition->chargement->contactchargement }}</strong>
                        <br/>
                        <i class="glyphicon glyphicon-earphone"></i>
                        <a href="callto:{{ $expedition->chargement->telephonechargement }}">{{ $expedition->chargement->telephonechargement }}</a>
                    </p>
                    <hr/>
                    <p class="text-left">
                        <strong>Remarques :</strong> <br/>
                        {{ $expedition->chargement->adressechargement }}
                    </p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <p class="text-left">
                        <span><i class="glyphicon glyphicon-briefcase"></i> Sociéte à la livraison </span> <br/>
                        <strong>{{ $expedition->chargement->societelivraison }}</strong>
                    </p>
                    <p class="text-left">
                        <span><i class="glyphicon glyphicon-user"></i> Contact à la livraison :</span> <br/>
                        <strong>{{ $expedition->chargement->contactlivraison }}</strong>
                        <br/>
                        <i class="glyphicon glyphicon-earphone"></i>
                        <a href="callto:{{ $expedition->chargement-> telephonelivraison}}">{{ $expedition->chargement->telephonelivraison }}</a>
                    </p>
                    <hr/>
                    <p class="text-left">
                        <strong>Remarques :</strong> <br/>
                        {{ $expedition->chargement->adresselivraison }}
                    </p>
                </div>

                @if($expedition->chargement->vehicule_id == null )
                <form class="col-md-4" method="post" action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="immatriculation" class="h6 text-center">Affecter un véhicule</label>
                            <select name="immatriculation" id="immatriculation" class="form-control">
                                @foreach($vehicules as $vehicule)
                                    @if($vehicule->typeCamion)
                                    <option value="{{ $vehicule->immatriculation }}">{{ $vehicule->immatriculation }} ({{ $vehicule->chauffeur }})</option>
                                    @endif
                                @endforeach
                            </select>

                            <input type="hidden" name="reference" value="{{ $expedition->reference }}">
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <br/>
                            <label class="text-gray text-center"><i class="glyphicon glyphicon-usd"></i> Sans aucun frais pour vous </label>
                            <label class="text-gray text-center"><i class="glyphicon glyphicon-check"></i> Paiement 30 jours garanti </label>
                            <button type="submit" class="btn btn-primary btn-xs form-control">Accepter l'offre</button>
                        </div>
                    </div>
                </form>
                @endif
            </div>

            @if($expedition->chargement->vehicule_id != null )
            <br class="clearfix"/>
            <br/>
            <br/>
            <br/>
            <h3 class="titre">Progression</h3>
            <div class="separateur"></div>

            <div class="col-md-12">
                <div class="element">
                    <span class="state active">1</span>
                    <span>Acceptée</span>
                    <span class="bar"></span>
                </div>
                <div class="element">
                    <span class="state">2</span>
                    <span>En chargement</span>
                    <span class="bar"></span>
                </div>
                <div class="element">
                    <span class="state">3</span>
                    <span>Chargement terminée</span>
                    <span class="bar"></span>
                </div>
                <div class="element">
                    <span class="state">4</span>
                    <span>En livraison</span>
                    <span class="bar"></span>
                </div>
                <div class="element">
                    <span class="state">5</span>
                    <span>Terminé</span>
                </div>
            </div>
            @endif
            <br class="clearfix">
        </div>
        <div class="col-md-4 col-sm-7 col-xs-12">
            <div id="map" style="height: 550px"></div>
        </div>
    </section>

    <br class="clearfix"/>
@endsection

@section('script')
    <script type="text/javascript">
        var directionsDisplay;
        var directionsService;

        function initMap() {
            directionsService = new google.maps.DirectionsService();

            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: {{ \App\Http\Controllers\MapController::COORD_CI_LAT }},
                    lng: {{ \App\Http\Controllers\MapController::COORD_CI_LNG }}
                },
                zoom: 7
            });

            directionsDisplay = new google.maps.DirectionsRenderer();
            directionsDisplay.setMap(map);
            calcRoute();
        }

        function calcRoute() {
            var start = new google.maps.LatLng({{ $expedition->coorddepart }});
            var end   = new google.maps.LatLng({{ $expedition->coordarrivee }});
            var request = {
                origin: start,
                destination: end,
                travelMode: 'DRIVING'
            };
            directionsService.route(request, function(result, status) {
                if (status == 'OK') {
                    directionsDisplay.setDirections(result);
                }
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ \App\Http\Controllers\MapController::API_KEY }}&libraries=places&callback=initMap">
    </script>
@endsection