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

        $expedition->statut = $statut;

        $this->markChange($expedition->chargement, $statut);

        return $expedition->save();
    }

    private function markChange(Chargement $chargement, $statut)
    {
        switch ($statut){
            case Statut::TYPE_EXPEDITION.Statut::ETAT_EN_COURS.Statut::AUTRE_ACCEPTE :
                $chargement->dateheurechargement = Carbon::now()->toDateTimeString();
                $chargement->vehicule->statut = Statut::TYPE_VEHICULE.Statut::ETAT_EN_MISSION.Statut::AUTRE_NON_NULL; //Véhicule en mission
                break;

            case Statut::TYPE_EXPEDITION.Statut::ETAT_LIVREE.Statut::AUTRE_ACCEPTE :
                $chargement->dateheurelivraison = Carbon::now()->toDateTimeString();
                $chargement->vehicule->statut = Statut::TYPE_VEHICULE.Statut::ETAT_ACTIF.Statut::AUTRE_NON_NULL; //Véhicule devient libre
                break;
        }

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

    private function generateOtp(Chargement $chargement)
    {
        $otp = rand(10000,99999);
        $chargement->otp = $otp;
        $chargement->dateheureotp = Carbon::now()->toDateTimeString();
        $chargement->saveOrFail();
        return $otp;
    }
}