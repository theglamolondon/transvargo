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
    const TYPE_VEHICULE = 3;

    //Identité d'accès
    const ETAT_ACTIF = 1;
    const ETAT_INACTIF = 2;
    //Véhicule
    const ETAT_EN_MISSION = 3;
    //Expédition
    const ETAT_PROGRAMMEE = 4;
    const ETAT_EN_COURS = 5;
    const ETAT_LIVREE = 6;
    const ETAT_ANNULEE = 7;

    const AUTRE_NON_NULL = 0;
    const AUTRE_NON_ACCEPTE = 1;
    const AUTRE_ACCEPTE = 2;
    const AUTRE_PAYEE = 3;
    const AUTRE_INITIE = 4;
    const AUTRE_NON_CONFRIME =5;

    public static function create($type, $etat, $autre = self::AUTRE_NON_NULL){
        return $type.$etat.$autre;
    }

    public static function IdentiteActifNonConfirme(){
        return self::TYPE_IDENTITE_ACCESS.self::ETAT_ACTIF.self::AUTRE_NON_CONFRIME;
    }
    public static function IdentiteActifConfirme(){
        return self::TYPE_IDENTITE_ACCESS.self::ETAT_ACTIF.self::AUTRE_NON_NULL;
    }
}