<?php

namespace App\Http\Controllers;

use App\IdentiteAccess;
use App\Services\Statut;
use App\Work\Tools;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        return redirect()->route('client.expeditions');
    }

    public function sendResponseContact(Request $request)
    {
        $this->validate($request,$this->validateRules());

        try{
            $this->sendEmail($request->except('_token'));
        }catch (\Swift_TransportException $e){
            Log::error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }

        return back()->with(Tools::MESSAGE_SUCCESS,Lang::get('message.site.contact'));
    }

    private function validateRules()
    {
        return [
            'fullname' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'subject' => 'present',
            'contact' => 'present',
        ];
    }

    private function sendEmail(array $data)
    {
        $obj = new Collection($data);
        Mail::raw($obj->get('message'),function ($message) use($obj){
            $message->to(env('APP_EMAIL','contact@transvargo.com'))
                    ->from($obj->get('email'),$obj->get('fullname','Internaute anonyme'));
            });
    }
}