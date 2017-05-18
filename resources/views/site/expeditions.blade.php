@extends('layouts._site')

@php
$total = 0;
@endphp

@section('content')
<section class="section section-inset-1">
    <div class="col-md-offset-1 col-md-10">
        <div class="">
            <div class="col-md-2 col-sm-4 col-xs-12">
                <a href="{{ route('client.newexpedition') }}" class="btn btn-primary btn-sm text-left">Nouvelle expédition</a>
                <div class="separateur"></div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12 section-inset-1">
                <div class="table-responsive">
                    <table class="table table-hover text-left">
                        <thead>
                        <tr class="bg-dark">
                            <th></th>
                            <th>Référence</th>
                            <th>Itininéraire</th>
                            <th>Distance</th>
                            <th>Statut</th>
                            <th width="14%">Coût</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($expeditions)
                        @foreach($expeditions as $expedition)
                        <tr>
                            <td>
                                <a title="Annuler l'expedition" class="icon icon-xs fa-trash icon-gray"></a>
                                @if($expedition->statut == \App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_PROGRAMMEE.\App\Services\Statut::AUTRE_INITIE)
                                    <a href="{{ route('client.newexpedition',['ref'=>base64_encode($expedition->reference)]) }}" title="Modifier l'expedition" class="icon icon-xs fa-pencil icon-gray"></a>
                                @endif
                            </td>
                            <td>{{ $expedition->reference }}</td>
                            <td>De [ {{ $expedition->lieudepart }} ]  à [ {{ $expedition->lieuarrivee }} ]</td>
                            <td>{{ $expedition->prix/\App\Expedition::UNIT_PRICE }} km</td>
                            <td>@lang('statut.'.$expedition->statut)</td>
                            <td>{{ number_format($expedition->prix,0,',',' ') }} Fcfa </td>
                            @php
                                $total += $expedition->prix
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
                    {{ $expeditions->links() }}
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
                <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg">Payer Maintenant</button>
            </div>
        </div>
    </div>
    <br class="clearfix"/>
</section>
@endsection