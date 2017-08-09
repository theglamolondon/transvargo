<?php

namespace App\Http\Controllers\Auth;

use App\Administrateur;
use App\Client;
use App\Http\Controllers\Controller;
use App\Staff;
use App\Transporteur;
use App\TypeIdentitite;
use App\Ville;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
            redirect()->route('transporteur.tableaubord');
        }

        if($user->authenticable instanceof Client )
        {
            redirect()->route('client.expeditions');
        }

        if($user->authenticable instanceof Staff )
        {
            redirect()->route('admin.tableaubord');
        }

        return $route;
    }
}
