<?php

namespace App\Http\Controllers;

use App\Events\AcceptExpedition;
use App\Expedition;
use App\Metier\ClientProcessing;
use App\Metier\ExpeditionProcessing;
use App\Services\Statut;
use App\TypeCamion;
use App\Work\Tools;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class ExpeditionController extends Controller
{
    use ClientProcessing,ExpeditionProcessing;

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function showNewExpeditionForm()
    {
        $types = TypeCamion::all();
        return view('site.newexpedition',compact("types"));
    }

    public function showExpeditions()
    {
        $expeditions = Expedition::with('client','chargement','livraison','nature')
            ->where('statut',Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_NON_ACCEPTE)
            ->orderBy('datechargement')
            ->get();
        return view('site.expeditions',compact("expeditions"));
    }

    public function saveNewExpedition(Request $request)
    {
        $this->validate($request, $this->validatorRules());

        $this->createExpedition($request->all());

        //steps 2
        return redirect()->route('client.commande')->with(Tools::MESSAGE_SUCCESS,Lang::get('message.expedition.create',['date' => $request->input('datechargement')]));
    }

    public function showCommande($reference)
    {
        $expedition = null;
        try{
            $expedition = $this->getExpeditionByReference($reference);
        }catch (ModelNotFoundException $e){
            return back()->withErrors($e->getMessage())->withInput();
        }

        return view('site.comande',compact('expedition'));
    }



    public function showDetailsExpeditions($reference)
    {
        return view('site.expeditiondetails');
    }
}
