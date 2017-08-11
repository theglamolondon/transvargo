<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 16/05/2017
 * Time: 12:15
 */

namespace App\Metier;


use App\Chargement;
use App\Events\AcceptExpedition;
use App\Expedition;
use App\Services\Statut;
use App\Vehicule;
use App\Work\Tools;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

trait ExpeditionProcessing
{
    //use MapProcessing;

    public function validatorRules()
    {
        return [
            'datechargement' => 'required|date_format:d/m/Y',
            'dateexpiration' => 'required|date_format:d/m/Y',
            'coordarrivee' => 'required',
            'lieuarrivee' => 'required',
            'coorddepart' => 'required',
            'lieudepart' => 'required',
            'prix' => 'present|numeric',
            'typecamion_id' => 'required|numeric',
            'masse' => 'required|numeric',
            'distance' => 'required|numeric',
        ];
    }

    private function generateReference()
    {
        return 'EXP'.date('dmY').'-'.strtoupper(bin2hex(random_bytes(3)));
    }

    private function validateAnOffer(){
        return [
            'immatriculation' => 'required|exists:vehicule,immatriculation',
            'reference' => 'required|exists:expedition,reference',
        ];
    }

    private function createExpedition(Request $request)
    {
        $data = $request->all();

        $_expedition = new Expedition(
        $raw = [
            'client_id' => Auth::user()->authenticable->identiteaccess_id,
            'reference' => $this->generateReference(),
            'dateheurecreation' => Carbon::now()->toDateTimeString(),
            'datechargement' => Carbon::createFromFormat('d/m/Y',$data['datechargement'])->toDateString(),
            'dateexpiration' => Carbon::createFromFormat('d/m/Y',$data['dateexpiration'])->toDateString(),
            'lieudepart'=>$data['lieudepart'],
            'lieuarrivee'=>$data['lieuarrivee'],
            'coorddepart'=>$data['coorddepart'],
            'coordarrivee'=>$data['coordarrivee'],
            'statut' => Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_INITIE,
            'fragile'=>$data['fragile'],
            'masse' => $data['masse'],
            'prix' => $data['prix'],
            'distance'=> $data['distance'],
            'typecamion_id'=> $data['typecamion_id'],
        ]);

        if($request->has('ref'))
        {
            $_expedition = $this->getExpeditionByReference(base64_decode($request->input('ref')));
        }

        $_expedition->saveOrFail($raw);

        return $_expedition;
    }

    private function reserveOffer(array $data)
    {
        $expedition = Expedition::with("chargement")->where('reference',$data['reference'])->first();

        if(!$expedition)
            throw new ModelNotFoundException(Lang::get('message.erreur.expedition.affectation'));

        $vehicule = Vehicule::where('immatriculation',$data['immatriculation'])->first();

        $expedition->chargement->vehicule()->associate($vehicule);
        $expedition->chargement->save();

        $expedition->statut = Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_ACCEPTE;
        $expedition->dateheureacceptation = Carbon::now()->toDateTimeString();
        $expedition->save();

        return $expedition;
    }

    public function acceptOffer(Request $request)
    {
        try{
            $this->validate($request, $this->validateAnOffer());

            $expedition = $this->reserveOffer($request->except('token'));

            event(new AcceptExpedition($expedition));

        } catch (ModelNotFoundException $e ){
            return back()->withErrors($e->getMessage());
        }

        return redirect()->route('transporteur.offres.liste')
            ->with(Tools::MESSAGE_SUCCESS,Lang::get('message.expedition.accept',['reference' => $request->input('reference')]));
    }

    private function getExpeditionByReference($reference)
    {
        $expedition = Expedition::where('reference',$reference)
            ->with('chargement')
            ->firstOrNew([]);

        if(!$expedition->exists)
            throw new ModelNotFoundException(Lang::get('message.erreur.expedition.notfound'));

        return $expedition;
    }

    private function validateCommande()
    {
        return [
            'adressechargement' => 'present',
            'societechargement' => 'required',
            'contactchargement' => 'required',
            'adresselivraison' => 'present',
            'societelivraison' => 'required',
            'contactlivraison' => 'required',
        ];
    }

    private function saveCommande(Expedition $expedition,array $data)
    {
        //dd($expedition);
        $chargement = new Chargement([
            'dateheurechargement' => Carbon::now()->toDateTimeString(),
            'adressechargement' => $data['adressechargement'],
            'societechargement' => $data['societechargement'],
            'contactchargement' => $data['contactchargement'],
            'adresselivraison' => $data['adresselivraison'],
            'societelivraison' => $data['societelivraison'],
            'contactlivraison' => $data['contactlivraison'],
        ]);

        $expedition->statut = Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_NON_ACCEPTE;
        $expedition->saveOrFail();

        $chargement->expedition()->associate($expedition);

        $chargement->saveOrFail();
    }


    public function getOffersToJson()
    {
        return $this->getOffers()
            ->get()
            ->toJson(JSON_UNESCAPED_UNICODE);
    }

    public function getOffersList()
    {
        return $this->getOffers()
            ->paginate(30);
    }

    /**
     * @return Builder
     */
    protected function getOffers(){
        return Expedition::with("client","chargement")
            ->where('statut',Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_NON_ACCEPTE)
            ->orderBy('datechargement');
    }
}