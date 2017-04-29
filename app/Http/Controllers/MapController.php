<?php

namespace App\Http\Controllers;

use App\Metier\MapProcessing;
use Illuminate\Http\Request;

class MapController extends Controller
{
    const API_KEY = 'AIzaSyD78-5HaLmtSDICayCdaP7LNP507F15F1c';
    const COORD_CI_LAT = '7.5450345';
    const COORD_CI_LNG = '-5.240738';

    use MapProcessing;

    public function getGoogleDistanceMatrixInfos(Request $request){
        return response($this->getDataFromGoogleMatrixAPI($request->input('origins'),$request->input('destinations')),200,[
            "Content-type" => "application/json; charset=utf-8"
        ]);
    }
}
