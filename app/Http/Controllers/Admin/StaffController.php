<?php

namespace App\Http\Controllers\Admin;

use App\ChauffeurPatron;
use App\IdentiteAccess;
use App\Metier\TransportProcessing;
use App\Metier\VehiculeProcessing;
use App\Services\Statut;
use App\Transporteur;
use App\TypeCamion;
use App\TypeTransporteur;
use App\Vehicule;
use App\Work\Tools;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    use TransportProcessing, VehiculeProcessing;

    public function __construct()
    {
        $this->middleware(['auth','staff']);
    }

    public function showDashboard()
    {
        return view('staff.tableaubord');
    }

    public function showCarriers()
    {
        return $this->performView($this->getTransporteur(),"Tous les transporteurs");
    }

    public function showRecentCarrier()
    {
        return $this->performView($this->getTransporteur('valid_by','=',null),"Transporteurs inscrits non validés");
    }

    private function performView(LengthAwarePaginator $transporteurs, $title)
    {
        return view('staff.transporteur-list',compact("transporteurs","title"));
    }

    public function showValidateFormCarrier($token)
    {
        $transporteur = $this->getTransporteurByActivateTokenField($token);
        $typevehicules = TypeCamion::all();

        if(!$transporteur->exists)
            return back()->withErrors(Lang::get('message.erreur.transporteur.notfound'));

        return view('staff.valid-form',compact("transporteur","typevehicules"));
    }

    public function validTransporteurAccount($token, Request $request)
    {
        $transporteur = $this->getTransporteurByActivateTokenField($token);
        $this->validate($request,$this->validatorTransporteur());

        try{
            $transporteur->valid_by = Auth::user()->id;

            $transporteur->identiteAccess->statut = Statut::create(Statut::TYPE_IDENTITE_ACCESS,Statut::ETAT_ACTIF,Statut::AUTRE_NON_NULL);
            $transporteur->save();

            if( $transporteur->typeTransporteur->id == TypeTransporteur::TYPE_CHAUFFEUR_PATRON ){
                $this->validate($request,$this->validChauffeurPatron());

                $this->saveChauffeurPatron($transporteur,$request->except('_token'));

                $data = $request->except('_token');
                $data['chauffeur'] = $transporteur->nom.' '.$transporteur->prenoms;
                $data['telephone'] = $transporteur->contact;
                $this->createVehicule($transporteur,$data);
            }

            if( $transporteur->typeTransporteur->id == TypeTransporteur::TYPE_PROPRIETAIRE_FLOTTE ){
                DB::begintransaction();
                try{
                    $data = null;
                    foreach ($request->input('immatriculation') as $k => $v)
                    {
                        $data = [
                            "immatriculation" => $request->input('immatriculation')[$k],
                            "capacite" => $request->input('capacite')[$k],
                            "chauffeur" => $request->input('chauffeur')[$k],
                            "telephone" => $request->input('telephone')[$k],
                            "typecamion_id" => $request->input('typecamion_id')[$k],
                        ];
                        $this->createTransporteurProprietaireFlotte($transporteur,$data);
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
        }catch (ModelNotFoundException $e){
            return back()->withErrors($e->getMessage());
        }catch (QueryException $e){
            return back()->withErrors($e->getMessage());
        }catch (\ErrorException $e) {
            return redirect()->route('admin.tableaubord')->withErrors($e->getMessage());
        }

        return redirect()->route('admin.transporteur.recents')->with(Tools::MESSAGE_SUCCESS,Lang::get('message.staff.valid-transporteur',['transporteur' => $transporteur->nom.' '.$transporteur->prenoms]));
    }

    public function createTransporteurProprietaireFlotte(Transporteur $transporteur, array $data)
    {
        Validator::make($data,$this->validateVehicule());

        $this->createVehicule($transporteur, $data);
    }
}