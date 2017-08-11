<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 09/08/2017
 * Time: 11:24
 */

namespace App\Http\Controllers\Api;


use App\IdentiteAccess;
use Illuminate\Http\Request;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Token;

trait JtwPassport
{

    /**
     * @return Sha256
     */
    private function getSigner()
    {
        return $signer = new Sha256();
    }

    private function getKey()
    {
        return md5('Transvargo-signer');
    }

    /**
     * @param IdentiteAccess $identite
     * @return \Lcobucci\JWT\Token
     */
    public function generateToken(IdentiteAccess $identite)
    {
        $builder = new Builder();
        $signer = $this->getSigner();


        $token = $builder->setIssuer(config('app.url'))
                        ->setAudience('com.transvargo.transvargo')
                        ->setExpiration(time() + 60*60*24*7) //secondes * minutes * heures * jours
                        ->set('email',$identite->email)
                        ->sign($this->getSigner(), $this->getKey())
                        ->getToken();

        return $token;
    }

    protected function validateToken($string)
    {
        $token = $this->getTokenObject($string);

        $this->verifyToken($token);

        if($token->isExpired(new \DateTime('now')))
        {
            throw new \Exception('Votre session a expirée. Veuillez vous reconnecter SVP',412);
        }

        return true;
    }

    protected function verifyToken(Token $token)
    {
        if(!$token->verify($this->getSigner(), $this->getKey()))
        {
            throw new \Exception('Votre jeton de sécurité est invalide',401);
        }

        return true;
    }

    protected function getTokenObject($string)
    {
        $parser = new Parser();

        return $parser->parse($string);
    }

    protected function getAuthorizationHeader(Request $request)
    {
        if(! $request->header('authorization'))
        {
            throw new \Exception("Forbidden",403);
        }

        return explode(" ",$request->header('authorization'))[1]; //;
    }

    public function refreshToken(Request $request)
    {
        $tokenRenew = null;

        try{

            $stringToken = $this->getAuthorizationHeader($request);

            $token = $this->getTokenObject($stringToken);

            $identite = new IdentiteAccess(['email' => $token->getClaim('email')]);

            $tokenRenew = $this->generateToken($identite);

        }catch (\Exception $e){

            return response(["error" => $e->getCode(), "message" => $e->getMessage()],$e->getCode());
        }

        return response([ "token" => $tokenRenew->__toString() ]);
    }
}