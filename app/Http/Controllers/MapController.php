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
}
