<?php

namespace App\Listeners;

use App\Events\DelivryChargement;
use App\Services\Sms\FreeSmsSender;
use App\Services\Sms\Textlocal;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DelivryTransporteurListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DelivryChargement  $event
     * @return void
     */
    public function handle(DelivryChargement $event)
    {
        $number = [ "number" => "+225".$event->expedition->client->contact ];
        $text = sprintf("Bonjour %s, votre expédition %s est sur le point d'être réceptionnée, veuiller saisir le code %s pour le valider",
            $event->expedition->chargement->contactlivraison,
            $event->expedition->reference,
            $event->expedition->chargement->otp);

        try{
            $sms = new Textlocal(null,null);
            $sms->sendSms($number, $text, "Transvargo");
            //FreeSmsSender::sendSMS($event->expedition->telephonelivraison, $text);
        }catch (\Exception $e){
            logger($e->getMessage());
            logger($e->getTraceAsString());
        }
        logger("SMS envoyé avec le mot de passe OTP : ".$event->expedition->__toString()."| OTP : ".$event->expedition->chargement->otp);
    }
}
