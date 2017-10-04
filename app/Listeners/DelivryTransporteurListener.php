<?php

namespace App\Listeners;

use App\Events\DelivryChargement;
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
        logger("SMS envoyé avec le mot de passe OTP : ".$event->expedition->__toString()."| OTP : ".$event->otp);
    }
}
