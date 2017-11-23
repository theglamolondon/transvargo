@extends("layouts._site")
@section("content")
    <section class="section section-inset-1">
        <div class="col-md-offset-1 col-md-10">
            <div class="">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <h3 class="text-left">Fiche</h3>
                    <div class="separateur"></div>
                </div>
            </div>
        </div>
        <br class="clearfix">
        @if($identite)
        <div class="col-md-offset-1 col-md-10">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <p class="text-left">
                        <span><i class="glyphicon glyphicon-calendar"></i> Date de Création </span> <br/>
                        <strong>{{(new \Carbon\Carbon($identite->client->datecreation))->format("d/m/Y à H:i") }}</strong>
                    </p>
                    @if($identite->grandcompte=1)
                        <p class="text-left">
                            <span><i class="glyphicon glyphicon-calendar"></i> Statut Grand Compte </span> <br/>
                            <strong>{{"ACTIVE"}} </strong>
                            <br/>
                        </p>
                    <p class="text-left">
                        <span><i class="glyphicon glyphicon-calendar"></i> Date Activation Grand Compte </span> <br/>
                        <strong>{{(new \Carbon\Carbon($identite->client->dategrandcompte))->format("d/m/Y à H:i") }}</strong>
                        <br/>
                    </p>
                    @endif
                    <hr/>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <p class="text-left">
                        <span><i class="glyphicon glyphicon-user"></i></i> Nom </span> <br/>
                        <strong>{{$identite->client->nom}}</strong>
                    </p>
                    <p class="text-left">
                        <span><i class="glyphicon glyphicon-user"></i> Prénoms</span> <br/>
                        <strong>{{$identite->client->prenoms}}</strong>
                        <br/>
                    </p>
                    <hr/>
                </div>
                <div class="col-md-4">
                        <p class="text-left">
                            <span><i class="glyphicon glyphicon-user"></i> Raison Sociale </span> <br/>
                            <strong>{{$identite->client->raisonsociale}}</strong>
                        </p>
                        <p class="text-left">
                            <span> <i class="glyphicon glyphicon-earphone"></i> Contact </span> <br/>
                            <strong>{{$identite->client->contact}}</strong>
                        </p>
                </div>
            </div>
        </div>
@endif
    </div>

        <div class="col-md-offset-1 col-md-10">
            <div class="">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <h3 class="text-left">Liste de ses expéditions</h3>
                    <div class="separateur"></div>
                </div>
            </div>
        </div>
        <br class="clearfix">
        <div class="col-md-offset-1 col-md-10">
            <div class="col-md-12 col-sm-12 col-xs-12 section-inset-1">
                <div class="table-responsive">
                    <table class="table table-hover text-left">
                        <thead>
                        <tr class="bg-dark">
                            <th>Référence</th>
                            <th>Date création</th>
                            <th>Trajet</th>
                            <th>Statut</th>
                            <th>Prix</th>
                            <th>Date chargement</th>
                            <th>Date Livraison</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($expeditions)
                            @foreach($expeditions as $expedition)
                            <tr>
                                <td><a href="{{ route("staff.offre.details", ["reference"=> $expedition->reference]) }}">{{ $expedition->reference }}</a></td>
                                <td>{{ (new \Carbon\Carbon($expedition->dateheurecreation))->format("d/m/Y à H:i") }}</td>
                                <td>De {{ $expedition->lieudepart }} à {{ $expedition->lieuarrivee }}</td>
                                <td>{{ \Illuminate\Support\Facades\Lang::get("statut.".$expedition->statut) }}</td>
                                <td>{{ number_format($expedition->prix,"0",","," ")}} FCFA</td>
                                <td>{{ (new \Carbon\Carbon($expedition->chargement->dateheurechargement))->format("d/m/Y à H:i") }}</td>
                                <td>{{ (new \Carbon\Carbon($expedition->chargement->dateheurelivraison))->format("d/m/Y à H:i") }}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br class="clearfix"/>
    </section>
@endsection