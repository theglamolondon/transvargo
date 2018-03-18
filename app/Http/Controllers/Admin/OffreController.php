<?php

namespace App\Http\Controllers\Admin;

use App\Events\AcceptExpedition;
use App\Expedition;
use App\Metier\ExpeditionProcessing;
use App\Services\Statut;
use App\Vehicule;
use App\Work\Tools;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class OffreController extends Controller
{
    use ExpeditionProcessing;

    public function liste(Request $request)
    {
        $expeditions = Expedition::with('typeCamion','client','chargement.vehicule.transporteur')
            //->where("statut", Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_NON_ACCEPTE)
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

            //Check if Client name is passed
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

            //Check if state is passed
            if($request->query("state") != "all"){
                $expeditions->where("statut", intval($request->query("state")));
            }
        }
    }

    public function saveAffect(Request $request, $reference)
    {
        $this->validate($request,[
            'prix' => 'required|numeric',
            'mttassurance' => 'required_if:isassure,1|numeric',
            'fraisannexe' => 'required_if:isassure,1|numeric',
            'vehicule_id' => 'required|numeric',
            'expedition_id' => 'required|numeric'
        ]);

        $expedition = Expedition::with('client','chargement.vehicule.transporteur','typeCamion')
            ->where('reference',$reference)
            ->first();

        if($request->input('expedition_id') != $expedition->id)
            return back()->withErrors("Un problème au niveau de la reférence de l'expédition est survenu.");

        $expedition->facture = sprintf("EXP%s-%04d", date('Ym'), $expedition->id);
        $expedition->prix = $request->input('prix');

        $vehicule = Vehicule::find($request->input('vehicule_id'));

        $expedition->chargement->vehicule()->associate($vehicule);
        $expedition->chargement->save();

        if($expedition->isassure){
            $expedition->mttassurance = intval($request->input('mttassurance'));
            $expedition->fraisannexe = intval($request->input('fraisannexe'));
        }


        $expedition->statut = Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_ACCEPTE;
        $expedition->dateheureacceptation = Carbon::now()->toDateTimeString();

        $expedition->save();

        try{
            event(new AcceptExpedition($expedition));
        }catch (\Exception $e){
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }

        return redirect()->route('staff.offres')
            ->with(Tools::MESSAGE_SUCCESS,Lang::get('message.expedition.accept',['reference' => $request->input('reference')]));
    }
}
