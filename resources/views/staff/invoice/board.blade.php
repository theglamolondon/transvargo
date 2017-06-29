@extends('layouts._site')

@section('content')
<section class="section section-inset-1">
    <div class="col-md-offset-1 col-md-10 col-sm-12">
        <div class="">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <h3 class="text-left">Facture client : grand compte - {{ $client->raisonsociale }} ({{ $client->nom }} {{ $client->prenoms }})</h3>
                <div class="separateur"></div>
            </div>
        </div>

        <br class="clearfix"/>

        <div class="clo-md-12">
            <form class="form-inline" method="get" action="">
                <div class="form-group">
                    <label for="depart" class="control-label">Période du </label>
                </div>

                <div class="form-group date">
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" name="dd" value="{{ (request()->has('dd') ? request()->input('dd') : \Carbon\Carbon::now()->format('d/m/Y')) }}">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="depart" class="control-label"> au </label>
                </div>

                <div class="form-group date">
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" name="df" value="{{ (request()->has('dd') ? request()->input('df') : \Carbon\Carbon::now()->format('d/m/Y')) }}">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                    </div>
                </div>

                <button class="btn btn-default btn-xs">Rechercher</button>
            </form>
        </div>

        <hr />

        <div class="">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Actions</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Contact</th>
                    <th>Raison sociale</th>
                    <th>Date de passage</th>
                    <th>Validé par</th>
                </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>{{ "" }}</td>
                        <td>{{ "" }}</td>
                        <td>{{ "" }}</td>
                        <td>{{ "" }}</td>
                        <td>{{ "" }}</td>
                        <td>{{ "" }}</td>
                        <td>{{ "" }}</td>
                    </tr>

                </tbody>
            </table>
        </div>

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