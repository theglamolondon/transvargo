<?php

namespace App\Http\Controllers\Api;

use App\Expedition;
use App\Metier\ExpeditionProcessing;
use App\Services\Statut;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChargementController extends Controller
{
    use ExpeditionProcessing;

    public function startChargement($transporteur, $reference, Request $request)
    {
        try{
            $expedition = Expedition::where('reference',$reference)->firstOrFail();
            $expedition->statut = Statut::create(Statut::TYPE_EXPEDITION, Statut::ETAT_EN_COURS, Statut::AUTRE_NON_NULL);

            return response()->json([""]);

        }catch (ModelNotFoundException $e){
            return response()->json(["message" => "Ce chargement n'existe pas votre liste."], 400);
        }
    }
}
