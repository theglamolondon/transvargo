<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 26/09/2017
 * Time: 14:05
 */

namespace App\Http\Controllers\Carrier;


use App\Chargement;
use App\Expedition;
use App\Services\Statut;
use Carbon\Carbon;
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
                $chargement->vehicule->statut = Statut::TYPE_VEHICULE.Statut::ETAT_ACTIF.Statut::AUTRE_NON_NULL; //Véhicule devient livre
                break;
        }
    }
}