@extends('layouts._site')
@section('content')
<section class="section section-inset-1">
    <div class="col-md-offset-1 col-md-10">
        <div class="">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <h3 class="text-left">Liste des grand comptes</h3>
                <div class="separateur"></div>
            </div>
            <div class="col-md-offset-9 col-md-3">
                <form class="form-inline" action="" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" name="search" placeholder="Nom, prenoms, email" value="{{request()->input("search")}}">
                    </div>
                    <button class=" btn-xs btn btn-primary" style="padding: 6px 2px;"><i class="fa fa-search" style="font-size: 16px;"></i> </button>
                </form>
            </div>
            <div class="">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Actions</th>
                        <th>Nom</th>
                        <th>Prénoms</th>
                        <th>Contact</th>
                        <th>Raison sociale</th>
                        <th>Date de passage</th>
                        <th>Validé par</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clientsGrandCompte as $client)
                    <tr>
                        <th>
                            <a href="{{ route("staff.invoice",["id" => $client->identiteaccess_id]) }}" title="Etablir les factures du mois">
                                <i style="font-size: 16px" class="fa fa-sticky-note-o"></i>
                            </a>
                        </th>
                        <td>{{$client->nom}}</td>
                        <td>{{$client->prenoms}}</td>
                        <td>{{$client->contact}}</td>
                        <td>{{$client->raisonsociale}}</td>
                        <td>{{$client->dategrandcompte}}</td>
                        <td>{{$client->validBy->nom}} {{$client->validBy->prenoms}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $clientsGrandCompte->appends(["search" => request()->input("search")])->links() }}
        </div>
    </div>

    <br class="clearfix"/>
</section>
@endsection