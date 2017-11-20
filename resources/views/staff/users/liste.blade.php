@extends('layouts._site')

@section("content")
<section class="section section-inset-1">
    <div class="col-md-offset-1 col-md-10">
        <div class="clearfix">
            <div class="col-md-6 col-sm-8 col-xs-12">
                <h3 class="text-left">Liste des utilisateurs</h3>
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
                            <th>Actions</th>
                            <th>Nom et Prenoms</th>
                            <th>Rôle</th>
                            <th>Email</th>
                            <th>Statut</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($utilisateurs)
                            @foreach($utilisateurs as $utilisateur)
                                <tr>
                                    <td width="10%">
                                        <a href="{{ route("staff.user.modifier", ["email"=>substr($utilisateur->identiteAcces->email,0,strpos($utilisateur->identiteAcces->email,"@"))]) }}" title="Modifier l'utilisateur"> <i class="glyphicon glyphicon-pencil"></i></a>
                                        <a href="{{ route("staff.user.modifier", ["email"=>substr($utilisateur->identiteAcces->email,0,strpos($utilisateur->identiteAcces->email,"@"))]) }}" title="Désactiver l'utilisateur"> <i class="glyphicon glyphicon-off"></i></a>
                                    </td>
                                    <td>{{ $utilisateur->nom }} {{ $utilisateur->prenoms }}</td>
                                    <td>{{ $utilisateur->role }}</td>
                                    <td>{{ $utilisateur->identiteAcces->email }}</td>
                                    <td>{{ \Illuminate\Support\Facades\Lang::get("statut.".$utilisateur->identiteAcces->statut) }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">
                                    <h3>Aucun utilisateur trouvé</h3>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                {{ $utilisateurs->links() }}
            </div>
        </div>
    </div>
    <br class="clearfix"/>
</section>
@endsection