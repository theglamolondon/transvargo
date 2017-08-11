<?php

namespace App\Http\Controllers\Api;

use App\Metier\ExpeditionProcessing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OffreController extends Controller
{
    use ExpeditionProcessing;

    public function liste()
    {
        return response()->json($this->getOffers()->get(),200,[],JSON_UNESCAPED_UNICODE);
    }

    public function accept()
    {

    }
}
