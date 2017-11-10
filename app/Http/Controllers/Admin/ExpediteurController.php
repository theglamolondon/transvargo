<?php

namespace App\Http\Controllers\Admin;

use App\Metier\ClientProcessing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpediteurController extends Controller
{
    use ClientProcessing;

    public function showExpediteursListe(Request $request)
    {
        $this->retrivingClients("", $clients);
        //dd($clients);
        return view('staff.expediteurslist', compact("clients"));
    }
}
