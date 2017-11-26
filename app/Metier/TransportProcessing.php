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
use App\Vehicule;
use App\Work\Tools;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

trait TransportProcessing
{
    use VehiculeProcessing;

    private function validatorTransporteur()
    {
        return [
            'nom' => 'required|max:255',
            'prenoms' => 'present',
            'comptecontribuable' => 'present',
            'raisonsociale' => 'present',
            'ville' => 'required',
            'typetransporteur_id' => 'required|integer',
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

    /**
     * @param string|null $champs
     * @param string|null $conditions
     * @param string|null $value
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function getTransporteur(string $champs = null, string $conditions = null, string $value = null)
    {
        $carrier = Transporteur::with('typeTransporteur','identiteAccess')->orderBy('datecreation','asc');

        if($champs)
            $carrier->where($champs, $conditions, $value);

        return $carrier->paginate(30);
    }

    /**
     * @param $token
     * @return Transporteur|Model
     */
    protected function getTransporteurByActivateTokenField($token)
    {
        list($date,$email) = explode('|',base64_decode($token));

        return Transporteur::with('typeTransporteur','vehicules')
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

    /**
     * @param Transporteur $transporteur
     * @param array $data
     * @param ChauffeurPatron|null $patron
     */
    protected function saveChauffeurPatron(Transporteur $transporteur, array $data, ChauffeurPatron $patron = null)
    {
        $data = [
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
        ];

        if(!$patron){ //N'existe pas
            $patron = new ChauffeurPatron($data);
        }else{ //Existe
            $patron->fill($data);
        }

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

    public function updateTransporteurAccount(string $token, Request $request)
    {
        $transporteur = $this->getTransporteurByActivateTokenField($token);

        $this->update($transporteur, $request->except("_token"));

        $this->updateTransporteur($transporteur, $request);

        //dd($request->input(), $transporteur);

        return redirect()->route("admin.transporteur.all")->with(Tools::MESSAGE_SUCCESS, Lang::get("message.staff.transporteur.update"));
    }

    protected function update(Transporteur $transporteur, array $data)
    {
        $transporteur->nom = $data["nom"];
        $transporteur->prenoms = $data["prenoms"];
        $transporteur->raisonsociale = $data["raisonsociale"];
        $transporteur->contact = $data["contact"];
        $transporteur->comptecontribuable = $data["comptecontribuable"];
        $transporteur->ville = $data["ville"];
        $transporteur->typetransporteur_id = $data["typetransporteur_id"];
        $transporteur->nationalite = $data["nationalite"];
        $transporteur->datenaissance = Carbon::createFromFormat("d/m/Y",$data["datenaissance"])->toDateString();
        $transporteur->lieunaissance = $data["lieunaissance"];
        $transporteur->rib = $data["rib"];

        $transporteur->saveOrFail();
    }

    private function updateTransporteur(Transporteur $transporteur, Request $request)
    {
        if( $transporteur->typeTransporteur->id == TypeTransporteur::TYPE_CHAUFFEUR_PATRON ){

            $this->validate($request,$this->validChauffeurPatron());

            $this->saveChauffeurPatron($transporteur,$request->except('_token'), $transporteur->extension);

            $data = $request->except('_token');
            $data['chauffeur'] = $transporteur->nom.' '.$transporteur->prenoms;
            $data['telephone'] = $transporteur->contact;
            $this->createVehicule($transporteur, $data, $transporteur->vehicules->first());
        }

        if( $transporteur->typeTransporteur->id == TypeTransporteur::TYPE_PROPRIETAIRE_FLOTTE ){
            DB::begintransaction();
            try{
                $data = null;
                foreach ($request->input('immatriculation') as $k => $v)
                {
                    $data = [
                        "id" => $request->input('id')[$k],
                        "immatriculation" => strtoupper($request->input('immatriculation')[$k]),
                        "capacite" => $request->input('capacite')[$k],
                        "chauffeur" => $request->input('chauffeur')[$k],
                        "telephone" => $request->input('telephone')[$k],
                        "typecamion_id" => $request->input('typecamion_id')[$k],
                    ];

                    if($request->input('id')[$k] == 0 || empty($request->input('id')[$k])){
                        $vehicule = new Vehicule($data);
                        $vehicule->statut = Statut::TYPE_VEHICULE.Statut::ETAT_ACTIF.Statut::AUTRE_NON_NULL;
                        $vehicule->transporteur()->associate($transporteur);
                        $vehicule->save();
                    }else{
                        $vehicule = Vehicule::find($request->input('id')[$k]);
                        $vehicule->fill($data);
                        $vehicule->save();
                    }
                }
            }catch (ModelNotFoundException $e){
                DB::rollback();
                return  back()->withErrors($e->getMessage());
            }catch (\Exception $e){
                DB::rollback();
                return  back()->withErrors($e->getMessage());
            }
            DB::commit();
        }
        return;
    }
}