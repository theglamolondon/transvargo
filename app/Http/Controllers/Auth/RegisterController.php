<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\Events\ExpediteurCreate;
use App\Events\TransporteurCreate;
use App\IdentiteAccess;
use App\Metier\ClientProcessing;
use App\Metier\TransportProcessing;
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

    use RegistersUsers, TransportProcessing, ClientProcessing;

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

    protected function validatorIdentiteAccess(){
        return  [
            'email' => 'required|email|max:255|unique:identiteaccess,email',
            'password' => 'required|min:6|confirmed',
            'terms' => 'accepted',
        ];
    }

    private function createIdentiteAccess(array $data, $identiteType)
    {
        $identite = new IdentiteAccess([
            'email' => $data['email'],
            'terms' => $data['terms'],
            'password' => bcrypt($data['password']),
            'typeidentite_id' => $identiteType,
            'statut' => Statut::create(Statut::TYPE_IDENTITE_ACCESS,Statut::ETAT_ACTIF,Statut::AUTRE_NON_CONFRIME),
            'activate_token' => base64_encode(Carbon::now()->toDateTimeString().'|'.$data['email'])
        ]);
        $identite->saveOrFail();
        return $identite;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return IdentiteAccess
     */
    protected function createClient(array $data, IdentiteAccess $identite)
    {
        //$identite->makeVisible('id');

        $client = new Client([
            'nom' => $data['nom'],
            'prenoms' => $data['prenoms'],
            'contact' => $data['contact'],
            'raisonsociale' => $data['raisonsociale'],
        ]);
        $client->identiteAccess()->associate($identite);
        $client->datecreation = Carbon::now()->toDateTimeString();
        $identite->setAuthenticable($client);

        $client->saveOrFail();

        return $identite;
    }

    public function registerTransporteur(Request $request)
    {
        $validateRules = $this->validatorTransporteur();
        unset($validateRules['rib']);
        $this->validate($request, $validateRules);

        try{
            $identite = $this->createIdentiteAccess($request->all(),TypeIdentitite::TYPE_TRANSPORTEUR);

            $identite = $this->createTransporteur($request->all(),$identite);

            event(new TransporteurCreate($identite->getAuthenticable()));

            return $this->registered($request, $identite)
                ?: redirect()->route('accueil')
                    ->with(Tools::MESSAGE_SUCCESS,Lang::get('message.inscription.transporteur.'.Tools::MESSAGE_SUCCESS))
                    ->with(Tools::MESSAGE_INFO,Lang::get('message.inscription.transporteur.'.Tools::MESSAGE_INFO));

        }catch (\Exception $e){
            Log::error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request,$this->validatorIdentiteAccess());
        $this->validate($request,$this->validatorClient());

        try{
            $identite = $this->createIdentiteAccess($request->all(),TypeIdentitite::TYPE_CLIENT);
            $user = $this->createClient($request->all(),$identite);

            event(new ExpediteurCreate($user->getAuthenticable()));

            $this->guard()->login($user);

            return redirect()->route('client.expeditions');
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }
}
