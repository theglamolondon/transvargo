<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    const API_KEY = 'AIzaSyD78-5HaLmtSDICayCdaP7LNP507F15F1c';

    public function getGoogleDistanceMatrixInfos(Request $request){
        return response($this->getDataFromGoogleMatrixAPI($request->input('origins'),$request->input('destinations')),200,[
            "Content-type" => "application/json; charset=utf-8"
        ]);
    }

    //@protected
    private function getDataFromGoogleMatrixAPI($origins, $destinations){
        $GoogleDistanceMatrixURL = "https://maps.googleapis.com/maps/api/distancematrix/json?key=".self::API_KEY."&origins=".$origins."&destinations=".$destinations;

        $target = curl_init($GoogleDistanceMatrixURL);
        curl_setopt($target,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($target,CURLOPT_RETURNTRANSFER,true);

        $resultat = curl_exec($target);

        if($resultat)
            return $resultat;
        else
            throwException(new \Exception('Google Distance Matrix API error'));
    }
}
