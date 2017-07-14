<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 30/06/2017
 * Time: 15:42
 */

namespace App\Work\Money;


class PayementException extends \Exception
{
    const INITIALISATION_FAILED = 001;
    const INSUFFICIENT_FUNDS = 002;
    const ERREUR_CONNECTION = 003;

    public function __construct($code, \Exception $previous = null)
    {
        $message = $this->getMessageFromCode($code);
        parent::__construct($message, $code, $previous);
    }

    private function getMessageFromCode($code){
        return $this->boot()[$code];
    }

    private function boot(){
        return[
            self::INITIALISATION_FAILED => "L'initialisation du moyen de paiement a échoué. Veuillez recommencer SVP.",
            self::INSUFFICIENT_FUNDS => "Nous sommes désolé, votre solde est inférieur au frais d'expédition!",
            self::ERREUR_CONNECTION => "Oups, nous n'arrivons pas à nous connecter à notre partenaire pour le paiement. Veuillez recommencer dans peu de temps SVP.!",
        ];
    }
}