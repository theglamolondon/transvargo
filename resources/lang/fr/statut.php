<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 29/04/2017
 * Time: 13:29
 */

return [
    \App\Services\Statut::TYPE_IDENTITE_ACCESS.\App\Services\Statut::ETAT_ACTIF.\App\Services\Statut::AUTRE_NON_NULL => 'Compte actif',
    \App\Services\Statut::TYPE_IDENTITE_ACCESS.\App\Services\Statut::ETAT_INACTIF.\App\Services\Statut::AUTRE_NON_NULL => 'Compte inactif',

    \App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_EN_COURS.\App\Services\Statut::AUTRE_NON_NULL => 'En cours',
    \App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_PROGRAMMEE.\App\Services\Statut::AUTRE_NON_NULL => 'Programmée',
    \App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_PROGRAMMEE.\App\Services\Statut::AUTRE_ACCEPTE => 'Programmée (pris en charge)',
    \App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_PROGRAMMEE.\App\Services\Statut::AUTRE_NON_ACCEPTE => 'Programmée (non pris en charge)',
    \App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_ANNULEE.\App\Services\Statut::AUTRE_ACCEPTE => 'Annulée',
    \App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_EN_COURS.\App\Services\Statut::AUTRE_ACCEPTE => 'En cours',
    \App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_PROGRAMMEE.\App\Services\Statut::AUTRE_INITIE => 'Initiée',
    \App\Services\Statut::TYPE_EXPEDITION.\App\Services\Statut::ETAT_LIVREE.\App\Services\Statut::AUTRE_ACCEPTE=> 'Livré',


    \App\Services\Statut::TYPE_VEHICULE.\App\Services\Statut::ETAT_INACTIF.\App\Services\Statut::AUTRE_NON_NULL => 'Véhicule inactif',
    \App\Services\Statut::TYPE_VEHICULE.\App\Services\Statut::ETAT_ACTIF.\App\Services\Statut::AUTRE_NON_NULL => 'Véhicule actif (disponible)',
    \App\Services\Statut::TYPE_VEHICULE.\App\Services\Statut::ETAT_EN_MISSION.\App\Services\Statut::AUTRE_NON_NULL => 'Véhicule en mission',
];