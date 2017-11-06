<?php

namespace App\Http\Controllers\Api;

use App\Chargement;
use App\Events\DelivryChargement;
use App\Expedition;
use App\Http\Controllers\Carrier\ChargementEvolution;
use App\Metier\ExpeditionProcessing;
use App\Services\Statut;
use Carbon\Carbon;
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
        return $this->livrerChargement(request());
    }

    public function finish($transporteur)
    {
        try{
            $this->finishExpedition(\request());
            return response()->json([
                "message" => sprintf("Expédition %s livrée et terminée", request()->input("reference"))
            ],200,[
                "Content-Type" => "text/json; charset=utf-8"
            ],JSON_UNESCAPED_UNICODE);

        }catch (ModelNotFoundException $e){
            return response()->json(["message" => "Ce chargement n'existe dans votre liste."], 400);
        }
    }
}
