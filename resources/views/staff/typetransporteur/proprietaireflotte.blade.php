<div class="col-md-12 col-sm-12 col-xs-12">
    <h3 class="text-left">Véhicule</h3>
    <div class="separateur"></div>
    <br class="clearfix" />
    <a href="javascript:void(0);" id="btnAdd" class="pull-left btn btn-primary">Ajouter</a>
</div>
<div class="vehicle-panel">
    <div class="col-md-4 col-sm-6 col-xs-12 model">
        <div class="form-group">
            <label class="control-label col-sm-4">Immatriculation *</label>
            <div class="col-sm-8 col-xs-12">
                <input type="text" required placeholder="Immatriculation du véhicule" name="immatriculation[]" class="form-control" value="{{old('immatriculation',$transporteur->vehicules->first() ? $transporteur->vehicules->first()->immatriculation : null)}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Capacité *</label>
            <div class="col-sm-8 col-xs-12">
                <div class="input-group">
                    <input type="number" required placeholder="Capacité en kg..." name="capacite[]" class="form-control" value="{{old('capacite',$transporteur->vehicules->first() ? $transporteur->vehicules->first()->capacite : null)}}">
                    <div class="input-group-addon">kg</div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Chauffeur *</label>
            <div class="col-sm-8 col-xs-12">
                <input type="text" required placeholder="nom du chauffeur..." name="chauffeur[]" class="form-control" value="{{old('chauffeur',$transporteur->vehicules->first() ? $transporteur->vehicules->first()->chauffeur : null)}}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Téléphone *</label>
            <div class="col-sm-8 col-xs-12">
                <input type="text" required placeholder="Telephone..." name="telephone[]" class="form-control" value="{{old('telephone',$transporteur->vehicules->first() ? $transporteur->vehicules->first()->telephone : null)}}">
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
</div>