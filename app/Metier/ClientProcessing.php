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
    protected function validatorClient()
    {
        return  [
            'nom' => 'required|max:255',
            'prenoms' => 'present',
            'raisonsociale' => 'present',
            'contact' => 'required|unique:client,contact',
        ];
    }
}