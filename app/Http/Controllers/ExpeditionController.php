<?php

namespace App\Http\Controllers;

use App\Events\AcceptExpedition;
use App\Expedition;
use App\Metier\ClientProcessing;
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
    use ClientProcessing;

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

    private function reserveOffer(array $data)
    {
        $expedition = Expedition::where('reference',$data['reference'])->first();

        if(!$expedition)
            throw new ModelNotFoundException(Lang::get('message.erreur.expedition.affectation'));

        $expedition->statut = Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_ACCEPTE;
        $expedition->save();

        return $expedition;
    }

    private function validateAnOffer(){
        return [
            'immatriculation' => 'required|exists:vehicule,immatriculation',
            'reference' => 'required|exists:expedition,reference',
        ];
    }

    private function addChargement(Expedition $expedition)
    {

    }

    public function acceptOffer(Request $request)
    {
        try{
            $this->validate($request, $this->validateAnOffer());

            $expedition = $this->reserveOffer($request->except('token'));

            $this->addChargement($expedition);

            event(new AcceptExpedition($expedition));

        } catch (ModelNotFoundException $e ){
            return back()->withErrors($e->getMessage());
        }

        return redirect()->route('transporteur.offres')
            ->with(Tools::MESSAGE_SUCCESS,Lang::get('message.expedition.accept',['reference' => $request->input('reference')]));
    }

    public function saveNewExpedition(Request $request)
    {
        $this->validate($request, $this->validatorRules());

        $this->createExpedition($request->all());

        return redirect()->route('client.myexpedition')->with(Tools::MESSAGE_SUCCESS,Lang::get('message.expedition.create',['date' => $request->input('datechargement')]));
    }

    private function createExpedition(array $data)
    {
        Expedition::create([
            'client_id' => Auth::user()->authenticable->identiteaccess_id,
            'reference' => $this->generateReference(),
            'datecreation' => Carbon::now()->toDateTimeString(),
            'adresselivraison' => '',
            'masse' => $data['masse'],
            'prix' => $data['prix'],
            'typecamion_id'=> $data['typecamion_id'],
            'fragile'=>$data['fragile'],
            'lieudepart'=>$data['lieudepart'],
            'lieuarrivee'=>$data['lieuarrivee'],
            'coorddepart'=>$data['coorddepart'],
            'coordarrivee'=>$data['coordarrivee'],
            'remarque'=>$data['remarque'],
            'datechargement' => Carbon::createFromFormat('d/m/Y',$data['datechargement'])->toDateString(),
            'statut' => Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_NON_ACCEPTE
        ]);
    }

    private function generateReference()
    {
        return 'EXP'.date('dmY').'-'.strtoupper(bin2hex(random_bytes(3)));
    }

    public function showDetailsExpeditions($reference)
    {

        return view('site.expeditiondetails');
    }
}
