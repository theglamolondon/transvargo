@extends('layouts._site')

@section('content')
    <style href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"></style>
    <section class="container-fluid">
        <div class="col-md-8 col-sm-5 col-xs-12">
            <div class="col-md-12 col-sm-12 col-xs-12">

                @foreach($errors->all() as $erreur)
                    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>{{ $erreur }}</div>
                @endforeach

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <p class="">
                        <img src="{{ config('app.url') }}/working/package32.png">
                        <strong>{{ $expedition->lieudepart }}</strong>
                        <small class="small">{{ $expedition->coorddepart }}</small>
                    </p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <p class="">
                        <img src="{{ config('app.url') }}/working/drapeaudamier32.gif">
                        <strong>{{ $expedition->lieuarrivee }}</strong>
                        <small class="small">{{ $expedition->coordarrivee }}</small>
                    </p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <h4 class="text-center">{{ number_format($expedition->prix,0,',',' ') }} F CFA</h4>
                </div>
            </div>

            <hr class="clearfix"/>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form class="" method="post" action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="immatriculation" class="h6">Affecter un véhicule</label>
                            <select name="immatriculation" id="immatriculation" class="form-control">
                                @foreach($vehicules as $vehicule)
                                    @if($vehicule->typeCamion)
                                    <option value="{{ $vehicule->immatriculation }}">{{ $vehicule->immatriculation }}</option>
                                    @endif
                                @endforeach
                            </select>

                            <input type="hidden" name="reference" value="{{ $expedition->reference }}">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label class="h6 text-gray text-center"><i class="fa fa-money"></i> Sans aucun frais pour vous </label>
                            <label class="h6 text-gray text-center"><i class="fa fa-check"></i> Paiement 30 jours garanti </label>
                            <button type="submit" class="btn btn-primary btn-xs form-control">Accepter l'offre</button>
                        </div>
                    </div>
                </form>
            </div>
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