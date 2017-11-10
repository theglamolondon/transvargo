<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 27/04/2017
 * Time: 22:51
 */

namespace App\Metier;


use App\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait ClientProcessing
{
    protected function validatorClient()
    {
        return  [
            'nom' => 'required|max:255',
            'prenoms' => 'present',
            'raisonsociale' => 'present',
            'contact' => 'required|unique:client,contact',
        ];
    }

    /**
     * @param Client $client
     * @param boolean $grandcompte
     * @return bool
     */
    protected function changerTypeCompte(Client $client, $grandcompte)
    {
        $client->grandcompte = $grandcompte;
        $client->valid_by = Auth::user()->id;
        $client->dategrandcompte = Carbon::now()->toDateTimeString();

        return $client->saveOrFail();
    }

    protected function getExpediteur($champs = null,$conditions = null,$value = null)
    {
        $clients = Client::with('identiteAccess')->orderBy('datecreation','asc');

        if($champs)
            $clients->where($champs, $conditions, $value);

        return $clients->paginate(30);
    }

    /**
     * @param $tofind string
     * @param $clientCollection mixed
     */
    protected function retrivingClients($tofind, &$clientCollection)
    {
        $clientCollection = Client::join('identiteaccess','identiteaccess.id','=','client.identiteaccess_id')
            ->where(DB::raw("concat(nom,prenoms,contact,email) "), 'like' ,"%$tofind%")
            //->toSql();
            ->paginate(30);
    }
}