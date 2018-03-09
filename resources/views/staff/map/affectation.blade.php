@extends('layouts._site')
@section('content')
    <section class="section section-inset-1">
        <div class="col-md-12">
            <div class="">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <h3 class="text-left">Cartographie des transporteurs</h3>
                    <div class="separateur"></div>
                </div>
            </div>
        </div>

        <div class="clearfix">
            <form action="" method="post">
                {{ csrf_field() }}
                <div class="col-md-2 col-sm-12">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <b>Expédition</b>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="N° d'expédition" disabled name="reference" id="reference" value="{{ $expedition->reference }}">
                                <input type="hidden" name="expedition_id" value="{{ $expedition->id }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <b>Transporteur</b>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nom du transporteur" disabled name="transporteur" id="transporteur" value="">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <b>Véhicule</b>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Immatriculation" disabled name="immatriculation" id="immatriculation" value="">
                                <input type="hidden" name="vehicule_id" id="vehicule_id">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <b>Prix de l'expédition</b>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="prix de l'expediton" name="prix" id="prix" value="0">
                            </div>
                        </div>

                        @if($expedition->isassure)
                            <div class="col-md-12">
                                <b>Prix de l'assurance</b><br>
                                <span>{{ $expedition->assurance->libelle }}</span>
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="prix de l'assurance" name="mttassurance" id="mttassurance" value="0">
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12">
                            <br><br><br>
                            <div class="input-group">
                                <button id="search" type="submit" class="btn btn-sm bg-dark">Choisir ce transporteur</button>
                            </div>
                            <br/><br/>
                        </div>
                    </div>
                </div>
            </form>

            <div class="col-md-10 col-sm-12">
                <div id="map" style="height: 900px;"></div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="application/javascript">
        let VEHICULES = {!! json_encode($localisations, JSON_UNESCAPED_UNICODE) !!};
        let VEHICULE_ACTIF = {};
        let URL = "#_#_";
        let URL_ITINERAIRE = '{{route("staff.expeditions.itineraire", ['immatriculation' => "_#1_", 'refrerence' => $expedition->reference ])}}';

        function initMap(){
            let map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: {{ \App\Http\Controllers\MapController::COORD_CI_LAT }},
                    lng: {{ \App\Http\Controllers\MapController::COORD_CI_LNG }} },
                zoom: 8
            });

            let infoWindow = new google.maps.InfoWindow;

            for(i = 0; i < VEHICULES.length; i++)
            {
                if( VEHICULES[i].coord != null)
                {
                    $coords = VEHICULES[i].coord.split(',');
                    let marker = new google.maps.Marker({
                        map: map,
                        animation: google.maps.Animation.DROP,
                        position: new google.maps.LatLng(parseFloat($coords[0]), parseFloat($coords[1])),
                        icon: '{{ asset('working/truck-map-marker30x42.png') }}',
                        tag : VEHICULES[i],
                    });

                    let infowincontent = "<div>"
                        +"<a href='"+URL.replace("_#_",VEHICULES[i].immatriculation)+"'>"
                        +"<b>Transporteur</b> : " + VEHICULES[i].raisonsociale + " (" +VEHICULES[i].nom +" "+ VEHICULES[i].prenoms +")</a><br/>"
                        +"<b>Téléphone</b> : " + VEHICULES[i].contact  + "<br/>"
                        +"<b>Véhicule</b> : " + VEHICULES[i].immatriculation + " (" +VEHICULES[i].typecamion + ")<br/>"
                        +"<b>Chauffeur</b> : " + VEHICULES[i].chauffeur + " (<i class='glyphicon glyphicon-phone'></i>"+ VEHICULES[i].ch_telephone +")" +"<br/>"
                        +"<hr style='display: block; width: 100%; margin: 4px 0;'/>"
                        +"<a href='"+ (URL_ITINERAIRE.replace("_#1_",VEHICULES[i].immatriculation))+"'>Afficher l'itinéraire ...</a>"+"<br/>"
                        +"</div>";

                    marker.addListener('click', function() {
                        $("#transporteur").val(marker.tag.chauffeur);
                        $("#immatriculation").val(marker.tag.immatriculation);
                        $("#vehicule_id").val(marker.tag.veh_id);
                        toggleBounce(marker);
                        infoWindow.setContent(infowincontent);
                        infoWindow.open(map, marker);
                    });

                    VEHICULE_ACTIF[VEHICULES[i].immatriculation] = marker;
                }
            }

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