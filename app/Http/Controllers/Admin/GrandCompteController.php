<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 15/06/2017
 * Time: 21:02
 */

namespace App\Http\Controllers\Admin;


use App\Client;
use App\Http\Controllers\Controller;
use App\IdentiteAccess;
use App\Metier\ClientProcessing;
use App\Work\Tools;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GrandCompteController extends Controller
{
    use ClientProcessing;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showList()
    {
        $clientsGrandCompte = Client::with("validBy")
            ->where('grandcompte',true);

        if(request()->has("search"))
            $clientsGrandCompte->where(DB::raw("concat(nom,prenoms,contact) "), 'like' ,"%".request()->input("search")."%");

        $clientsGrandCompte = $clientsGrandCompte->paginate(20);

        return view('staff.grand-compte.liste',compact("clientsGrandCompte"));
    }

    public function searchClient(Request $request)
    {
        $clients = null;
        if($request->has('query'))
            $this->retrivingClients($request->input('query'),$clients);

        return view('staff.grand-compte.search',compact("clients"));
    }

    public function switchGrandClient(Request $request)
    {
        $this->validate($request,[
            "email" => "required|email|exists:identiteaccess"
        ]);

        $identite = IdentiteAccess::with("client")->where("email",$request->input("email"))
                    ->firstOrFail();

        $client = $identite->client;
        $client->grandcompte = (intval($request->input("grandcompte")) >= 1);
        $client->valid_by = Auth::user()->getId();
        $client->dategrandcompte = Carbon::now()->toDateTimeString();

        $client->saveOrFail();

        return redirect()->back()->with(Tools::MESSAGE_SUCCESS,"Le client {$client->nom} {$client->prenoms} est passé grand compte.");
    }

}