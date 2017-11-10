@extends('layouts._site')
@section('content')
<section class="section section-inset-1">
    <div class="col-md-12">
        <div class="">
            <div class="col-md-6 col-sm-8 col-xs-12">
                <h3 class="text-left">Cartographie des expéditions en cours</h3>
                <div class="separateur"></div>
            </div>
        </div>
    </div>

    <div class="clearfix">
        <div class="col-md-2 col-sm-12">
            <div class="col-md-12">
                <div class="col-md-12">
                    <b>Expédition</b>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="N° d'expédition" name="reference" id="reference" value="{{ request()->query("reference") }}">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i> </span>
                    </div>
                    <br/><br/>
                </div>

                <div class="col-md-12">
                    <b>Véhicule</b>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Immatriculation" name="immatriculation" id="immatriculation" value="{{ request()->query("immatriculation") }}">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i> </span>
                    </div>
                    <br/><br/>
                </div>

                <div class="col-md-12">
                    <div class="input-group">
                        <button id="search" type="button" class="btn btn-sm bg-dark">Rechercher</button>
                    </div>
                    <br/><br/>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-sm-12">
            <div id="map" style="height: 900px;"></div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script type="application/javascript">
    let EXPEDITIONS_ACTIVES = {};

    function initMap(){
        let map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: {{ \App\Http\Controllers\MapController::COORD_CI_LAT }},
                lng: {{ \App\Http\Controllers\MapController::COORD_CI_LNG }} },
            zoom: 8
        });

        let infoWindow = new google.maps.InfoWindow;

        $.get("{{ route('staff.expeditions.localistion') }}", function (data) {
            console.log(data);
            let URL = '{{route("staff.offre.details", ['refrerence' => "_#_"])}}'

            for(i = 0; i < data.length; i++)
            {
                let marker = new google.maps.Marker({
                    map: map,
                    animation: google.maps.Animation.DROP,
                    position: new google.maps.LatLng(parseFloat(data[i].position.latitude), parseFloat(data[i].position.longitude)),
                    icon: '{{ asset('working/truck-map-marker30x42.png') }}',
                    tag : data[i],
                });

                let infowincontent = "<div>"
                    +"<a href='#'><strong>Expédition " + data[i].expedition.reference+"</strong></a><br/>"
                    +"<b>Transporteur</b> : " + data[i].expedition.chargement.vehicule.transporteur.raisonsociale + " (" +data[i].expedition.chargement.vehicule.transporteur.nom +" "+ data[i].expedition.chargement.vehicule.transporteur.prenoms +")<br/>"
                    +"<b>Véhicule</b> : " + data[i].expedition.chargement.vehicule.immatriculation + " (" +data[i].expedition.type_camion.libelle + ")<br/>"
                    +"<b>Chauffeur</b> : " + data[i].expedition.chargement.vehicule.chauffeur + " (<i class='glyphicon glyphicon-phone'></i>"+ data[i].expedition.chargement.vehicule.telephone +")" +"<br/>"
                    +"</div>";

                marker.addListener('click', function() {
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                    infoWindow.setContent(infowincontent);
                    infoWindow.open(map, marker);
                });

                EXPEDITIONS_ACTIVES[data[i].expedition.reference] = marker;
            }
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ \App\Http\Controllers\MapController::API_KEY }}&libraries=places&callback=initMap">
</script>
@endsection