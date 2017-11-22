@extends("layouts._site")
@section("content")
    <section class="section section-inset-1">
        <div class="col-md-offset-1 col-md-10">
            <div class="">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <h3 class="text-left">Fiche</h3>
                    <div class="separateur"></div>
                </div>
            </div>
        </div>
        <br class="clearfix">
        <div class="col-md-offset-1 col-md-10">

        </div>

        <div class="col-md-offset-1 col-md-10">
            <div class="">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <h3 class="text-left">Liste de ses expéditions</h3>
                    <div class="separateur"></div>
                </div>
            </div>
        </div>
        <br class="clearfix">
        <div class="col-md-offset-1 col-md-10">
            <div class="col-md-12 col-sm-12 col-xs-12 section-inset-1">
                <div class="table-responsive">
                    <table class="table table-hover text-left">
                        <thead>
                        <tr class="bg-dark">
                            <th>Référence</th>
                            <th>Date création</th>
                            <th>Trajet</th>
                            <th>Statut</th>
                            <th>Prix</th>
                            <th>Date chargement</th>
                            <th>Date Livraison</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($expeditions)
                            @foreach($expeditions as $expedition)
                            <tr>
                                <td><a href="{{ route("staff.offre.details", ["reference"=> $expedition->reference]) }}">{{ $expedition->reference }}</a></td>
                                <td>{{ (new \Carbon\Carbon($expedition->dateheurecreation))->format("d/m/Y à H:i") }}</td>
                                <td>De {{ $expedition->lieudepart }} à {{ $expedition->lieuarrivee }}</td>
                                <td>{{ \Illuminate\Support\Facades\Lang::get("statut.".$expedition->statut) }}</td>
                                <td>{{ number_format($expedition->prix,"0",","," ")}} FCFA</td>
                                <td>{{ (new \Carbon\Carbon($expedition->chargement->dateheurechargement))->format("d/m/Y à H:i") }}</td>
                                <td>{{ (new \Carbon\Carbon($expedition->chargement->dateheurelivraison))->format("d/m/Y à H:i") }}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br class="clearfix"/>
    </section>
@endsection