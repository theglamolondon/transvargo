<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\IdentiteAccess;
use App\Work\Tools;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

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

        $this->changePassword($identite, $request);

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

    private function changePassword(IdentiteAccess &$identiteAccess, Request $request)
    {
        if($request->input("passwordupdate"))
        {
            $identiteAccess->password = bcrypt($request->input("password"));
            $identiteAccess->save();
        }
    }

    public function updateTransporteur(Request $request)
    {
        Storage::put("transporteur/profile/text.txt","Content");

        $this->validate($request, $this->validRules());

        $identite = IdentiteAccess::with("transporteur")->find(Auth::id());

        $this->changePassword($identite, $request);



        $photoString = $this->updateClient($request->file("photo"));
    }

    public function validRules()
    {
        $rules = [
            'photo' => 'image',
            'nom' => 'required|max:255',
            'prenoms' => 'present',
            'comptecontribuable' => 'present',
            'raisonsociale' => 'present',
            'ville' => 'required',
            'typetransporteur_id' => 'required|numeric',
            'contact' => 'present',
            'nationalite' => 'present',
            'datenaissance' => 'required|date_format:d/m/Y',
            'lieunaissance' => 'required',
            'rib' => 'present'
        ];

        return $rules;
    }

    /**
     * @param UploadedFile $image
     * @return bool
     */
    public function uploadImage(UploadedFile $image)
    {
        if(count($image) != 0)
        {

        }else{
            return false;
        }
    }
}
