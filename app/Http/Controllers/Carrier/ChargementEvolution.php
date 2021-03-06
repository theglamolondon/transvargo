<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 26/09/2017
 * Time: 14:05
 */

namespace App\Http\Controllers\Carrier;


use App\Chargement;
use App\Events\DelivryChargement;
use App\Events\ExpeditionFinish;
use App\Expedition;
use App\Services\Statut;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

trait ChargementEvolution
{
    /**
     * @param $reference
     * @param $statut
     * @return bool
     */
    public function changeStatutExpedition($reference, $statut)
    {
        $expedition = Expedition::with("chargement")
            ->where("reference", $reference)
            ->first();

        //Nous ajoutons l'état payé ou accepté déjà existant du statut au nouveau statut
        $expedition->statut = $statut.substr($expedition->statut,2,1);

        $this->markChange($expedition->chargement, $statut);

        return $expedition->save();
    }

    private function markChange(Chargement $chargement, $statut)
    {
        switch ($statut){
            case Statut::TYPE_EXPEDITION.Statut::ETAT_EN_COURS :
                $chargement->dateheurechargement = Carbon::now()->toDateTimeString();
                $chargement->vehicule->statut = Statut::TYPE_VEHICULE.Statut::ETAT_EN_MISSION.Statut::AUTRE_NON_NULL; //Véhicule en mission
                break;

            case Statut::TYPE_EXPEDITION.Statut::ETAT_LIVREE :
                $chargement->dateheurelivraison = Carbon::now()->toDateTimeString();
                $chargement->vehicule->statut = Statut::TYPE_VEHICULE.Statut::ETAT_ACTIF.Statut::AUTRE_NON_NULL; //Véhicule devient libre
                break;
        }

        $chargement->save();
        $chargement->vehicule->save();
    }

    private function livrerChargement(Request $request)
    {
        try{
            $expedition = Expedition::with("chargement")
                ->where("reference",$request->input("reference"))
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

    private function finishExpedition(Request $request)
    {
        if(
        !$this->changeStatutExpedition(request()->input("reference"), Statut::TYPE_EXPEDITION.Statut::ETAT_LIVREE)
        ){
            throw new ModelNotFoundException();
        }

        $expedition = Expedition::with('client','chargement.vehicule.transporteur','typeCamion')
            ->where("reference", $request->input("reference"))->firstOrFail();

        $expedition->bonlivraison = sprintf("BL%s-%04d", date('Ym'), $expedition->id);
        $expedition->saveOrFail();

        event(new ExpeditionFinish($expedition));
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