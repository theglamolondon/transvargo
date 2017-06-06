<?php

namespace App\Listeners;

use App\Events\AcceptTransporteur;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AcceptTransporteurListener
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
     * @param  AcceptTransporteur  $event
     * @return void
     */
    public function handle(AcceptTransporteur $event)
    {
        //Envoie de SMS
    }
}
