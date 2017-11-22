<?php

namespace App\Http\Controllers\Admin;

use App\Expedition;
use App\IdentiteAccess;
use App\Metier\ClientProcessing;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpediteurController extends Controller
{
    use ClientProcessing;

    public function showExpediteursListe(Request $request)
    {
        $this->retrivingClients("", $clients);
        //dd($clients);
        return view('staff.client.expediteurslist', compact("clients"));
    }

    public function showExpediteurFiche(string $email)
    {
        try{
            $email = base64_decode($email);
            $identite = IdentiteAccess::with('client')->where('email',$email)->firstOrFail();

            $expeditions = Expedition::with('chargement')
                ->where('client_id',$identite->id)
                ->orderBy('dateheurecreation','desc')
                ->paginate(10);

            return view('staff.client.fiche',compact("identite","expeditions"));
           // dd($expeditions, $identite);
        }catch (ModelNotFoundException $e){
            return back()->withErrors("L'expéditeur n'existe pas");
        }
    }
}
