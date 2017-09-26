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

        return $expedition->save();
    }
}