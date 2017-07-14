@extends('layouts._site')

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
                        <th>Distance</th>
                        <th>Fragile</th>
                        <th width="14%">Coût</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($offres)
                    @foreach($offres as $offre)
                    <tr>
                        <td><a href="{{ route('transport.accept',['reference' => $offre->reference]) }}"><i class="fa fa-check"></i> </a> </td>
                        <td>{{ $offre->reference }}</td>
                        <td>De {{ $offre->lieudepart }} à {{ $offre->lieuarrivee }}</td>
                        <td>{{ $offre->distance }} km</td>
                        <td>{{ $offre->fragile ? "oui" : "non" }}</td>
                        <td>{{ number_format($offre->prix,0,"."," ") }} FCFA</td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br class="clearfix">
</section>
@endsection