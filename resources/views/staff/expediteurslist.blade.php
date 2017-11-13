@extends('layouts._site')

@section('content')
    <section class="section section-inset-1">

        <div class="col-md-offset-1 col-md-10">
            <div class="">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <h3 class="text-left">Critères</h3>
                    <div class="separateur"></div>
                </div>
            </div>
        </div>

        <div class="col-md-offset-1 col-md-10">
            <form action="" method="get">
                <div class="form-group">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <b>Nom ou raison sociale</b>
                        <div class="input-group">
                            <input type="text" class="form-control"  name="name" value="{{ request()->query("name") }}" placeholder="Transporteur">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i> </span>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <b>Tonnage</b>
                        <div class="input-group">
                            <input type="number" class="form-control"  name="tonnnage" value="{{ request()->query("tonnnage") }}" placeholder="Tonnnage">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-"></i> </span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <b>Type de véhicule</b>
                        <div class="input-group">
                            <input type="text" class="form-control"  name="type_car" value="{{ request()->query("type_car") }}" placeholder="Type de véhicule">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-drive"></i> </span>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <b>&nbsp;</b>
                        <div class="input-group">
                            <button class="btn btn-primary btn-sm">Rechercher</button>
                        </div>
                    </div>
                </div>
            </form>
            <br/><br/><br/>
        </div>


        <div class="col-md-offset-1 col-md-10">
            <div class="clearfix">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <h3 class="text-left">Liste des comptes d'expéditeurs</h3>
                    <div class="separateur"></div>
                </div>
            </div>
        </div>
        <br class="clearfix"/>

        <div class="col-md-offset-1 col-md-10">
            <div class="clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12 section-inset-1">
                    <div class="table-responsive">
                        <table class="table table-hover text-left">
                            <thead>
                            <tr class="bg-dark">
                                <th>Nom et Prenoms</th>
                                <th>Type</th>
                                <th>Contact</th>
                                <th>Ville</th>
                                <th>Inscrit le</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($clients)
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{ $client->nom }} {{ $client->prenoms }} ({{ $client->raisonsociale ?? "Client particulier" }})</td>
                                        <td>{{ $client->grandcompte ? "Grand compte" : "normal" }}</td>
                                        <td>{{ $client->contact }}</td>
                                        <td>{{ $client->ville }}</td>
                                        <td>{{ (new \Carbon\Carbon($client->datecreation))->format('d/m/Y à H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">
                                        <h3>Aucun transporteur trouvé</h3>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
        <br class="clearfix"/>
    </section>
@endsection