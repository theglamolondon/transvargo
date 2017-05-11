<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\Events\ExpediteurCreate;
use App\Events\TransporteurCreate;
use App\IdentiteAccess;
use App\Pays;
use App\Services\Statut;
use App\Transporteur;
use App\TypeIdentitite;
use App\TypeTransporteur;
use App\User;
use App\Http\Controllers\Controller;
use App\Ville;
use App\Work\Tools;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/accueil.html';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     *
     * @return array
     */
    protected function validator()
    {
        return  [
            'nom' => 'required|max:255',
            'email' => 'required|email|max:255|unique:identiteaccess,email',
            'contact' => 'required|unique:client,contact',
            'password' => 'required|min:6|confirmed',
            'terms' => 'accepted',
        ];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return IdentiteAccess
     */
    protected function create(array $data)
    {
        $identite = new IdentiteAccess([
            'email' => $data['email'],
            'terms' => $data['terms'],
            'password' => bcrypt($data['password']),
            'typeidentite_id' => TypeIdentitite::TYPE_CLIENT,
            'statut' => Statut::create(Statut::TYPE_IDENTITE_ACCESS,Statut::ETAT_ACTIF,Statut::AUTRE_NON_CONFRIME),
            'activate_token' => base64_encode(Carbon::now()->toDateTimeString().'|'.$data['email'])
        ]);
        $identite->saveOrFail();

        $identite->makeVisible('id');

        $client = new Client([
            'nom' => $data['nom'],
            'prenoms' => $data['prenoms'],
            'contact' => $data['contact'],
            'raisonsociale' => $data['raisonsociale'],
        ]);
        $client->identiteAccess()->associate($identite);

        $identite->setAuthenticable($client);

        $client->saveOrFail();

        //Log::error(base64_encode(Carbon::now()->toDateTimeString().'|'.$data['email']));

        return $identite;
    }

    public function showRegistrationForm()
    {
        $villes = Ville::orderBy('nom','asc')->get();
        $countries = Pays::orderBy('nom','asc')->get();

        return view('auth.register',compact("villes","countries"));
    }


    private function validatorTransporteur()
    {
        return [
            'nom' => 'required|max:255',
            'email' => 'required|email|max:255|unique:identiteaccess,email',
            'password' => 'required|min:6|confirmed',
            'comptecontribuable' => 'present',
            'raisonsociale' => 'present',
            'ville_id' => 'required|numeric',
            'typetransporteur_id' => 'required|numeric',
            'terms' => 'accepted',
        ];
    }

    private function createTransporteur(array $data){
        $identite = new IdentiteAccess([
            'email' => $data['email'],
            'terms' => $data['terms'],
            'password' => bcrypt($data['password']),
            'typeidentite_id' => TypeIdentitite::TYPE_TRANSPORTEUR,
            'statut' => Statut::create(Statut::TYPE_IDENTITE_ACCESS,Statut::ETAT_INACTIF,Statut::AUTRE_NON_CONFRIME)
        ]);
        $identite->saveOrFail();

        $transporteur = new Transporteur([
            'identiteaccess_id' => $identite->id,
            'nom' => $data['nom'],
            'prenoms' => $data['prenoms'],
            'raisonsociale' => $data['raisonsociale'],
            'comptecontribuable' => $data['comptecontribuable'],
            'ville_id' => $data['ville_id'],
            'typetransporteur_id' => $data['typetransporteur_id'],
        ]);

        if($data['typetransporteur_id'] == TypeTransporteur::TYPE_CHAUFFEUR_PATRON)
            $transporteur->limite =

        $transporteur->saveOrFail();

        $identite->setAuthenticable($transporteur);

        return $identite;
    }

    public function registerTransporteur(Request $request)
    {
        dd($request);
        $this->validate($request, $this->validatorTransporteur());

        $identite = $this->createTransporteur($request->all());

        event(new TransporteurCreate($identite->getAuthenticable()));

        //$this->guard()->login($dentite);

        return $this->registered($request, $identite)
            ?: redirect()->route('accueil')
                ->with(Tools::MESSAGE_SUCCESS,Lang::get('message.inscription.transporteur'.Tools::MESSAGE_SUCCESS))
                ->with(Tools::MESSAGE_INFO,Lang::get('message.inscription.transporteur'.Tools::MESSAGE_INFO));
    }

    public function showTransporteurRegistrationForm()
    {
        $villes = Ville::orderBy('nom','asc')->get();
        $countries = Pays::orderBy('nom','asc')->get();

        return view('auth.carrier.register',compact("villes","countries"));
    }

    public function register(Request $request)
    {
        $this->validate($request,$this->validator());

        try{
            $user = $this->create($request->all());

            event(new ExpediteurCreate($user->getAuthenticable()));

            $this->guard()->login($user);

            return redirect()->route('client.tableaubord');
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }
}
