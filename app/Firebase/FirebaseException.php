<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 22/02/2017
 * Time: 08:49
 */

namespace App\Firebase;


use Exception;

class FirebaseException extends \Exception
{
    const GOOGLE_API_ERROR = 1000;
    const DEFAULT_ERROR = 0000;

    private $initialMessage;

    public function __construct($message, $code = self::DEFAULT_ERROR, Exception $previous = null)
    {
        $this->initialMessage = $message;
        parent::__construct($message, $code, $previous);
    }

    public function explainError($code = self::DEFAULT_ERROR){
        $error = null;

        switch ($code){
            case self::DEFAULT_ERROR :
                $error = "Une erreur inconnue est survenue";
                break;
            case self::GOOGLE_API_ERROR :
                $error = "Une erreur de connexion avec le serveur a été détecté. ".$this->initialMessage;
                break;
        }

        return $error;
    }

}