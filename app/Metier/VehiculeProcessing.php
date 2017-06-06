<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 04/06/2017
 * Time: 22:14
 */

namespace App\Metier;


use App\Services\Statut;
use App\Transporteur;
use App\Vehicule;

trait VehiculeProcessing
{
    public function createVehicule(Transporteur $transporteur, array $data)
    {
        $vehicule = new Vehicule([
            "immatriculation" => $data["immatriculation"],
            "capacite" => $data["capacite"],
            "chauffeur" => $data["chauffeur"],
            "telephone" => $data["telephone"],
            "statut" => Statut::TYPE_VEHICULE.Statut::ETAT_ACTIF.Statut::AUTRE_NON_NULL,
            "typecamion_id" => $data["typecamion_id"],
        ]);

        $vehicule->transporteur()->associate($transporteur);

        $vehicule->saveOrFail();
    }
}