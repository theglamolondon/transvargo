<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 27/04/2017
 * Time: 22:51
 */

namespace App\Metier;


use App\Services\Statut;
use App\Work\Tools;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

trait ClientProcessing
{
    private function activateCheck()
    {
        if (Auth::user()->statut == Statut::create(Statut::TYPE_IDENTITE_ACCESS , Statut::ETAT_ACTIF , Statut::AUTRE_NON_CONFRIME))
            return false;
        else
            return true;
    }
}