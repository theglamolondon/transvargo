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
                        <div class="address">Contact : {{ $invoices->first()->client->contact }}</div>
                        <div class="email"><a href="mailto:{{ $invoices->first()->client->identiteAccess->email }}">{{ $invoices->first()->client->identiteAccess->email }}</a></div>
                    </div>
                </td>
                <td class="head">
                    <div id="invoice1">
                        <h2>Facture N° {{ $invoices->first()->facture }}</h2>
                        <div class="date">Date de la facture : {{ (new \Carbon\Carbon($invoices->first()->dateheurecreation))->format('d/m/Y') }}</div>
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
            <th class="total">MONTANT</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
        <tr>
            <td class="no">#{{ $loop->index + 1 }}</td>
            <td class="desc">Transport de colis de {{ $invoice->tonnage ? $invoice->tonnage->masse." tonne(s)" : "Masse non définie" }} kg</td>
            <td class="desc">{{ $invoice->lieudepart }}<br/>{{ $invoice->chargement ? $invoice->chargement->adressechargement : '' }}</td>
            <td class="desc">{{ $invoice->lieuarrivee }}<br/>{{ $invoice->chargement ? $invoice->chargement->adresselivraison : '' }}</td>
            <td class="unit">{{ $invoice->typeCamion ? $invoice->typeCamion->libelle : 'Non défini' }}</td>
            <td class="total">{{ number_format($invoice->prix,0,'.', ' ') }}</td>
            @php
                $total += $invoice->prix
            @endphp
        </tr>
        @if($invoice->isassure)
        <tr>
            <td class="no">#{{ $loop->index + 2 }}</td>
            <td class="desc">Assurance {{ $invoice->assurance->libelle }}</td>
            <td class="desc"></td>
            <td class="desc"></td>
            <td class="unit"></td>
            <td class="total">{{ number_format($invoice->mttassurance,0,'.', ' ') }}</td>
        </tr>
        <tr>
            <td class="no">#{{ $loop->index + 3 }}</td>
            <td class="desc">Frais annexe assurance</td>
            <td class="desc"></td>
            <td class="desc"></td>
            <td class="unit"></td>
            <td class="total">{{ number_format($invoice->fraisannexe,0,'.', ' ') }}</td>
        </tr>
        @php
            $total += $invoice->mttassurance + $invoice->fraisannexe
        @endphp
        @endif
        @endforeach()
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="2">Montant Total</td>
            <td>{{ number_format($total,0,'.', ' ') }}</td>
        </tr>
        </tfoot>
    </table>
    <div id="notices">
        <div>Montant en lettre :</div>
        <div class="notice">Facture arretée à la somme de {{ \App\Work\NombreToLettre::getLetter($total) }} FCFA</div>
    </div>

    <br/>

    <div id="thanks">Merci de votre confiance!</div>
@endsection