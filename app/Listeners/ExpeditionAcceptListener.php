<?php

namespace App\Listeners;

use App\Events\AcceptExpedition;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class ExpeditionAcceptListener
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
     * @param  AcceptExpedition  $event
     * @return void
     */
    public function handle(AcceptExpedition $event)
    {
        Log::info('Expedition '.$event->expedition->reference.'acceptée');
    }
}
