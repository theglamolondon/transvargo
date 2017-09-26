<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\IdentiteAccess;
use App\Work\Tools;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class UpdateProfileController extends Controller
{

    public function updateClient(Request $request)
    {
        $this->validate($request, [
            "prenoms" => "required",
            "nom" => "required",
            "raisonsociale" => "present",
            "contact" => "required",
            "password" => "required_if:passwordupdate,1|confirmed",
        ]);

        $identite = IdentiteAccess::with("client")->find(Auth::id());

        if($request->input("passwordupdate"))
        {
            $identite->password = bcrypt($request->input("password"));
            $identite->save();
        }

        try{
            $identite->client()->update($request->only("prenoms", "nom", "raisonsociale", "contact"));
        }catch (ModelNotFoundException $e){
            return back()->withErrors($e->getMessage())->withInput();
        }

        return back()->with(Tools::MESSAGE_SUCCESS, Lang::get("message.profil.update"));
    }

    public  function getViewTransporteurProfile()
    {
        return view("carrier.compte");
    }

    public function updateTransporteur(Request $request)
    {
        dd($request);
    }
}
