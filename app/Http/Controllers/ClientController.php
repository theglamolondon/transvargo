<?php

namespace App\Http\Controllers;

use App\Expedition;
use App\Metier\ClientProcessing;
use App\Metier\ExpeditionProcessing;
use App\Services\Statut;
use App\TypeCamion;
use App\Work\Tools;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Schema;

class ClientController extends Controller
{
    use ClientProcessing, ExpeditionProcessing;

    public function __construct()
    {
        $this->middleware(['auth','client']);
    }

    public function showNewExpeditionForm(Request $request)
    {
        if(Auth::user()->activateCheck())
        {
            $expedition = new Expedition();

            if($request->has('ref')){
                $expedition = $this->getExpeditionByReference(base64_decode($request->input('ref')));
            }

            $types = TypeCamion::all();
            return view('site.newexpedition',compact("types","expedition"));

        }else{

            return redirect()
                ->route('client.expeditions')
                ->with(Tools::MESSAGE_WARNING, Lang::get('message.erreur.identite.noactivate'));
        }

    }

    public function showMyAccount()
    {
        if(Auth::user()->activateCheck()) {

            return view('site.myaccount');

        }else{

            return redirect()
            ->route('client.expeditions')
            ->with(Tools::MESSAGE_WARNING, Lang::get('message.erreur.identite.noactivate'));
        }
    }

    public function showCommande($reference)
    {
        $expedition = null;
        try{
            $expedition = $this->getExpeditionByReference($reference);
        }catch (ModelNotFoundException $e){
            return back()->withErrors($e->getMessage())->withInput();
        }

        return view('site.commande',compact('expedition'));
    }

    public function showExpeditions()
    {
        $expeditions = Expedition::with('client','chargement')
            ->whereNotIn('statut',[Statut::TYPE_EXPEDITION.Statut::ETAT_LIVREE.Statut::AUTRE_NON_NULL])
            ->orderBy('datechargement')
            ->paginate(30);

        return view('site.expeditions',compact("expeditions"));
    }

    public function showInvoices()
    {
        if(Auth::user()->activateCheck()) {

            return view('site.invoices');

        }else{

            return redirect()
                ->route('client.expeditions')
                ->with(Tools::MESSAGE_WARNING, Lang::get('message.erreur.identite.noactivate'));
        }
    }
}