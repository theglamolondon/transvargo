<?php

namespace App\Listeners;

use App\Events\NewExpedition;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpeditionListener
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
     * @param  NewExpedition  $event
     * @return void
     */
    public function handle(NewExpedition $event)
    {
        Log::info("Nouvelle expédition de transport de marchandise créée");
    }
}
