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
    public function createVehicule(Transporteur $transporteur, array $data, Vehicule $vehicule = null)
    {
        if(!$vehicule){
            $vehicule = new Vehicule($this->extractVehiculeData($data));
            $vehicule->statut = Statut::TYPE_VEHICULE.Statut::ETAT_ACTIF.Statut::AUTRE_NON_NULL;
        }else{
            $vehicule->fill($this->extractVehiculeData($data));
        }

        $vehicule->transporteur()->associate($transporteur);

        $vehicule->saveOrFail();
    }

    protected function extractVehiculeData(array $data)
    {
        return [
            "immatriculation" => strtoupper($data["immatriculation"]),
            "capacite" => $data["capacite"],
            "chauffeur" => $data["chauffeur"],
            "telephone" => $data["telephone"],
            "typecamion_id" => $data["typecamion_id"],
        ];
    }

    /**
     * @param Transporteur $transporteur
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function getVehiculeBuilder(Transporteur $transporteur)
    {
        return Vehicule::with('typeCamion')
            ->where('transporteur_id',$transporteur->identiteaccess_id);
    }
}