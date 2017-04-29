<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 27/04/2017
 * Time: 22:51
 */

namespace App\Metier;


trait ClientProcessing
{
    public function validatorRules()
    {
        return [
            'datechargement' => 'required|date_format:d/m/Y',
            'coordarrivee' => 'required',
            'lieuarrivee' => 'required',
            'coorddepart' => 'required',
            'lieudepart' => 'required',
            'prix' => 'required|numeric',
            'typecamion_id' => 'required|numeric',
            'masse' => 'required|numeric',
        ];
    }
}