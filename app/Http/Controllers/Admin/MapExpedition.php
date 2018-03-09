<?php

namespace App\Http\Controllers\Admin;

use App\Expedition;
use App\Localisation;
use App\Metier\ExpeditionProcessing;
use App\Metier\MapProcessing;
use App\Services\Statut;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class MapExpedition extends Controller
{
    use ExpeditionProcessing, MapProcessing;

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

    private function getExpeditionNonAffectes()
    {
        return Expedition::with( "chargement.vehicule.transporteur", "typeCamion")
            ->whereIn("statut", [
                Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_NON_ACCEPTE,
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

    public function affectExpedditionToCarrier($reference)
    {
        try{
            $expedition = Expedition::with("chargement.vehicule.transporteur", "typeCamion", "assurance","tonnage")
                ->where("reference", $reference)
                ->firstOrFail();
            $localisations = Localisation::with("vehicule")
                ->latest("datelocalisation")
                ->un

            return view('staff.map.affectation', compact("expedition"));
        }catch (ModelNotFoundException $e){
            return back()->withErrors("Expedition introuvable");
        }
    }
}