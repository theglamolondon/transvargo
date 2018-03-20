<div class="col-md-12 col-sm-12 col-xs-12">
    <h3 class="text-left">Véhicule</h3>
    <div class="separateur"></div>
    <br class="clearfix" />
    <a href="javascript:void(0);" id="btnAdd" class="pull-left btn btn-primary">Ajouter</a>
</div>
<div class="vehicle-panel">
    @if(count($transporteur->vehicules)!=0)
    @foreach($transporteur->vehicules as $vehicule)
    <div class="col-md-4 col-sm-6 col-xs-12 model">
        <input type="hidden" name="id[]" value="{{$vehicule->id}}">
        <div class="form-group">
            <label class="control-label col-sm-4">Immatriculation *</label>
            <div class="col-sm-8 col-xs-12">
                <input type="text" required placeholder="Immatriculation du véhicule" name="immatriculation[]" class="form-control" value="{{$vehicule->immatriculation}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Capacité *</label>
            <div class="col-sm-8 col-xs-12">
                <div class="input-group">
                    <input type="number" required placeholder="Capacité en kg..." name="capacite[]" class="form-control" value="{{$vehicule->capacite}}">
                    <div class="input-group-addon">kg</div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Chauffeur *</label>
            <div class="col-sm-8 col-xs-12">
                <input type="text" required placeholder="nom du chauffeur..." name="chauffeur[]" class="form-control" value="{{$vehicule->chauffeur}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Téléphone *</label>
            <div class="col-sm-8 col-xs-12">
                <input type="text" required placeholder="Telephone..." name="telephone[]" class="form-control" value="{{$vehicule->telephone}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Type de camion *</label>
            <div class="col-sm-8 col-xs-12">
                <select name="typecamion_id[]" required class="form-control" >
                    @foreach($typevehicules as $typevehicule)
                        <option value="{{ $typevehicule->id }}" @if($vehicule->typecamion_id == $typevehicule->id) selected @endif >{{ $typevehicule->libelle }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div class="col-md-4 col-sm-6 col-xs-12 model">
        <input type="hidden" name="id[]" value="{{0}}">
        <div class="form-group">
            <label class="control-label col-sm-4">Immatriculation *</label>
            <div class="col-sm-8 col-xs-12">
                <input type="text" required placeholder="Immatriculation du véhicule" name="immatriculation[]" class="form-control" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Capacité *</label>
            <div class="col-sm-8 col-xs-12">
                <div class="input-group">
                    <input type="number" required placeholder="Capacité en kg..." name="capacite[]" class="form-control" value="">
                    <div class="input-group-addon">kg</div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Chauffeur *</label>
            <div class="col-sm-8 col-xs-12">
                <input type="text" required placeholder="nom du chauffeur..." name="chauffeur[]" class="form-control" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Téléphone *</label>
            <div class="col-sm-8 col-xs-12">
                <input type="text" required placeholder="Telephone..." name="telephone[]" class="form-control" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Type de camion *</label>
            <div class="col-sm-8 col-xs-12">
                <select name="typecamion_id[]" required class="form-control" >
                    @foreach($typevehicules as $typevehicule)
                        <option value="{{ $typevehicule->id }}">{{ $typevehicule->libelle }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @endif
</div>