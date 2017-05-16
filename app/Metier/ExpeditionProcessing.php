<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 16/05/2017
 * Time: 12:15
 */

namespace App\Metier;


use App\Events\AcceptExpedition;
use App\Expedition;
use App\Services\Statut;
use App\Work\Tools;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

trait ExpeditionProcessing
{
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


    private function reserveOffer(array $data)
    {
        $expedition = Expedition::where('reference',$data['reference'])->first();

        if(!$expedition)
            throw new ModelNotFoundException(Lang::get('message.erreur.expedition.affectation'));

        $expedition->statut = Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_ACCEPTE;
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

        return redirect()->route('transporteur.offres')
            ->with(Tools::MESSAGE_SUCCESS,Lang::get('message.expedition.accept',['reference' => $request->input('reference')]));
    }

    private function getExpeditionByReference($reference)
    {
        $expedition = Expedition::where('reference',$reference)
            ->with('chargement')
            ->firstOrNew();

        if(!$expedition->exist)
            throw new ModelNotFoundException(Lang::get('message.erreur.expedition.notfound'));

        return $expedition;
    }
}