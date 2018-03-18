<?php

namespace App\Http\Controllers;

use App\Events\NewExpedition;
use App\Expedition;
use App\Metier\ExpeditionProcessing;
use App\Services\Statut;
use App\TypeCamion;
use App\Work\Tools;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ExpeditionController extends Controller
{
    use ExpeditionProcessing;

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function saveNewExpedition(Request $request)
    {
        $this->validate($request, $this->validatorRules(), [
            "require_if.valeurassuree" => "La valeur monétaire de la machandise transportée est requise pour le calclu de l'assurance."
        ]);

        $expedition = $this->createExpedition($request);

        return redirect()
            ->route('client.commande',['reference' => $expedition->reference ])
            ->with(Tools::MESSAGE_SUCCESS,Lang::get('message.expedition.initiee'));
    }

    public function publishExpedition(Request $request, $reference)
    {
        try{
            $this->validate($request,$this->validateCommande());

            $expedition = $this->saveCommande($this->getExpeditionByReference($reference),$request->all());

            event(new NewExpedition($expedition));

            return redirect()
                ->route('client.expeditions')
                ->with(Tools::MESSAGE_SUCCESS,Lang::get('message.expedition.create',['date' => $request->input('datechargement')]));

        }catch (ModelNotFoundException $e){

            return back()->withErrors($e->getMessage());
        }
    }


    public function showDetailsExpeditions($reference)
    {
        return view('site.expeditiondetails');
    }
}
