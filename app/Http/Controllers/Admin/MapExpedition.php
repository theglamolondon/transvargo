<?php

namespace App\Http\Controllers\Admin;

use App\Expedition;
use App\Metier\ExpeditionProcessing;
use App\Services\Statut;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapExpedition extends Controller
{
    use ExpeditionProcessing;

    public function showMap()
    {
        return view('staff.map.expeditions');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getExpeditionInAction()
    {
        return Expedition::with( "chargement.vehicule.transporteur", "typeCamion")
            ->whereIn("statut", [
                Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_ACCEPTE,
                Statut::TYPE_EXPEDITION.Statut::ETAT_EN_COURS.Statut::AUTRE_ACCEPTE,
            ])->get();
    }

    public function ajaxGetLocatisation()
    {
        $output = [];

        foreach ($this->getExpeditionInAction() as $expedition)
        {
            $output[] = [
                "expedition" => $expedition->toArray(),
                "position" => $expedition->chargement->vehicule->localisation() ?
                    (
                        $expedition->chargement->vehicule->localisation()->latest('datelocalisation')->first() ?
                            $expedition->chargement->vehicule->localisation()->latest('datelocalisation')->first()->toArray() : null
                    ) : null
            ];
        }

        return response()->json($output, 200, [
            "Content-Type" => "application/json"
        ], JSON_UNESCAPED_UNICODE);
    }
}