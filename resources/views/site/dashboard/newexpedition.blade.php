<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="col-md-12 col-xs-12">
                <aside id="map" style="height: 550px;"></aside>
            </div>
            <div class="col-md-5 col-lg-6 visible-md visible-lg">
                <div class="img-thumbnail-mod-2"><img src="{{config('app.url')}}/images/index-2.jpg" width="705" height="655" alt=""></div>
            </div>
            <div class="col-sm-10 col-md-7 col-lg-6 inset-3">
                <br>
                <form class="form-horizontal" action="" method="post">
                    <div class="">
                    <div class="form-group distance">
                        <label for="depart" class="h6">De (ville) *</label>
                        <input type="text" class="form-control autocomplete" name="depart" id="depart">
                    </div>
                    <div class="form-group distance">
                        <label for="arrivee" class="h6">A (ville) *</label>
                        <input type="text" class="form-control autocomplete" name="arrivee" id="arrivee">
                    </div>
                    <div class="form-group distance">
                        <label for="distance" class="h6">Distance (km) *</label> <span><img src="{{config('app.url')}}/balls.gif" id="spinner" style="display:none; left: 101%; position: absolute; top: 30%;"></span>
                        <input type="text" class="numbers-only form-control" id="distance" disabled>
                    </div>
                    <div class="form-group weight">
                        <label for="weight" class="h6">Masse (kg)</label>
                        <input type="text" id="weight" class="numbers-only form-control" name="masse">
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
                                <input data-price="25" type="radio" name="blankRadio" id="blankRadioYes" value="option1" class="numbers-only"><span class="radio-field"></span><span>Oui</span>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="blankRadio" id="blankRadioNo" value="option2" class="numbers-only"><span class="radio-field"></span><span>Non</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group border-top inset-4 h4">
                        <p>Total : <span id="total">0</span> F CFA</p>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script type="application/ecmascript">
        var DISTANCE_MATRIX_URL = '{{ route('ajax_distancematrix') }}';
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 7.5450345, lng: -5.240738}, //7.5450345,-7.7914844
                zoom: 7
            });
            var inputD = document.getElementById('depart');
            var inputA = document.getElementById('arrivee');

            var autocompleteD = new google.maps.places.Autocomplete(inputD);
            autocompleteD.bindTo('bounds', map);

            var autocompleteA = new google.maps.places.Autocomplete(inputA);
            autocompleteA.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            autocompleteD.addListener('place_changed', function() {
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

            autocompleteA.addListener('place_changed', function() {
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

            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;

            directionsDisplay.setMap(map);

            var onChangeHandler = function() {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            };
            document.getElementById('depart').addEventListener('change', onChangeHandler);
            document.getElementById('arrivee').addEventListener('change', onChangeHandler);
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            directionsService.route({
                origin: document.getElementById('depart').value,
                destination: document.getElementById('arrivee').value,
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                    $.ajax(DISTANCE_MATRIX_URL,{
                        method: 'post',
                        dataType: 'json',
                        data:{ from: $("#depart").val(), to : $("#arrivee").val()},
                        beforeSend : function (xhr, obj) {
                            $("#spinner").show();
                        },
                        complete : function (xhr, obj) {
                            $("#spinner").hide();
                            xhr.done(function (data) {
                                //console.log(data);
                                $("#distance").val(data.rows[0].elements[0].distance.text);

                                var km = (data.rows[0].elements[0].distance.text).replace("/km/",'');

                                $("#total").text(parseInt(km) * {{\App\Expedition::UNIT_PRICE}});
                            })
                        }
                    });
                } else {
                    //window.alert('Directions request failed due to ' + status);
                }
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ \App\Http\Controllers\MapController::API_KEY }}&libraries=places&callback=initMap">
    </script>
@endsection