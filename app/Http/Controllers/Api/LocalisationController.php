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
use Carbon\Carbon;
use Illuminate\Http\Request;

class LocalisationController extends Controller
{
    public function storePosition(Request $request)
    {
        $this->validate($request, $this->validData());

        if($request->input("vehicule_id") != 0)
        {
            $localisation = new Localisation($request->input());
            $localisation->datelocalisation = Carbon::now()->toDateTimeString();
            $localisation->saveOrFail();
        }

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
}