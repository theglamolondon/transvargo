<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="col-md-12 col-xs-12">
                <aside id="map" style="height: 450px;"></aside>
            </div>
            <div class="col-md-5 col-lg-6 visible-md visible-lg">
                <div class="img-thumbnail-mod-2"><img src="{{config('app.url')}}/images/index-2.jpg" width="705" height="655" alt=""></div>
            </div>
            <div class="col-sm-10 col-md-7 col-lg-6 inset-3">
                <br>
                <div class="calculator">
                    <div data-price="1" class="form-group distance">
                        <label for="dist" class="h6">Distance (mi) *</label>
                        <input type="text" id="dist" class="numbers-only">
                    </div>
                    <div data-price="2" class="form-group weight">
                        <label for="weight" class="h6">Weight (lb)</label>
                        <input type="text" id="weight" class="numbers-only">
                    </div>
                    <div id="capacity" data-price="1" class="capacity clearfix">
                        <div class="form-group">
                            <label for="length" class="h6">Length (in)</label>
                            <input type="text" id="length" class="numbers-only">
                        </div>
                        <div class="form-group">
                            <label for="height" class="h6">Height (in)</label>
                            <input type="text" id="height" class="numbers-only">
                        </div>
                        <div class="form-group">
                            <label for="width" class="h6">Width (in)</label>
                            <input type="text" id="width" class="numbers-only">
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="h6">Fragile</p>
                        <div class="radio">
                            <label>
                                <input data-price="25" type="radio" name="blankRadio" id="blankRadioYes" value="option1" class="numbers-only"><span class="radio-field"></span><span>Yes</span>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="blankRadio" id="blankRadioNo" value="option2" class="numbers-only"><span class="radio-field"></span><span>No</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="h6">Extra services:</p>
                        <div class="checkbox-group">
                            <label class="checkbox-inline">
                                <input data-price="15" type="checkbox" id="extra1" class="numbers-only"><span class="checkbox-field"></span><span>Insurance</span>
                            </label>
                            <label class="checkbox-inline">
                                <input data-price="20" type="checkbox" id="extra2" class="numbers-only"><span class="checkbox-field"></span><span>Express Delivery</span>
                            </label>
                            <label class="checkbox-inline">
                                <input data-price="25" type="checkbox" id="extra3" class="numbers-only"><span class="checkbox-field"></span><span>Packaging</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group border-top inset-4 h4">
                        <p>Total:<span id="total">0</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        // Note: This example requires that you consent to location sharing when
        // prompted by your browser. If you see the error "The Geolocation service
        // failed.", it means you probably did not give permission for the browser to
        // locate you.

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 13
            });
            var infoWindow = new google.maps.InfoWindow({map: map});

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    infoWindow.setPosition(pos);
                    infoWindow.setContent('Location found.');
                    map.setCenter(pos);
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ \App\Http\Controllers\MapController::API_KEY }}&callback=initMap">
    </script>
@endsection