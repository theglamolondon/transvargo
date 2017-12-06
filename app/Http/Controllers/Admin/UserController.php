<?php

namespace App\Http\Controllers\Admin;

use App\IdentiteAccess;
use App\Services\Statut;
use App\Staff;
use App\TypeIdentitite;
use App\Work\Tools;
use Dompdf\Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    use UsersProcessing;

    public function ajouter()
    {
        return view("staff.users.nouveau");
    }

    public function create(Request $request)
    {
        $this->validRequest($request);

        try{
            $this->addUserStaff($request->except("_token", "password_confirmation"));
        }catch (\Exception $e){
            logger($e->getMessage());
            logger($e->getTraceAsString());
            return back()->withErrors("Une erreur s'est produite pendant l'enregistrement de l'utilisateur. Vérifier que l'email n'est pas déjà utilisé.");
        }

        return redirect()->route("staff.user.liste")->with(Tools::MESSAGE_SUCCESS, "Nouvel utilisateur ajouté avec succès !");
    }

    private function addUserStaff(array $data)
    {
        $identite = new IdentiteAccess();
        $identite->email = sprintf("%s@transvargo.com", $data["email"]);
        $identite->password = bcrypt($data["password"]);
        $identite->statut = Statut::TYPE_IDENTITE_ACCESS.Statut::ETAT_ACTIF.Statut::AUTRE_NON_NULL;
        $identite->terms = 1;
        $identite->activate_token = base64_encode($identite->email);
        $identite->typeidentite_id = TypeIdentitite::TYPE_STAFF_USER;
        $identite->saveOrFail();

        $staff = new Staff();
        $staff->identiteAcces()->associate($identite);
        $staff->nom = $data['nom'];
        $staff->role = $data['role'];
        $staff->prenoms = $data['prenoms'];
        $staff->raisonsociale = config("app.name", "Transvargo");
        $staff->saveOrFail();
    }

    private function validRequest(Request $request)
    {
        $this->validate($request, [
            "prenoms" => "present",
            "nom" => "required",
            "role" => "required",
            "email" => "required",
            "password" => "required|confirmed"
        ]);
    }

    public function liste(Request $request)
    {
        $utilisateurs = Staff::with("identiteAcces")->paginate(15);

        return view("staff.users.liste", compact("utilisateurs"));
    }

    public function modifier($email)
    {
        $utilisateur = null;
        try{
            $utilisateur = IdentiteAccess::with("staff")->where("email", sprintf("%s@transvargo.com",$email))->firstOrFail();
        }catch (ModelNotFoundException $e){
            return back()->withErrors("L'utilisateur spécifié n'existe pas !");
        }
        return view("staff.users.modifier", compact("utilisateur"));
    }

    public function update(Request $request, $email)
    {
        $this->validate($request, [
            "prenoms" => "present",
            "nom" => "required",
            "role" => "required",
            "email" => "required",
            "statut" => "required|integer",
            "password" => "required_if:change_password,1|confirmed"
        ]);

        $utilisateur = null;
        try{
            $utilisateur = IdentiteAccess::with("staff")->where("email", sprintf("%s@transvargo.com",$email))->firstOrFail();

            $utilisateur->email = sprintf("%s@transvargo.com", $request->input("email"));
            $utilisateur->statut = $request->input("statut");

            if($request->has("change_password"))
            {
                $utilisateur->password = bcrypt($request->input("password"));
            }
            $utilisateur->saveOrFail();

            $utilisateur->staff->nom = $request->input("nom");
            $utilisateur->staff->prenoms = $request->input("prenoms");
            $utilisateur->staff->role = $request->input("role");
            $utilisateur->staff->saveOrFail();

        }catch (ModelNotFoundException $e){
            return back()->withErrors("L'utilisateur spécifié n'existe pas !");
        }
        return redirect()->route("staff.user.liste")->with(Tools::MESSAGE_SUCCESS, "L'uilisateur a été modifié avec succès !");
    }
}
