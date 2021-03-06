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
use Illuminate\Support\Facades\Log;

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
            'isassure' => 'required|boolean',
            'assurance_id' => 'required_if:isassure,1',
            'valeurassuree' => 'required_if:isassure,1|numeric',
            'tonnage_id' => 'required|numeric',
            'typecamion_id' => 'required|numeric',
            //'masse' => 'required|numeric',
            //'distance' => 'required|numeric',
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

    /**
     * @param Request $request
     * @return Expedition|\Illuminate\Database\Eloquent\Model|null|static
     * @throws \Throwable
     */
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
            'valeurassuree' => $data["valeurassuree"],
            'masse' => 0,
            'prix' => 0,
            'distance'=> 0,
            'tonnage_id' => $data['tonnage_id'] == '-1' ? null : $data['tonnage_id'],
            'isassure' => $data['isassure'],
            'assurance_id' => $data['isassure'] ? $data['assurance_id'] : null,
            'typecamion_id'=> $data['typecamion_id'],
        ]);

        if($request->has('ref'))
        {
            $_expedition = $this->getExpeditionByReference(base64_decode($request->input('ref')));
        }

        $_expedition->saveOrFail($raw);

        return $_expedition;
    }

    /**
     * @param array $data
     * @return Expedition;
     */
    private function reserveOffer(array $data)
    {
        $expedition = Expedition::with('client','chargement.vehicule.transporteur','typeCamion')
            ->where('reference',$data['reference'])
            ->first();

        if( intval($expedition->statut) > Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_NON_ACCEPTE)
        {
            throw new ModelNotFoundException(Lang::get('message.erreur.expedition.affectation'));
        }


        if($expedition->client->grandcompte){
            $this->makeFacture($expedition);
        }

        $vehicule = Vehicule::where('immatriculation',$data['immatriculation'])->first();

        $expedition->chargement->vehicule()->associate($vehicule);
        $expedition->chargement->save();

        $expedition->statut = Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_ACCEPTE;
        $expedition->dateheureacceptation = Carbon::now()->toDateTimeString();
        $expedition->save();

        return $expedition;
    }

    private function makeFacture(Expedition $expedition)
    {
        $expedition->facture = sprintf("EXP%s-%04d", date('Ym'), $expedition->id);
        $expedition->save();
    }

    /**
     * @param Request $request
     * @return bool
     */
    private function accept(Request $request)
    {
        $this->validate($request, $this->validateAnOffer());

        $expedition = $this->reserveOffer($request->except('token'));

        try{
            event(new AcceptExpedition($expedition));
        }catch (\Exception $e){
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return true;
    }

    public function acceptOffer(Request $request)
    {
        try{
            $this->accept($request);
        } catch (ModelNotFoundException $e ){
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return back()->withErrors($e->getMessage());
        }
        return redirect()->route('transporteur.offres.liste')
            ->with(Tools::MESSAGE_SUCCESS,Lang::get('message.expedition.accept',['reference' => $request->input('reference')]));
    }

    private function getExpeditionByReference($reference)
    {
        $expedition = null;
        try {
            $expedition = Expedition::with('chargement.vehicule.transporteur', 'client', 'typeCamion')
                ->where('reference', $reference)
                ->firstOrFail();
        }catch (ModelNotFoundException $e){
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            throw new ModelNotFoundException(Lang::get('message.erreur.expedition.notfound'));
        }

        return $expedition;
    }

    private function validateCommande()
    {
        return [
            'adressechargement' => 'present',
            'societechargement' => 'present',
            'contactchargement' => 'required',
            'telephonechargement' => 'required',
            'adresselivraison' => 'present',
            'societelivraison' => 'present',
            'contactlivraison' => 'required',
            'telephonelivraison' => 'required',
        ];
    }

    /**
     * @param Expedition $expedition
     * @param array $data
     * @return mixed
     * @throws \Throwable
     */
    private function saveCommande(Expedition $expedition,array $data)
    {
        $chargement = new Chargement([
            //'dateheurechargement' => Carbon::now()->toDateTimeString(),
            'adressechargement' => $data['adressechargement'],
            'societechargement' => $data['societechargement'],
            'contactchargement' => $data['contactchargement'],
            'telephonechargement' => $data['telephonechargement'],
            'adresselivraison' => $data['adresselivraison'],
            'societelivraison' => $data['societelivraison'],
            'contactlivraison' => $data['contactlivraison'],
            'telephonelivraison' => $data['telephonelivraison'],
        ]);

        $expedition->statut = Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_NON_ACCEPTE;
        $expedition->saveOrFail();

        $chargement->expedition()->associate($expedition);

        $chargement->saveOrFail();

        return $chargement->expedition;
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
        return Expedition::with("client","chargement","typeCamion","tonnage")
            ->where('statut',Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_NON_ACCEPTE)
            ->where("dateexpiration",">", Carbon::now()->addDay()->toDateString())
            ->orderBy('datechargement')
            ->select("expedition.*");
    }

    /**
     * @param $reference
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($reference)
    {
        try{
            $expedition = $this->getExpeditionByReference($reference);

            if($expedition->chargement == null){
                return back()->withErrors(Lang::get('message.erreur.offre.incomplet'));
            }

            return view("staff.offre-details", compact("expedition"));
        }catch (ModelNotFoundException $e){
            logger($e->getTraceAsString());
            return back()->withErrors($e->getMessage());
        }
    }
}