<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\IdentiteAccess;
use App\Pays;
use App\Services\Statut;
use App\User;
use App\Http\Controllers\Controller;
use App\Ville;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
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
            'email' => 'required|email|max:255|unique:identiteaccess',
            'password' => 'required|min:6|confirmed',
            'ville_id' => 'required',
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
            'ville_id' => $data['ville_id'],
            'password' => bcrypt($data['password']),
            'statut' => Statut::create(Statut::TYPE_IDENTITE_ACCESS,Statut::ETAT_ACTIF)
        ]);
        $identite->saveOrFail();

        $client = new Client([
            'nom' => $data['nom'],
            'prenoms' => $data['prenoms'],
            'raisonsociale' => $data['raisonsociale'],
            'identiteaccess_id' => $identite->id
        ]);
        $client->saveOrFail();

        $identite->setAuthenticable($client);

        return $identite;
    }

    public function showRegistrationForm()
    {
        $villes = Ville::orderBy('nom','asc')->get();
        $countries = Pays::orderBy('nom','asc')->get();

        return view('auth.register',compact("villes","countries"));
    }

    public function register(Request $request)
    {
        $this->validate($request,$this->validator());

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
