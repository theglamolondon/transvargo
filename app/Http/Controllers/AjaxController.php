<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 23/04/2017
 * Time: 17:06
 */

namespace App\Http\Controllers;


use App\Expedition;
use App\Metier\MapProcessing;
use App\Services\Statut;
use App\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    use MapProcessing;

    public function getDistanceMatrix(Request $request){
        return $this->getDataFromGoogleMatrixAPI(urlencode($request->input('from')),urlencode($request->input('to')),"&units=imperial");
    }

    public function getOffers()
    {
        return Expedition::with('client','chargement','livraison','nature')
            ->where('statut',Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_NON_ACCEPTE)
            ->orderBy('datechargement')
            ->get()
            ->toJson(JSON_UNESCAPED_UNICODE);
    }
}