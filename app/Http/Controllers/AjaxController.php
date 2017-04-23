<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 23/04/2017
 * Time: 17:06
 */

namespace App\Http\Controllers;


use App\Metier\MapProcessing;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    use MapProcessing;

    public function getDistanceMatrix(Request $request){
        return $this->getDataFromGoogleMatrixAPI(urlencode($request->input('from')),urlencode($request->input('to')),"&units=imperial");
    }
}