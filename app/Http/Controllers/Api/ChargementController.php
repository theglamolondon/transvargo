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
        try{
            $expedition = Expedition::with("chargement")
                            ->where("reference",request()->input("reference"))
                            ->first();

            $this->generateOtp($expedition->chargement);

            event(new DelivryChargement($expedition));

            return response()->json([
                "message" => "Livraison en attente de validation",
                "otp" => $expedition->chargement->otp
            ],200,[
                "Content-Type" => "text/json; charset=utf-8"
            ],JSON_UNESCAPED_UNICODE);

        }catch (ModelNotFoundException $e){
            return response()->json(["message" => "Ce chargement n'existe dans votre liste."], 400);
        }
    }

    public function finish($transporteur)
    {
        try{
            if(
            !$this->changeStatutExpedition(request()->input("reference"), Statut::create(Statut::TYPE_EXPEDITION, Statut::ETAT_LIVREE, Statut::AUTRE_ACCEPTE))
            ){
                throw new ModelNotFoundException();
            }

            return response()->json([
                "message" => sprintf("Expédition %s livrée et terminée", request()->input("reference"))
            ],200,[
                "Content-Type" => "text/json; charset=utf-8"
            ],JSON_UNESCAPED_UNICODE);

        }catch (ModelNotFoundException $e){
            return response()->json(["message" => "Ce chargement n'existe dans votre liste."], 400);
        }
    }

    private function generateOtp(Chargement $chargement)
    {
        $otp = rand(10000,99999);
        $chargement->otp = $otp;
        $chargement->dateheureotp = Carbon::now()->toDateTimeString();
        $chargement->saveOrFail();
        return $otp;
    }
}
