@extends('layouts._site')
@section('content')
    <section class="section section-inset-1">
        <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12">
            <div class="col-md-4 col-sm-6 col-xs-12 " style="border-right: 1px solid #777777; min-height: 600px;">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <h3 class="text-left">Rechercher</h3>
                    <div class="separateur"></div>
                </div>
                <br class="clearfix"/>

                <form class="form-inline" method="get" action="">
                    <div class="form-group col-md-12">
                        <input class="form-control" name="query" value="{{old('query')}}" id="query" required placeholder="Nom, prénoms, contact ou email">
                        <button type="submit" class="btn btn-primary btn-sm" style="padding: 2px 4px;margin-top: 0px;"><i class="fa fa-search"></i> </button>
                    </div>
                </form>

                <hr>

                <div class="col-md-12">
                    <h3>Infos client</h3>
                    <div class="">

                    </div>
                </div>
            </div>

            <div class="col-md-8 col-sm-6 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h3 class="text-left">Résultat(s) @if( request()->has('query') )pour  <i class="fa fa-quote-left"></i>{{ request()->input('query') }} <i class="fa fa-quote-right"></i> @endif </h3>
                    <div class="separateur"></div>
                </div>
                <br class="clearfix"/>

                <div class="table-responsive">
                    @if(isset($clients))
                    <table class="table table-hover text-left">
                        <thead>
                        <tr class="bg-dark">
                            <th>Nom & prénoms</th>
                            <th>Raison sociale</th>
                            <th>Contact</th>
                            <th>Date création</th>
                            <th>Grand compte</th>
                            <th>Date passage</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($clients)
                            @foreach($clients as $client)
                                <tr class="toselect">
                                    <td>{{ $client->nom }} {{ $client->prenoms }}</td>
                                    <td>{{ $client->raisonsociale ? $client->raisonsociale : 'N/D' }}</td>
                                    <td>{{ $client->contact }}</td>
                                    <td>{{ (new\Carbon\Carbon($client->datecreation))->format('d/m/Y') }}</td>
                                    <td>{{ $client->grandcompte ? 'Oui' : 'Non' }}</td>
                                    <td>{{ $client->dategrandcompte ? (new\Carbon\Carbon($client->dategrandcompte))->format('d/m/Y') : null }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal"
                                                data-content="{{$client->nom}} {{$client->prenoms}},{{$client->email}},{{$client->grandcompte}}">
                                            Grand compte
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">
                                    <h3 class="text-center">Aucun client trouvé</h3>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    @endif
                </div>
                {{ isset($clients) ? $clients->links() :'' }}
            </div>
        </div>
        <br class="clearfix"/>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document" style="margin-top: 150px;">
            <div class="modal-content">
                <form class="form-horizontal" method="post" action="{{ route('staff.switch.gc') }}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Passage en "Grand compte"</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-4 col-xs-12 control-label">Client</label>
                            <div class="col-md-8 col-xs-12">
                                <input class="form-control" type="text" disabled value="" placeholder="Nom du client" name="fullname" id="fullanme">
                            </div>
                        </div>
                        {{csrf_field()}}
                        <input type="hidden" id="email" name="email" />
                        <div class="form-group">
                            <label class="col-md-4 col-xs-12 control-label">Grand compte</label>
                            <div class="col-md-8 col-xs-12">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary active">
                                        <input type="radio" value="{{true}}" name="grandcompte" id="option1" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" value="{{false}}" name="grandcompte" id="option2" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary btn-xs">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="application/javascript">
        $('#myModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('content'); // Extract info from data-* attributes

            var property = recipient.split(",");

            var modal = $(this);
            modal.find('.modal-title').text('Grand compte ' + property[0]);
            modal.find('.modal-body input:text').val(property[0]);
            modal.find('.modal-body #email').val(property[1]);

            var optionRadio = $('input[name=grandcompte]');
            if(property[2] == 1) //Déjà un grand compte
            {
                $('#option1').trigger('click');
            }else{ //N'a pas encore de compte
                $('#option2').trigger('click');
            }
        })
    </script>
@endsection
