@extends('layouts._site')

@section('content')
    <div class="container bg-light">
        <div class="row">
            <div class="col-xs-12 box">
                <div class="ibox-content clearfix steps">
                    <div class="col-md-4 col-xs-4">
                        <div class="step">
                            <div class="round">
                                <div class="ring one"></div>
                                <div class="cutout">
                                    <h3 class="time">1</h3>
                                </div>
                            </div>
                            <h3 class="title">Tarif définitif</h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-4">
                        <div class="step active">
                            <div class="round">
                                <div class="ring one"></div>
                                <div class="ring two"></div>
                                <div class="cutout">
                                    <h3 class="time">2</h3>
                                </div>
                            </div>
                            <h3 class="title">Commande</h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-4">
                        <div class="step">
                            <div class="round">
                                <div class="ring one"></div>
                                <div class="ring two"></div>
                                <div class="ring three"></div>
                                <div class="ring four"></div>
                                <div class="cutout">
                                    <h3 class="time">3</h3>
                                </div>
                            </div>
                            <h3 class="title">Confirmation</h3>
                        </div>
                    </div>
                </div>

                <br/> <br/>

                @foreach($errors->all() as $erreur)
                    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>{{ $erreur }}</div>
                @endforeach

                <form class="form-horizontal col-md-8" action="{{ route('client.commande', ['reference' => $expedition->reference]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-sm-4">Société au chargement *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Nom de la société au chargement" id="societechargement" name="societechargement" class="form-control" value="{{old('societechargement')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Contact au chargement *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Personne à contacter au chargement" id="contactchargement" name="contactchargement" class="form-control" value="{{old('contactchargement')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-6 col-xs-12">Informations complémentaires sur le chargement</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <textarea class="form-control" name="adressechargement" placeholder="Informations sur le lieu de chargement et des marchandises" maxlength="255">{{old('adressechargement')}}</textarea>
                        </div>
                    </div>

                    <div class="nav nav-tabs"></div>
                    <br/>


                    <div class="form-group">
                        <label class="control-label col-sm-4">Société à la livraison *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Nom de la société à la livraison" id="societelivraison" name="societelivraison" class="form-control" value="{{old('societelivraison')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Contact à la livraison *</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" placeholder="Personne à contacter à la livraison" id="contactlivraison" name="contactlivraison" class="form-control" value="{{old('contactlivraison')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-6 col-xs-12">Informations complémentaires sur la livraison</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <textarea class="form-control" name="adresselivraison" placeholder="Informations sur le lieu de déchargement et des marchandises" maxlength="255">{{old('adresselivraison')}}</textarea>
                        </div>
                    </div>

                    <div class="nav nav-tabs"></div>
                    <br/>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-6 col-xs-12"></label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <button type="submit" class="btn btn-primary btn-sm btn-min-width-lg">Commander</button>
                        </div>
                    </div>
                </form>


                <div class="col-md-offset-1 col-md-3">
                    <h3 class="text-left">Expédition</h3>
                    <div class="separateur"></div>
                    <p class="text-left"><strong> <i class="fa fa-barcode"></i> {{ $expedition->reference }} </strong> </p>
                    <p class="text-left"><strong> <i class="fa fa-money"></i> {{ number_format($expedition->prix,0,'.',' ') }} F CFA</strong> </p>
                    <p class="text-left"><strong> <i class="fa fa-tachometer"></i> {{ number_format($expedition->prix/\App\Expedition::UNIT_PRICE,0,'.',' ') }} Km</strong> </p>
                </div>

            </div>
        </div>
    </div>
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