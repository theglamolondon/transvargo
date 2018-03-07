@extends('layouts._site')

@section('content')
<div class="container bg-light">
    <div class="row">
        <div class="col-xs-12 box">
            <div class="ibox-content clearfix steps">
                <div class="col-md-4 col-xs-4">
                    <div class="step active">
                        <div class="round">
                            <div class="ring one"></div>
                            <div class="cutout">
                                <h3 class="time">1</h3>
                            </div>
                        </div>
                        <h3 class="title">Tarif définitif</h3>
                    </div>
                </div>
                <div class="col-md-4 col-xs-4">
                    <div class="step">
                        <div class="round">
                            <div class="ring one"></div>
                            <div class="ring two"></div>
                            <div class="cutout">
                                <h3 class="time">2</h3>
                            </div>
                        </div>
                        <h3 class="title">Commande</h3>
                    </div>
                </div>
                <div class="col-md-4 col-xs-4">
                    <div class="step">
                        <div class="round">
                            <div class="ring one"></div>
                            <div class="ring two"></div>
                            <div class="ring three"></div>
                            <div class="ring four"></div>
                            <div class="cutout">
                                <h3 class="time">3</h3>
                            </div>
                        </div>
                        <h3 class="title">Confirmation</h3>
                    </div>
                </div>
            </div>

            <br/> <br/>

            <div class="col-md-5 col-lg-6 col-xs-12">
                <aside id="map" style="height: 550px;"></aside>
            </div>

            <div class="col-sm-10 col-md-7 col-lg-6 inset-3">
                <br>
                <form class="form-horizontal" action="" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group">
                            <label for="depart" class="control-label col-md-4 col-sm-6 col-xs-12">Lieu de chargement *</label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <input type="text" class="form-control autocomplete" name="lieudepart" id="lieudepart" data-change="0"  value="{{ old('lieudepart',$expedition->lieudepart) }}">
                                <input type="hidden" name="coorddepart" id="coorddepart" value="{{ old('coorddepart',$expedition->coorddepart) }}">
                                <input type="checkbox" id="myPosition" > Utiliser ma position actuelle
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="depart" class="control-label col-md-4 col-sm-6 col-xs-12">Lieu de déchargement *</label> <span><img src="{{config('app.url')}}/balls.gif" id="spinner" style="display:none; left: 101%; position: absolute; top: 30%;"></span>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <input type="text" class="form-control autocomplete" name="lieuarrivee" id="lieuarrivee" data-change="0" value="{{ old('lieuarrivee',$expedition->lieuarrivee) }}">
                                <input type="hidden" name="coordarrivee" id="coordarrivee" value="{{ old('coordarrivee',$expedition->coordarrivee) }}">
                            </div>
                        </div>


                        <div class="nav nav-tabs"></div>
                        <br/>

                        <div class="form-group date">
                            <label for="depart" class="control-label col-md-4 col-sm-6 col-xs-12">Date d'expédition *</label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" name="datechargement" id="expedition" data-date-start-date="0d" value="{{ old('datechargement',(new \Carbon\Carbon($expedition->datechargement))->format('d/m/Y')) }}">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group date">
                            <label for="depart" class="control-label col-md-4 col-sm-6 col-xs-12">Date d'expiration *</label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" name="dateexpiration" id="expiration" data-date-start-date="0d" value="{{ old('dateexpiration',(new \Carbon\Carbon($expedition->dateexpiration))->format('d/m/Y')) }}">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                </div>
                            </div>
                        </div>

                        <div class="nav nav-tabs"></div>
                        <br/>

                        <div class="form-group">
                            <label for="depart" class="control-label col-md-4 col-sm-6 col-xs-12">Type de camion *</label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <select name="typecamion_id" class="form-control">
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}" @if(old('typecamion_id',$expedition->typecamion_id) == $type->id ) selected @endif>{{ $type->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="depart" class="control-label col-md-4 col-sm-6 col-xs-12">Tonnage du camion</label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <select name="tonnage_id" class="form-control">
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" @if(old('typecamion_id',$expedition->typecamion_id) == $type->id ) selected @endif>{{ $type->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="depart" class="control-label col-md-4 col-sm-6 col-xs-12">Fragile</label>
                            <div class="col-md-2 col-sm-3 col-xs-4">
                                <div class="radio">
                                    <label>
                                        <input data-price="25" type="radio" name="fragile" id="blankRadioYes" value="1" class="numbers-only" @if(old('fragile',$expedition->fragile)) checked @endif />
                                        <span class="radio-field"></span><span>Oui</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-3 col-xs-4">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="fragile" id="blankRadioNo" value="0" checked class="numbers-only" @if(!old('fragile',$expedition->fragile)) checked @endif />
                                        <span class="radio-field"></span><span>Non</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="nav nav-tabs"></div>
                        <br/>



                        <div class="form-group">
                            <label for="depart" class="control-label col-md-4 col-sm-6 col-xs-12">Assurance</label>
                            <div class="col-md-2 col-sm-3 col-xs-4">
                                <div class="radio">
                                    <label>
                                        <input data-price="25" type="radio" name="fragile" id="blankRadioYes" value="1" class="numbers-only" @if(old('fragile',$expedition->fragile)) checked @endif />
                                        <span class="radio-field"></span><span>Oui</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-3 col-xs-4">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="fragile" id="blankRadioNo" value="0" checked class="numbers-only" @if(!old('fragile',$expedition->fragile)) checked @endif />
                                        <span class="radio-field"></span><span>Non</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="depart" class="control-label col-md-4 col-sm-6 col-xs-12">Type d'assurance</label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <select name="assurance_id" class="form-control">
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" @if(old('typecamion_id',$expedition->typecamion_id) == $type->id ) selected @endif>{{ $type->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg">Suivant</button>
                </form>
            </div>
        </div>
    </div>
</div>
<br class="clearfix">
@endsection

@section('script')
    <script src="{{ asset("js/bootstrap-datepicker.min.js") }}"></script>
    <script src="{{ asset("js/bootstrap-datepicker.fr.min.js") }}"></script>
    <script type="application/javascript">
        $('input.datepicker').datepicker({
            format: "dd/mm/yyyy",
            todayBtn: true,
            language: "fr",
            autoclose: true,
        });
    </script>

    <script type="application/ecmascript">
        var DISTANCE_MATRIX_URL = '{{ route('ajax.distancematrix') }}';
        var directionsService = null;
        var directionsDisplay = null;

        $(document).ready(function (){
            $('#myPosition').click(function () {

                if($(this).is(':checked'))
                {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            lat = position.coords.latitude;
                            lng = position.coords.longitude;

                            //permettre la modification du champs
                            $("#lieudepart").attr("data-change",1);

                            document.getElementById("lieudepart").value = lat+","+lng;
                            document.getElementById("coorddepart").value = lat+","+lng;
                        });
                    }
                }
            });
        });

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: {{ \App\Http\Controllers\MapController::COORD_CI_LAT }}, lng: {{ \App\Http\Controllers\MapController::COORD_CI_LNG }} }, //7.5450345,-7.7914844
                zoom: 7
            });
            var options = {
                componentRestrictions: {country: ['ci']}
            };

            var inputD = document.getElementById('lieudepart');
            var inputA = document.getElementById('lieuarrivee');

            var autocompleteD = new google.maps.places.Autocomplete(inputD,options);
            autocompleteD.bindTo('bounds', map); //map

            var autocompleteA = new google.maps.places.Autocomplete(inputA,options);
            autocompleteA.bindTo('bounds', map); //map

            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            autocompleteD.addListener('place_changed', function(e) {
                console.log("place changed");
                console.log(autocompleteD.getBounds());
                $("#lieudepart").attr("data-change",0);

                document.getElementById('coorddepart').value = autocompleteD.getBounds().getCenter().lat()+','+autocompleteD.getBounds().getCenter().lng();
                infowindow.close();
                marker.setVisible(false);
                var place = autocompleteD.getPlace();
                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);  // Why 17? Because it looks good.
                }
                marker.setIcon(/** @type {google.maps.Icon} */({
                    url: place.icon,
                    icon: '{{ config('app.url') }}/working/package32.png',
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);
            });

            autocompleteA.addListener('place_changed', function(e) {
                console.log("place changed");
                $("#lieuarrivee").attr("data-change",0);
                document.getElementById('coordarrivee').value = autocompleteA.getBounds().getCenter().lat()+','+autocompleteA.getBounds().getCenter().lng();
                infowindow.close();
                marker.setVisible(false);
                var place = autocompleteA.getPlace();
                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);  // Why 17? Because it looks good.
                }

                marker.setIcon(/** @type {google.maps.Icon} */({
                    url: place.icon,
                    icon: '{{ asset('/working/package32.png') }}',
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);
            });

            directionsService = new google.maps.DirectionsService;
            directionsDisplay = new google.maps.DirectionsRenderer;

            directionsDisplay.setMap(map);

            var onChangeHandler = function(a) {
                console.log("Lieu content value changed");
                console.log(a);
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            };
            document.getElementById('lieudepart').addEventListener('change', onChangeHandler);
            document.getElementById('lieuarrivee').addEventListener('change', onChangeHandler);

            map.addListener('click',function (event) {
                console.log("Event",event);
                //Déclaration des variables
                var coord_ = event.latLng.lat()+","+event.latLng.lng();
                var lieu_ = event.latLng.lat()+","+event.latLng.lng();
                var change_ = 1; //1 = oui | 0 = non

                if (typeof(event.placeId) !== 'undefined'){
                    var srvPlace = new google.maps.places.PlacesService(map);
                    srvPlace.getDetails({
                        placeId: event.placeId
                    }, function(place, status) {
                        console.log(status, place);
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
                            //console.log(place);
                            coord_ = place.geometry.location.lat()+","+place.geometry.location.lng();
                            lieu_ = place.name+','+place.formatted_address;
                            change_ = 0;

                            //Application des changemements visuels
                            applyChange(coord_,lieu_,change_);
                        }
                    });
                }else {
                    console.log("Place Id undefined");
                    applyChange(coord_,lieu_,change_);
                }
            });
        }

        function applyChange(coord,lieu,change) {
            var event_change = new Event('change');

            if (document.getElementById("lieudepart").value == ""){
                $("#lieudepart").attr("data-change",change);
                document.getElementById("lieudepart").value = lieu;
                document.getElementById("coorddepart").value = coord;
                document.dispatchEvent(event_change);
            }else {
                $("#lieuarrivee").attr("data-change",change);
                document.getElementById("lieuarrivee").value = lieu;
                document.getElementById("coordarrivee").value = coord;
                document.dispatchEvent(event_change);
            }
            //calul de la distance Matrix
            calculateAndDisplayRoute(directionsService, directionsDisplay);
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            directionsService.route({
                origin: document.getElementById('lieudepart').value,
                destination: document.getElementById('lieuarrivee').value,
                travelMode: 'DRIVING',
            }, function(response, status) {
                console.log(response, status);
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                    console.log("Lancement de la requête Ajax");
                    $.ajax(DISTANCE_MATRIX_URL,{
                        method: 'post',
                        dataType: 'json',
                        data:{ from: $("#coorddepart").val(), to : $("#coordarrivee").val()},
                        beforeSend : function (xhr, obj) {
                            $("#spinner").show();
                        },
                        complete : function (xhr, obj) {
                            $("#spinner").hide();
                            xhr.done(function (data) {
                                console.log(data);

                                //Changement de la description des villes si dans les input les coordonnées sont affichées
                                var regex = /^[\d\.,-]*$/;
                                if($("#lieudepart").val().match(regex) != null)
                                    $('#lieudepart').val(data.origin_addresses[0]);

                                if($("#lieuarrivee").val().match(regex) != null)
                                    $('#lieuarrivee').val(data.destination_addresses[0]);

                                if(data.rows[0].elements[0].status != "ZERO_RESULTS")
                                {
                                    //Affichage du résultat de distance Matrix
                                    $("#distance").val(data.rows[0].elements[0].distance.text);

                                    var km = (data.rows[0].elements[0].distance.text).replace(" km",'');

                                    $("#_distance").val((data.rows[0].elements[0].distance.text).replace(" km",''));

                                    $("#total").text(parseInt(km) * {{\App\Expedition::UNIT_PRICE}});
                                    $("#prix").val(parseInt(km) * {{\App\Expedition::UNIT_PRICE}});
                                }else{

                                }
                            })
                        },
                        error: function (xhr, obj) {
                            $("#spinner").hide();
                            $("#error").text("Une erreur de connexion est survenue. Nous n'arrivons pas à déterminer la distance en Km. Vérifier votre connexion SVP !");
                        }
                    });
                } else {
                    console.log("erreur de calcul de distance");
                    $("#error").text("Une erreur de connexion est survenue. Nous n'arrivons pas à déterminer la distance en Km. Vérifier votre connexion SVP !");
                    //window.alert('Directions request failed due to ' + status);
                }
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ \App\Http\Controllers\MapController::API_KEY }}&libraries=places&callback=initMap">
    </script>
@endsection