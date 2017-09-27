<?php

namespace App\Http\Controllers\Auth;

use App\Administrateur;
use App\Client;
use App\Http\Controllers\Controller;
use App\Services\Statut;
use App\Staff;
use App\Transporteur;
use App\TypeIdentitite;
use App\Ville;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        //$this->guard()->user()->authenticable;

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    protected function authenticated(Request $request, $user)
    {
        $route = null;

        if($user->authenticable instanceof Transporteur )
        {
            session(["role" => Transporteur::class]);
            redirect()->route('transporteur.tableaubord');
        }

        if($user->authenticable instanceof Client )
        {
            session(["role" => Client::class]);
            redirect()->route('client.expeditions');
        }

        if($user->authenticable instanceof Staff )
        {
            session(["role" => Staff::class]);
            redirect()->route('admin.tableaubord');
        }

        $timeToLive = 60*24*30; //minutes * heures * nombre jours = 1 mois de 30 jours

        Cookie::queue("email",  $user->email, $timeToLive);

        return $route;
    }
}
