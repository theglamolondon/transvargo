<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 23/04/2017
 * Time: 17:08
 */

namespace App\Metier;


use App\Http\Controllers\MapController;

trait MapProcessing
{
    //@protected
    private function getDataFromGoogleMatrixAPI($origins, $destinations, $unit=null){
        $GoogleDistanceMatrixURL = "https://maps.googleapis.com/maps/api/distancematrix/json?".$unit."key=".MapController::API_KEY."&origins=".$origins."&destinations=".$destinations;

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