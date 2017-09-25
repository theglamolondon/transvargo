@extends('layouts._site')

@section('content')
    <section class="bg-light section-lg">
        <ol class="breadcrumb">
            <li class="">Transporteur</li>
            <li class="active">Tableau de bord</li>
        </ol>
    </section>

    <section class="section">
        <div class="row">
            <div class="panel panel-primary col-md-4 col-sm-12 col-xs-12" style="border-color: #fff">
                <div class="panel-heading"> Mes véhicules <span><a class="bg-dark left" style="display: inline-block;" href="javascript:void(0);" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i></a> </span></div>
                <div class="panel-body">
                    @foreach($errors->all() as $erreur)
                        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>{{ $erreur }}</div>
                    @endforeach
                    <div class="table-mobile table-responsive">
                        <table class="table table-striped text-left table-dark">
                            <thead>
                            <tr class="text-sm-center">
                                <th>Immatriculation</th>
                                <th>Capacité (kg)</th>
                                <th>Type</th>
                                <th>Statut</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($vehicules->count())
                            @foreach($vehicules as $vehicule)
                                <tr class="text-sm-center">
                                    <td>{{ $vehicule->immatriculation }}</td>
                                    <td>{{ $vehicule->capacite }}</td>
                                    <td>{{ $vehicule->typeCamion->libelle }}</td>
                                    <td>@lang('statut.'.$vehicule->statut)</td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="4">
                                        <div class="jumbotron">
                                            <h4 class="text-xs-center">Vous n'avez pas véhicule</h4>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="panel panel-primary col-md-8 col-sm-12 col-xs-12" style="border-color: #fff">
                <div class="panel-heading">Géo position des véhicules</div>
                <div class="panel-body">
                    <div id="map" style="height: 650px;"></div>
                </div>
            </div>
            <!--
            <div class="panel panel-primary col-md-8 col-sm-6 col-xs-12" style="border-color: #fff">
                <div class="panel-heading">Tableau de bord</div>
                <div class="panel-body">
                    <div class="container">
                        <h4 class="text-center">Compteur</h4>
                        <hr>
                        <div class="row">
                            <div class="progress-container row offset-7 flow-offset-1">
                                <div class="col-sm-6 col-md-3">
                                    <div class="thumbnail-mod-1">
                                        <div class="progress-bar-wrapper">
                                            <div data-value="50" data-stroke="10" data-trail="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-radial progress-bar-default"></div>
                                        </div>
                                        <p class="h5 fw-l inline-block">Air Transportation</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="thumbnail-mod-1">
                                        <div class="progress-bar-wrapper">
                                            <div data-value="75" data-stroke="10" data-trail="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-radial progress-bar-default"></div>
                                        </div>
                                        <p class="h5 fw-l inline-block">Marine Transportation</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="thumbnail-mod-1">
                                        <div class="progress-bar-wrapper">
                                            <div data-value="25" data-stroke="10" data-trail="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-radial progress-bar-default"></div>
                                        </div>
                                        <p class="h5 fw-l inline-block">Trucking Services</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="thumbnail-mod-1">
                                        <div class="progress-bar-wrapper">
                                            <div data-value="100" data-stroke="10" data-trail="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-radial progress-bar-default"></div>
                                        </div>
                                        <p class="h5 fw-l inline-block">Safety Escort Services</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            -->
        </div>
        <hr class="clearfix"/>


    </section>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 9999;">
        <form class="" method="post" action="{{ route('transport.ajoutervehicule') }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nouveau véhicule de transport</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" name="immatriculation" placeholder="Immatriculation" value="{{ old(('immatriculation')) }}">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="capacite" placeholder="Capacité max de chargement en KG" value="{{ old('capacite') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="chauffeur" placeholder="Nom du chauffeur" value="{{ old('chauffeur') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="telephone" placeholder="N° du téléphone embarqué" value="{{ old('telephone') }}">
                    </div>
                    <div class="form-group">
                        <select name="typecamion_id" class="form-control">
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" @if(old('typecamion_id') == $type->id) selected @endif >{{ $type->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </div>
        </div>
        </form>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: {{ \App\Http\Controllers\MapController::COORD_CI_LAT }},
                    lng: {{ \App\Http\Controllers\MapController::COORD_CI_LNG }} },
                zoom: 8
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ \App\Http\Controllers\MapController::API_KEY }}&libraries=places&callback=initMap">
    </script>
@endsection