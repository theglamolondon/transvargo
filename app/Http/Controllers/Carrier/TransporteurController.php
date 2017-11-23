<?php

namespace App\Http\Controllers\Carrier;

use App\Chargement;
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
    use ExpeditionProcessing, ChargementEvolution;

    public function __construct()
    {
        //
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
        $chargement = Chargement::with(['expedition','vehicule' ])
            ->join("vehicule","vehicule.id","=","chargement.vehicule_id","inner")
            ->where("vehicule.transporteur_id","=", Auth::id())
            ->orderBy('dateheurechargement')
            ->select("chargement.*")
            ->paginate(30);
        return view('carrier.chargement', compact('chargement'));
    }

    public function showAcceptOfferForm($reference){
        global $expedition;

        $expedition = Expedition::with("chargement.vehicule.typeCamion")
            ->where('reference',$reference)
            ->first();

        if(!$expedition) {
            return back()->withErrors(Lang::get('message.erreur.offre'));
        }

        if( (!($expedition->statut != Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_NON_ACCEPTE ) && ($expedition->chargement->vehicule_id != null)) )
        {
            return back()->withErrors(Lang::get('message.erreur.expedition.affectation'));
        }

        $vehicules = Vehicule::where('transporteur_id',Auth::id())
            ->with(['typeCamion' => function ($query){
                global $expedition;
                $query->where('id',$expedition->typecamion_id);
            }])
            ->get();

        return view('carrier.accept',compact('expedition','vehicules'));
    }

    public function startChargement(Request $request)
    {
        $this->validate($request, [
            "reference" => "required|exists:expedition",
            "statut" => "required|numeric"
        ]);

         if( $this->changeStatutExpedition($request->input("reference"), Statut::TYPE_EXPEDITION.Statut::ETAT_EN_COURS) )
         {
            return back()->with(Tools::MESSAGE_SUCCESS, "Expédition démarrée");
         }else{
             return back()->withErrors("Impossible de démarrer l'expédition");
         }
    }

    public function delivry(Request $request)
    {
        return $this->livrerChargement($request);
    }

    public function validerLivraison(Request $request)
    {
        try{
            $this->finishExpedition($request);
            return redirect()->route("transporteur.offres.liste")->with(Tools::MESSAGE_SUCCESS, sprintf("Expédition %s livrée et terminée", $request->input("reference")));
        }catch (ModelNotFoundException $e){
            return back()->withErrors("Cette expédition n'existe dans votre liste.");
        }
    }
}