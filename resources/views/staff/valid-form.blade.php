@extends('layouts._site')

@section('content')
    <section class="section section-inset-1">
        <div class="col-md-offset-1 col-md-10">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <h3 class="text-left">Validation de transporteur</h3>
                <div class="separateur"></div>
            </div>

            <br class="clearfix"/>

            <div class="panel panel-primary">
                <div class="panel-heading">Fiche transporteur ({{ $transporteur->typeTransporteur->libelle }}) : {{ $transporteur->raisonsociale }}</div>
                <div class="panel-body">
                    <form class="form-horizontal login-form" method="post" action="">
                        {{ csrf_field() }}
                        <input type="hidden" name="typetransporteur_id" value="{{$transporteur->typetransporteur_id}}">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-sm-4">Prénoms *</label>
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" required placeholder="Votre prénom..." id="prenoms" name="prenoms" class="form-control" value="{{old('prenoms',$transporteur->prenoms)}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4">Nom *</label>
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" placeholder="Votre nom..." id="nom" name="nom" class="form-control" value="{{old('nom',$transporteur->nom)}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group date">
                                <label for="datenaissance" class="control-label col-md-4 col-sm-6 col-xs-12">Date de naissance *</label>
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" required class="form-control datepicker" data-date-format="dd/mm/yyyy" name="datenaissance" id="datenaissance" data-date-end-date="-18y" value="{{ old('datenaissance',((new \Carbon\Carbon($transporteur->datenaissance))->format('d/m/Y'))) }}">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4">Lieu de naissance *</label>
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" placeholder="Lieu de naissance..." id="lieunaissance" name="lieunaissance" class="form-control" value="{{old('lieunaissance',$transporteur->lieunaissance)}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-sm-4">Nationalité *</label>
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" placeholder="Nationalité..." id="nationalite" name="nationalite" class="form-control" value="{{old('nationalite',$transporteur->nationalite)}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4">Contact *</label>
                                <div class="col-sm-8 col-xs-12">
                                    <input type="number" placeholder="Contact..." id="contact" name="contact" class="form-control" value="{{old('contact',$transporteur->contact)}}" required>
                                </div>
                            </div>
                        </div>

                        <div class="nav nav-tabs"></div>
                        <br/>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-sm-4">Raison sociale</label>
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" required placeholder="Raison sociale..." id="raisonsociale" name="raisonsociale" class="form-control" value="{{old('raisonsociale',$transporteur->raisonsociale)}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4">Compte contribuable</label>
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" placeholder="Compte contribuable..." id="comptecontribuable" name="comptecontribuable" class="form-control" value="{{old('comptecontribuable',$transporteur->comptecontribuable)}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-sm-4">RIB</label>
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" required placeholder="Relevé d'identité bancaire" id="rib" name="rib" class="form-control" value="{{old('rib',$transporteur->rib)}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4">Ville</label>
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" required placeholder="Ville..." id="ville" name="ville" class="form-control" value="{{old('ville',$transporteur->ville)}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-sm-4">Créé le</label>
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" disabled placeholder="Date création" id="datecreation" name="datecreation" class="form-control" value="{{old('datecreation',(new \Carbon\Carbon($transporteur->datecreation))->format('d/m/Y à H:i:s'))}}">
                                </div>
                            </div>

                        </div>

                        <div class="nav nav-tabs"></div>
                        <br/>

                        @if($transporteur->typetransporteur_id == \App\TypeTransporteur::TYPE_CHAUFFEUR_PATRON)
                            @include('staff.typetransporteur.chauffeurpatron')
                        @elseif($transporteur->typetransporteur_id == \App\TypeTransporteur::TYPE_PROPRIETAIRE_FLOTTE)
                            @include('staff.typetransporteur.proprietaireflotte')
                        @endif

                        <div class="nav nav-tabs"></div>
                        <br/>

                        <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg">Valider l'inscription</button>

                    </form>
                </div>
            </div>
        </div>

        <br class="clearfix"/>
    </section>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.fr.min.js"></script>
    <script type="application/javascript">
        $('#datenaissance').datepicker({
            format: "dd/mm/yyyy",
            todayBtn: true,
            language: "fr",
            autoclose: true,
        });

        //Map
        function initMap() {
            var options = {
                componentRestrictions: {country: ['ci']}
            };
            var inputs = [
                document.getElementById('ville'), document.getElementById('lieunaissance'),
                document.getElementById('localisationU1'), document.getElementById('localisationU2'),
            ];

            inputs.forEach(function (e) {
                if(e){
                   new google.maps.places.Autocomplete(e,options);
                }
            });
        }
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ \App\Http\Controllers\MapController::API_KEY }}&libraries=places&callback=initMap">
    </script>
@endsection