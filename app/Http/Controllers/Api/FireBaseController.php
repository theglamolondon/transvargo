<?php

namespace App\Http\Controllers\Api;

use App\Vehicule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FireBaseController extends Controller
{
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
