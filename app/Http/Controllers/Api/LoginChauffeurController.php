<?php

namespace App\Http\Controllers\Api;

use App\Vehicule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginChauffeurController extends Controller
{
    use JtwPassport;

    public function login(Request $request)
    {
        $this->validRequest($request);
        $vehicule = null;
        $token = null;

        try{
            $vehicule = $this->attemptLogin($request->input("immatriculation"), $request->input("telephone"));

            $token = $this->generateToken($vehicule->transporteur->identiteAccess)->__toString();

        }catch (\Exception $e){
            return response(["error" => $e->getCode(), "message" => $e->getMessage()],$e->getCode());
        }

        return response()->json(compact('token', "vehicule"),200,[],JSON_UNESCAPED_UNICODE);
    }

    private function validRequest(Request $request){
        $this->validate($request, [
            "immatriculation" => "required",
            "telephone" => "required"
        ],[
           "immatriculation.required" => "L'immatriculation du véhicule est requise",
           "telephone.required" => "Le numéro de téléphone du véhicule est requise pour l'authentification",
        ]);
    }

    /**
     * @param $login
     * @param $password
     * @return Vehicule
     * @throws \Exception
     */
    private function attemptLogin($immatriculation,$telephone)
    {
        $vehicule = null;
        try{
            $vehicule = Vehicule::with('transporteur.identiteAccess','typeCamion')
                ->where('immatriculation',str_replace(" ","",$immatriculation))
                ->where('telephone',str_replace(" ","",$telephone))
                ->firstOrFail();

        }catch (ModelNotFoundException $e){
            throw new \Exception('Unauthorized',401);
        }

        return $vehicule;
    }
}