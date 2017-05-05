@extends('layouts._site')

@section('content')
    <section class="row bg-dark">
        <div class="col-md-2 col-sm-12 col-xs-12" style="padding-left: 30px;">
            <br/>
            <div class="form-group">
                <input type="text" class="form-control autocomplete" name="search" id="search" placeholder="Affiner votre recherche">
            </div>
            <hr/>

            <aside class="form-group">
                <label class="material">Départ</label>
                <input type="text" class="form-control" name="depart" id="depart" placeholder="Départ du chargement">
                <label class="material">Arrivée</label>
                <input type="text" class="form-control" name="arrivee" id="arrivee" placeholder="Arrivée du chargement">
            </aside>
            <hr/>
            <aside class="form-group">
                <label> <i class="fa fa-calendar"></i> Date de chargement</label>
                <input class="form-control" id="datechargement" placeholder="Date d'enlèvement">

                <label> <i class="fa fa-truck"></i> Masse au chargement </label>
                <input class="form-control" id="masse" placeholder="Masse au chargement">
            </aside>

            <aside class="form-group">
                <a href="#" class="btn btn-primary btn-xs form-control" id="reference">Accepter</a>
            </aside>
            <button class="btn btn-primary btn-xs btn-primary-variant-1"> <i class="fa fa-map-marker"></i>Itinéraire</button>
        </div>

        <div id="map" class="col-md-10 col-sm-12 col-xs-12" style="height: 900px; padding: 8px;"></div>

        <br class="clearfix"/>
    </section>

    <div id="waiting" >
        <div class="msg"> <img src="{{config('app.url')}}/balls.gif" /> <h4>Chargement ...</h4></div>
    </div>
    <br style="margin-bottom: 5px;">
@endsection

@section('script')
    <script type="application/ecmascript">

        var OFFERS_URL = '{{ route('ajax.offers') }}';
        var ACCEPT_URL = '{{ route('transport.accept',['reference' => '_ref_']) }}';

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: {{ \App\Http\Controllers\MapController::COORD_CI_LAT }}, lng: {{ \App\Http\Controllers\MapController::COORD_CI_LNG }} },
                zoom: 8
            });

            //Autocomplète
            var input = document.getElementById('search');
            var bounds = new google.maps.LatLngBounds(
                    new google.maps.LatLng({{ \App\Http\Controllers\MapController::COORD_CI_LAT }},{{ \App\Http\Controllers\MapController::COORD_CI_LNG }})
            );
            var options = {bounds: bounds};

            var autocomplete = new google.maps.places.Autocomplete(input, options);

            autocomplete.addListener('place_changed', function(e) {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }
                console.log(autocomplete.getBounds());

                /*
                var bermudaTriangle = new google.maps.Polygon({
                    paths: autocomplete.getBounds(),
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 3,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35
                });
                bermudaTriangle.setMap(map);
                */

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);  // Why 17? Because it looks good.
                }
            });

            //Chargement des offres
            $.ajax(OFFERS_URL,{
                method: 'get',
                dataType: 'json',
                beforeSend : function (xhr, obj) {
                    $("#waiting").show();
                },
                complete : function (xhr, obj) {
                    xhr.done(function (data) {
                        for(var i=0; i < data.length; i++)
                        {
                            var marker = new google.maps.Marker({
                                //anchorPoint: new google.maps.Point(0, -29),
                                position:{lat: parseFloat((data[i].coorddepart.split(','))[0]), lng: parseFloat((data[i].coorddepart.split(','))[1]) },
                                icon: '{{ config('app.url') }}/working/package32.png',
                                map: map,
                            });
                            marker.ref = data[i];
                            marker.addListener('click',function () {
                                $("#depart").val(this.ref.lieudepart);
                                $("#arrivee").val(this.ref.lieuarrivee);
                                $("#masse").val(this.ref.masse+' KG');
                                $("#datechargement").val(this.ref.datechargement);
                                $("#reference").attr('href',ACCEPT_URL.replace('_ref_',this.ref.reference));
                                //console.log(this);
                            })
                        }
                    });

                    //Cacher le loader
                    $("#waiting").hide();
                }
            });
        }
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ \App\Http\Controllers\MapController::API_KEY }}&libraries=places&callback=initMap">
    </script>
@endsection