<?php

namespace App\Http\Controllers;

use App\Services\Statut;
use App\Vehicule;
use App\Work\Tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class VehiculeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function addNewVehicle(Request $request)
    {
        if(Auth::user()->authenticable->limite != null && Auth::user()->authenticable->limite > Vehicule::where('transporteur_id',Auth::user()->id)->count() )
            return back()->withErrors(Lang::get('message.erreur.vehicule.limite'));

        $this->validate($request,[
            'immatriculation' => 'required|unique:vehicule|regex:/([0-9]{1,4})(\s?)([a-zA-Z\s]{2})(\s?)([0-2]{2})/',
            'capacite' => 'required|numeric',
            'telephone' => 'required',
        ]);

        $data = $request->except('_token');
        $data['transporteur_id'] = Auth::user()->id;
        $data['statut'] = Statut::TYPE_VEHICULE.Statut::ETAT_ACTIF.Statut::AUTRE_NON_NULL;

        Vehicule::create($data);

        return back()->with(Tools::MESSAGE_SUCCESS,Lang::get('message.vehicule.nouveau',['immat' => $data['immatriculation']]));
    }
}
