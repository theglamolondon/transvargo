@extends('layouts._site')
@section('content')
<section class="section section-inset-1">
    <div class="col-md-12">
        <div class="">
            <div class="col-md-6 col-sm-8 col-xs-12">
                <h3 class="text-left">Itinéraire</h3>
                <div class="separateur"></div>
            </div>
        </div>

        <div class="clearfix">
            <div class="col-md-12 col-sm-12">
                <div id="map" style="height: 900px;"></div>
            </div>
        </div>
    </div>
    <br class="clearfix" />
</section>
@endsection

@section('script')
<script type="application/javascript">
    function initMap(){
        let navigationPoints = [@foreach($positions as $position){lat: {{$position->latitude}},lng: {{$position->longitude}}},@endforeach];
        let map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: {{ $positions->last()->latitude ?? 0 }},
                lng: {{ $positions->last()->longitude ?? 0 }}
            },
            zoom: 15
        });

        let itineraire = new google.maps.Polyline({
            path: navigationPoints,
            geodesic: true,
            strokeColor: '#F75958',
            strokeOpacity: 0.8,
            strokeWeight: 2
        });

        itineraire.setMap(map);

        let infoWindow = new google.maps.InfoWindow;

        //Départ -----------------------------------------------------------------------------------------------------------
        let markerDepart = new google.maps.Marker({
            map: map,
            animation: google.maps.Animation.DROP,
            position: {lat: {{ explode(",",$expedition->coorddepart)[0] }}, lng: {{ explode(",",$expedition->coorddepart)[1] }} },
            icon: '{{ asset('working/drapeaudamier32.gif') }}',
        });

        let infowincontentDepart = "<div>"
            +"<strong>Expédition {{ $expedition->reference }}</strong><br/>"
            +"<b>Masse</b> :  {{ $expedition->masse }} kg<br/>"
            +"<b>Fragile</b> : {{ $expedition->fragile ?"oui" : "non" }}<br/>"
            +"</div>";

        markerDepart.addListener('click', function() {
            toggleBounce(markerDepart);
            infoWindow.setContent(infowincontentDepart);
            infoWindow.open(map, markerDepart);
        });

        //Actuel -----------------------------------------------------------------------------------------------------------
        let markerArrivee = new google.maps.Marker({
            map: map,
            animation: google.maps.Animation.DROP,
            position: {lat: {{$positions->last()->latitude ?? 0}}, lng: {{$positions->last()->longitude ?? 0}} },
            icon: '{{ asset('working/truck-map-marker30x42.png') }}',
        });

        let infowincontentArrivee = "<div>"
            +"<b>Immatriculation</b> {{ $vehicule->immatriculation }}<br/>"
            +"<b>Vitesse</b> : {{ ceil( ($positions->last()->speed ?? 1)*3.6) }} km/h<br/>"
            +"<b>Dernière position</b> : {{ (new \Carbon\Carbon($positions->last()->datelocalisation ?? ""))->format("d/m/Y à H:i") }}<br/>"
            +"</div>";

        markerArrivee.addListener('click', function() {
            toggleBounce(markerArrivee);
            infoWindow.setContent(infowincontentArrivee);
            infoWindow.open(map, markerArrivee);
        });

        function toggleBounce(marker)
        {
            if (marker.getAnimation() !== null) {
                marker.setAnimation(null);
            } else {
                marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        }
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ \App\Http\Controllers\MapController::API_KEY }}&libraries=places&callback=initMap">
</script>
@endsection