@extends("layouts._site")

@section("content")
<section class="section section-inset-1">
    <div class="col-md-12">
        <div class="">
            <div class="col-md-6 col-sm-8 col-xs-12">
                <h3 class="text-left">Critères</h3>
                <div class="separateur"></div>
            </div>
        </div>
    </div>

    <div class="clearfix">
        <div class="col-md-12">
            <form action="" method="get">
                <div class="form-group date">
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <b>Période du</b>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" name="periode_du" id="periode_du" value="{{ request()->query("periode_du") ? request()->query("periode_du") : \Carbon\Carbon::now()->firstOfMonth()->format('d/m/Y') }}">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <b>Au</b>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" name="periode_au" id="periode_au" value="{{ request()->query("periode_au") ? request()->query("periode_au") : \Carbon\Carbon::now()->format('d/m/Y') }}">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <b>Client</b>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nom du client" name="client_name" id="client_name" value="{{ request()->query("client_name") }}">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i> </span>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <b>Transporteur</b>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nom du transporteur" name="transporteur_name" id="transporteur_name" value="{{ request()->query("transporteur_name") }}">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i> </span>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <b>&nbsp;</b>
                        <div class="input-group">
                            <button class="btn btn-primary btn-sm">Rechercher</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <hr class="clearfix" />


    <div class="col-md-12">
        <div class="">
            <div class="col-md-6 col-sm-8 col-xs-12">
                <h3 class="text-left">Liste des offres ({{ number_format($expeditions->count(),0,".", " ") }} offres trouvées)</h3>
                <div class="separateur"></div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 section-inset-1">
        <div class="table-responsive">
            <table class="table table-hover text-left">
                <thead>
                <tr class="bg-dark">
                    <th>Référence</th>
                    <th>Date de création</th>
                    <th>Date d'expiration</th>
                    <th>Lieu de départ</th>
                    <th>Lieu d'arrivée</th>
                    <th>Date chargement</th>
                    <th>Distance</th>
                    <th>Client</th>
                    <th>Statut</th>
                    <th>Transporteur</th>
                    <th>Véhicule</th>
                    <th>Type camion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($expeditions as $expedition)
                    <tr>
                        <td><a href="{{ route("staff.offre.details",["reference" => $expedition->reference]) }}">{{ $expedition->reference }}</a></td>
                        <td>{{ (new \Carbon\Carbon($expedition->dateheurecreation))->format('d/m/Y H:i') }}</td>
                        <td>{{ (new \Carbon\Carbon($expedition->dateexpiration))->format('d/m/Y') }}</td>
                        <td>{{ $expedition->lieudepart }}</td>
                        <td>{{ $expedition->lieuarrivee }}</td>
                        <td>{{ (new \Carbon\Carbon($expedition->datechargement))->format('d/m/Y') }}</td>
                        <td>{{ number_format($expedition->distance,0,','," ")}} km</td>
                        <td>{{ $expedition->client->nom }} {{ $expedition->client->prenoms }}</td>
                        <td>{{ \Illuminate\Support\Facades\Lang::get('statut.'.$expedition->statut) }}</td>
                        <td>{{ $expedition->chargement ? ($expedition->chargement->vehicule ? $expedition->chargement->vehicule->transporteur->raisonsociale : "") : ""}}</td>
                        <td>{{ $expedition->chargement ? ($expedition->chargement->vehicule ? $expedition->chargement->vehicule->immatriculation : "") : ""}}</td>
                        <td>{{ $expedition->typeCamion->libelle }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $expeditions->links() }}
    </div>
    <br class="clearfix"/>
</section>
@endsection


@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.fr.min.js"></script>
    <script type="application/javascript">
        $('input.datepicker').datepicker({
            format: "dd/mm/yyyy",
            todayBtn: true,
            language: "fr",
            autoclose: true,
        });
    </script>
@endsection