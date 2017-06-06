<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 01/06/2017
 * Time: 18:01
 */

namespace App\Metier;


use App\ChauffeurPatron;
use App\Events\TransporteurCreate;
use App\IdentiteAccess;
use App\Services\Statut;
use App\Transporteur;
use App\TypeIdentitite;
use App\TypeTransporteur;
use App\Work\Tools;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

trait TransportProcessing
{
    private function validatorTransporteur()
    {
        return [
            'nom' => 'required|max:255',
            'prenoms' => 'present',
            'comptecontribuable' => 'present',
            'raisonsociale' => 'present',
            'ville' => 'required',
            'typetransporteur_id' => 'required|numeric',
            'contact' => 'present',
            'nationalite' => 'present',
            'datenaissance' => 'required|date_format:d/m/Y',
            'lieunaissance' => 'required',
            'rib' => 'present'
        ];
    }

    private function extractData(array $data)
    {
        return [
            'nom' => $data['nom'],
            'prenoms' => $data['prenoms'],
            'raisonsociale' => $data['raisonsociale'],
            'comptecontribuable' => $data['comptecontribuable'],
            'ville' => $data['ville'],
            'contact' => $data['contact'],
            'nationalite' => $data['nationalite'],
            'lieunaissance' => $data['lieunaissance'],
            'datenaissance' => Carbon::createFromFormat('d/m/Y',$data['datenaissance'])->toDateString(),
            'typetransporteur_id' => $data['typetransporteur_id'],
        ];
    }

    private function createTransporteur(array $data,IdentiteAccess $identite){

        $transporteur = new Transporteur($this->extractData($data));
        $transporteur->identiteAccess()->associate($identite);

        $transporteur->datecreation = Carbon::now()->toDateTimeString();
        $transporteur->rib = 'N/D';

        if($data['typetransporteur_id'] == TypeTransporteur::TYPE_CHAUFFEUR_PATRON)
            $transporteur->limite = Transporteur::LIMITE_CHAUFFEUR_PATRON;

        $transporteur->saveOrFail();

        $identite->setAuthenticable($transporteur);

        return $identite;
    }

    protected function getTransporteur($champs = null,$conditions = null,$value = null)
    {
        $carrier = Transporteur::with('typeTransporteur','identiteAccess')->orderBy('datecreation','asc');

        if($champs)
            $carrier->where($champs, $conditions, $value);

        return $carrier->paginate(30);
    }

    protected function getTransporteurByActivateTokenField($token)
    {
        list($date,$email) = explode('|',base64_decode($token));

        return Transporteur::with('typeTransporteur')
            ->join('identiteaccess','identiteaccess.id','=','transporteur.identiteaccess_id')
            ->where('email',$email)
            ->firstOrNew([]);
    }

    protected function validChauffeurPatron()
    {
        return [
            "nomprenomsU1" => "required",
            "professionU1" => "required",
            "contactU1" => "required",
            "localisationU1" => "required",
            "observationU1" => "present",
            "nomprenomsU2" => "required",
            "professionU2" => "required",
            "contactU2" => "required",
            "localisationU2" => "required",
            "observationU2" => "present",
        ];
    }

    protected function saveChauffeurPatron(Transporteur $transporteur, array $data)
    {
        $patron = new ChauffeurPatron([
            "nomprenomsU1" => $data["nomprenomsU1"],
            "professionU1" => $data["professionU1"],
            "contactU1" => $data["contactU1"],
            "localisationU1" => $data["localisationU1"],
            "observationU1" => $data["observationU1"],
            "nomprenomsU2" => $data["nomprenomsU2"],
            "professionU2" => $data["professionU2"],
            "contactU2" => $data["contactU2"],
            "localisationU2" => $data["localisationU2"],
            "observationU2" => $data["observationU2"],
        ]);
        $patron->transporteur()->associate($transporteur);

        $patron->saveOrFail();
    }

    protected function validateVehicule()
    {
        return [
            "immatriculation" => "required|unique:vehicule|regex:/^([0-9]{4}[a-zA-Z]{2}[0-2]{2})$/g",
            "capacite" => "required|numeric",
            "chauffeur" => "required",
            "telephone" => "required|regex:/^([0-9]{2}\\s?){4}$/g",
            "typecamion_id" => "required|numeric|exist:typecamion",
        ];
    }
}