@extends('layouts._site')
{{ $total = 0 }}
@section('content')
<section class="section section-inset-1">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 section-inset-1">
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
                        @foreach($expeditions as $expedition)
                        <tr>
                            <td><a title="Annuler l'expedition" class="icon icon-xs fa-trash icon-gray"></a></td>
                            <td>{{ $expedition->reference }}</td>
                            <td><a href="#"> De [ {{ $expedition->lieudepart }} ]  à [ {{ $expedition->lieuarrivee }} ]</a></td>
                            <td>{{ $expedition->prix/\App\Expedition::UNIT_PRICE }} km</td>
                            <td>@Lang('statut.'.$expedition->statut)</td>
                            <td>{{ number_format($expedition->prix,0,',',' ') }} Fcfa</td>
                            {{ $total += $expedition->prix }}
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <form class="rd-mailform coupon-form pull-sm-left">
                    <div class="mfInput pull-sm-left">
                        <input placeholder="Coupon code">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">apply coupon</button>
                </form>

            </div>
            <div class="col-xs-12 col-sm-7 col-sm-offset-5 col-lg-4 col-lg-offset-8">
                <div class="table-responsive">
                    <table class="table table-hover text-left">
                        <thead>
                        <tr class="bg-dark">
                            <th>Cart Totals</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-gray">Subtotal</td>
                            <td>$58.00</td>
                        </tr>
                        <tr>
                            <td class="text-gray">Total</td>
                            <td class="font-secondary">{{ number_format($total,0,',',' ') }} F cfa</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg offset-5">proceed to checkout</button>
            </div>
        </div>
    </div>
</section>
@endsection