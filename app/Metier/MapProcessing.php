<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 23/04/2017
 * Time: 17:08
 */

namespace App\Metier;


use App\Expedition;
use App\Http\Controllers\MapController;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

trait MapProcessing
{
    //@protected
    private function getDataFromGoogleMatrixAPI($origins, $destinations, $unit=null){
        $GoogleDistanceMatrixURL = "https://maps.googleapis.com/maps/api/distancematrix/json?"."key=".MapController::API_KEY."&origins=".$origins."&destinations=".$destinations;

        $target = curl_init($GoogleDistanceMatrixURL);
        curl_setopt($target,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($target,CURLOPT_RETURNTRANSFER,true);

        $resultat = curl_exec($target);

        if($resultat)
            return $resultat;
        else
            throw (new \Exception('Google Distance Matrix API error'));
    }

    public function showInitenaireExpedition(string $immatriculation, string $reference)
    {
        try{
            $expedition = Expedition::with("chargement")->where("reference", $reference)->firstOrFail();
            $vehicule = Vehicule::where("immatriculation", $immatriculation)->firstOrFail();

            $positions = $vehicule->localisation()->whereBetween("datelocalisation",[$expedition->dateheureacceptation, $expedition->chargement->dateheurelivraison ?? Carbon::now()->toDateTimeString()])
                ->orderBy("datelocalisation")
                ->select("latitude","longitude","speed","datelocalisation")
                ->get();

            //dd($positions);
            if($positions->count() == 0){
                return back()->withErrors("Aucune position trouvée pour cette expédition");
            }
            return view('staff.map.itineraire', compact("vehicule", "positions", "expedition"));
        }catch (ModelNotFoundException $e){
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return back()->withErrors("Véhicule ou expédition introuvable");
        }
    }
}