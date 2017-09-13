<?php

namespace App\Http\Controllers\Api;

use App\Metier\VehiculeProcessing;
use App\Transporteur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehiculeController extends Controller
{
    use VehiculeProcessing;

    public function liste($transporteur, $typecamion)
    {
        $Objtransporteur = new Transporteur();
        $Objtransporteur->identiteaccess_id = $transporteur;

        $builder = $this->getVehiculeBuilder($Objtransporteur);

        $vehicules = $builder->where('typecamion_id', $typecamion)->get();

        return response()->json($vehicules,200,[],JSON_UNESCAPED_UNICODE);
    }
}
