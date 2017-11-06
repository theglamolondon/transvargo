@extends('layouts._site')

@php
$total = 0;
@endphp

@section('content')
<section class="section section-inset-1">
    <div class="col-md-offset-1 col-md-10">
        <div class="">
            <br/>
            <div class="col-md-12 col-sm-12 col-xs-12 section-inset-1">
                <div class="table-responsive">
                    <table class="table table-hover text-left">
                        <thead>
                        <tr class="bg-dark">
                            <th></th>
                            <th>Référence</th>
                            <th>Itininéraire</th>
                            <th>Distance</th>
                            <th>Date d'acceptation</th>
                            <th>Immatriculation</th>
                            <th>Nom du Chauffeur</th>
                            <th>Contact</th>
                            <th width="14%">Prix</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($chargement)
                        @foreach($chargement as $chargements)
                        <tr class="dropdown-point">
                            <td>
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('transport.accept',['reference' => $chargements->expedition->reference]) }}">
                                            <i class="glyphicon glyphicon-book"></i>
                                            Détails
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a title="Annuler l'expedition" href="#"><i class="glyphicon glyphicon-trash"></i> Annuler</a></li>
                                </ul>
                                @if($chargements->expedition->statut == \App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_PROGRAMMEE.\App\Services\Statut::AUTRE_INITIE)
                                @endif
                            </td>
                            <td>{{ $chargements->expedition->reference }}</td>
                            <td>De [ {{ $chargements->expedition->lieudepart }} ]  à [ {{ $chargements->expedition->lieuarrivee }} ]</td>
                            <td>{{ $chargements->expedition->prix/\App\Expedition::UNIT_PRICE }} km</td>
                            <td>{{ (new \Carbon\Carbon($chargements->expedition->dateheureacceptation))->format("d/m/Y à H:i") }}</td>
                            <td>{{ $chargements ? ($chargements->vehicule ? $chargements->vehicule->immatriculation : '') : ''}}</td>
                            <td>{{ $chargements->vehicule ? $chargements->vehicule->chauffeur : '' }}</td>
                            <td>{{ $chargements ? ($chargements->vehicule ? $chargements->vehicule->telephone : '') : '' }}</td>
                            <td>{{ number_format($chargements->expedition->prix * \App\Transporteur::POURCENTAGE,0,',',' ') }} Fcfa </td>
                            @php
                                $total += $chargements->expedition->prix* \App\Transporteur::POURCENTAGE
                            @endphp
                        </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="6"><h3>Vous n'avez aucune expédition</h3></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>
                <!--
                <form class="rd-mailform coupon-form pull-sm-left">
                    <div class="mfInput pull-sm-left">
                        <input placeholder="Coupon code">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Réduction</button>
                </form>
                -->
            </div>
            <div class="col-xs-12 col-sm-7 col-sm-offset-5 col-lg-3 col-lg-offset-9">
                <div class="table-responsive">
                    <table class="table table-hover text-left">
                        <thead>
                        <tr class="bg-dark">
                            <th>Coût Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-gray">Total</td>
                            <td class="font-secondary">{{ number_format($total,0,',',' ') }} F cfa</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <br class="clearfix"/>
</section>
@endsection