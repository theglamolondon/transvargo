@extends('layouts._site')

@section('content')
    <section class="row bg-dark">
        <div class="col-md-2 col-sm-12 col-xs-12">

        </div>

        <div id="map" class="col-md-10 col-sm-12 col-xs-12" style="height: 900px; padding: 8px;">

        </div>

        <br class="clearfix"/>
    </section>

    <div id="waiting">
        <div class="msg"> <img src="{{config('app.url')}}/balls.gif" /> <h4>Chargement ...</h4></div>
    </div>
    <br style="margin-bottom: 5px;">
@endsection

@section('script')
    <script type="application/ecmascript">
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: {{ \App\Http\Controllers\MapController::COORD_CI_LAT }}, lng: {{ \App\Http\Controllers\MapController::COORD_CI_LNG }} },
                zoom: 8
            });
        }
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ \App\Http\Controllers\MapController::API_KEY }}&libraries=places&callback=initMap">
    </script>
@endsection