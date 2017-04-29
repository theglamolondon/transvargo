<?php

namespace App\Listeners;

use App\Events\TransporteurCreate;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class TransporteurListener
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
     * @param  TransporteurCreate  $event
     * @return void
     */
    public function handle(TransporteurCreate $event)
    {
        Log::info("Email envoyé pour la création d'un professionnel du transport de marchandise");
    }
}
