<?php

namespace App\Http\Controllers;

use App\IdentiteAccess;
use App\Services\Statut;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class SiteController extends Controller
{
    //

    public function index(Request $request){
        return view('site.index');
    }

    public function showTermOfUsesPage(Request $request){
        return view('site.terms');
    }

    public function showTransporteurTermOfUsesPage(Request $request){
        return view('carrier.terms');
    }

    public function showContactPage(Request $request){
        return view('site.contact');
    }

    public function validation($token)
    {
        //lecture et décode du token
        list($dateHeure,$email) = explode('|',base64_decode($token));

        try{
            //Capture de la date et heure de la création
            $dateTime = new Carbon($dateHeure);

            //Max hour life 168 = 7 jours de validité avec 24h/jour
            if( (60*24*7) < $dateTime->diffInMinutes(Carbon::now(),false) )
                throw new \Exception(Lang::get('message.inscription.client.expire'));

            $identite = IdentiteAccess::where('email',$email)->with('client')->first();

            if(!$identite)
                throw new ModelNotFoundException('Votre token est invalide ou a été mal généré !');

            //MAJ du statut
            $identite->statut = Statut::create(Statut::TYPE_IDENTITE_ACCESS,Statut::ETAT_ACTIF,Statut::AUTRE_NON_NULL);

            $identite->saveOrFail();
        }catch (ModelNotFoundException $e){
            return view('error.404');
        }catch (\Exception $e){
            return redirect()->route('login')->withErrors($e->getMessage());
        }
    }
}