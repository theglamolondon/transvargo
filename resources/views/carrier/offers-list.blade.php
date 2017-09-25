@extends('layouts._site')
@php
\Carbon\Carbon::setLocale("fr");
@endphp
@section('content')
<section class="section section-inset-1">
    <div class="col-md-offset-1 col-md-10">
        <div class="col-md-12 col-sm-12 col-xs-12 section-inset-1">
            <div class="table-responsive">
                <table class="table table-hover text-left">
                    <thead>
                    <tr class="bg-dark">
                        <th></th>
                        <th>Référence</th>
                        <th>Itininéraire</th>
                        <th>Enlevement</th>
                        <th>Livraison</th>
                        <th>Distance</th>
                        <th>Type camion</th>
                        <th>Fragile</th>
                        <th width="14%">Prix</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($offres)
                    @foreach($offres as $offre)
                    <tr>
                        <td>
                            <a title="Accepter l'offre" href="{{ route('transport.accept',['reference' => $offre->reference]) }}"><i class="glyphicon glyphicon-folder-open"></i> </a>
                        </td>
                        <td>{{ $offre->reference }}</td>
                        <td>De {{ $offre->lieudepart }} à {{ $offre->lieuarrivee }}</td>
                        <td class="text-left">
                            {{ (new DateTime($offre->datechargement))->format("d/m/Y") }} <br/>
                            <span class="text-gray small">{{ $offre->chargement->adressechargement}}</span>
                        </td>
                        <td>
                            {{ (new \Carbon\Carbon($offre->dateexpiration))->format("d/m/Y") }} <br/>
                            <span class="text-gray small">{{ $offre->chargement->adresselivraison}}</span>
                        </td>
                        <td>{{ $offre->distance }} km</td>
                        <td>{{ $offre->typeCamion->libelle }}</td>
                        <td>{{ $offre->fragile ? "oui" : "non" }}</td>
                        <td>{{ number_format(($offre->prix * \App\Transporteur::POURCENTAGE),0,"."," ") }} FCFA</td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>

                {{ $offres->links() }}
            </div>
        </div>
    </div>
    <br class="clearfix">
</section>
@endsection