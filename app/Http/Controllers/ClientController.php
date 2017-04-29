<?php

namespace App\Http\Controllers;

use App\Expedition;
use App\Metier\ClientProcessing;
use App\Services\Statut;
use App\TypeCamion;
use App\Work\Tools;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Schema;

class ClientController extends Controller
{
    use ClientProcessing;

    public function __construct()
    {
        $this->middleware(['auth','client']);
    }

    public function showDashboard()
    {
        return view('site.dashboard');
    }

    public function showNewExpeditionForm()
    {
        $types = TypeCamion::all();
        return view('site.newexpedition',compact("types"));
    }

    public function showExpeditions()
    {
        $expeditions = Expedition::with('client','chargement','livraison','nature')->orderBy('datechargement')->get();
        return view('site.expeditions',compact("expeditions"));
    }

    public function showMyAccount()
    {
        return view('site.myaccount');
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
            'datechargement' => Carbon::createFromFormat('d/m/Y',$data['datechargement'])->toDateString(),
            'statut' => Statut::TYPE_EXPEDITION.Statut::ETAT_PROGRAMMEE.Statut::AUTRE_NON_ACCEPTE
        ]);
    }

    private function generateReference()
    {
        return 'EXP'.date('dmY').'-'.bin2hex(random_bytes(3));
    }
}