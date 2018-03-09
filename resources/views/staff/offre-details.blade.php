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
                    @if(\Illuminate\Support\Facades\Auth::user()->typeidentite_id == \App\TypeIdentitite::TYPE_TRANSPORTEUR)
                        <h3 class="text-center">{{ number_format($expedition->prix * \App\Transporteur::POURCENTAGE,0,',',' ') }} F CFA</h3>
                    @else
                        <h3 class="text-center">{{ number_format($expedition->prix,0,',',' ') }} F CFA</h3>
                    @endif
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
                    @if(substr($expedition->statut, 1) == intval(\App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_PROGRAMMEE) )
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
                    @endif

                    <div class="">
                    @if(substr($expedition->statut, 0, 2) >= intval(\App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_PROGRAMMEE))
                        <a class="h6" title="Télécharger la facture" target="_blank" href="{{ route("staff.pdf.facture", ["reference" => $expedition->reference]) }}"><i class="glyphicon glyphicon-save-file"></i> Facture</a>
                    @endif
                    <br/>
                    <!--
                    @if(substr($expedition->statut, 0, 2) >= intval(\App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_EN_COURS))
                        <a class="h6" title="Télécharger le bon de livraison" target="_blank" href="{{ route("staff.pdf.bonlivraison", ["reference" => $expedition->reference]) }}"><i class="glyphicon glyphicon-paste"></i> Bon de livraison</a>
                    @endif
                    -->
                    </div>
                </div>
            </div>

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
                    <span class="state @if(substr($expedition->statut,  0, 2) >= intval(\App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_EN_COURS)) active @endif">2</span>
                    <span>En cours</span>
                    <span class="bar"></span>
                </div>
                <div class="element">
                    <span class="state @if(substr($expedition->statut,  0, 2) >= intval(\App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_LIVREE)) active @endif">3</span>
                    <span>Livrée</span>
                    <span class="bar"></span>
                </div>
                <div class="element">
                    <span class="state @if($expedition->statut >= intval(\App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_LIVREE.\App\Services\Statut::AUTRE_PAYEE)) active @endif">4</span>
                    <span>Terminé</span>
                </div>
            </div>
            <br class="clearfix">

        </div>
        <div class="col-md-4 col-sm-7 col-xs-12">
            <div id="map" style="height: 550px"></div>
            <br>
            <br>
            <a href="{{ route('staff.offre.affect', [ "reference" => $expedition->reference ]) }}" class="btn btn-primary btn-sm btn-min-width-lg">Affecter</a>
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