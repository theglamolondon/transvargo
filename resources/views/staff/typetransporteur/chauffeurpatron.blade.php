<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h3 class="text-left">Personne 1 en  cas d'urgence</h3>
        <div class="separateur"></div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-4">Nom prénoms</label>
        <div class="col-sm-8 col-xs-12">
            <input type="text" required placeholder="Nom et prénoms..." id="nomprenomsU1" name="nomprenomsU1" class="form-control" value="{{old('nomprenomsU1',$transporteur->extension ? $transporteur->extension->nomprenomsU1:null )}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Profession</label>
        <div class="col-sm-8 col-xs-12">
            <input type="text" required placeholder="Profession..." id="professionU1" name="professionU1" class="form-control" value="{{old('professionU1',$transporteur->extension ? $transporteur->extension->professionU1 : null)}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Contact</label>
        <div class="col-sm-8 col-xs-12">
            <input type="text" required placeholder="Contact..." id="contactU1" name="contactU1" class="form-control" value="{{old('contactU1',$transporteur->extension ? $transporteur->extension->contactU1 : null)}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Localisation</label>
        <div class="col-sm-8 col-xs-12">
            <input type="text" required placeholder="Lieu ou ville d'habitation..." id="localisationU1" name="localisationU1" class="form-control" value="{{old("localisationU1",$transporteur->extension ? $transporteur->extension->localisationU1 : null)}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Observation</label>
        <div class="col-sm-8 col-xs-12">
            <textarea placeholder="Observation..." id="observationU1" name="observationU1" class="form-control">{{old("observationU1",$transporteur->extension ? $transporteur->extension->observationU1 : null)}}</textarea>
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h3 class="text-left">Personne 2 en  cas d'urgence</h3>
        <div class="separateur"></div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-4">Nom prénoms</label>
        <div class="col-sm-8 col-xs-12">
            <input type="text" required placeholder="Nom et prénoms..." id="nomprenomsU2" name="nomprenomsU2" class="form-control" value="{{old('nomprenomsU2',$transporteur->extension ? $transporteur->extension->nomprenomsU2:null )}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Profession</label>
        <div class="col-sm-8 col-xs-12">
            <input type="text" required placeholder="Profession..." id="professionU2" name="professionU2" class="form-control" value="{{old('professionU2',$transporteur->extension ? $transporteur->extension->professionU2 : null)}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Contact</label>
        <div class="col-sm-8 col-xs-12">
            <input type="text" required placeholder="Contact..." id="contactU2" name="contactU2" class="form-control" value="{{old('contactU2',$transporteur->extension ? $transporteur->extension->contactU2 : null)}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Localisation</label>
        <div class="col-sm-8 col-xs-12">
            <input type="text" required placeholder="Lieu ou ville d'habitation..." id="localisationU2" name="localisationU2" class="form-control" value="{{old("localisationU2",$transporteur->extension ? $transporteur->extension->localisationU2 : null)}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Observation</label>
        <div class="col-sm-8 col-xs-12">
            <textarea placeholder="Observation..." id="observationU2" name="observationU2" class="form-control">{{old("observationU2",$transporteur->extension ? $transporteur->extension->observationU2 : null)}}</textarea>
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h3 class="text-left">Véhicule</h3>
        <div class="separateur"></div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-4">Immatriculation *</label>
        <div class="col-sm-8 col-xs-12">
            <input type="text" required placeholder="Immatriculation du véhicule" id="immatriculation" name="immatriculation" class="form-control" value="{{old('immatriculation',$transporteur->vehicules->first() ? $transporteur->vehicules->first()->immatriculation : null)}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Capacité *</label>
        <div class="col-sm-8 col-xs-12">
            <div class="input-group">
                <input type="number" required placeholder="Capacité en kg..." id="capacite" name="capacite" class="form-control" value="{{old('capacite',$transporteur->vehicules->first() ? $transporteur->vehicules->first()->capacite : null)}}">
                <div class="input-group-addon">kg</div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Chauffeur *</label>
        <div class="col-sm-8 col-xs-12">
            <input type="text" disabled placeholder="nom du chauffeur..." id="chauffeur" name="chauffeur" class="form-control" value="{{old('chauffeur',$transporteur->vehicules->first() ? $transporteur->vehicules->first()->chauffeur : $transporteur->nom." ".$transporteur->prenoms)}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Téléphone *</label>
        <div class="col-sm-8 col-xs-12">
            <input type="text" disabled placeholder="Telephone..." id="telephone" name="telephone" class="form-control" value="{{old('telephone',$transporteur->vehicules->first() ? $transporteur->vehicules->first()->telephone : $transporteur->contact)}}">
        </div>
    </div>

    <div class="form-group">
        <label for="typecamion_id" class="control-label col-sm-4">Type de camion *</label>
        <div class="col-sm-8 col-xs-12">
            <select name="typecamion_id" required id="typecamion_id" class="form-control" >
                @foreach($typevehicules as $typevehicule)
                <option @if(old('typecamion_id',$transporteur->vehicules->first() ? $transporteur->vehicules->first()->typecamion_id : null)) selected @endif value="{{ $typevehicule->id }}">{{ $typevehicule->libelle }}</option>
                @endforeach
            </select>
        </div>
    </div>

</div>