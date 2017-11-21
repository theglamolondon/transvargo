@extends('layouts._site')

@section('content')
    <style href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"></style>
    <section class="container-fluid">
        <div class="col-md-offset-1 col-md-6 col-sm-5 col-xs-12">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <h3 class="titre">Détails</h3>
                <div class="separateur"></div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <p class="text-left">
                        <img src="{{ config('app.url') }}/working/package32.png">
                        <strong>{{ $expedition->lieudepart }}</strong><br/>
                        <small class="small">A partir du {{ (new \Carbon\Carbon($expedition->datechargement))->format("d/m/Y") }}</small>
                    </p>
                    <hr class=""/>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <p class="text-left">
                        <img src="{{ config('app.url') }}/working/drapeaudamier32.gif">
                        <strong>{{ $expedition->lieuarrivee }}</strong><br/>
                        <small class="small">Jusqu'au {{ (new \Carbon\Carbon($expedition->dateexpiration))->format("d/m/Y") }}</small>
                    </p>
                    <hr class=""/>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <h3 class="text-center">{{ number_format($expedition->prix * \App\Transporteur::POURCENTAGE,0,',',' ') }} F CFA</h3>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <p class="text-left">
                        <span><i class="glyphicon glyphicon-briefcase"></i> Sociéte au chargement </span> <br/>
                        <strong>{{ $expedition->chargement->societechargement }}</strong>
                    </p>
                    <p class="text-left">
                        <span><i class="glyphicon glyphicon-user"></i> Contact au chargement </span> <br/>
                        <strong>{{ $expedition->chargement->contactchargement }}</strong>
                        <br/>
                        <i class="glyphicon glyphicon-earphone"></i>
                        <a href="callto:{{ $expedition->chargement->telephonechargement }}">{{ $expedition->chargement->telephonechargement }}</a>
                    </p>
                    <hr/>
                    <p class="text-left">
                        <strong>Remarques :</strong> <br/>
                        {{ $expedition->chargement->adressechargement }}
                    </p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <p class="text-left">
                        <span><i class="glyphicon glyphicon-briefcase"></i> Sociéte à la livraison </span> <br/>
                        <strong>{{ $expedition->chargement->societelivraison }}</strong>
                    </p>
                    <p class="text-left">
                        <span><i class="glyphicon glyphicon-user"></i> Contact à la livraison :</span> <br/>
                        <strong>{{ $expedition->chargement->contactlivraison }}</strong>
                        <br/>
                        <i class="glyphicon glyphicon-earphone"></i>
                        <a href="callto:{{ $expedition->chargement-> telephonelivraison}}">{{ $expedition->chargement->telephonelivraison }}</a>
                    </p>
                    <hr/>
                    <p class="text-left">
                        <strong>Remarques :</strong> <br/>
                        {{ $expedition->chargement->adresselivraison }}
                    </p>
                </div>


                <div class="col-md-4">
                @if($expedition->chargement->vehicule_id == null )
                    <form method="post" action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="immatriculation" class="h6 text-center">Affecter un véhicule</label>
                            <select name="immatriculation" id="immatriculation" class="form-control">
                                @foreach($vehicules as $vehicule)
                                    @if($vehicule->typeCamion)
                                    <option value="{{ $vehicule->immatriculation }}">{{ $vehicule->immatriculation }} ({{ $vehicule->chauffeur }})</option>
                                    @endif
                                @endforeach
                            </select>

                            <input type="hidden" name="reference" value="{{ $expedition->reference }}">
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <br/>
                            <label class="text-gray text-center"><i class="glyphicon glyphicon-usd"></i> Sans aucun frais pour vous </label>
                            <label class="text-gray text-center"><i class="glyphicon glyphicon-check"></i> Paiement 30 jours garanti </label>
                            <button type="submit" class="btn btn-primary btn-xs form-control">Accepter l'offre</button>
                        </div>
                    </div>
                </form>
                @elseif($expedition->statut == 242 )
                    <form method="post" action="{{ route("chargement.change.statut", [ "reference" => $expedition->reference ]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="reference" value="{{ $expedition->reference }}">
                        <input type="hidden" name="statut" value="{{ \App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_EN_COURS.\App\Services\Statut::AUTRE_ACCEPTE }}">
                        <button type="submit" class="btn btn-primary btn-xs form-control">Démarrer le chargement</button>
                    </form>
                    <br/>
                @endif
                @if( $expedition->chargement->vehicule != null )
                    <p class="text-left">
                        <span><i class="glyphicon glyphicon-user"></i> Chauffeur </span> <br/>
                        <strong>{{ $expedition->chargement->vehicule->chauffeur }}</strong>
                    </p>
                    <p class="text-left">
                        <span><i class="glyphicon glyphicon-cd"></i> Véhicule </span> <br/>
                        <strong>{{ $expedition->chargement->vehicule->immatriculation }}</strong>
                    </p>

                    @if($expedition->statut == 252 )
                    <form action="{{ route('chargement.livrer', [ "reference" => $expedition->reference ]) }}" method="post">
                        {{ csrf_field() }}
                        <button type="button" class="btn btn-primary btn-xs form-control" data-toggle="modal" data-target="#myModal" onclick="beginLivraison();">Livrer</button>
                    </form>
                    @endif
                @endif
                </div>
            </div>

            @if($expedition->chargement->vehicule_id != null )
            <br class="clearfix"/>
            <br/>
            <br/>
            <br/>
            <h3 class="titre">Progression</h3>
            <div class="separateur"></div>

            <div class="col-md-12">
                <div class="element">
                    <span class="state active">1</span>
                    <span>Programmé</span>
                    <span class="bar"></span>
                </div>
                <div class="element">
                    <span class="state @if($expedition->statut >= 252) active @endif">2</span>
                    <span>En cours</span>
                    <span class="bar"></span>
                </div>
                <div class="element">
                    <span class="state @if($expedition->statut >= 262) active @endif">3</span>
                    <span>Livrée</span>
                    <span class="bar"></span>
                </div>
                <div class="element">
                    <span class="state @if($expedition->statut >= 262) active @endif">4</span>
                    <span>Terminé</span>
                </div>
            </div>
            @endif

            <br class="clearfix">
        </div>
        <div class="col-md-4 col-sm-7 col-xs-12">
            <div id="map" style="height: 550px"></div>
        </div>
    </section>

    <br class="clearfix"/>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 9999;">
        <form action="{{ route("chargement.valide.livraison", [ "reference" => $expedition->reference ]) }}" method="post">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Vérification du OTP envoyé par SMS</h4>
                    </div>
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group distance">
                                <label for="depart" class="control-label col-md-4 col-sm-6 col-xs-12">Code OTP *</label>
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <input type="hidden" name="reference" value="{{ $expedition->reference }}">
                                    <input type="text" class="numbers-only form-control" max="5" maxlength="5" name="otp" id="otp" placeholder="XXXXX">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg">Vérifier</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var directionsDisplay;
        var directionsService;

        function initMap() {
            directionsService = new google.maps.DirectionsService();

            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: {{ \App\Http\Controllers\MapController::COORD_CI_LAT }},
                    lng: {{ \App\Http\Controllers\MapController::COORD_CI_LNG }}
                },
                zoom: 7
            });

            directionsDisplay = new google.maps.DirectionsRenderer();
            directionsDisplay.setMap(map);
            calcRoute();
        }

        function calcRoute() {
            var start = new google.maps.LatLng({{ $expedition->coorddepart }});
            var end   = new google.maps.LatLng({{ $expedition->coordarrivee }});
            var request = {
                origin: start,
                destination: end,
                travelMode: 'DRIVING'
            };
            directionsService.route(request, function(result, status) {
                if (status == 'OK') {
                    directionsDisplay.setDirections(result);
                }
            });
        }

        function beginLivraison() {
            $.ajax({
                type:"POST",
                url:"{{ route("chargement.livrer", [ "reference" => $expedition->reference ]) }}",
                data:{
                    _token: "{{ csrf_token() }}",
                    reference: "{{ $expedition->reference }}"
                },
                success : function (data, status, xhr) {
                    
                }
                
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ \App\Http\Controllers\MapController::API_KEY }}&libraries=places&callback=initMap">
    </script>
@endsection