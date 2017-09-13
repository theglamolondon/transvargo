<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 09/08/2017
 * Time: 09:45
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\IdentiteAccess;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends  Controller
{
    use JtwPassport;

    public function login(Request $request)
    {
        $data = null;

        try{
            $this->validateRequest($request);

            $data = $this->attemptLogin($request->input('email'), $request->input('password'));

            if(! $data)
            {
                throw new \Exception("Le login ou le mot de passe est incorrect",403);
            }

            if($data->transporteur == null)
            {
                throw new \Exception("Votre compte ne vous permet pas de vous connecter comme transporteur",403);
            }

        }catch (\Exception $e){
            return response(["error" => $e->getCode(), "message" => $e->getMessage()],$e->getCode());
        }

        $token = $this->generateToken($data)->__toString();

        return response()->json(compact('data', 'token'),200,[],JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param Request $request
     */
    private function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails())
        {
            throw new \Exception("Le login et mot de passe sont requis",400);
        }
    }


    /**
     * @param $login
     * @param $password
     * @return \App\IdentiteAccess|null|static
     * @throws \Exception
     */
    private function attemptLogin($login,$password)
    {
        $identite = null;
        try{
            $identite = IdentiteAccess::with('transporteur')
                ->where('email',$login)->firstOrFail();

            if(!Hash::check($password, $identite->password))
            {
                throw new \Exception("Le login ou le mot de passe est incorrect",403);
            }

        }catch (ModelNotFoundException $e){
            throw new \Exception('Unauthorized',401);
        }finally{
            return $identite;
        }

    }
}