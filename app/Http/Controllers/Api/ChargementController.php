<?php

namespace App\Http\Controllers\Api;

use App\Events\DelivryChargement;
use App\Expedition;
use App\Http\Controllers\Carrier\ChargementEvolution;
use App\Metier\ExpeditionProcessing;
use App\Services\Statut;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChargementController extends Controller
{
    use ExpeditionProcessing, ChargementEvolution;

    public function startChargement($transporteur)
    {
        try{

            if(
            !$this->changeStatutExpedition(\request()->input("reference"), Statut::create(Statut::TYPE_EXPEDITION, Statut::ETAT_EN_COURS, Statut::AUTRE_ACCEPTE))
            ){
                throw new ModelNotFoundException();
            }

            return response()->json(["message" => "Chargement débuté"]);

        }catch (ModelNotFoundException $e){
            return response()->json(["message" => "Ce chargement n'existe dans votre liste."], 400);
        }
    }

    public function delivry($transporteur)
    {
        try{

            if(
            !$this->changeStatutExpedition(request()->input("reference"), Statut::create(Statut::TYPE_EXPEDITION, Statut::ETAT_LIVREE, Statut::AUTRE_ACCEPTE))
            ){
                throw new ModelNotFoundException();
            }

            event(new DelivryChargement(Expedition::where("reference",request()->input("reference"))->first()));
            return response()->json(["message" => "Chargement débuté"]);

        }catch (ModelNotFoundException $e){
            return response()->json(["message" => "Ce chargement n'existe dans votre liste."], 400);
        }
    }

    public function checkOTP()
    {
        $otp = rand(10000,99999);

        return response()->json([ "otp" => $otp ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
