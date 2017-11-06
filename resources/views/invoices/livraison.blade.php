@extends('invoices.layout')
@php
    $total = 0;
@endphp
@section('content')
    <div id="details" class="clearfix">
        <table border="0" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
                <td class="desc head">
                    <div id="client">
                        <div class="to">CLIENT :</div>
                        <h2 class="name">{{ $invoices->first()->client->nom }} {{ $invoices->first()->client->prenoms }}</h2>
                        <div class="address">{{ $invoices->first()->client->raisonsociale }} - Contact : {{ $invoices->first()->client->contact }}</div>
                        <div class="email"><a href="mailto:{{ $invoices->first()->client->identiteAccess->email }}">{{ $invoices->first()->client->identiteAccess->email }}</a></div>
                    </div>
                </td>
                <td class="head">
                    <div id="invoice1">
                        <h1>Bon de livraison N° {{ $invoices->first()->bonlivraison }}</h1>
                        <div class="date">Date de livraison : {{ (new \Carbon\Carbon($invoices->first()->dateheurecreation))->format('d/m/Y') }}</div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="no">#</th>
            <th class="desc">NATURE DE <br> MARCHANDISE</th>
            <th class="qty">LIEU <br> CHARGEMENT</th>
            <th class="qty">LIEU <br> DECHARGEMENT</th>
            <th class="unit">TYPE <br> CAMION</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr>
                <td class="no">{{ $loop->index + 1 }}</td>
                <td class="desc">Colis de {{ $invoice->masse }} kg</td>
                <td class="desc">{{ $invoice->lieudepart }}<br/>{{ $invoice->chargement ? $invoice->chargement->adressechargement : '' }}</td>
                <td class="desc">{{ $invoice->lieuarrivee }}<br/>{{ $invoice->chargement ? $invoice->chargement->adresselivraison : '' }}</td>
                <td class="unit">{{ $invoice->typeCamion ? $invoice->typeCamion->libelle : 'Non défini' }}</td>
                @php
                    $total += $invoice->prix
                @endphp
            </tr>
        @endforeach()
        </tbody>
    </table>
    <div id="notices">
        <div>Montant en lettre :</div>
        <div class="notice">Facture arretée à la somme de {{ \App\Work\NombreToLettre::getLetter($total*1.18) }} FCFA</div>
    </div>

    <br/>

    <div id="thanks">Merci de votre confiance!</div>
@endsection