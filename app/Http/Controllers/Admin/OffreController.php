<?php

namespace App\Http\Controllers\Admin;

use App\Expedition;
use App\Metier\ExpeditionProcessing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OffreController extends Controller
{
    use ExpeditionProcessing;

    public function liste(Request $request)
    {
        $expeditions = Expedition::with('typeCamion','client','chargement.vehicule.transporteur')
            ->orderBy('dateheurecreation','desc');

        $this->filterExpeditions($request, $expeditions);

        $expeditions = $expeditions->select("expedition.*")
            ->paginate(30);


        return view('staff.offres', compact('expeditions'));
    }

    private function filterExpeditions(Request $request, Builder &$expeditions)
    {
        //Check if Get Query is passed in current request
        if(count($request->query())){
            $expeditions = $expeditions->whereBetween("dateheurecreation",[
                Carbon::createFromFormat("d/m/Y H:i:s", $request->query("periode_du")." 00:00:00")->toDateTimeString(),
                Carbon::createFromFormat("d/m/Y H:i:s", $request->query("periode_au")." 23:59:59")->toDateTimeString()
            ]);

            //Cheeck if Client name is passed
            if(!empty($request->query("client_name"))){
                $expeditions = $expeditions->join("client","client.identiteaccess_id", "=", "expedition.client_id")
                    ->whereRaw("concat(client.nom, client.prenoms, client.raisonsociale) like '%".$request->query("client_name")."%'");
            }

            //Check if Transporteur name is passed
            if(!empty($request->query("transporteur_name"))){
                $expeditions = $expeditions->join("chargement","chargement.expedition_id", "=","expedition.id")
                    ->join("vehicule", "vehicule.id","=", "chargement.vehicule_id")
                    ->join("transporteur", "transporteur.identiteaccess_id", "=", "vehicule.transporteur_id")
                ->whereRaw("concat(transporteur.nom, transporteur.prenoms, transporteur.raisonsociale) like '%".$request->query("transporteur_name")."%'");
            }
        }
    }

    public function details($reference)
    {
        try{
            $expedition = $this->getExpeditionByReference($reference);

            return view("carrier.accept", compact("expedition"));
        }catch (ModelNotFoundException $e){
            logger($e->getTraceAsString());
            return back()->withErrors($e->getMessage());
        }
    }
}
