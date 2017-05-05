@extends('layouts._site')

@section('content')
<div class="col-md-12 col-xs-12">
    <aside id="map" style="height: 550px;"></aside>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12">

            @foreach($errors->all() as $erreur)
                <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>{{ $erreur }}</div>
            @endforeach

            <div class="col-md-5 col-lg-6 visible-md visible-lg">
                <div class="img-thumbnail-mod-2"><img src="{{config('app.url')}}/images/index-2.jpg" width="705" height="655" alt=""></div>
            </div>
            <div class="col-sm-10 col-md-7 col-lg-6 inset-3">
                <br>
                <form class="form-horizontal" action="" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group date" data-provide="datepicker">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="depart" class="h6">Date de chargement *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" name="datechargement" id="datepicker">
                                    <span class="input-group-addon"> <i class="glyphicon glyphicon-th"></i> </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="depart" class="h6">De (ville) *</label>
                                <input type="text" class="form-control autocomplete" name="lieudepart" id="lieudepart" data-change="0">
                                <input type="hidden" name="coorddepart" id="coorddepart">
                                <input type="checkbox" id="myPosition" > Utiliser ma position actuelle
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="arrivee" class="h6">A (ville) *</label> <span><img src="{{config('app.url')}}/balls.gif" id="spinner" style="display:none; left: 101%; position: absolute; top: 30%;"></span>
                                <input type="text" class="form-control autocomplete" name="lieuarrivee" id="lieuarrivee" data-change="0">
                                <input type="hidden" name="coordarrivee" id="coordarrivee">
                            </div>
                        </div>

                        <div class="form-group distance">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="distance" class="h6">Distance (km) *</label>
                                <input type="text" class="numbers-only form-control" id="distance" disabled>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="weight" class="h6">Masse (kg)</label>
                                <input type="text" id="weight" class="numbers-only form-control" name="masse">
                             </div>
                        </div>

                        <div class="form-group">
                            <label class="h6">Type de camion</label>
                            <select name="typecamion_id" class="form-control">
                                @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->libelle }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <p class="h6">Fragile</p>
                            <div class="radio">
                                <label>
                                    <input data-price="25" type="radio" name="fragile" id="blankRadioYes" value="1" class="numbers-only"><span class="radio-field"></span><span>Oui</span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="fragile" id="blankRadioNo" value="0" checked class="numbers-only"><span class="radio-field"></span><span>Non</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="h6">Remarques</label>
                            <textarea class="form-control" name="remarque" placeholder="Veuillez saisir ici vos remarques sur cette expédition" maxlength="255">{{old('remaque')}}</textarea>
                        </div>

                        <div class="form-group border-top inset-4 h4">
                            <p>Total : <span id="total">0</span> F CFA</p>
                            <input type="hidden" name="prix" id="prix" >
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg">Créer une nouvelle expédition</button>
                </form>
            </div>
        </div>
    </div>
</div>
<br class="clearfix">
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.fr.min.js"></script>
    <script type="application/ecmascript">
        $('input.datepicker').datepicker({
            format: "dd/mm/yyyy",
            todayBtn: true,
            language: "fr"
        });
    </script>

    <script type="application/ecmascript">
        var DISTANCE_MATRIX_URL = '{{ route('ajax.distancematrix') }}';
        var directionsService = null;
        var directionsDisplay = null;

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: {{ \App\Http\Controllers\MapController::COORD_CI_LAT }}, lng: {{ \App\Http\Controllers\MapController::COORD_CI_LNG }} }, //7.5450345,-7.7914844
                zoom: 7
            });

            var inputD = document.getElementById('lieudepart');
            var inputA = document.getElementById('lieuarrivee');

            var autocompleteD = new google.maps.places.Autocomplete(inputD);
            autocompleteD.bindTo('bounds', map);

            var autocompleteA = new google.maps.places.Autocomplete(inputA);
            autocompleteA.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            autocompleteD.addListener('place_changed', function(e) {
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

            directionsService = new google.maps.DirectionsService;
            directionsDisplay = new google.maps.DirectionsRenderer;

            directionsDisplay.setMap(map);

            var onChangeHandler = function() {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            };
            document.getElementById('lieudepart').addEventListener('change', onChangeHandler);
            document.getElementById('lieuarrivee').addEventListener('change', onChangeHandler);

            map.addListener('click',function (event) {
                console.log(event);
                //Déclaration des variables
                var coord_ = event.latLng.lat()+","+event.latLng.lng();
                var lieu_ = event.latLng.lat()+","+event.latLng.lng();
                var change_ = 1; //1 = oui | 0 = non

                if (typeof(event.placeId) !== 'undefined'){
                    var srvPlace = new google.maps.places.PlacesService(map);
                    srvPlace.getDetails({
                        placeId: event.placeId
                    }, function(place, status) {
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
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
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
                                //console.log(data);

                                //Changement de la description des villes
                                if($("#lieudepart").attr("data-change") == 1)
                                    $('#lieudepart').val(data.origin_addresses[0]);

                                if($("#lieuarrivee").attr("data-change") == 1)
                                    $('#lieuarrivee').val(data.destination_addresses[0]);

                                //Affichage du résultat de distance Matrix
                                $("#distance").val(data.rows[0].elements[0].distance.text);

                                var km = (data.rows[0].elements[0].distance.text).replace("/km/",'');

                                $("#total").text(parseInt(km) * {{\App\Expedition::UNIT_PRICE}});
                                $("#prix").val(parseInt(km) * {{\App\Expedition::UNIT_PRICE}});
                            })
                        }
                    });
                } else {
                    //window.alert('Directions request failed due to ' + status);
                }
            });
        }

        function findMyPosition(arg) {
            if($(arg).checked)
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
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ \App\Http\Controllers\MapController::API_KEY }}&libraries=places&callback=initMap">
    </script>
@endsection