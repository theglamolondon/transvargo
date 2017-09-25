<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateProfileController extends Controller
{

    public  function getViewTransporteurProfile()
    {
        return view("carrier.compte");
    }

    public function updateTransporteur(Request $request)
    {
        dd($request);
    }
}
