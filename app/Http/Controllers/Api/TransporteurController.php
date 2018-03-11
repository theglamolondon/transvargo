<?php

namespace App\Http\Controllers\Api;

use App\Chargement;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransporteurController extends Controller
{
    public function myExpeditions($transporteur)
    {
        try{
            $chargements = Chargement::with(['expedition.client','expedition.tonnage','vehicule'])
                ->join("vehicule","vehicule.id","=","chargement.vehicule_id","inner")
                //->join("tonnage","tonnage.id","=","chargement.vehicule_id","inner")
                ->where("vehicule.transporteur_id","=", $transporteur)
                ->orderBy('dateheurechargement')
                ->select("chargement.*")
                ->get();
            return response()->json($chargements, 200, [], JSON_UNESCAPED_UNICODE);
        }catch (ModelNotFoundException $e){
            return $e->getMessage();
        }
    }
}