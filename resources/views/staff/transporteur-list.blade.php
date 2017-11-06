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
                <h3 class="text-left">{{ $title }}</h3>
                <div class="separateur"></div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12 section-inset-1">
                <div class="table-responsive">
                    <table class="table table-hover text-left">
                        <thead>
                        <tr class="bg-dark">
                            <th></th>
                            <th>Raison sociale</th>
                            <th>Type</th>
                            <th>Contact</th>
                            <th>Ville</th>
                            <th>Inscrit le</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($transporteurs)
                            @foreach($transporteurs as $transporteur)
                            <tr>
                                <td><a href="{{ route('staff.valid.transporteur',['token'=>$transporteur->identiteAccess->activate_token]) }}" title="Fiche du transporteur" class="icon icon-xs fa-pencil icon-gray"></a></td>
                                <td>{{ $transporteur->raisonsociale }} ({{ $transporteur->nom }} {{ $transporteur->prenoms }})</td>
                                <td>{{ $transporteur->typeTransporteur->libelle }}</td>
                                <td>{{ $transporteur->contact }}</td>
                                <td>{{ $transporteur->ville }}</td>
                                <td>{{ (new \Carbon\Carbon($transporteur->datecreation))->format('d/m/Y à H:i:s') }}</td>
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
                {{ $transporteurs->links() }}
            </div>
        </div>
    </div>
    <br class="clearfix"/>
</section>
@endsection