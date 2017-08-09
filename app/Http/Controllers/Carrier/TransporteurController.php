<?php

namespace App\Http\Controllers\Carrier;

use App\Expedition;
use App\Metier\ExpeditionProcessing;
use App\Services\Statut;
use App\TypeCamion;
use App\Vehicule;
use App\Work\Tools;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Schema;

class TransporteurController extends Controller
{
    use ExpeditionProcessing;

    public function __construct()
    {
        $this->middleware(['auth','transporteur']);
    }

    public function showDashboard()
    {
        if(!Auth::user()->activateCheck())
            return $this->showNoValidAccount();

        $vehicules = Vehicule::where('transporteur_id',Auth::user()->id)
            ->with('typeCamion')
            ->get();

        $types = TypeCamion::all();
        return view('carrier.dashboard',compact("vehicules","types"));
    }

    public function showNoValidAccount()
    {
        return view('carrier.no-valid-account');
    }

    public function showOffersOnMap()
    {
        if(!Auth::user()->activateCheck())
            return $this->showNoValidAccount();

        return view('carrier.offers-map');
    }

    public function showOfferOnListView()
    {
        if(!Auth::user()->activateCheck())
            return $this->showNoValidAccount();

        $offres = $this->getOffersList();

        return view('carrier.offers-list',compact("offres"));
    }

    public function showChargement()
    {
        return view('carrier.chargement');
    }

    public function showAcceptOfferForm($reference){
        global $expedition;
        $expedition = Expedition::where('reference',$reference)->first();

        if(!$expedition)
            return back()->withErrors(Lang::get('message.erreur.offre'));

        if($expedition->statut != Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_NON_ACCEPTE)
            return back()->withErrors(Lang::get('message.erreur.expedition.affectation'));

        $vehicules = Vehicule::where('transporteur_id',Auth::user()->id)
            ->with(['typeCamion' => function ($query){
                global $expedition;
                $query->where('id',$expedition->typecamion_id);
            }])
            ->get();

        return view('carrier.accept',compact('expedition','vehicules'));
    }
}
