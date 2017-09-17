<?php

namespace App\Http\Controllers\Api;

use App\Metier\ExpeditionProcessing;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class OffreController extends Controller
{
    use ExpeditionProcessing;

    public function liste()
    {
        return response()->json($this->getOffers()->get(),200,[],JSON_UNESCAPED_UNICODE);
    }

    public function acceptOffre(Request $request)
    {
        try{
            $this->accept($request);
        } catch (ModelNotFoundException $e ){
            return response()->json(["message" => $e->getMessage()],500);
        }

        return
                response()->json([
                    "message" => Lang::get('message.expedition.accept',['reference' => $request->input('reference')]),
                ]);
    }
}
