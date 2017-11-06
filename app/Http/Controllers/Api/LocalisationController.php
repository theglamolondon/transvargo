<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 30/10/2017
 * Time: 11:53
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Localisation;
use App\Vehicule;
use Illuminate\Http\Request;

class LocalisationController extends Controller
{
    public function storePosition(Request $request)
    {
        $this->validate($request, $this->validData());

        $localisation = new Localisation($request->input());
        $localisation->saveOrFail();

        return response()->json([
        "message" => "OK"
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }

    private function validData()
    {
        return [
            "latitude" => "required",
            "longitude" => "required",
            "vehicule_id" => "required"
        ];
    }

    public function refreshToken(Request $request)
    {
        $this->validate($request, [
            "id" => "required|integer|exists:vehicule",
            "immatriculation" => "required",
            "firebasetoken" => "required"
        ]);

        $vehicule = Vehicule::where("immatriculation", $request->input("immatriculation"))
            ->where("id", $request->input("id"))
            ->firstOrFail();

        $vehicule->firebasetoken = $request->input("firebasetoken");
        $vehicule->saveOrFail();

        return response()->json([
            "message" => "OK"
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }
}