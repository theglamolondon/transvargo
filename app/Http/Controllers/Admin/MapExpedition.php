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
use Illuminate\Support\Facades\DB;
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

    public function affectExpeditionToCarrier($reference)
    {
        $sql = <<<EOD
select DISTINCT v.id as veh_id, v.immatriculation, v.chauffeur, v.telephone as ch_telephone,
(select concat_ws(',',latitude, longitude) from localisation
where vehicule_id = v.id order by datelocalisation desc limit 1) as coord,  tc.libelle as typecamion, t.*
from vehicule v join transporteur t on t.identiteaccess_id = v.transporteur_id join typecamion tc on tc.id = v.typecamion_id;
EOD;

        try{
            $expedition = Expedition::with("typeCamion", "assurance", "tonnage")
                ->where("reference", $reference)
                ->firstOrFail();
            $localisations = DB::select($sql);

            return view('staff.map.affectation', compact("expedition", "localisations"));
        }catch (ModelNotFoundException $e){
            return back()->withErrors("Expedition introuvable");
        }
    }
}