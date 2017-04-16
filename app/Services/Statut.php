<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 12/04/2017
 * Time: 08:35
 */

namespace App\Services;


class Statut
{
    const TYPE_IDENTITE_ACCESS = 1;
    const TYPE_EXPEDITION = 2;
    const ETAT_ACTIF = 1;
    const ETAT_INACTIF = 2;
    const AUTRE_NON_NULL = 0;

    public static function create($type, $etat, $autre = self::AUTRE_NON_NULL){
        return $type.$etat.$autre;
    }

    public function getStringFromCode($code){
        //$type = strpos($code,);
    }
}